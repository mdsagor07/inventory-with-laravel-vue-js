<template>
  
  <div>

 <div class="row">
  <router-link to="/store-customer" class="btn btn-primary">Add Customer </router-link>
   
 </div>
<br>
   <!-- <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here"> -->


<br>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                </div>
                <div class="table-responsive">
                  <table id="myTable2" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    

                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->


   
  </div>


</template>



<script type="text/javascript">


import $ from 'jquery';



import  'datatables.net/js/jquery.dataTables.min.js'
import 'datatables.net-dt/js/dataTables.dataTables.min.js'
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    data(){
      return{
        customers:[],
        searchTerm:''
      }
    },
   
 
  methods:{
    allCustomer(){
      axios.get('/api/customer/')
      .then(({data}) => (this.customers = data))
      .catch()
    },
  deleteCustomer(id){
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
                axios.delete('/api/customer/'+id)
               .then(() => {
                this.customers = this.customers.filter(customer => {
                  return customer.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'customer'}) 
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
  created(){
    // this.allCustomer();


    $(document).ready(function() {
    
       $('#myTable2').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "api/customer",
                buttons: [
              'copy', 'excel', 'pdf'
                 ],
                "columns": [
              
                {data: 'name', name: 'name'},   
                
                 { data: 'photo', name: 'photo',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"" + data + "\" height=\"45\"/>";
                    }
                },   
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                
                {data: 'address', name: 'address'},
            
                
               
                  {
              data: 'id',name: 'action',
              render: function(data){
                let btn;
                
                         btn='<router-link :to="{name: edit-employee, params:{id:'+data+'}}" class="btn btn-sm btn-primary">Edit</router-link>';
                         btn= btn+ '<button  id="btn"   class="edit btn btn-danger btn-sm m-2">Delete</button>';
                        return btn;
                        
                        
             },
             
          },

          

                    
                ]
            });


})

    
  } 
  
  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>