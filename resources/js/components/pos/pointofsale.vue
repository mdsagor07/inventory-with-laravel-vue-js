<template>
  
  <div>

     <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pos Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">
            
           

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Details</h6>
                     <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>  
                </div>
                


            
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#">name</a></td>
                        <td>qty</td>
                        <td>unit</td>
                        <td><span class="badge badge-success">Total</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">delete</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">name</a></td>
                        <td>qty</td>
                        <td>unit</td>
                        <td><span class="badge badge-success">Total</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">delete</a></td>
                      </tr>
                      
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <ul class="list-group">
                    <li  class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                      <strong>20</strong>
                    </li>
                    <li  class="list-group-item d-flex justify-content-between align-items-center">Subtotal:
                      <strong>200$</strong>
                    </li>
                    <li  class="list-group-item d-flex justify-content-between align-items-center">Vat:
                      <strong>20%</strong>
                    </li>
                    <li  class="list-group-item d-flex justify-content-between align-items-center">Total :
                      <strong>300$</strong>
                    </li>
                  </ul>

                      <br> 

        <form >

           <label>Customer Name</label>
          <select class="form-control" v-model="customer_id">
         <option :value="customer.id" v-for="customer in customers">{{customer.name }} </option>
                 
           </select>



           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay">

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due">

          <label>Pay By</label>
          <select class="form-control" v-model="payby">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>  

                </div>
            




              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products </h6>
                 
                </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" 
              aria-selected="true">AllProduct</button>
            </li>

            <li class="nav-item" role="presentation"  v-for="category in categories" :key="category.id">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
               type="button" role="tab"
               aria-controls="profile"
                aria-selected="false" @click="subproduct(category.id)" >{{ category.category_name  }}</button>
            </li>
          
          

          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" 
            aria-labelledby="home-tab">
            
              <div class="card-body">
              
            <input type="text" v-model="searchTerm" class="form-control" style="width: 100%;" placeholder="Search Here">
             <br>

                   <div class="row">
                 <div class="col-lg-3 col-md-3 col-sm-6 col-6" 
                 v-for="product in filtersearch" :key="product.id">

                   <a href="#">
                      <div class="card" style="width: 8.5rem;">
                        <img class="card-img-top" :src="product.image" id="em_photo">
                        <div class="card-body">
                          <h5 class="card-title">{{ product.product_name }}</h5>

                          <td v-if="product.product_quantity>=1">
                            <small class="badge badge-success"> Available {{ product.product_quantity }}</small>

                        </td>
                        <td v-else=" ">
                            <span class="badge badge-danger"> Stock Out</span>
                          
                        </td>
                     
            
                         
                        </div>
                      </div> </a>
                  
                    </div>

                 </div>
            </div>
              </div>
              
            


            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                 
            <input type="text" v-model="getsearchTerm" class="form-control" style="width: 100%;" placeholder="Search Here">
             <br>

                
                   <div class="row">
                 <div class="col-lg-3 col-md-3 col-sm-6 col-6" 
                 v-for="getproduct in getfiltersearch" :key="getproduct.id">

                   <a href="#">
                      <div class="card" style="width: 8.5rem;">
                        <img class="card-img-top" :src="getproduct.image" id="em_photo">
                        <div class="card-body">
                          <h5 class="card-title">{{ getproduct.product_name }}</h5>

                          <td v-if="getproduct.product_quantity>=1">
                            <small class="badge badge-success"> Available {{ getproduct.product_quantity }}</small>

                        </td>
                        <td v-else=" ">
                            <span class="badge badge-danger"> Stock Out</span>
                          
                        </td>
                     
            
                         
                        </div>
                      </div> </a>
                  
                    </div>
                    </div>


         
                  

             </div>
          </div>



              

                </div>
               
              </div>
            </div>

            
          </div>
          <!--Row-->
 
        

        </div>
   
  </div>


</template>



<script type="text/javascript">
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    created(){
    this.allProduct();
    this.allCategory();
    this.allCustomer();
    
    
  } ,


    data(){
      return{
        products:[],
        categories:'',
        getproducts:[],
        getsearchTerm:'',
        searchTerm:'',
        customers:[],

        customer_id: '',
        pay:'',
        due:'',
        payby:'',
        errors:'',
        carts:[],
        vats:''
      }
    },
    computed:{
      filtersearch(){
      return this.products.filter(product => {
         return product.product_name.match(this.searchTerm)
      }) 
      },
       getfiltersearch(){
      return this.getproducts.filter(getproduct => {
       
         return getproduct.product_name.match(this.getsearchTerm)
       }) 
      },
    },
 
  methods:{
    allProduct(){
      axios.get('/api/product/')
      .then(({data}) => (this.products = data))
      .catch()
    },
    allCategory(){
      axios.get('/api/category/')
      .then(({data}) => (this.categories = data))
      .catch()
    },

     allCustomer(){
      axios.get('/api/customer/')
      .then(({data}) => (this.customers = data))
      .catch(console.log(this.errors))
    },


    subproduct(id){
      axios.get('/api/getting/product/'+id)
      .then(({data}) => (this.getproducts = data))
      .catch()
    }
   
  },
  
  
  } 
</script>


<style type="text/css" scoped>
  #em_photo{
    height: 95px;
    width: 130px;
  }
</style>