<?php



namespace App\Http\Controllers\admin;



use App\Model\Country;

use App\Model\State;

use App\Model\City;

use App\Model\Area;

use Illuminate\Http\Request;

use Hash;

use App\Http\Controllers\Controller;

use Validator;

//use Datatables;

use DB;

use App\Helpers\Common_helper;

use Yajra\DataTables\Facades\DataTables; 



class DestinationController extends Controller

{
    
    public function showCSV(){

        return view("admin.imortcsv");

    }
    
    
    public function updateCityStatus($id)
    {
    	//get product status with the help of product ID
    	$product = DB::table('city')
    				->select('status')
    				->where('id','=',$id)
    				->first();
    
    	//Check user status
    	if($product->status == '1'){
    		$status = '0';
    	}else{
    		$status = '1';
    	}
    
    	//update product status
    	$values = array('status' => $status );
    	DB::table('city')->where('id',$id)->update($values);
    
    	//session()->flash('msg','Product status has been updated successfully.');
    	return back()->with('message','City Status Update Successfully !');
    }

    public function index(){

        $data['countries']=Country::orderBy('country_name', 'asc')->get();

       // dd($data);

        return view("admin.list_country",$data);

    }

    public function stateData(){

       



        $data['state'] = State::leftJoin('country','state.country_id', '=', 'country.id')

        ->select('state.*' ,'country.country_name')
        ->orderBy('country.country_name', 'asc')

        ->get();

        $data['country'] = Country::all();

        //dd($data);   

        return view("admin.state-list",$data);

    }

    public function cityData(){

       



        $data['city'] = DB::table('city')

         ->leftJoin('country','city.country_id', '=', 'country.id')

         ->leftJoin('state','city.sid', '=', 'state.id')

        ->select('city.*' ,'country.country_name','state.state_name')
        ->orderBy('country.country_name', 'asc')

        ->get();

        $data['country'] = Country::all();

        //dd($data);   

        return view("admin.city-list",$data);

    }

    public function areaData(){

       



        $data['area'] = DB::table('area')

         ->leftJoin('country','area.country_id', '=', 'country.id')

         ->leftJoin('state','area.sid', '=', 'state.id')

         ->leftJoin('city','area.cid', '=', 'city.id')

        ->select('area.*' ,'country.country_name','state.state_name','city.city_name')
        ->orderBy('country.country_name', 'asc')

        ->get();

        $data['country'] = Country::all();

        //dd($data);   

        return view("admin.area-list",$data);

    }

    /*Country crud*/

