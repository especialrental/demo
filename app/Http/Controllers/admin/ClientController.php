<?php

namespace App\Http\Controllers\admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
use Datatables;
use DB;
use App\Helpers\Common_helper;

class ClientController extends Controller
{
    public function index(){
        return view("admin.list_client");
    }
    public function create(){
        
        /*$common_lib = new Common_helper(); 
        $price = $common_lib->bark();
        dd($price);*/
        /*$title = str_slug('Awesome Title', '-');
        dd($title);*/
        return view("admin.create_client");

    }
    public function edit($id){
        
        
        $client = ($id > 0)?Client::find($id):array();
        if(empty($client)){
            $request->session()->flash("msg", "Invalid request.");
            return redirect("/dashboard/client_list");
        }
        return view("admin.edit_client",compact('client'));
    } 
    public function clientdata(){
         
        $queryData  = DB::table("fp_clients")
                ->where('status', '<>', 2)
                ->get();

        return Datatables::of($queryData)
                        ->editColumn("image", function($queryData) {
                            $url = asset('/'); 
                            return ($queryData->image)?'<img src="'.$url.'uploads/'. $queryData->image. '" style="width:50px;">':'';
                            
                        })
                        ->editColumn("status", function($queryData) {
                            return ($queryData->status)?'Deactive':'Active';
                        })
                        ->editColumn("action", function($queryData) {
                            
                            $nestedData= array();
                            if ( $queryData->status == 1 ) {
                                $nestedData['status'] = "DeActive";
                                $className =  "fa fa-circle-o";
                            }
                            else {
                                $nestedData['status'] =  "Active";
                                $className =  "fa fa-circle";
                            }  
                            $url = asset('/'); 
                            return '<a href="'.$url.'dashboard/edit_client_data/'.$queryData->id.'" class="btn btn-rounded btn-xs btn-info mb-1 mr-1 btn-edit" data-id="' . $queryData->id . '"><i class="fa fa-pencil"></i></a>'
                                    . '<a href="javascript:" class="btn btn-rounded btn-xs btn-danger mb-1 mr-1 btn-delete" data-id="' . $queryData->id . '"><i class="fa fa-trash"></i></a>'.'<a href="javascript:" onclick="ActivateDeActivateThisRecord(this,\'fp_clients\','.$queryData->id.');" class="btn btn-rounded btn-xs btn-success mb-1 mr-1 btn-active" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="'.$className.'"></i></a>';
                        })
                        ->rawColumns([
                            "action","image"])
                        ->make(true);
    }

    public function save(Request $request){
        //dd($request->all());
        $id = $request->userid;

        $validator = Validator::make(

            array(
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "phone"=>$request->phone,
                "email"=>$request->email,
                "dob"=>$request->dob,
                "gender"=>$request->gender,
                "address_line_1"=>$request->address_line_1,
                "city"=>$request->city,
                "state"=>$request->state,
                "country"=>$request->country,
                "pincode"=>$request->pincode,
                "images"=>$request->upload_image,
                "password"=>$request->password,
                "confirm_password"=>$request->confirm_password
                /*'$request->confirm_password'=>($request->get('same:$request->password'))*/ 
            ),
            array(
                "first_name"=>"required",
                "last_name"=>"required",
                "phone"=>"required|numeric",
                "email"=>"required|email",
                "dob"=>"required",
                "gender"=>"required", 
                "address_line_1"=>"required",
                "city"=>"required",
                "state"=>"required",
                "country"=>"required",
                "pincode"=>"required",
                "images"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "password"=>"required",
                "confirm_password"=>"required",
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            )
            
        );
        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();
        $request->upload_image->move(public_path('images'), $imageName);*/ 
        if ($validator->fails()){

            return redirect("/dashboard/add_client")->withErrors($validator)->withInput();
        }
        
        if($id > 0){
            $client = Client::find($id);
            $action = "updated";
        }
        else{
            $client = new Client;
            $action = "created";
        }
        
        $common_lib = new Common_helper();
        $slug = $common_lib->createSlug($request->first_name,$id,'fp_clients');

        $file = $request->file('upload_image');
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $new_name);
        $client->image = $new_name;
        $client->first_name=$request->first_name;
        $client->last_name=$request->last_name;
        $client->phone=$request->phone;
        $client->email=$request->email;
        $client->dob=$request->dob;
        $client->gender=$request->gender;
        $client->address_line_1=$request->address_line_1;
        $client->city=$request->city;
        $client->state=$request->state;
        $client->country=$request->country;
        $client->pincode=$request->pincode;
        $client->slug=$slug;
        $client->save();
        /*print_r($client->id);
        exit();*/
        if($id > 0){
            /*DB::table('fp_auths')
        ->where('role_id', $request->userid)  
        ->limit(1)  
        ->update(array('email' => $client->email,'password'=>Hash::make($request->password)));*/
        \DB::table('fp_auths') ->where('role_id', $request->userid) ->limit(1) ->update( [ 'email' => $client->email,'password'=>Hash::make($request->password), 'updated_at'=>date('Y-m-d H:i:s') ]);
        }
        else{
            $data = array('role'=>'client','role_id'=>$client->id,'email'=>$request->email,'password'=>Hash::make($request->password),'created_at'=>date('Y-m-d H:i:s'));
        DB::table('fp_auths')->insert($data);
        }
         
        $request->session()->flash("msg", "Client has been $action successfully.");
        return redirect("/dashboard/add_client");
        
    }
    

    public function delete(Request $request) {

        $id = $request->hiddenval;

        $queryData = User::find($id);

        if (isset($queryData->id)) {

            $queryData->delete();

            echo json_encode(array("status" => 1, "message" => "User deleted successfully"));
        } else {
            echo json_encode(array("status" => 0, "message" => "User doesnot exists"));
        }

        die();
    }
}
