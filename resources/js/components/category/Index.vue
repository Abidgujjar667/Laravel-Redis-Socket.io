<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Categories List</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Categories</li>
                    <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex  align-items-center justify-content-between">
                            <router-link to="/add-category" class="btn btn-info">Add Category</router-link>
                            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="category in filtersearch" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.category_name }}</td>
                                    <td>
                                        <router-link :to="{name: 'edit-category', params:{id:category.id}}" class="btn btn-sm btn-info">Edit</router-link>

                                        <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger text-white">Delete</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->


        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        mounted() {
            if (!User.logedIn()){
                this.$router.push({name:'login'});
            }
        },
        data(){
          return{
              categories:[],
              searchTerm:''
          }
        },
        computed:{
            filtersearch(){
                return this.categories.filter(category => {
                    return category.category_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            getCategories(){
              axios.get('/api/category')
                  .then(res =>{
                      this.categories=res.data;
                      //console.log(res.data);
                  })
                  .catch(err =>{
                      console.log(err);
                  })
          },
            deleteCategory(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/category/'+id)
                            .then(() => {
                                this.categories = this.categories.filter(category => {
                                    return category.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'category'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            }
        },
        created() {
            this.getCategories();
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>