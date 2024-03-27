<?php



namespace App\Http\Controllers\admin;



use App\Model\Amenities;

use App\Model\Amenity;

use App\Model\SubAmenity;

use Illuminate\Http\Request;

use Hash;

use App\Http\Controllers\Controller;

use Validator;

//use Datatables;

use DB;

use App\Helpers\Common_helper;

use Yajra\DataTables\Facades\DataTables; 



class AmenitiesController extends Controller

{

    public function index(){

        $data['amenity'] = Amenity::orderBy('id', 'asc')->get();

        //dd($data);

        return view("admin.list_aminities",$data);

    }

    

    public function save(Request $request){

        //dd($request->all());

        $validator =$request->validate(

            array(

                "name"=>"required",

                 

            ) 

        );



        if($request->amid){

            $amenity = Amenity::find($request->amid);


        }

        else{

            $amenity = new Amenity;

        }   

        

        $amenity->amen_value=$request->name;
        
        

        if($amenity->save()){

            return back()->with('message','Amenity Add/Update Successfully !');

        }

    }

    public function edit(Request $request){

        //return $request->all();

        if($request->id){

            $amenity =Amenity::find($request->id);

            return array('status'=>1,'data'=>$amenity);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    } 

    public function delete(Request $request){

        //return $request->all();

        if($request->id){

            $amenity =Amenity::find($request->id);

            if($amenity->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }



    public function getSubAmenity(Request $request,$id){

        $data['subamenity']=SubAmenity::where('aid',$id)->orderBy('amenity', 'asc')->get();

        $data['amenity_id']=$id;

        //dd($data);

        return view('admin.subamenities',$data);

    }



    public function save_sub(Request $request){

        //dd($request->all());

        $validator =$request->validate(

            array(

                "name"=>"required",

                 

            ) 

        );



        if($request->samid){

            $samenity = SubAmenity::find($request->samid);

        }

        else{

            $samenity = new SubAmenity;

        }   

        

        $samenity->aid=$request->aid;

        $samenity->amenity=$request->name;
           
        $file = $request->file('upload_subimage');
        if ($file !== null) {
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/amenity'), $new_name);
        $samenity->image = $new_name;
        }
        

        if($samenity->save()){

            return back()->with('message','SubAmenity Add/Update Successfully !');

        }

    }

    public function edit_sub(Request $request){

        //return $request->all();

        if($request->id){

            $samenity =SubAmenity::find($request->id);

            return array('status'=>1,'data'=>$samenity);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Something Went Wrong!');

    } 

    public function delete_sub(Request $request){

        //return $request->all();

        if($request->id){

            $samenity =SubAmenity::find($request->id);

            if($samenity->delete()){

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

