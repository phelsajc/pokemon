<template>
    <div>
                        <form class="user" @submit.prevent="update">
                            <h5>&nbsp;</h5>
                            <h5>You have to relogin inorder to see changes.</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" id="fname" placeholder="Enter Fisrt ame" v-model="form.fname">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="lname" placeholder="Enter Last ame" v-model="form.lname">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="bday" placeholder="Enter 2022-10-29" v-model="form.bday">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </form>
                    </div>
</template>

<script type="text/javascript">

    export default {
        created(){
            if(!User.loggedIn()){
                this.$router.push({name: '/'})
            }
        },

        data() {
            return {
                form: {
                    fname: localStorage.getItem('fname'),
                    lname: localStorage.getItem('lname'),
                    bday: localStorage.getItem('bday'),
                    id: localStorage.getItem('user_id'),
                }
            }
        },
        methods: {
            async update() {
                axios.post('/api/trainer-update',this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Registered successfully'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
            }

          
        },
    }
    
</script>

<style>

</style>