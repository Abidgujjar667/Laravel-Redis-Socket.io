<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h4 class="h4 text-gray-900">Add Employee</h4>
                                        <router-link to="/employee" class="btn btn-info btn-sm">All Employee</router-link>
                                    </div>
                                    <hr>
                                    <form @submit.prevent="onsubmit" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control"  placeholder="Enter Full Name">
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                            </div>
                                            <div class=" col-md-6 form-group">
                                                <label>Email</label>
                                                <input type="email" v-model="form.email" class="form-control"  aria-describedby="emailHelp"
                                                       placeholder="Enter Email Address">
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label>Phone</label>
                                                <input type="text" v-model="form.phone" class="form-control"  placeholder="Enter Phone">
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Salary</label>
                                                <input type="text" v-model="form.salary" class="form-control"  placeholder="Enter Salary">
                                                <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label>Address</label>
                                                <input type="text" v-model="form.address" class="form-control"  placeholder="Enter Address">
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                               <div class="custom-file">
                                                   <label>Photo</label>
                                                   <input type="file" class="form-control" v-on:change="onChange">
                                                   <!--<small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>-->
                                               </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Join Date</label>
                                            <input type="date" v-model="form.joindate" class="form-control"  >
                                            <small class="text-danger" v-if="errors.joindate">{{ errors.joindate[0] }}</small>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>


                                    </form>

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
        name: "create",
        mounted() {
            if (!User.logedIn()){
                this.$router.push({name:'login'});
            }
        },
        data(){
            return{
                form:{
                    name:'',
                    email:'',
                    phone:'',
                    salary:'',
                    address:'',
                    photo:'',
                    joindate:'',
                },

                errors:{}
            }
        },

        methods:{
            onChange(e) {
                var file=e.target.files[0];
                /*if (file.size>1048770){
                    Notification.image_validation();
                }else {
                    let reader=new FileReader();
                    reader.onload=event =>{
                        this.form.photo = event.target.result;
                        console.log(event.target.result);
                    }
                    reader.readAsDataURL(file);
                    this.form.photo = e.target.files[0];
                }*/
                this.form.photo = e.target.files[0];

            },
            onsubmit(){
                axios.post('/api/employee',this.form)
                    .then(res => {
                        if (res.message=='success'){
                            this.$router.push({ name:'add-employee'}).catch(()=>{});
                        }
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
        }
    }
</script>

<style scoped>

</style>