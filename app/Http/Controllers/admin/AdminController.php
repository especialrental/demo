<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
use Datatables;
use DB;
use App\Helpers\Common_helper;
use Auth;

class AdminController extends Controller
{
    public function index(){
        return view("admin.list_user");
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function create(){
        
        /*$common_lib = new Common_helper(); 
        $price = $common_lib->bark();
        dd($price);*/
        /*$title = str_slug('Awesome Title', '-');
        dd($title);*/
        return view("admin.create_user");

    }
    public function edit($id){
        
        
        $user = ($id > 0)?User::find($id):array();
        if(empty($user)){
            $request->session()->flash("msg", "Invalid request.");
            return redirect("/dashboard/user_list");
        }
        return view("admin.edit_user",compact('user'));
    } 
    public function userdata(){
         
        $queryData  = DB::table("fp_users")
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
                            return '<a href="'.$url.'dashboard/edit_data/'.$queryData->id.'" class="btn btn-rounded btn-xs btn-info mb-1 mr-1 btn-edit" data-id="' . $queryData->id . '"><i class="fa fa-pencil"></i></a>'
                                    . '<a href="javascript:" class="btn btn-rounded btn-xs btn-danger mb-1 mr-1 btn-delete" data-id="' . $queryData->id . '"><i class="fa fa-trash"></i></a>'.'<a href="javascript:" onclick="ActivateDeActivateThisRecord(this,\'fp_users\','.$queryData->id.');" class="btn btn-rounded btn-xs btn-success mb-1 mr-1 btn-active" title="Active/DeActive" data-status="'.$nestedData['status'].'"><i class="'.$className.'"></i></a>';
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

            return redirect("/dashboard/add_user")->withErrors($validator)->withInput();
        }
        
        if($id > 0){
            $user = User::find($id);
            $action = "updated";
        }
        else{
            $user = new User;
            $action = "created";
        }
        
        $common_lib = new Common_helper();
        $price = $common_lib->createSlug($request->first_name,$id,'fp_users');

        $file = $request->file('upload_image');
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $new_name);
        $user->image = $new_name;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->dob=$request->dob;
        $user->gender=$request->gender;
        $user->address_line_1=$request->address_line_1;
        $user->city=$request->city;
        $user->state=$request->state;
        $user->country=$request->country;
        $user->pincode=$request->pincode;
        $user->slug=$price;
        $user->save();
        /*print_r($user->id);
        exit();*/
        if($id > 0){
            /*DB::table('fp_auths')
        ->where('role_id', $request->userid)  
        ->limit(1)  
        ->update(array('email' => $user->email,'password'=>Hash::make($request->password)));*/
        \DB::table('fp_auths') ->where('role_id', $request->userid) ->limit(1) ->update( [ 'email' => $user->email,'password'=>Hash::make($request->password), 'updated_at'=>date('Y-m-d H:i:s') ]);
        }
        else{
            $data = array('role'=>'user','role_id'=>$user->id,'email'=>$request->email,'password'=>Hash::make($request->password),'created_at'=>date('Y-m-d H:i:s'));
        DB::table('fp_auths')->insert($data);
        }
         
        $request->session()->flash("msg", "User has been $action successfully.");
        return redirect("/dashboard/add_user");
        
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
    public function changePwd(Request $request){
        $user = Auth::user();
        if($request->isMethod('get')){
            return view('auth.passwords.update');
        } else {
            $input = $request->only('current_pwd','new_pwd','cnf_pwd');
    
    		$validator = Validator::make($input, [
    			'current_pwd' => 'required',
    			'new_pwd' => 'required|min:6',
    			'cnf_pwd' => 'required|same:new_pwd',     
    		], [
    			'current_pwd.required' => 'Please Enter Current Password',
    			'new_pwd.required' => 'Please Enter New Password',
    			'new_pwd.min' => 'New Password must be 6 or greater',
    			'cnf_pwd.required' => 'Please Enter Confirm Password',
    			'cnf_pwd.same' => 'Confirm Password Is Not Same As New Password'
    		]);
    		
    		
    		if ( $validator->fails() ) {
    			return back()->withErrors($validator);
    		}
    		$current_password = $user->password;
    		if(Hash::check($input['current_pwd'], $current_password)) {
    			$user->password = Hash::make(trim($input['new_pwd']));
    			$request->session()->put('password',$input['new_pwd']);
    			$user->save(); 
    			return back()->with( array('message' => 'Password Change Successfully')); 
    		} else { 
    			return back()->withErrors( array('notmatch' => 'Please Enter Correct Current Password')); 
    		}
        }
    }
}
