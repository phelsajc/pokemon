<template>
    <div>
        <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
            <div class="card-body p-0">
                <div class="row">
                <div class="col-lg-12">
                    <div class="login-form">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" @submit.prevent="login">
                        <div class="form-group">                          
                            <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" v-model="form.username">
                            <small class="text-danger" v-if="errors.username">{{ errors.username[0] }}</small>
                        </div>
                        <div class="form-group">                       
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" v-model="form.password">
                            <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small> </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <hr>
                    </form>
                    <hr>
                        <div class="text-center">
                            <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script type="text/javascript">

    export default {
        created(){
            if(User.loggedIn()){
                this.$router.push({name: 'home'})
            }
        },

        data() {
            return {
                form: {
                    username: null,
                    password: null,
                },
                errors:{}
            }
        },
        methods: {
            async login() {
                await axios.post('/api/auth/login',this.form)
                    .then(res => {
                    
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                    //this.$router.push({name: 'home'})
                    
                    //this.$router.push({ name: 'all_employee' })
                    location = "/all_pokemon"
                })
                .catch(error => this.errors = error.response.data.errors)
                .catch(
                    Toast.fire({
                        icon: 'warning',
                        title: 'User Not Found!'
                    }),

                    console.log(this.errors)
                )
            }
        },
    }
    
</script>

<style>

</style>