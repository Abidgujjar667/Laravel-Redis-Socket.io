<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Update Category</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Category</li>
                    <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <router-link to="/category" class="btn btn-info">All Category</router-link>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="onsubmit" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>Category Name</label>
                                        <input type="text" v-model="form.category_name" class="form-control"  placeholder="Enter Category Name">
                                        <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                    </div>

                                </div>


                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->


        </div>
    </div>
</template>

<script>
    export default {
        name: "Edit",
        mounted() {
            if (!User.logedIn()){
                this.$router.push({name:'login'});
            }
        },
        data(){
            return{
                form:{
                    category_name:'',
                },

                errors:{}
            }
        },

        methods:{
            onsubmit(){
                let id=this.$route.params.id;
                axios.patch('/api/category/'+id,this.form)
                    .then(res => {
                        this.$router.push({ name:'category'}).catch(()=>{});
                        //console.log(res);
                    })
                    .catch(err => {
                        this.errors=err.response.data.errors;
                        Toast.fire({
                            icon: 'warning',
                            title: 'Invalid Data'
                        })

                        //console.log(err);
                    })
            }
        },

        created() {
            let id=this.$route.params.id;
            axios.get('/api/category/'+id)
                .then(res =>{
                    this.form=res.data;
                    //console.log(res);
                })
                .catch(err =>{
                    console.log(err);
                })
        }
    }
</script>

<style scoped>

</style>