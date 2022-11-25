<template>
    <div>        
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Patient List</h1>
          </div>
        </div>
      </div>
    </section>

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>                
              </div>
              <div class="card-body"> <div id="loader" :class="{'d-none': isHidden }"></div>
                <ul class="list-group">
              <button type="button" class="btn btn-sm btn-primary" @click="checkPokemon()">Clear Selection</button>
              <button type="button" class="btn btn-sm btn-success" @click="savePokemon()">Save Pokemon</button>
                    <input type="text" v-model="form.searchTerm2" @change="filterEmployee()" class="form-control to-right" style="width:100%;" placeholder="Search patient here"> 
                    
                      <li class="list-group-item " v-for="(e, index) in filtersearch" :key="e.name">
                        <div class="d-flex w-100 justify-content-between">
                <h1 class="mb-1"> <span class="badge badge-primary"><strong>{{e.name}} </strong></span></h1>
                </div>
                
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox1" :disabled="pokemon_hate.length>=3" :name="e.name+'_opt'" :value="e.name+'_hate'" @click="chooseHate(e.name)">
                  <label class="form-check-label" for="inlineCheckbox1">Hate</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox2" :disabled="pokemon_fav.length>=3" :name="e.name+'_opt'" :value="e.name+'_fav'" @click="chooseFav(e.name)">
                  <label class="form-check-label" for="inlineCheckbox2">Favorite</label>
                </div>
                      </li>
                </ul>
                <br>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    </div>
</template>

<script type="text/javascript">

    export default {
  created() {
        if (!User.loggedIn()) {
              alert(!User.loggedIn())
                this.$router.push({name: '/'})
            }
            
            Notification.success()
            this.allEmployee();
            this.me();
        }, 
        data(){
            
            return {
                hasError: false,
                isHidden: true,
                form: {
                  searchTerm2: null,
                  start: 0
                },
                employees:[],
                searchTerm:'',
                countRecords: 0,
                getdctr: '-',
                utype: User.user_type(),
                token: localStorage.getItem('token'),
              showing: '',
              pokemon_hate: [],
              pokemon_fav:[],
            }
        },
        computed:{
            filtersearch(){
                return this.employees.filter(e => {
                  return e.name.match(this.searchTerm)
                })
            },
            
        },
        methods: {
          chooseHate(id) {
            this.pokemon_hate.push({
                'name':id,
                'status':0
            });
          },
          chooseFav(id) {
            this.pokemon_fav.push({
                'name':id,
                'status':1
            });
          },
          checkPokemon() {
            console.log(this.pokemon_hate[0].name)
            console.log(this.pokemon_hate[1].name)
            console.log(this.pokemon_hate[2].name)

            
            console.log(this.pokemon_fav[0].name)
            console.log(this.pokemon_fav[1].name)
            console.log(this.pokemon_fav[2].name)
          },

          
          savePokemon(){
                axios.post('/api/store-pokemon',{                  
                  pokemon_hate: this.pokemon_hate,       
                  pokemon_fav: this.pokemon_fav,
                  user: User.user_id(),
                })
                .then(res => {
                    Notification.success()
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved successfully'
                    })
                   // this.$router.push({name: 'all_employee'});
                })
                .catch(error => this.errors = error.response.data.errors)
            },

            allEmployee(){
              this.isHidden =  false        
                //axios.get('/api/employee')
                axios.get('https://pokeapi.co/api/v2/pokemon/')
                .then(({data}) => (this.employees = data.results,/*  ,this.countRecords =data[0].count,this.showing = data[0].showing, */
              this.isHidden =  true  ))
                .catch()
            },
            me(){                
                axios.post('/api/auth/me','',{
                    headers: {
                      //"Content-Type": "application/x-www-form-urlencoded",
                      Authorization: "Bearer ".concat(this.token),
                      Accept: "application/jsons",
                    }
                  })
                  .then(res => {
                    console.log(res)
                })
              .catch(error => this.errors = error.response.data.errors)

            },
            pdf(){
                /* axios.get('/pdf')
                .then(({data}) => (
                    console.log(data)
                ))
                .catch() */
                window.open("/api/pdf", '_blank');
            },
          async  check_doctors_detail(id) {   
            return await axios.get( '/api/check_doctors_detail/'+id)
              .then(response => {
                setTimeout(function() {
                  return response.data;
                }, 3000);

              })
             /*  .then((response) => {  
                return  Promise.resolve(response.data); }) */

            },
          /* async  check_doctors_detail(id) {   
             return await axios.get( '/api/check_doctors_detail/'+id)
            }, */
            formatDate(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' }
                return new Date(date).toLocaleDateString('en', options)
            },
            deleteRecord(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/api/employee/'+id)
                        .then(() => {
                            this.employees = this.employees.filter(e => {
                                return e.id != id
                            })
                        })
                        .catch(() =>{
                            //this.$router.push({name: 'all_employee'})
                            this.$router.push("/all_employee").catch(()=>{});
                        })

                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            },
            filterEmployee(){                   
                this.employees = []
                this.countRecords = null
              this.form.start = 0
              this.isHidden =  false
                //axios.post('/api/filterEmployee',this.form)
                axios.post('/api/patientEmployee',this.form)
                
                .then(res => {
                  this.employees = res.data[0].data
                  this.countRecords =res.data[0].count 
                  console.log(res.data.data)
                  this.isHidden =  true
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            getPageNo(id){
              this.form.start = (id-1) * 10
              this.isHidden =  false
            
              axios.post('/api/patientEmployee',this.form)
                .then(res => {
                  this.employees = res.data[0].data
                  this.countRecords =res.data[0].count 
                  this.showing = res.data[0].showing,
                  console.log(res.data[0])
                  this.isHidden =  true
            
              })
              .catch(error => this.errors = error.response.data.errors)
            },
        },
        /* mounted () {
          axios.get('/api/check_doctors_detail/'+id)
              .then(response => (this.getdctr = response))
        }, */
        /* created(){
            this.allEmployee();
        } */
    }
    
</script>

<style>
    .em_photo{
        height: 40px;
        width: 40px;
    }

    .to-right{
      float: right;
    }

    .spin_center{
      position: absolute;
      top: 50%;
      left: 50%;
      width: 300px;
      text-align:center;
      transform: translateX(-50%);
      /*display: none;*/
    }

    .spin_center2{
      top: 50%;
      left: 50%;
      width: 300px;
      text-align:center;
      transform: translateX(-50%);
      /*display: none;*/
    }

    .btn-app {
      height: unset !important;
      padding: 0 1.5em 0 1.5em;
  }
</style>

<style>
  /* Center the loader */
  #loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 120px;
    height: 120px;
    margin: -76px 0 0 -76px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }
  
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  /* Add animation to "page content" */
  .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
  }
  
  @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 } 
    to { bottom:0px; opacity:1 }
  }
  
  @keyframes animatebottom { 
    from{ bottom:-100px; opacity:0 } 
    to{ bottom:0; opacity:1 }
  }
  
  #myDiv {
    display: none;
    text-align: center;
  }
  </style>