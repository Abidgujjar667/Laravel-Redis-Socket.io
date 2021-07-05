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
                                        <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <a href="index.html" class="btn btn-primary btn-block">Forget</a>
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
                                            <router-link to="/" class="font-weight-bold " >Back to login!</router-link>
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
        name: "Login"
    }
</script>

<style scoped>

</style>