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
              <div class="card-body">
                <div id="loader" :class="{'d-none': isHidden }"></div>
                <ul class="list-group">
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="checkPokemon()"
                  >
                    Clear Selection
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-success"
                    @click="savePokemon()"
                  >
                    Save Pokemon
                  </button>
                  <input
                    type="text"
                    v-model="searchPokemon"
                    @change="filterPokemon()"
                    class="form-control to-right"
                    style="width: 100%"
                    placeholder="Search patient here"
                  />

                  <li
                    class="list-group-item"
                    v-for="(e, index) in filtersearch"
                    :key="e.name"
                  >
                    <div class="d-flex w-100 justify-content-between">
                      <h1 class="mb-1">
                        <span class="badge badge-primary"
                          ><strong>{{e.name}} </strong></span
                        >
                      </h1>
                    </div>

                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        id="inlineCheckbox1"
                        :disabled="pokemon_hate.length>=3"
                        :name="e.name+'_opt'"
                        :value="e.name+'_hate'"
                        @click="chooseHate(e.name)"
                      />
                      <label class="form-check-label" for="inlineCheckbox1"
                        >Hate</label
                      >
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        id="inlineCheckbox2"
                        :disabled="pokemon_fav.length>=3"
                        :name="e.name+'_opt'"
                        :value="e.name+'_fav'"
                        @click="chooseFav(e.name)"
                      />
                      <label class="form-check-label" for="inlineCheckbox2"
                        >Favorite</label
                      >
                    </div>
                  </li>
                  <!-- <nav aria-label="Page navigation example" class="to-right">
                        <ul class="pagination">
                          <li class="page-item" v-for="(e, index) in this.countRecords" ><a class="page-link" @click="getPageNo(index+25)" href="#">{{index+1}}</a></li>
                        </ul>
                      </nav> -->
                </ul>
                <br />
                <!--             <nav aria-label="Page navigation example">  
  <ul class="pagination justify-content-end">
                          <li class="page-item" v-for="(e, index) in this.countRecords_stat" v-if="page_count<=this.countRecords"><a class="page-link" @click="getPageNo(index+25)" href="#">{{index+1}}</a></li>
                      
                        </ul>
  </nav> -->

                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item" @click="getPageNo('prev',1)">
                      <a
                        class="page-link"
                        href="javascript:void(0)"
                        aria-label="Previous"
                      >
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li
                      class="page-item"
                      v-for="(e, indexes) in page_count"
                      v-bind:class="{'active': indexes==selectedPage}"
                    >
                      <a
                        class="page-link"
                        @click="getPageNo('page',indexes)"
                        href="javascript:void(0)"
                        >{{indexes+1}}</a
                      >
                    </li>
                    <li class="page-item" @click="getPageNo('next',1)">
                      <a
                        class="page-link"
                        href="javascript:void(0)"
                        aria-label="Next"
                      >
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
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
            this.allPokemons();
        }, 
        data(){
            
            return {
                hasError: false,
                page_count: 10,
                indexes:0,
                isHidden: true,
                form: {
                  searchTerm2: null,
                  start: 0
                },
                selectedPage: 0,
                pokemons:[],
                searchPokemon:'',
                countRecords: 0,
              pokemon_hate: [],
              pokemon_fav:[],
              cnt_pager:0,
              offset: 10,
            }
        },
        computed:{
            filtersearch(){
                return this.pokemons.filter(e => {
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
                })
                .catch(error => this.errors = error.response.data.errors)
            },

            allPokemons(){
              this.isHidden =  false        
                axios.get('https://pokeapi.co/api/v2/pokemon/')
                .then(({data}) => (
                  this.pokemons = data.results,
                  this.countRecords =Math.round(data.count/20) ,
              this.isHidden =  true 
               ))
                .catch()
            },
            
            
            filterPokemon(){                   
                this.pokemons = []
                this.countRecords = null
              this.form.start = 0
              this.isHidden =  false
              let api = ''
              if(this.searchPokemon!=''){
               api =  axios.get('https://pokeapi.co/api/v2/pokemon/'+this.searchPokemon) 
              }else{
               api =  axios.get('https://pokeapi.co/api/v2/pokemon/') 
              }               
                api.then(res => {
                  console.log(res)
              if(this.searchPokemon!=''){
                  this.pokemons.push({
                    'name':res.data.name
                  })
                }else{
                  this.pokemons = res.data.results
                }
                  /* this.pokemons = res.data[0].data
                 */
                  this.countRecords =res.data.count 
                 this.isHidden =  true 
                })
                .catch(error => this.errors = error.response.data.errors)
            },

            getPageNo(type,id){
              //let offset = (id-1) * 10
              this.cnt_pager=this.cnt_pager+id
              if(type=="next"){
                this.selectedPage = this.cnt_pager
                this.offset = this.offset +10
              }else if(type=="prev"){
                this.selectedPage =  this.cnt_pager
                this.offset = this.offset -10
              }
              this.isHidden =  false
                if(this.selectedPage<=10){
                //  this.page_count = 10
                  this.indexes =this.indexes + 10
                }else if(this.selectedPage<=30){
               //   this.page_count = 20
                  this.indexes = this.indexes + 20
                }else if(this.selectedPage<=40){
                 // this.page_count = 30
                  this.indexes = this.indexes + 30
                }
                console.log(this.countRecords)
                console.log(this.indexes)
             axios.get('https://pokeapi.co/api/v2/pokemon?'+'limit='+20+'&offset='+ this.offset) 
                .then(res => {
                  this.pokemons = res.data.results
                  this.countRecords =Math.round(res.data.count/this.indexes)
                  this.isHidden =  true
            
              })
              .catch(error => this.errors = error.response.data.errors)
            },
        },
    }
    
</script>
