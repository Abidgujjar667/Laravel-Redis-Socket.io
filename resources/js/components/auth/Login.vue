<template>
    <!-- Login Content -->
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-12">
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
                                            <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <hr>
                                        <!--<a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>-->
                                    </form>

                                    <div class="text-center">
                                        <div class="d-flex justify-content-between">
                                            <router-link to="/forget" class="font-weight-bold text-warning" >Forget Password!</router-link>
                                            <router-link to="/register" class="font-weight-bold " >Create an Account!</router-link>
                                        </div>
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
    <!-- Login Content -->
</template>

<script>
    export default {
        name: "Login",
        mounted() {
           if (User.logedIn()){
               this.$router.push({name:'home'});
           }
        },
        data(){
            return{
                form:{
                    email:'',
                    password:''
                },

                errors:{}
            }
        },
        methods:{
            login(){
                axios.post('/api/auth/login',this.form)
                    .then(res => {
                        User.responseAfterLogin(res);
                        Toast.fire({
                            icon: 'success',
                            title: 'Signed in successfully'
                        });
                        this.$router.push({ name:'home' });
                        //console.log(res.data);
                    })
                    .catch(err => {
                        this.errors=err.response.data.errors;
                        Toast.fire({
                            icon: 'warning',
                            title: 'Invalid Email or Password'
                        })
                    })
            }
        }
    }
</script>

<style scoped>

</style>