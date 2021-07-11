<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form @submit.prevent="onsubmit" >
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" v-model="form.name" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name">
                                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input type="password" v-model="form.password_confirmation" class="form-control" id="exampleInputPasswordRepeat"
                                                   placeholder="Repeat Password">
                                            <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>


                                    </form>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold " >Already have an account?</router-link>
                                    </div>
                                    <div class="text-center">
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

<script>
    export default {
        name: "Register",
        mounted() {
            if (User.logedIn()){
                this.$router.push({name:'home'});
            }
        },
        data(){
            return{
                form:{
                    name:'',
                    email:'',
                    password:'',
                    password_confirmation:''
                },

                errors:{}
            }
        },

        methods:{
            onsubmit(){
                axios.post('/api/auth/register',this.form)
                    .then(res => {
                        if (res.status==200){
                            this.$router.push('/home');
                        }
                        //console.log(res);
                    })
                    .catch(err => {
                        this.errors=err.response.data.errors;
                        Toast.fire({
                            icon: 'warning',
                            title: 'Invalid Email or Password'
                        })

                        //console.log(err);
                    })
            }
        }
    }
</script>

<style scoped>

</style>