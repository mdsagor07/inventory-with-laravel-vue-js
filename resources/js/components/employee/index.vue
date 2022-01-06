<template>




<div  id="search">

    <div>
        <div class="row">
           <router-link class="btn btn-primary ml-3" style="height:35px; width:200px;" to="/store-employee">Add Employee</router-link>

        </div>
    </div>
   

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
         <div>
             <input type="text" v-model="searchTerm" class="form-control mt-4 mb-2  ml-.8" style="width: 100%;" placeholder="Search Here">
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
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr >
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Joining_Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filteredsearch" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td><img :src="employee.photo" alt="photo" id="em_photo"></td>
                        <td>{{ employee.phone }}</td>
                        <td>${{ employee.salary }}</td>
                        <td>{{ employee.joining_date }}</td>
                        <td>
                          <router-link :to="{name:'edit-employee', params:{id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="DeleteEmployee(employee.id)" class="btn btn-sm btn-danger">Delete</a>
                          </td>
                      </tr>
                      
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
<script>
export default {


  created(){
    if(!User.loggedIn())
    this.$router.push({name:'/'})

  },
  
  data(){
      return{
          employees:[],
          searchTerm:'',

      }
  },
  computed:{
    filteredsearch(){

      if(this.searchTerm){
                return this.employees.filter((employee)=>{
                    return employee.phone.match(this.searchTerm);
            })
        }
        
        else{
            return this.employees;
        }
    }

  },
  methods:{ 
      allEmployee(){
          axios.get('/api/employee/')
          .then(({data}) => (this.employees=data))
          .catch()
      },
      DeleteEmployee(id){
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
        
      }

  },
  created(){
      this.allEmployee();
  }

 

}
</script>
<style scoped>
#em_photo{
  height: 40px;
  width: 40px;
}

</style>