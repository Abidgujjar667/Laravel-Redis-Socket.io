<template>
    <div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h4 class="h4 text-gray-900 ">All Employee</h4>
                                        <router-link to="/add-employee" class="btn btn-info btn-sm">Add Employee</router-link>
                                    </div>
                                    <hr>

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
        name: "create",
        mounted() {
            if (!User.logedIn()){
                this.$router.push({name:'login'});
            }
        },

        methods:{

        }
    }
</script>

<style scoped>

</style>