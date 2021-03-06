<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::all();
        return response()->json($supplier);
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
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers',
   
           ]);


           if($request->photo){
            $position=strpos($request->photo,';');
            $sub=substr($request->photo,0,$position);
            $ext=explode('/',$sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path= 'backend/supplier/';
            $image_url=$upload_path. $name;
            $img->save( $image_url);

            $supplier=new Supplier;
            $supplier->name=$request->name;
            $supplier->email=$request->email;
            $supplier->phone=$request->phone;
            $supplier->address=$request->address;
            $supplier->shopname=$request->shopname;
            $supplier->photo=$image_url;
            
            $supplier->save();

        }else{

            $supplier=new Supplier;
            $supplier->name=$request->name;
            $supplier->email=$request->email;
            $supplier->phone=$request->phone;
            $supplier->address=$request->address;
            $supplier->shopname=$request->shopname;
            
            $supplier->save();
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
        $supplier=Supplier::where('id',$id)->get()->first();
        return response()->json($supplier);
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
        $data = Supplier::find($id);

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->shopname=$request->shopname;
        $data->address=$request->address;
       
        $image=$request->newphoto;
        
        
        if($image){

            $position=strpos($image,';');
            $sub=substr($image,0,$position);
            $ext=explode('/',$sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path= 'backend/supplier/';
         
            $image_url=$upload_path. $name;
            $success=$img->save( $image_url);

            if($success){

                $data['photo']=$image_url;
                $img=Supplier::where('id',$id)->get()->first();
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
        $supplier = Supplier::find($id);
        $photo=$supplier->photo;
        if($photo){
            unlink($photo);
            Supplier::where('id',$id)->delete();
        }else
        {
            Supplier::where('id',$id)->delete();
        }
    }
}
