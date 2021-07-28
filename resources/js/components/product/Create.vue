<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Product</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <router-link to="/product" class="btn btn-info">All Products</router-link>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="onsubmit" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>Product Name</label>
                                        <input type="text" v-model="form.product_name" class="form-control"  placeholder="Enter Product Name">
                                        <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Product Code</label>
                                        <input type="text" v-model="form.product_code" class="form-control"  aria-describedby="emailHelp"
                                               placeholder="Enter Product Code">
                                        <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>Category</label>
                                        <select v-model="form.category_id" class="form-control">
                                            <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Product Supplier</label>
                                        <select v-model="form.supplier_id"  class="form-control">
                                            <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 form-group">
                                        <label>Product Root</label>
                                        <input type="text" v-model="form.root" class="form-control"  placeholder="Enter Root">
                                        <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Buying Price</label>
                                        <input type="text" v-model="form.buying_price" class="form-control"  aria-describedby="emailHelp"
                                               placeholder="Enter Buying Price">
                                        <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Selling Price</label>
                                        <input type="text" v-model="form.selling_price" class="form-control"  aria-describedby="emailHelp"
                                               placeholder="Enter Selling Price">
                                        <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label>Buying Date</label>
                                        <input type="date" v-model="form.buying_date" class="form-control" >
                                        <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Product Quantity</label>
                                        <input type="text" v-model="form.product_quantity" class="form-control"  aria-describedby="emailHelp"
                                               placeholder="Enter Product Quantity">
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
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
                                            <img :src="form.image" alt="image" style="width:40px; height:40px;">
                                            <!--<small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>-->
                                        </div>
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
        name: "Create",
        mounted() {
            if (!User.logedIn()){
                this.$router.push({name:'login'});
            }
        },
        data(){
            return{
                form:{
                    category_id:'',
                    product_name:'',
                    product_code:'',
                    root:'',
                    buying_price:'',
                    selling_price:'',
                    supplier_id:'',
                    buying_date:'',
                    image:'',
                    product_quantity:'',
                },

                errors:{},
                categories:{},
                suppliers:{},
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
                        this.form.image = event.target.result;
                        //console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                    //this.form.photo = event.target.files[0];
                }


            },
            onsubmit(){
                axios.post('/api/product',this.form)
                    .then(res => {
                        this.$router.push({ name:'product'}).catch(()=>{});
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
            },
        },
        created(){
            axios.get('/api/category/')
                .then(({data}) => (this.categories = data))

            axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))

        }
    }
</script>

<style scoped>

</style>