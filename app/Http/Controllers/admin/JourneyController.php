<?php







namespace App\Http\Controllers\admin;







use Illuminate\Http\Request;



use Hash;



use App\Http\Controllers\Controller;



use Validator;

use App\Model\Journey;

use DB;



use App\Helpers\Common_helper;



use Yajra\DataTables\Facades\DataTables; 







class JourneyController extends Controller



{



    public function index(){

    	

        return view("admin.journey");

    }

    public function save(Request $request){

        //dd($request->name);

        $validator =$request->validate(

            array(
                "name"=>"required",
            ) 

        );

      

        if($request->jId){

            $journey = Journey::find($request->jId);
            
        }

        else{

            $journey = new Journey;
             
        }   

        $journey->city=$request->name;
        $file = $request->file('upload_image');
        if ($file !== null) {
        
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/journey'), $new_name);
        $journey->image = $new_name;
        }

        if($journey->save()){

            return back()->with('message',' Add/Update Successfully !');

        }

    }
    public function list(){
        $data['journey'] = Journey::paginate(10);
        //dd($data);
        return view("admin.list_journey",$data);
    }

    public function edit(Request $request,$id){

    	$data['journey'] = Journey::Where('id','=',$id)->first();
    	 return view("admin.journey",$data);

    }

    public function delete(Request $request){

        //return $request->all();

        if($request->id){

            $journey =Journey::find($request->id);

            if($journey->delete()){

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