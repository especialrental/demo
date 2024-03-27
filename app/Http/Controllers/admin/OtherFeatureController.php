<?php

namespace App\Http\Controllers\admin;

use App\Model\OtherFeature;
use App\Model\Amenities;
use App\Model\Amenity;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
use Datatables;
use DB;
use App\Helpers\Common_helper;

class OtherFeatureController extends Controller
{
    public function index(){
    	$data['otherfeature']=OtherFeature::orderBy('categoryname', 'asc')->get();
        return view("admin.otherfeature_list",$data);
    }
    public function save(Request $request){
    	//dd($request->all());
        $validator =$request->validate(
            array(
                "name"=>"required",
                 
            ) 
        );

        if($request->fid){
            $feature = OtherFeature::find($request->fid);
        }
        else{
            $feature = new OtherFeature;
        }   
        
        $feature->categoryname=$request->name;
        $feature->description=$request->description;
        
        if($feature->save()){
            return back()->with('message','Other-Feature Add/Update Successfully !');
        }
    }
    public function edit(Request $request){
        //return $request->all();
        if($request->id){
            $feature =OtherFeature::find($request->id);
            return array('status'=>1,'data'=>$feature);
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Something Went Wrong!');
    } 
    public function delete(Request $request){
        //return $request->all();
        if($request->id){
            $feature =OtherFeature::find($request->id);
            if($feature->delete()){
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