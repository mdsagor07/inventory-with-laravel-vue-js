<template>




<div  id="search">

    <div>
        <div class="row">
           <router-link class="btn btn-primary ml-3 mb-2" style="height:35px; width:200px;" to="/store-employee">Add Employee</router-link>

        </div>
    </div>
   

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
         <div>
             <!-- <input type="text" v-model="searchTerm" class="form-control mt-4 mb-2  ml-.8" style="width: 100%;" placeholder="Search Here"> -->
               </div>
        <div >
          <div >
              
           <div class="row">
                 
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table id="myTable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr >
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Salary(Taka)</th>
                        <th>Joining_Date</th>
                        
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    
                     
                    </tbody>
                  </table>
                </div>
               
              </div>
            </div>
          </div>
          <!--Row-->
          </div>
        </div>
      </div>
    </div>
</div>
</template>
<script type="text/javascript" >
 import jQuery from 'jquery';

 let $ = jQuery;

import  '../../button.js'
import  'datatables.net/js/jquery.dataTables.min.js'
import 'datatables.net-dt/js/dataTables.dataTables.min.js'
import Vue from 'vue'
export default {

 

    
  created(){
    if(!User.loggedIn())
    this.$router.push({name:'/'})
  },

  
  data(){

      return{
          employees:[],
          searchTerm:'',
          data:""
      }
  },
  
  
  
  methods:{ 

      allEmployee(){
          axios.get('/api/employee/')
          .then(({data}) => (this.employees=data))
          .catch()
      },


      draw() {
            $('.btn-delete').on('click', function() {
                alert('delete')
            })
        },

  

      DeleteEmployee(id){
        alert(id);
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              axios.delete('/api/employee/'+id)
              .then(()=> {
                this.employees=this.employees.filter( employee =>{
                  return employee.id !=id
                })
              })
              .catch(()=> {
                this.$router.push({name:'employee'})
              })  
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
        
      },
      
      

      
  },
  
  created(){
      //this.allEmployee();
     
      $(document).ready( function () {

    
           // $.noConflict();
            $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "api/employee",
               
                "columns": [
              
                {data: 'name', name: 'name'},   
                 { data: 'photo', name: 'photo',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"" + data + "\" height=\"45\"/>";
                    }
                },   
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'salary', name: 'salary'},
                {data: 'joining_date', name: 'joining_date'},
               
                  {
              data: 'id',name: 'action',
              render: function(data){
                let btn; 
                  
                
                         btn='<button id="edit-btn" data-id="'+data+'"  class="edit btn btn-info btn-sm m-2">Edit</button>';
                         btn= btn+ '<button  id="btn-delete" data-id="'+data+'"  class="edit btn btn-danger btn-sm m-2">Delete</button>';
                        return btn;
                        
                        
             },
             
          },

          

                    
                ]
            });


                $(document).on('click','#edit-btn',function (e){


                  let id = $(this).attr("data-id");
                 
                  var url = 'employee';
                  url = url.replace('employee', 'edit-employee/'+id);
                  window.location.href = url;
                  Notification.success()

            })
        

       $(document).on('click','#btn-delete',function (e) {
         let id = $(this).attr("data-id");
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              axios.delete('/api/employee/'+id)
              .then(()=> {
                this.employees=this.employees.filter( employee =>{
                  return employee.id !=id
             
                })
              })
              .catch(()=> {
                
                var url = 'employee';
                 //$("#myTable").load(url);
                window.location.href = url;
                //this.$router.push({name:'employee'})
              })  
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
      
        
       })

            
   });

   
  }
 
  }
  
</script>
<style scoped>

</style>