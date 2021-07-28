<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Supplier List</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Supplier</li>
                    <li class="breadcrumb-item active" aria-current="page">All Supplier</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex  align-items-center justify-content-between">
                            <router-link to="/add-supplier" class="btn btn-info">Add Supplier</router-link>
                            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="supplier in filtersearch" :key="supplier.id">
                                    <td>{{ supplier.id }}</td>
                                    <td>{{ supplier.name }}</td>
                                    <td>{{ supplier.phone }}</td>
                                    <td>{{ supplier.shopname }}</td>
                                    <td>{{ supplier.address }}</td>
                                    <td><img :src="supplier.photo" id="em_photo"></td>
                                    <td>
                                        <router-link :to="{name: 'edit-supplier', params:{id:supplier.id}}" class="btn btn-sm btn-info">Edit</router-link>

                                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white">Delete</a>
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
              suppliers:[],
              searchTerm:''
          }
        },
        computed:{
            filtersearch(){
                return this.suppliers.filter(supplier => {
                    return supplier.name.match(this.searchTerm)
                })
            }
        },
        methods:{
          getSuppliers(){
              axios.get('/api/supplier')
                  .then(res =>{
                      this.suppliers=res.data;
                      //console.log(res.data);
                  })
                  .catch(err =>{
                      console.log(err);
                  })
          },
            deleteSupplier(id){
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
                        axios.delete('/api/supplier/'+id)
                            .then(() => {
                                this.suppliers = this.suppliers.filter(supplier => {
                                    return supplier.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'supplier'})
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
            this.getSuppliers();
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>