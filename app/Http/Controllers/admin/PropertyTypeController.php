<?php

namespace App\Http\Controllers\admin;

use App\Model\PropertyType;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
//use Datatables;
use DB;
use App\Helpers\Common_helper;
use Yajra\DataTables\Facades\DataTables;

class PropertyTypeController extends Controller
{
    public function index(){
    	$data['propertytype']=PropertyType::orderBy('categoryname', 'asc')->get();
        return view("admin.propertytype_list",$data);
    }
    public function savePType(Request $request){
    	//dd($request->all());
        $validator =$request->validate(
            array(
                "propertyTypeName"=>"required",
                 
            ) 
        );

        if($request->ptid){
            $type = PropertyType::find($request->ptid);
        }
        else{
            $type = new PropertyType;
        }   
        
        $type->categoryname=$request->propertyTypeName;
        $type->description=$request->description;
        
        if($type->save()){
            return back()->with('message','Property-Type Add/Update Successfully !');
        }
    }
    public function editPType(Request $request){
        //return $request->all();
        if($request->id){
            $type =PropertyType::find($request->id);
            return array('status'=>1,'data'=>$type);
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    } 
    public function deletePType(Request $request){
        //return $request->all();
        if($request->id){
            $type =PropertyType::find($request->id);
            if($type->delete()){
                return array('status'=>1,'data'=>'Record Deleted!');
            }else{
                return array('status'=>0,'data'=>'Record Not Deleted!');
            }
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }
}        