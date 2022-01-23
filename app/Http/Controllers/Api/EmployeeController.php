<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Yajra\Datatables\Datatables;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
         $employee=Employee::all(); 
        // return response()->json($employee);
         return datatables()->of(Employee::all())->toJson();
        // return Datatables::of($employee)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($employee){


        //                    $btn = '<router-link  id="editbtn" data-id="'.$employee->id.'  " class="edit btn btn-info btn-sm m-2">Edit</router-link>';
                           
        //                    $btn = $btn.'<a  onclick="DeleteEmployee('.$employee->id.')"  class="delete btn btn-danger btn-sm m-2">Delete</a>';
         
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
           
        //  'email'=>'required|max:255'|'unique:employees',
        //  'name'=>'required',
        //  'phone'=>'required|max:255'|'unique:employees',
         

        // ]);
        $validateData = $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
   
           ]);

        if($request->photo){
            $position=strpos($request->photo,';');
            $sub=substr($request->photo,0,$position);
            $ext=explode('/',$sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path= 'backend/employee/';
         
            $image_url=$upload_path. $name;
            $img->save( $image_url);

            $employee=new Employee;
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->address=$request->address;
            $employee->salary=$request->salary;
            $employee->nid=$request->nid;
            $employee->photo=$image_url;
            $employee->joining_date=$request->joining_date;
            $employee->save();

        }else{

            $employee=new Employee;
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->address=$request->address;
            $employee->salary=$request->salary;
            $employee->nid=$request->nid;
            
            $employee->joining_date=$request->joining_date;
            $employee->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee=Employee::where('id',$id)->get()->first();
         return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Employee::find($id);

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->salary=$request->salary;
        $data->address=$request->address;
        $data->nid=$request->nid;
        $data->joining_date=$request->joining_date;
        $image=$request->newphoto;
        
        
        if($image){

            $position=strpos($image,';');
            $sub=substr($image,0,$position);
            $ext=explode('/',$sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path= 'backend/employee/';
         
            $image_url=$upload_path. $name;
            $success=$img->save( $image_url);

            if($success){

                $data['photo']=$image_url;
                $img=Employee::where('id',$id)->get()->first();
                $image_path=$img->photo;
                $done=unlink($image_path);
                $data->save();
                

            }
        }
        
        else{
            $oldphoto=$request->photo;
            $data['photo']=$oldphoto;
            $data->save();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $photo=$employee->photo;
        if($photo){
            unlink($photo);
            Employee::where('id',$id)->delete();
        }else
        {
            Employee::where('id',$id)->delete();
        }
    }
}
