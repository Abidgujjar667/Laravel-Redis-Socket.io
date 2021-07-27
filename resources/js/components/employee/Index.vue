<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Employees List</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Employee</li>
                    <li class="breadcrumb-item active" aria-current="page">All Employee</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex  align-items-center justify-content-between">
                            <router-link to="/add-employee" class="btn btn-info">Add Employee</router-link>
                            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Address</th>
                                    <th>Join Date</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in filtersearch" :key="employee.id">
                                    <td>{{ employee.id }}</td>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.address }}</td>
                                    <td>{{ employee.joindate }}</td>
                                    <td><img :src="employee.photo" id="em_photo"></td>
                                    <td>
                                        <!--<router-link :to="{name: 'edit-employee', params:{id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>-->

                                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</a>
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
              employees:[],
              searchTerm:''
          }
        },
        computed:{
            filtersearch(){
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)
                })
            }
        },
        methods:{
          getEmployees(){
              axios.get('/api/employee')
                  .then(res =>{
                      this.employees=res.data;
                      //console.log(res.data);
                  })
                  .catch(err =>{
                      console.log(err);
                  })
          },
            deleteEmployee(id){
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
                        axios.delete('/api/employee/'+id)
                            .then(() => {
                                this.employees = this.employees.filter(employee => {
                                    return employee.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'employee'})
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
            this.getEmployees();
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>