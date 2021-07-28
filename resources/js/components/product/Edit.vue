<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Update Supplier</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Supplier</li>
                    <li class="breadcrumb-item active" aria-current="page">Update Employee</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <router-link to="/supplier" class="btn btn-info">All Supplier</router-link>
                        </div>
                        <div class="card-body">
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
                                        <label>Address</label>
                                        <input type="text" v-model="form.address" class="form-control"  placeholder="Enter Address">
                                        <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-3 form-group">
                                        <div class="custom-file">
                                            <label>Photo</label>
                                            <input type="file" class="form-control" v-on:change="onChange">
                                            <!--<small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="custom-file pt-3 d-flex justify-content-center">
                                            <img :src="form.photo" alt="image" style="width:40px; height:40px;">
                                            <!--<small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>-->
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Shop Name</label>
                                        <input type="text" v-model="form.shopname" class="form-control" placeholder="Enter shop name" >
                                        <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-2">
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
                    name:'',
                    email:'',
                    phone:'',
                    address:'',
                    photo:'',
                    newphoto:'',
                    shopname:'',
                },

                errors:{}
            }
        },

        methods:{
            onChange(event) {
                //console.log(event);
                var file=event.target.files[0];
                if (file.size>1048770){
                    Notification.image_validation();
                }else {
                    let reader=new FileReader();
                    reader.onload=event =>{
                        this.form.newphoto = event.target.result;
                        //console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                    //this.form.photo = event.target.files[0];
                }


            },
            onsubmit(){
                let id=this.$route.params.id;
                axios.patch('/api/supplier/'+id,this.form)
                    .then(res => {
                        this.$router.push({ name:'supplier'}).catch(()=>{});
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
            axios.get('/api/supplier/'+id)
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