    public function edit(Request $request){

        //return $request->all();

        if($request->id){

            $country =Country::find($request->id);

            return array('status'=>1,'data'=>$country);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    } 

    public function delete(Request $request){

        //return $request->all();

        if($request->id){

            $country =Country::find($request->id);

            if($country->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

    public function save(Request $request){

        $validator =$request->validate(

            array(

                "country_name"=>"required",

            ) 

        );

        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();

        $request->upload_image->move(public_path('images'), $imageName);*/ 

        if($request->cid){

            $country = Country::find($request->cid);

        }

        else{

            $country = new Country;

        }   


        $country->country_name=$request->country_name;

        if($country->save()){

            return back()->with('message','Country Add/Update Successfully !');

        }

    }

    /*End Country Crud*/



    /*Start State Crud*/

    public function saveState(Request $request){

        //dd($request->all());

        $validator =$request->validate(

            array(

                "country_id"=>"required",

                "state"=>"required",

            ) 

        );

        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();

        $request->upload_image->move(public_path('images'), $imageName);*/ 

        if($request->sid){

            $state = State::find($request->sid);

        }

        else{

            $state = new State;

        }   

        

        $state->country_id=$request->country_id;

        $state->state_name=$request->state;

        if($state->save()){

            return back()->with('message','State Add/Update Successfully !');

        }

    }

    public function editState(Request $request){

        //return $request->all();

        if($request->id){

            $state = State::find($request->id);

            return array('status'=>1,'data'=>$state);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    } 

    public function deleteState(Request $request){

        //return $request->all();

        if($request->id){

            $state = State::find($request->id);

            if($state->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

    /*End State Crud*/



    /*Start City Crud*/

    public function saveCity(Request $request){

        //dd($request->all());

        $validator =$request->validate(

            array(

                "country_id"=>"required",

                "state"=>"required",

                "city_name"=>"required",

            ) 

        );

        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();

        $request->upload_image->move(public_path('images'), $imageName);*/ 

        if($request->cid){

            $city = City::find($request->cid);

        }

        else{

            $city = new City;

        }   

        

        $city->country_id=$request->country_id;

        $city->sid=$request->state;

        $city->city_name=$request->city_name;
        $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
    	$urlValue = str_replace ( $chars, "-", $request->city_name);
    	$city->url = strtolower(str_replace ( $chars, "-", $urlValue ));
        if($city->save()){

            return back()->with('message','City Add/Update Successfully !');

        }

    }

    public function editCity(Request $request){

        //return $request->all();

        $html='';

        if($request->id){

            $city = City::find($request->id);

            $html.='<div class="form-group"><label>Counrty Name</label>

                    <select class="form-control bindState" name="country_id" id="country_id">';

                    $countries=Country::orderby('country_name','asc')->get();

                    foreach ($countries as $country) {

                        if($city->country_id==$country->id){

                            $html.='<option selected value="'.$country->id.'">'.$country->country_name.'</option>';

                        }else{

                            $html.='<option value="'.$country->id.'">'.$country->country_name.'</option>'; 

                        }

                    }

                $html.='</select></div>';

                $html.='<div class="form-group"><label>State Name</label>

                        <select class="form-control" name="state" id="state" required="">';

                    $states=State::where('country_id',$city->country_id)->orderby('state_name','asc')->get();

                    foreach ($states as $state) {

                        if($state->id==$city->sid){

                            $html.='<option selected value="'.$state->id.'">'.$state->state_name.'</option>';

                        }else{

                            $html.='<option value="'.$state->id.'">'.$state->state_name.'</option>';

                        }

                    }

                $html.='</select></div><div class="form-group">

                        <label>City Name</label>

                        <input type="text" class="form-control" name="city_name" id="city_name" value="'.$city->city_name.'" placeholder="City Name">

                        <input type="hidden" name="cid" id="cid" value="'.$city->id.'">

                    </div>';

            return array('status'=>1,'data'=>$html);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    } 

    public function deleteCity(Request $request){

        //return $request->all();

        if($request->id){

            $city = City::find($request->id);

            if($city->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

    /*End City Crud*/



    /*Start Area Crud*/

    public function saveArea(Request $request){

        //dd($request->all());

        $validator =$request->validate(

            array(

                "country_id"=>"required",

                "state"=>"required",

                "city"=>"required",

                "area_name"=>"required",

            ) 

        );

        /*$imageName = time().'.'.$request->upload_image->getClientOriginalExtension();

        $request->upload_image->move(public_path('images'), $imageName);*/ 

        if($request->aid){

            $area = Area::find($request->aid);

        }

        else{

            $area = new Area;

        }   

        

        $area->country_id=$request->country_id;

        $area->sid=$request->state;

        $area->cid=$request->city;

        $area->area_name=$request->area_name;
        $area->url=$request->slug;

        if($area->save()){

            return back()->with('message','Area Add/Update Successfully !');

        }

    }

    public function editArea(Request $request){

        //return $request->all();

        $html='';



        if($request->id){

            $area = Area::find($request->id);

            $html.='<div class="form-group"><label>Counrty Name</label>

                    <select class="form-control bindState" name="country_id" id="country_id">';

                    $countries=Country::orderby('country_name','asc')->get();

                    foreach ($countries as $country) {

                        if($area->country_id==$country->id){

                            $html.='<option selected value="'.$country->id.'">'.$country->country_name.'</option>';

                        }else{

                            $html.='<option value="'.$country->id.'">'.$country->country_name.'</option>'; 

                        }

                    }

                $html.='</select></div>';

                $html.='<div class="form-group"><label>State Name</label>

                        <select class="form-control bindCity" name="state" id="state" required="">';

                    $states=State::where('country_id',$area->country_id)->orderby('state_name','asc')->get();

                    foreach ($states as $state) {

                        if($state->id==$area->sid){

                            $html.='<option selected value="'.$state->id.'">'.$state->state_name.'</option>';

                        }else{

                            $html.='<option value="'.$state->id.'">'.$state->state_name.'</option>';

                        }

                    }

                $html.='</select></div>';

                $html.='<div class="form-group"><label>City Name</label>

                        <select class="form-control" name="city" id="city" required="">';

                    $city=City::where('sid',$area->sid)->orderby('city_name','asc')->get();

                    foreach ($city as $cities) {

                        if($cities->id==$area->cid){

                            $html.='<option selected value="'.$cities->id.'">'.$cities->city_name.'</option>';

                        }else{

                            $html.='<option value="'.$cities->id.'">'.$cities->city_name.'</option>';

                             }

                         }



                $html.='</select></div><div class="form-group">

                        <label>Area Name</label>

                        <input type="text" class="form-control" name="area_name" id="area_name" value="'.$area->area_name.'" placeholder="Area Name">

                        <input type="hidden" name="aid" id="aid" value="'.$area->id.'">

                    </div>';  
                    
                    
                    $html.='</select></div><div class="form-group">

                        <label>Url</label>

                        <input type="text" class="form-control" name="slug" id="slug" value="'.$area->url.'" placeholder="Url">

                        <input type="hidden" name="aid" id="aid" value="'.$area->id.'">

                    </div>';





            return array('status'=>1,'data'=>$html);

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Something Went Wrong!');

    } 

    public function deleteArea(Request $request){

        //return $request->all();

        if($request->id){

            $area = Area::find($request->id);

            if($area->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }

    /*End Area Crud*/

}

