<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use App\Http\Controllers\Controller;
use Validator;
use Datatables;
use DB;
use App\Helpers\Common_helper;
use Session;
use Input;

class UpdateController extends Controller
{  
     
        public function index(Request $request){
        
            $action='';
        if (! $request->action) {
          
        }
        $action=$request->action;
        $data=$request;

         if($action=="bindState")
          $return['country'] = $this->countryData($_POST['catId']);
         else if($action=="bindCity")
          $return['state'] = $this->stateData($_POST['catId']);
         else if($action=="bindArea")
          $return['city'] = $this->cityData($_POST['catId']);
        return response()->json(['data'=>$return]);
        /*$this->output->set_content_type('application/json')->set_output(json_encode($return));*/
      
      } 

    
    public function countryData($countryid) {
        $countrydata = DB::select("SELECT id,state_name FROM state WHERE country_id= ".$countryid."");
        return ( $countrydata ) ? $countrydata : array();
    }
    public function stateData($stateid) {
        $statedata = DB::select("SELECT id,city_name FROM city WHERE sid= ".$stateid."");
        return ( $statedata ) ? $statedata : array();
    }
    public function cityData($cityid) {
        $citydata = DB::select("SELECT id,area_name FROM area WHERE cid= ".$cityid."");
        return ( $citydata ) ? $citydata : array();
    }
 }
 
 ?>   