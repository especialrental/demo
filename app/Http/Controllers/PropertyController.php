<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Property;
use App\Model\PropertyType;
use App\Model\PropertyGallery;
use App\Model\Amenity;
use App\Model\PropertyRates;
use App\Model\ExtraFee;
use App\Model\PropertyAmenities;
use App\Model\SubAmenity;
use App\Model\Area;
use App\Model\State;
use App\Model\Country;
use App\Model\Ical_Events;
use App\Model\City;
use App\Model\Contact;
use App\Model\Enquiry;
use App\Model\Subscription;
use App\Model\Review;
use App\Model\Currency;
use App\Http\Libraries\PropertyLibrary;
use Illuminate\Support\Str;
use DB;
use DateTime;
use App\Model\Payment;
use App\Helpers\Common_helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Model\PropertySpecials;
use Illuminate\Support\Arr;
use File;
use Yajra\DataTables\Facades\DataTables;
use Razorpay\Api\Api; 
use Session;

class PropertyController extends Controller{
    
    public function index(Request $request){
		//dd(44);
        if(!empty($request->country_name)){
			
        $countryName=$request->country_name;
		$temp =''; 
		$temps='';
		$tempc='';
		$tempa='';
		$ppid=0;
		$data=array();
		$data['meta']= City::Where('city_name','=',$countryName)->first();
	   $data['city'] = City::orderBy('id', 'asc')->get();
		$data['propertyTypeData']  = PropertyType::select('id', 'categoryname')->orderBy('categoryname', 'asc')->get();
		$common_lib = new PropertyLibrary();
		 $data['countryName']=$request->country_name;
		if(isset($request->country_name) && !empty($request->country_name)){
		     $str_arr = explode (",", $request->country_name);
		    $country = Country::where('country_name','LIKE',"%$str_arr[0]%")->first();
		    if($country){
		    	$temp = $country->id;
		    }else{
		    	$state = State::where('state_name','LIKE',"%$str_arr[0]%")->first();
		    	if($state){
                    $temp = $state->country_id;
            	    $temps = $state->id;
            	}else{
            		$city = City::where('city_name','LIKE',"%$str_arr[0]%")->first();
            		if($city){
                        $temp = $city->country_id;
              		    $temps=$city->sid;
              	        $tempc = $city->id;  
              	    }else{
		              	$area = Area::where('area_name','LIKE',"%$str_arr[0]%")->first();
		              	if($area){
	              		    $temp = $area->country_id;
	              		    $temps=$area->sid;
	              		    $tempc = $area->cid;
	              	        $tempa = $area->id;  
	              	    }else{
		                	$temp = 1000;
	              		    $temps=1000;
	              		    $tempc = 1000;
	              	        $tempa = 1000;
	              	    }
	              	}
	            }
	        }
	    }
		    
	    $data['sdate']=$request->search_startdate;
	    $data['edate']=$request->search_enddate;
	    $data['pType']=$request->property_type;
	    $data['pBed']=$request->bed;
	    $data['pBath']=$request->bath;
	    $data['pSleep']=$request->sleep;
	    $data['srate'] = $request->srate;
	    $data['erate'] = $request->erate;
	    $data['amenities'] = $request->amenities;
	    $data['neighbourhood'] = $request->neighbourhood;
	    $data['longterm'] = $request->longterm;
	    $data['paginate']=8;
		$data['properties'] = $common_lib->propertydata($request->all(),$temp,$temps,$tempc,$tempa);
		$data['filters'] = Input::all();
		$data['bTitle'] = 'Especialrentals | Property List';
		
		return view('property.property',$data)->render();
        }
        else
        {
             return redirect('404');
        }
    }
    
	public function indexpropert(Request $request ){
		 $countryName = $request->country_name;
	     $cityData= City::where('url',$request->url)->first();
	    if(!empty($cityData)){
		if(empty($countryName)){
		    $cityData= City::where('url',$request->url)->first();
		    $data['city']= $cityData->city_name??'';
		    
	    $countryName1=$cityData->city_name??'';
		$temp =''; 
		$temps='';
		$tempc='';
		$tempa='';
		$ppid=0;
		$data=array();
		$data['meta']= City::Where('city_name','=',$countryName1)->first();
		$data['city'] = City::orderBy('id', 'DESC')->get();
		$data['propertyTypeData']  = PropertyType::select('id', 'categoryname')->orderBy('categoryname', 'DESC')->get();
		$common_lib = new PropertyLibrary();
	    $data['countryName']=$countryName1;
		if(isset($cityData->city_name) && !empty($cityData->city_name)){
		    $str_arr = explode (",", $cityData->city_name);
		    $country = Country::where('country_name','LIKE',"%$cityData->city_name%")->first();
		    if($country){
		    	$temp = $country->id;
		    }else{
		    	$state = State::where('state_name','LIKE',"%$str_arr[0]%")->first();
		    	if($state){
                    $temp = $state->country_id;
            	    $temps = $state->id;
            	}else{
            		$city = City::where('city_name','LIKE',"%$str_arr[0]%")->first();
            		if($city){
                        $temp = $city->country_id;
              		    $temps=$city->sid;
              	        $tempc = $city->id;  
              	    }else{
		              	$area = Area::where('area_name','LIKE',"%$str_arr[0]%")->first();
		              	if($area){
	              		    $temp = $area->country_id;
	              		    $temps=$area->sid;
	              		    $tempc = $area->cid;
	              	        $tempa = $area->id;  
	              	    }else{
		                	$temp = 1000;
	              		    $temps=1000;
	              		    $tempc = 1000;
	              	        $tempa = 1000;
	              	    }
	              	}
	            }
	        }
	    }
		    
	    $data['sdate']=$request->search_startdate;
	    $data['edate']=$request->search_enddate;
	    $data['pType']=$request->property_type;
	    $data['pBed']=$request->bed;
	    $data['pBath']=$request->bath;
	    $data['pSleep']=$request->sleep;
	    $data['srate'] = $request->srate;
	    $data['erate'] = $request->erate;
	    $data['amenities'] = $request->amenities;
	    $data['neighbourhood'] = $request->neighbourhood;
	    $data['longterm'] = $request->longterm;
	    $data['paginate']=8;
		$data['properties'] = $common_lib->propertydata($request->all(),$temp,$temps,$tempc,$tempa);
		$data['filters'] = Input::all();
		$data['bTitle'] = 'Especialrentals | Property List';
		 
		return view('property.prt',$data)->render();
		
		} else {
	    $countryName = $request->country_name;
	    $cityData= City::where('url',$request->url)->first();
	    $cityData= City::where('url',$request->url)->first();
		$data['city']= $cityData->city_name??'';    
	    $countryName1=$cityData->city_name??'';
		$temp =''; 
		$temps='';
		$tempc='';
		$tempa='';
		$ppid=0;
		$data=array();
		
		$data['propertyTypeData']  = PropertyType::select('id', 'categoryname')->orderBy('categoryname', 'DESC')->get();
		$common_lib = new PropertyLibrary();
		$data['countryName']=$request->country_name;
		if(isset($request->country_name) && !empty($request->country_name)){
		    $str_arr = explode (",", $request->country_name);
		    $country = Country::where('country_name','LIKE',"%$str_arr[0]%")->first();
		    if($country){
		    	$temp = $country->id;
		    }else{
		    	$state = State::where('state_name','LIKE',"%$str_arr[0]%")->first();
		    	if($state){
                    $temp = $state->country_id;
            	    $temps = $state->id;
            	}else{
            		$city = City::where('city_name','LIKE',"%$str_arr[0]%")->first();
            		if($city){
                        $temp = $city->country_id;
                        $temp = $city->meta_tag;
                        $temp = $city->meta_description;
              		    $temps=$city->sid;
              	        $tempc = $city->id;  
              	    }else{
		              	$area = Area::where('area_name','LIKE',"%$str_arr[0]%")->first();
		              	if($area){
	              		    $temp = $area->country_id;
	              		    $temps=$area->sid;
	              		    $tempc = $area->cid;
	              	        $tempa = $area->id;  
	              	    }else{
		                	$temp = 1000;
	              		    $temps=1000;
	              		    $tempc = 1000;
	              	        $tempa = 1000;
	              	    }
	              	}
	            }
	        }
	    }
		    
	    $data['sdate']=$request->search_startdate;
	    $data['edate']=$request->search_enddate;
	    $data['pType']=$request->property_type;
	    $data['pBed']=$request->bed;
	    $data['pBath']=$request->bath;
	    $data['pSleep']=$request->sleep;
	    $data['srate'] = $request->srate;
	    $data['erate'] = $request->erate;
	    $data['amenities'] = $request->amenities;
	    $data['neighbourhood'] = $request->neighbourhood;
	    $data['longterm'] = $request->longterm;
	    $data['paginate']=8;
		$data['properties'] = $common_lib->propertydata($request->all(),$temp,$temps,$tempc,$tempa);
		$data['filters'] = Input::all();
		$data['meta']= City::Where('city_name','=',$countryName)->first();
		$data['bTitle'] = 'Especialrentals | Property List';
		return view('property.prt',$data)->render();
		   }
	    }
	    else
	    {
	        return redirect('404');
	    }
		 
	}

    
	public function filter_property(Request $request){
         //dd($request->all());
         $temp =''; 
         $temps='';
         $tempc='';
         $tempa='';
         $ppid=0;
		$data=array();
		  $data['propertyTypeData']  = PropertyType::select('id', 'categoryname')->get();
		  $common_lib = new PropertyLibrary();
		    $data['countryName']=$request->country_name;
             
		    if(isset($request->country_name) && !empty($request->country_name)){
		     $str_arr = explode (",", $request->country_name);
		        //dd($str_arr[0]);
		        /*$temp = array();
		        foreach ($str_arr as $value) {*/
		          //dd($value);
		          $country = Country::where('country_name','=',$str_arr[0])->first();
		          
		          if(count($country)>0){
		                   //array_push($temp, $country->id);
		          	      $temp = $country->id;
		          }else{
                      /*$temp = 20000;*/
		            $state = State::where('state_name','=',$str_arr[0])->first();

		            if(count($state)){
		                     $temp = $state->country_id;
		            	     $temps = $state->id;
		            	     
		            }else{
                       /*$temps = 20000;*/
		              $city = City::where('city_name','=',$str_arr[0])->first();
		              
		              if(count($city)){
		                        $temp = $city->country_id;
		              		    $temps=$city->sid;
		              	        $tempc = $city->id; 
		                        
		              }
		              else{
		              	/*$tempc = 20000;*/
		              	$area = Area::where('area_name','=',$str_arr[0])->first();
		              	if(count($area)){
		              		    $temp = $area->country_id;
		              		    $temps=$area->sid;
		              		    $tempc = $area->cid;
		              	        $tempa = $area->id;  

		                }
		                else{
		                	 $temp = 1000;
		              		    $temps=1000;
		              		    $tempc = 1000;
		              	        $tempa = 1000;
		                }


		              }
		              
		            }

		          }
		        /*}*/ //$ppid=$temp[0]; 
                 //dd($temps); 
		       }
		    
		    $data['sdate']=$request->search_startdate;
		    $data['edate']=$request->search_enddate;
		    $data['pType']=$request->property_type;
		    $data['pBed']=$request->bed;
		    $data['pBath']=$request->bath;
		    $data['pSleep']=$request->sleep;
		    $data['srate'] = $request->srate;
		    $data['erate'] = $request->erate;
		    $data['amenities'] = $request->amenities;
		    $data['neighbourhood'] = $request->neighbourhood;
		    $data['longterm'] = $request->longterm;
		    
	      $data['properties'] = $common_lib->propertydata($request->all(),$temp,$temps,$tempc,$tempa);

		return view('property.search_data',$data)->render();
	}




     public function demoUrl(Request $request){
        
        $proUrl ='place-d-italie-studio-apartment-with-aircon';
        $getId = Property::Where('url','=',$proUrl)->first();
		$id = $getId->id;
		//$id='0';
		//dd($id);
		    $dataid =Property::find($id);
		    if(!empty($dataid)){
		$data=array();
		
		$data['properties']= Property::where('id','=',$id)->first();
		$data['images']= PropertyGallery::Where('propertyid','=',$id)->orderby('photoorder','ASC')->limit(3)->offset(1)->get();
	//	DB::select("SELECT * FROM  property_gallery where propertyid ='ORDER BY id ASC LIMIT 1,4");
		$data['images1']= PropertyGallery::Where('propertyid','=',$id)->orderby('photoorder','ASC')->limit(1)->get();
	    //dd($data['images']);
	    $data['bTitle'] = 'Especialrentals | '.ucwords(strtolower($data['properties']->propertyname));
	    $data['cTitle'] = html_entity_decode(strip_tags(substr($data['properties']->description,0, 200)));
	    $data['city'] = City::orderBy('id', 'asc')->get();
		return view('demo',$data);
		}else{
		   return view('404'); 
		}
	}
	

    public function getPropertyDetailsByUrl(Request $request,$cityUrl,$room,$area,$proUrl){
        if ($u = Property::where('url', '=', $proUrl)->first()){
            
        $getId = Property::Where('url','=',$proUrl)->first();
		$id = $getId->id;
		//$id='0';
		//dd($id);
		    $dataid =Property::find($id);
		    if(!empty($dataid)){
		$data=array();
		$data['properties']= Property::where('id','=',$id)->first();
		$data['images']= PropertyGallery::Where('propertyid','=',$id)->limit(4)->offset(1)->orderBy('photoorder', 'ASC')->get();
		$data['images1']= PropertyGallery::Where('propertyid','=',$id)->limit(1)->offset(0)->orderby('photoorder','ASC')->get();
		$data['imagesAll']= PropertyGallery::Where('propertyid','=',$id)->orderby('photoorder','ASC')->get();
		$data['imagesAll1']= PropertyGallery::Where('propertyid','=',$id)->limit(1)->offset(0)->orderby('photoorder','ASC')->get();
	    //dd($data['images']);
	    $data['bTitle'] = 'Especialrentals | '.ucwords(strtolower($data['properties']->propertyname));
	    $data['cTitle'] = html_entity_decode(strip_tags(substr($data['properties']->description,0, 200)));
	    $data['city'] = City::orderBy('id', 'asc')->get();
	    $data['cityUrl'] = $cityUrl;
	    $data['rooms'] = $room;
		
		return view('demo',$data);
		}else{
		   return redirect('404');
		}
        }
        else
        {
           return redirect('404');  
        }
	}
	
	 
	public function getDetails(Request $request,$id='0'){
		//dd($id);
		    $dataid =Property::find($id);
		    if(!empty($dataid)){
// 		$data=array();
// 		$data['properties']= Property::where('id','=',$id)->first();
// 		$data['images']= PropertyGallery::Where('propertyid','=',$id)->orderby('photoorder','ASC')->get();
// 	    //dd($data['images']);
// 	    $data['bTitle'] = 'Especialrentals | '.ucwords(strtolower($data['properties']->propertyname));
// 	    $data['cTitle'] = html_entity_decode(strip_tags(substr($data['properties']->description,0, 200)));
// 	    $data['city'] = City::orderBy('id', 'asc')->get();
// 		return view('property.details',$data);
        return redirect('404');
		}else{
		  return redirect('404');
		}
	}
	public function show_property(Request $request){
		//dd($request->countryId);
		$data=array();
		  if(isset($request->countryId)){
		  $qdata=Property::where('status' , 0);
           $data['properties'] =  $qdata->Where('country' , $request->countryId)->paginate(15);  
		  /*->orWhere('country' = $request->countryId])->paginate(15);*/
		 }
		 else{
		 	$data['properties']=Property::where('status',0)->paginate(15);
		 }
		 $data['countryName']=$request->countryname;
		 $data['coId']=$request->countryId;

		//dd($data['properties'][0]->id);

		 /*foreach ($data['properties'] as $key => $value) {
		 	//dd($value->id);
		 	$event =  Ical_Events::Where('propertyid' , $value->id)->get();
            foreach ($event as $key => $events) {
            	if($events->start_date < $request->start_date && $events->end_date < $request->end_date){
                   $qdata=Property::where('status' , 0);
		           $data['properties'] =  $qdata->Where('country' , $request->countryId)->paginate(15);
            	}
            }*/
		 /*}*/
		 
		$data['city'] = City::orderBy('id', 'asc')->get();
		$data['propertyTypeData']  = PropertyType::select('id', 'categoryname')->get();
		return view('property.property',$data);
	}
	public function propty_search(Request $request){
		if($request->get('query'))
	     {
	      $query = $request->get('query');

	      /*$data = DB::table('country')
	        ->where('country_name', 'LIKE', "%{$query}%")
	        ->get();*/
	       $data = //Country::where('country_name', 'like', '%'.$query.'%')->get();
	               
      	               Country::join('state','country.id','=','state.country_id')->join('city','state.id','=','city.sid')->select(DB::raw('CONCAT(country_name,"," ,state_name,",", city_name) AS area' ),'country.id')->WHERE ('country_name', 'like', '%'.$query.'%')->orWhere('state_name', 'like', '%'.$query.'%')->orWhere('city_name','like', '%'.$query.'%')->get();
      	               //return $data;
	       //return array('status'=>1,'data'=>$data);
	      $output = '<ul class="dropdown-menu" style="display:block; width: 100%; position:relative">';
	      foreach($data as $row)
	      {
	       $output .= '
	       <li class="asearch"><a class="autosearch" href="javascript:void(0);" data-id="'.$row->id.'">'.$row->area.'</a></li>
	       ';
	      }
	      $output .= '</ul>';
	      echo $output;
	     }
	}
	public function propty_neighbour(Request $request){
		$html='';
		$neigh = isset($request->neighbourhood) ?$request->neighbourhood :'';
		if(isset($request->cityname)){
		$data = City::select('id')->Where('city_name',$request->cityname)->first();
		//return $data->id;
		/*$neighbour = Area::select('id', 'area_name')->where('cid',$data->id)->get(); */
		if($data){
		$neighbour = Area::select('id', 'area_name')->where('cid',$data->id)->orderBy('area_name', 'asc')->get(); 
		/*$html .=*/
		$arra = explode(",", $request->neighbourhoodids);


		foreach ($neighbour as $cneighbour) { 
		  if($cneighbour->id){
		  	$checked = ((in_array($cneighbour->id, $arra))?'checked':'') ;
		  //$selected = ($neigh == $cneighbour->id) ? 'selected' : ''; 
		  //return $selected; 

		  $html .='<label class="dropdown-item" style="width: 100%;padding: 5px;float: left;display: flex;border-bottom: 1px solid #e6e4e4;align-items: start;background: linear-gradient(0deg, #f3f3f3, transparent); text-transform: capitalize"><input type="checkbox" class="advcheck" style="margin-top:4px;margin-right:5px;" name="neighbourhood[]" value="'.$cneighbour->id.'" '.$checked.'>'.$cneighbour->area_name.'</label>';
	     } }
	     }
	     else{
	     	$html .='<span>All Neighbour</span>';
	     }
	 }

	    return $html;
	}
	private function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
    private function returnDates($fromdate, $todate){
	    $fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
	    $todate = \DateTime::createFromFormat('Y-m-d', $todate);
	    return new \DatePeriod(
	        $fromdate,
	        new \DateInterval('P1D'),
	        @$todate->modify('+1 day')
	    );
	 }

    private function convertCurrency($amount, $from, $to){
	  //$conv_id = "{$from}_{$to}";
	  $req_url = "https://api.exchangerate-api.com/v4/latest/$from";
	  $response_json = file_get_contents($req_url);
	  if(false !== $response_json) {

    // Try/catch for json_decode operation
    try {

	// Decoding
		$response_object = json_decode($response_json);

		// YOUR APPLICATION CODE HERE, e.g.
		$base_price = $amount; // Your price in USD
		$peur = $to;
	 	$EUR_price = round(($base_price * $response_object->rates->$peur), 2);
         return $EUR_price;
	    }
	    catch(Exception $e) {
	        // Handle JSON parse error...
	    }

	}
	}
	public function saveBeforePayment(Request $request){
		$amount = $request->totalAmount;
		$pro_currency = \App\Model\ExtraFee::where('propertyid',$request->propertyid)->first();

		/*Create Order Id */
		/*$lastPayment_id = Payment::orderBy('id','DESC')->pluck('id')->first();
		$nextId = $lastPayment_id + 1; // Increment the ID by 1
		$getId = 'ORD'.'1000000'.$nextId;
        $order_number = 'ORD' . str_pad($getId, 10, '0', STR_PAD_LEFT);*/
		
		

		$data = [
       	   'propertyid' => $request->propertyid,
           'razorpay_payment_id' => $request->razorpay_payment_id,
           'totalAmount' => $request->totalAmount,
           'start_date' => $request->first_date,
           'end_date' => $request->last_date,
           'name' => $request->fbname.' '.$request->lbname,
           'email'=>$request->bemail,
           'mob'=>$request->bphone,
           'gen'=>$request->gen,
           'how_did_you'=>$request->how_did_you,
           'mformate'=>$request->mformate,
           'business'=>$request->business,
           'myself'=>$request->myself,
           'comment'=>$request->bcomment,
           'guest'=>$request->nguest,
           'child'=>$request->nchild,
           'currency'=>$request->currency,
           'cleanAmt'=>$request->cleanAmt,
           'cnightAmt'=>$request->cnightAmt,
           'prop_name'=>$request->pro_name,
           'tax' => ($pro_currency->tax) ? $pro_currency->tax : 0,

           'night'=>$request->night,
           'extraHtml'=> $request->extraHtml

        ];
		//dd($pro_currency);
        $getId = Payment::insertGetId($data);

		foreach($pro_currency as $cn)
		{
			$curr = $request->currency;
		}
		
		$api = new Api('rzp_live_Zx06Ob9agoXD8R', '7RrhFxXaGNDT0sCSszzK3tWM');

		$orderData = [
			'receipt'         => "qwsaq1",
			'amount'          => $amount * 100, // 2000 rupees in paise
			'currency'        => $curr,
			'payment_capture' => 1 // auto capture
			//'razorpay_payment_id' => $order_number // Pass the order ID here
		];
	
		 $razorpayOrder = $api->order->create($orderData);

		 $razorpayOrderId = $razorpayOrder['id'];

		$_SESSION['razorpay_order_id'] = $razorpayOrderId;

		$request->session()->put('razorpay_order_id',$razorpayOrderId);

       $arr = array('status' => true, 'id' => $getId,'orderid' =>$razorpayOrderId);
		return $arr;

	}
    public function paysuccess(Request $request){    	
        $payment = Payment::find($request->id);
        $extraFee = ExtraFee::where('propertyid', $request->pro_id)->first();
        $property = Property::find($payment->propertyid);
        $from = 'bookings@especialrentals.com';
		if($payment){
			$eventdata = array('propertyid'=>$payment->propertyid, 'role'=>1, 'start_date'=>$payment->start_date, 'end_date'=>$payment->end_date,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
			Ical_Events::insert($eventdata);
		}
		$sub = \App\Model\PropertyGallery::where('propertyid',$payment->propertyid)->orderby('photoorder','ASC')->get();
        $to = $payment->email; 
		$subject = "Booking Invoice";
		$message = '<table style="width: 100%;border-collapse: collapse;font-family:Helvetica,Arial,sans-serif;border-top:1px solid rgb(219,219,220);font-size:14px;" cellpadding="10" cellspacing="15"> <tbody> <tr style="border-bottom: 10px solid #f3772d;"> <td colspan="3"> <img src="'.url('/public/frontend/images/header_logo_default2.png').'" alt="logo_epecialrentals.png" height="63"/> </td> </tr> <tr> <td colspan="3"> <h1 style="color:rgb(53,62,68);padding:0px;margin:20px 0px;text-align:center;line-height:1.3;word-break:normal;font-size:24px">Booking Invoice</h1> </td> </tr> <tr> <td colspan="3"> <table style="width: 100%;border-collapse: collapse;"> <tbody> <tr> <td colspan="2" style="vertical-align:top;"> <a href="'.url('/property/detail/'.$payment->propertyid.'').'" target="_blank" style="text-align: center; display: block;"><img src="'.url('/public/uploads/property_image/'.$payment->propertyid.'/'.$sub->first()->photoname.'').'" style="max-width:200px;" width="200"></a> </td> </tr> <tr> <td colspan="2"> <table style="width: 100%;border-collapse: collapse;" cellpadding="10" cellspacing="10" > <tbody> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;vertical-align:top;color:rgb(51,51,51);font-weight:bold;line-height:28px;border-left:none"> Property </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;vertical-align:top;font-weight:bold;line-height:28px;border-left:none" align="right"> <a href="'.url('/property/detail/'.$payment->propertyid.'').'" target="_blank" style="color:#f3772c;">'.$payment->prop_name.'</a> </td> </tr> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;"> Dates </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right"> <div> <span style="white-space:nowrap"> <strong>'.$payment->start_date."-".$payment->end_date.'</strong>,&nbsp;'.$payment->night.' nights </span> </div> </td> </tr> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;">Guest </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right"> <div align="right"> <span style="white-space:nowrap">'.$payment->guest.' Adult, '.$payment->child.' Children</span> </div> </td> </tr> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;"> Traveller Name </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right"> <div> <span style="white-space:nowrap">'.$payment->gen." ".$payment->name.'</span> </div> </td> </tr> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;"> Traveller Mobile </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right"> <div> <span style="white-space:nowrap">'.+ $payment->mformate."-".$payment->mob.'</span> </div> </td> </tr> <tr style="border-bottom: 1px solid #f0f0f0;"> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;">Traveller Email </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right"> <div> <span style="white-space:nowrap"> <a href="mailto:'.$payment->email.'" target="_blank">'.$payment->email.'</a> </span> </div> </td> </tr> <tr> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;color:rgb(51,51,51);font-weight:bold;">Comments </td> <td style="word-break:break-word;border-collapse:collapse;padding:8px 10px;" align="right">'.$payment->comment.' </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">How did you hear about us?</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$payment->how_did_you.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Purpose Of Visit</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$payment->business.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Booking For</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$payment->myself.'</span> </p> </td> </tr></tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr style="border-top:1px solid rgb(219,219,220);"> <td colspan="3" align="center"> <table cellpadding="10" style="width: 100%;"> <tbody> <tr> <td style="font-family:Helvetica,Arial,sans-serif;word-break:break-word;border-collapse:collapse;padding:8px 0px;vertical-align:top;text-align:center;color:rgb(255,255,255);font-weight:normal;line-height:28px;display:block;width:auto;background:#f3772d;border:1px solid rgb(255,138,0);border-radius:4px"> <a href="'.url('/property').'" style="color:rgb(255,255,255);text-decoration-line:none;font-weight:700" target="_blank">&nbsp;&nbsp;View All Property&nbsp;&nbsp;</a> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table>'; 
		$rCurrency = Currency::where(['short_code'=>$payment->currency,'status'=>'1'])->first();
		if($extraFee->refund) $reFund = 'Refundable Amount - '.$rCurrency->symbol.' '.$extraFee->refund. ' !'; else $reFund = 'None'; 
		$message .= '<table style="width: 100%;border-collapse: collapse;font-family:Helvetica,Arial,sans-serif;border-top:1px solid rgb(219,219,220);font-size:14px;" cellpadding="10" cellspacing="15"> <tbody> <tr style="border-top:1px solid rgb(219,219,220);"> <td colspan="3"> <table style="width: 100%;"> <tbody> <tr> <td colspan="2" style="border-collapse:collapse;padding:5px 0;color:rgb(51,51,51);font-weight:bold;"> Traveller Payment </td> </tr> <tr> <td colspan="2" style="word-break:break-word;border-collapse:collapse;color:rgb(51,51,51);font-weight:bold;">'.$payment->extraHtml.' </td> </tr> <tr style="border-top:1px solid rgb(219,219,220);"> <td colspan="3"> <table style="width: 100%"> <tbody> <tr> <td colspan="2" style="word-break:break-word;border-collapse:collapse;padding:5px 0;color:rgb(51,51,51);font-weight:bold;"> Cancellation Policy </td> </tr> <tr> <td style="word-break:break-word;color:rgb(51,51,51);"> '.$extraFee->extraNotes. ' </td> </tr> <tr> <td style="word-break:break-word;border-collapse:collapse;color:rgb(51,51,51);font-weight:bold;"> Security Deposit </td> <td style="word-break:break-word;color:rgb(51,51,51);"> '.$reFund.' </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table>';

		
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "CC: ".$from."\r\n";
			// More headers
			$headers .= 'From: <'.$from.'>' . "\r\n";
			$payment->razorpay_payment_id = $request->razorpay_payment_id;
	        $payment->status = 1;
	        $payment->save();
			if(mail($to,$subject,$message,$headers))
			{
		        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
		        return Response()->json($arr);
			}
		 
    }
    public function RazorThankYou()
	 {
	 return view('property.thankyou');
	 }
	 public function enquiryThankYou()
	 {
	 return view('property.enquirythank');
	 }
	 public function contactThankYou()
	 {
	 return view('property.contact_thank');
	 }
	public function review(Request $request){
		//print_r ($request->all());
		if($request->email && $request->rate){
			// if(Review::where('email',$request->email)->exists()){
			// 	return array('status'=>0,'message'=>'Email / Rating not Exist!');
			// }
			$review= new Review();
			$review->name=$request->name;
			$review->email=$request->email;
			$review->pro_name=$request->pro_name;
			$review->pro_id=$request->pro_id;
			$review->journey_date=$request->journey_date;
			$review->title=$request->title;
			$review->description=$request->description;
			$review->location=$request->location;
			$review->rating_number=$request->rate;
			if($review->save()){ 
				$avg=Review::select('rating_number')->where('pro_id',$review->pro_id)->avg('rating_number');
			     $ratecount = Review::where('pro_id',$review->pro_id)->count();
			}else{
				return array('status'=>0,'message'=>'Failed To Submit Review!');
			}
			
			$property=Property::find($review->pro_id);
			$property->avg_rating=$avg;
			$property->rating_counts=$ratecount;
			if($property->save()){
				return array('status'=>1,'message'=>'Review Submitted successfully!');
			}
		}else{
			return array('status'=>0,'message'=>'Email / Rating not Exist!');
		}
	    
	} 
	public function sub_email(Request $request){
		//return $request->all();
		$data = Subscription::where('email','=',$request->email)->first();
		if($data){
			echo "Your email is already exists";
		}else{
			$subdata = array('email'=>$request->email);
			Subscription::insert($subdata);
			echo "Your email successfully Subscribed";
		}

	}
	public function enquiryFormData(Request $request){
	    $data = new Enquiry;
	    $data->propertyid = $request->pro_id;
	    $data->propertyName = $request->pro_name;
	    $data->name = $request->fname.' '.$request->lname;
	    $data->email = $request->email;
	    $data->mob = $request->mob;
	    $data->comment = $request->comment;
	    $data->gen = $request->gen;
	    $data->mformate = $request->mformate;
	    $data->business = $request->business;
	    $data->myself = $request->myself;
	    $data->created_at =date('Y-m-d H:i:s');
	    $data->updated_at = date('Y-m-d H:i:s');
		
		$property = Property::where('id',$request->pro_id)->first();
		
		$type = Area::where('id',$property->town)->first();
	    $city = City::where('id',$property->city)->first();
		
		$roomType = $property->room_type;
		$room = Str::slug($roomType, '-');
		$str = strtolower($type->area_name);
		$area =  Str::slug($str, '-');
		$pro = $property->url;
		$proUrl = Str::slug($pro, '-');
		$cityUrl = Str::slug($city->city_name, '-');
		$urls = $cityUrl.'/'.$room.'/'.$area.'/'.$pro;
		
	    
        //if($request->fname){
        //$enquirydata = array('propertyid'=>$request->pro_id,'propertyName'=>$request->pro_name,'name'=>$request->fname.' '.$request->lname, 'email'=>$request->email, 'mob'=>$request->mob, 'comment'=>$request->comment, 'gen'=>$request->gen, 'mformate'=>$request->mformate, 'business'=>$request->business, 'myself'=>$request->myself, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
        //}
        //Enquiry::insert($enquirydata);
	    
	    if($data->save()){
	    $from = 'bookings@especialrentals.com';
	    $sub = \App\Model\PropertyGallery::where('propertyid',$request->pro_id)->orderby('photoorder','ASC')->get();
	    
        $to = $request->email;
		$subject = "Booking Inquiry from ".$request->fname." ".$request->lname." (".$request->checkin. " - " . $request->checkout.") 'EspecialRentals.com'";

		$message = '<table style="width: 100%"> <tbody> <tr> <td> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td style="margin:0 20px 0 0;padding:0 15px 0 0;"> <div style="display:inline-block;margin:0 0 8px 0"> <img style="padding:10px;height: 70px;" src="'.url('/public/frontend/images/header_logo_default2.png').'" alt="EspecialRentals"> </div> </td> <td style="padding:0;margin:0;text-align:right"> <p style="font-weight:bold;margin:0 0 5px;padding:0">Need help with your trip?</p> <span style="margin:0;padding:0;font-weight:800">Ph. No.:</span> <span>UK : + 44 (0) 208-099-7520 </span> </td> </tr> <tr> <td colspan="2"> <hr style="border-top:0px solid #ccc"> </td> </tr> <tr> <td colspan="2" style="border-bottom:1px solid #ffcc00"> <div style="height:110px;background-color:#f3772d;padding-left:5px;border:1px solid #a1a0a0;margin-top:10px;margin-bottom:10px"> <table> <tbody> <tr> <td colspan="2"> <img height="100px" src="https://ci3.googleusercontent.com/proxy/jVa9m9EpWQ6dxfVClBw27cuUzjNKvyR7toKmr0YarhoZwEAMV6XCnKT19BhdR9PcU-RARkepX2FGnQyC76Hs1A5n5Q=s0-d-e1-ft#https://st.redbus.in/Images/notification/otg.png"> </td> <td colspan="6" style="color:#fff"> <span style="font-weight:bold;font-family:Arial,Helvetica,sans-serif;font-size:larger;font-size:36px"> Booking Inquiry </span> <br> <span style="font-size:25px;line-height:30px">  </span> </td> </tr> </tbody> </table> </div> </td> </tr> </tbody> </table> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td colspan="2"><a href="'.url('/'.$urls.'').'" style="color:#f3772d;text-decoration-line:none;font-weight:700; display: block;text-align: center" target="_blank"><img src="'.url('/public/uploads/property_image/'.$request->pro_id.'/'.$sub->first()->photoname.'').'" style="width: 70%;max-width:400px;"></a></td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:bold;margin:0 0 5px;padding:0;text-transform:capitalize"> <span>Property Name</span> </p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span><a href="'.url('/'.$urls.'').'" target="_blank" style="color:#f3772c;">'.$request->pro_name.'</a></span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">CheckIn Dates</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->checkin.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">CheckOut Dates</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->checkout.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Total Guest</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->guest.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Total Nights</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->night.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Name</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->gen."".$request->fname." ".$request->lname.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Email</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->email.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Phone No.</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.+$request->mformate."-".$request->mob.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Comment</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->comment.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">How did you hear about us?</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->how_did_you.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Purpose Of Visit</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->business.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Booking For</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->myself.'</span> </p> </td> </tr></tbody> </table> <table border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td> <div style="background-color:#f3772c;width:100%"> <br> <a href="'.url('/').'" style="border-radius:4px;letter-spacing:0.4px;display:block;height:25px;width:180px;color:#34495e;background-color:white;font-weight:bold;line-height:1.5;text-align:center;font-size:16px;text-decoration:none;margin:0 auto;font-family:Montserrat,sans-serif;padding-left:24px;padding-right:24px;padding-top:11px;padding-bottom:11px" target="_blank">View All Property</a> <br> </div> </td> </tr> </tbody> </table> <br> </td> </tr> </tbody> </table>';
        
			
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		//$headers .= "CC: ".$to.", ".$from."\r\n";
		$headers .= "CC: ".$from."\r\n";
		// More headers
		$headers .= 'From: <'.$from.'>' . "\r\n";

		if(mail($to,$subject,$message,$headers))
		{
            echo "Your Inquiry request is initiated.We will contact you as soon as possible.";
		}
	    
	    }
	} 
	
	public function contactInfo(Request $request){
		//return $request->all();

		/*if($request->name){
			$contactdata = array('name'=>$request->name, 'email'=>$request->email, 'message'=>$request->des,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
		}
		Contact::insert($contactdata);*/
        $from = 'bookings@especialrentals.com';
        
		$to = $request->email;
		$subject = "Thanks for Contacting EspecialRentals Make An Enquiry";

		$message = '<table style="width: 100%"> <tbody> <tr> <td> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td style="margin:0 20px 0 0;padding:0 15px 0 0;width:0%"> <div style="display:inline-block;border-right:1px solid #ccc;margin:0 0 8px 0"> <img style="padding:10px;height: 70px;" src="'.url('/public/frontend/images/header_logo_default2.png/').'" alt="EspecialRentals"> </div> </td> <td style="width:35%;padding:0;margin:0;text-align:right"> <p style="font-weight:bold;margin:0 0 5px;padding:0">Need help with your trip?</p> <span style="margin:0;padding:0;font-weight:800">Ph. No.:</span> <span>UK : + 44 (0) 208-099-7520</span> </td> </tr> <tr> <td colspan="2"> <hr style="border-top:0px solid #ccc"> </td> </tr> </tr> <tr> <td colspan="2" style="border-bottom:1px solid #ffcc00"> <div style="height:110px;background-color:#f3772d;padding-left:5px;border:1px solid #a1a0a0;margin-top:10px;margin-bottom:10px"> <table> <tbody> <tr> <td colspan="2"> <img height="100px" src="https://ci3.googleusercontent.com/proxy/jVa9m9EpWQ6dxfVClBw27cuUzjNKvyR7toKmr0YarhoZwEAMV6XCnKT19BhdR9PcU-RARkepX2FGnQyC76Hs1A5n5Q=s0-d-e1-ft#https://st.redbus.in/Images/notification/otg.png"> </td> <td colspan="6" style="color:#fff"> <span style="font-weight:bold;font-family:Arial,Helvetica,sans-serif;font-size:larger;font-size:36px"> Contact Us </span> <br> <span style="font-size:25px;line-height:30px"> </span> </td> </tr> </tbody> </table> </div> </td> </tr> </tbody> </table> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Name</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->fname.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Last Name</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->lname.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Email</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->email.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Phone </p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->mobile.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Location</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->city.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Check-in Date</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->search_startdate.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Check-out Date</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->search_enddate.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">How did you hear about us?</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->how_did_you.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Adult</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->count_guests.'</span> </p> </td> </tr><tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Child</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->count_children.'</span> </p> </td> </tr>  <tr style="margin:0;padding:0"><td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"><p style="font-weight:700;margin:0 0 5px;padding:0">Customer Phone No.</p></td><td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"><p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->mformate."".$request->mob.'</span> </p></td></tr><tr style="margin:0;padding:0"><td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"><p style="font-weight:700;margin:0 0 5px;padding:0">How did you hear about us?</p></td><td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"><p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->how_did_you.'</span> </p></td></tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"><p style="font-weight:700;margin:0 0 5px;padding:0">Comment</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->des.'</span> </p> </td> </tr> </tbody> </table> <table border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;font-size:14px;background-color:#f3772c;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td style="background-color:#f3772c;width:100%"><table align="center" border="0" cellpadding="10" cellspacing="0" style="border:0;border-collapse:collapse;border-spacing:0;background-color:#f3772c;"> <tbody> <tr> <td> <a href="'.url('/').'" style="border-radius:4px;letter-spacing:0.4px;display:block;height:25px;width:180px;color:#34495e;background-color:white;font-weight:bold;line-height:1.5;text-align:center;font-size:16px;text-decoration:none;margin:0 auto;font-family:Montserrat,sans-serif;padding-left:24px;padding-right:24px;padding-top:11px;padding-bottom:11px" target="_blank">View All Property</a> </td> </tr> </tbody> </table></td> </tr> </tbody> </table> <br> </td> </tr> </tbody> </table>';

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "CC: ".$from."\r\n";
		// More headers
		$headers .= 'From: <'.$from.'>' . "\r\n";

		if(mail($to,$subject,$message,$headers))
		{
		    echo "1";
            echo "THANK YOU FOR SUBMITTING YOUR REQUEST. ONE OF OUR REPRESENTATIVE WE WILL CONTACT YOU SHORTLY.";
		}
		else
		{
		    echo "2";
		}

	}
	
	
	
	
	
	public function contact(Request $request){
		//return $request->all();

		if($request->fname){
			$contactdata = array('name'=>$request->fname.' '.$request->lname, 'email'=>$request->email, 'phone'=>$request->mob, 'subject'=>$request->subject, 'message'=>$request->message,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
		}
		Contact::insert($contactdata);
        $from = 'contact@especialrentals.com';
        
		$to = $request->email;
		$subject = "Thanks for Contacting EspecialRentals";

		$message = '<table style="width: 100%"> <tbody> <tr> <td> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td style="margin:0 20px 0 0;padding:0 15px 0 0;width:0%"> <div style="display:inline-block;border-right:1px solid #ccc;margin:0 0 8px 0"> <img style="padding:10px;height: 70px;" src="'.url('/public/frontend/images/header_logo_default2.png/').'" alt="EspecialRentals"> </div> </td> <td style="width:35%;padding:0;margin:0;text-align:right"> <p style="font-weight:bold;margin:0 0 5px;padding:0">Need help with your trip?</p> <span style="margin:0;padding:0;font-weight:800">Ph. No.:</span> <span>UK : + 44 (0) 208-099-7520</span> </td> </tr> <tr> <td colspan="2"> <hr style="border-top:0px solid #ccc"> </td> </tr> </tr> <tr> <td colspan="2" style="border-bottom:1px solid #ffcc00"> <div style="height:110px;background-color:#f3772d;padding-left:5px;border:1px solid #a1a0a0;margin-top:10px;margin-bottom:10px"> <table> <tbody> <tr> <td colspan="2"> <img height="100px" src="https://ci3.googleusercontent.com/proxy/jVa9m9EpWQ6dxfVClBw27cuUzjNKvyR7toKmr0YarhoZwEAMV6XCnKT19BhdR9PcU-RARkepX2FGnQyC76Hs1A5n5Q=s0-d-e1-ft#https://st.redbus.in/Images/notification/otg.png"> </td> <td colspan="6" style="color:#fff"> <span style="font-weight:bold;font-family:Arial,Helvetica,sans-serif;font-size:larger;font-size:36px"> Contact Us </span> <br> <span style="font-size:25px;line-height:30px">  </span> </td> </tr> </tbody> </table> </div> </td> </tr> </tbody> </table> <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Name</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->fname." ".$request->lname.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Email</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->email.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Customer Phone No.</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->mob.'</span> </p> </td> </tr> <tr style="margin:0;padding:0"> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0">Comment</p> </td> <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle"> <p style="font-weight:700;margin:0 0 5px;padding:0; text-align: right"> <span>'.$request->message.'</span> </p> </td> </tr> </tbody> </table> <table border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;font-size:14px;background-color:#f3772c;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:100%"> <tbody> <tr> <td style="background-color:#f3772c;width:100%"><table align="center" border="0" cellpadding="10" cellspacing="0" style="border:0;border-collapse:collapse;border-spacing:0;background-color:#f3772c;"> <tbody> <tr> <td> <a href="'.url('/').'" style="border-radius:4px;letter-spacing:0.4px;display:block;height:25px;width:180px;color:#34495e;background-color:white;font-weight:bold;line-height:1.5;text-align:center;font-size:16px;text-decoration:none;margin:0 auto;font-family:Montserrat,sans-serif;padding-left:24px;padding-right:24px;padding-top:11px;padding-bottom:11px" target="_blank">View All Property</a> </td> </tr> </tbody> </table></td> </tr> </tbody> </table> <br> </td> </tr> </tbody> </table>';

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "CC: ".$from."\r\n";
		// More headers
		$headers .= 'From: <'.$from.'>' . "\r\n";

		if(mail($to,$subject,$message,$headers))
		{
            echo "THANK YOU FOR SUBMITTING YOUR REQUEST. ONE OF OUR REPRESENTATIVE WE WILL CONTACT YOU SHORTLY.";
		}

	}
	public function cal_rate(Request $request){
		$redirect = $request->redirect_url;
		$curency=$request->currency;
		$curencyto ='USD';
		$curS = Currency::where(['short_code'=>$curency])->first();
		$curesyml = ($curS) ? $curS->symbol : '$';
		if(isset($request->last_date)){
			$start = $this->test_input($request->first_date);
			$end = $this->test_input($request->last_date);
			$guest = $this->test_input($request->guest);
			$child = $this->test_input($request->child);
			$pro_id = $this->test_input($request->pro_id);
			$prop_name = $this->test_input($request->pro_head);
			
			$redirect_url=$request->redirect_url;
			$guests = $guest + $child;
			$todaysDate = date("Y-m-d");
			$st_date=date_create($start);
			$checkin=date_format($st_date,'Y-m-d');
			$ed_date=date_create($end);
			$checkout=date_format($ed_date,'Y-m-d');
			$datetime = DateTime::createFromFormat('Y-m-d', $checkin);
			$wekend = $datetime->format('D');
         	if(isset($request->pro_id)){
         		$date1 = $checkin;
         		$date2 = $checkout;
         		$referer = $_SERVER['HTTP_REFERER'];
         		$datePeriod = $this->returnDates($date1, $date2);
         		foreach($datePeriod as $date) {
					$ad1[] = $date->format('Y-m-d');
				}
				array_pop($ad1);
				$query=DB::select("SELECT * FROM `ical_events`  WHERE (('$date1' BETWEEN `start_date` AND `end_date`) OR ('$date2' BETWEEN `start_date` AND `end_date`)  or (`start_date` >='$date1' and 'end_date' <= '$date2'))  AND propertyid='".$pro_id."'");
				if($query){
					echo "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Some dates are already booked,Choose available dates only</span>";die();
				}
				$day_a = count($ad1)+1 ;
				$total_nights = count($ad1);
				if($day_a<2){
					echo "<script>alert('Please select minimum 2 days.')</script>";
					$referer = $_SERVER['HTTP_REFERER'];
					echo "<script>window.location='$redirect'</script>";
				}
				$sel1234 = PropertyRates::where('propertyid',$pro_id)->get();
				foreach ($sel1234 as $value12) {
					@$result = array_intersect($ad[$i], $ad1);
					@$result1 = array_intersect($result, $ad[$i]);
					$rateres[] = $result1;
				}
				@$as = array_filter($rateres);
				if(empty($as)){
					$as = $ad1;
				}
				if(!empty($as)){
					foreach($as as $key=>$val){
					    $ke[] = $key;
					    $valu[] = $val;
					}
					foreach($valu as $vall){
						$valll = $vall;
					}
					$array  = @$as ;
					$result = Arr::flatten($array);
					@$last_mat = count($result); 
					$ratesData = PropertyRates::where('propertyid',$pro_id)->get();
					$rates=0;
					$min_nights=0;
					$checkin_time=strtotime($checkin);
					$checkout_time=strtotime($checkout);
					if($ratesData){
						foreach ($ratesData as $value) {
							$a = trim($value->id);
							$ids[] = trim($value->id);
							$one_night = (is_null($value->nightrate))? 0: trim($value->nightrate);
							$weekend = (is_null($value->weekend))? 0: trim($value->weekend);
							$weekly = (is_null($value->weekrate))? 0: trim($value->weekrate);

							$monthly = (is_null($value->monthrate))? 0: trim($value->monthrate);
							$d1=date_create(date('Y-m-d',$value->todate));
							$d2=date_create($checkin);
							if($total_nights>=30){ 
								if($checkin_time>=$value->fromdate && $checkout_time<=$value->todate){
									if($monthly>0 && $total_nights>0){
										$rate_cal=($monthly/30)*$total_nights;
										$rates+=round($rate_cal);
									}
									$min_nights=$value->minimumstay;
								}
								elseif($checkin_time>=$value->fromdate && $checkin_time<=$value->todate){
									//checkin exist in one saeson
									$nights=date_diff(date_create(date('Y-m-d',$value->todate)),date_create($checkin))->days;
									$nights+=1;
									if($monthly>0 && $nights>0){
										$rate_cal=($monthly/30)*$nights;
										$rates+=round($rate_cal);
									}
									$min_nights=$value->minimumstay;
								}elseif($checkout_time>=$value->fromdate && $checkout_time<=$value->todate){
									//checkout exist in one saeson
									$nights=date_diff(date_create(date('Y-m-d',$value->fromdate)),date_create($checkout))->days;
									if($monthly>0 && $nights>0){
										$rate_cal=($monthly/30)*$nights;
										$rates+=round($rate_cal);
									}/*else {
										echo "<script>alert('Booking are not available between these dates.')</script>";
		            					echo "<script>window.location='$redirect'</script>";
		            				}*/
		            			}
		            		}elseif($total_nights<30 && $total_nights>=7){
		            			// checkin and checkout  exist in same season
		            			if($checkin_time>=$value->fromdate && $checkout_time<=$value->todate){
		            				if($weekly>0 && $total_nights>0){
		            					$rate_cal=($weekly/7)*$total_nights;
		            					$rates+=round($rate_cal);
		            				}
		            				$min_nights=$value->minimumstay;
		            			}elseif($checkin_time>=$value->fromdate && $checkin_time<=$value->todate){
		            				//checkin exist in one season
		            				$nights=date_diff(date_create(date('Y-m-d',$value->todate)),date_create($checkin))->days;
		            				$nights+=1;
		            				if($weekly>0 && $nights>0){
		            					$rate_cal=($weekly/7)*$nights;
		            					$rates+=round($rate_cal);
		            				}
		            				$min_nights=$value->minimumstay;
		            			}elseif($checkout_time>=$value->fromdate && $checkout_time<=$value->todate){
		            				//checkout exist in one season
		            				$nights=date_diff(date_create(date('Y-m-d',$value->fromdate)),date_create($checkout))->days;
		            				if($weekly>0){
		            					$rate_cal=($weekly/7)*$nights;
		            					$rates+=round($rate_cal);
		            				}
		            			}/*else {
									echo "<script>alert('Booking are not available between these dates.')</script>";
						            echo "<script>window.location='$redirect'</script>";
								}*/
							}elseif($total_nights<7 && $total_nights>0){
								// checkin and checkout  exist in same season
								$one_rate=0;
								if($checkin_time>=$value->fromdate && $checkout_time<=$value->todate){
									if($total_nights>0){
										for($i=1;$i<=$total_nights;$i++){
											$wekend=$st_date->format('D');
											if(($wekend==="Fri") || ($wekend==="Sat") || ($wekend==="Sun")){ 
												$one_rate+= $weekend; 
											}else{
												$one_rate+=$one_night;
											}
											$st_date->modify('+1 day');
										}
										$rates+=$one_rate;
									}
									$min_nights=$value->minimumstay;
								}elseif($checkin_time>=$value->fromdate && $checkin_time<=$value->todate){
									//checkin exist in one season
									$nights=date_diff(date_create(date('Y-m-d',$value->todate)),date_create($checkin))->days;
									$nights+=1;
									if($nights>0){
										for($i=1;$i<=$nights;$i++){
											$wekend=$st_date->format('D');
											if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun")){ 
												$one_rate+= $weekend; 
											}else{
												$one_rate+=$one_night;
											}
											$st_date->modify('+1 day');
										}
										$rates+=$one_rate;
									}
									$min_nights=$value->minimumstay;
								}elseif($checkout_time>=$value->fromdate && $checkout_time<=$value->todate){
									//checkout exist in one season
									$nights=date_diff(date_create(date('Y-m-d',$value->fromdate)),date_create($checkout))->days;
									if($nights>0){
										for($i=1;$i<=$nights;$i++){
											$wekend=$st_date->format('D');
											if(($wekend==="Fri")||($wekend==="Sat")||($wekend==="Sun")){ 
												$one_rate+= $weekend; 
											}else{
												$one_rate+=$one_night;
											}
											$st_date->modify('+1 day');
										}
										$rates+=$one_rate;
									}
								}
							}
					    	/*else {
							   echo "<script>alert('Booking are not available between these dates.')</script>";
							  echo "<script>window.location='$redirect'</script>";
							}*/
						}
					}
					$extra_per_charge =0;
					$other_fee =0;
					$pets_fee =0;
					$refund =0;
					$taxv =0;
					$extra_p_charge=0;
					$cleen_fee =0;
					$extrarates =ExtraFee::where('propertyid',$pro_id)->first();  
					$extra_per_charge= $extrarates->extrafee;
					if($guest > 6 ){
						$extra_guest = $guest-6;
						$extra_p_charge = $extra_guest*$extra_per_charge*$total_nights;
					}	
					$refund = $extrarates->refund;
					$taxv = $extrarates->tax;
					$cleen_fee = $extrarates->clean;
					$totaling=$rates;
					$refund = $refund;
					$total1 = $totaling + $cleen_fee + $pets_fee + $other_fee + $extra_p_charge;
					$tax = ($total1 * $taxv)/100 ;
					$total = $total1 + $tax;
					$request->session()->put('total',$total);
					$k =0;
					if(($total_nights < $min_nights)&&($total_nights>0)){
						echo "<span style='color:#ff3300;background: antiquewhite;padding: 10px;'>Minimum Stay is ".$min_nights." Night</span>"; die();
					}
					$datein=date_create_from_format("Y-m-d",$checkin);
					$firstdate = date_format($datein,"jS F, Y");
					$dateout=date_create_from_format("Y-m-d",$checkout);
					$lastdate = date_format($dateout,"jS F, Y"); ?>
<?php if($totaling==0){
						echo "<span style='color:#ff3300;background: antiquewhite;padding: 3px;'>Rates are not available, Please contact Epsecial Rentals representative.</span>"; die();
					}else{ ?>
<p class="form-control-static">
    <span id="total-night">
        <?php echo $total_nights ;?>
    </span> Nights
    <strong> &nbsp;&nbsp;</strong>
    <span class="value">
        <?php echo $curesyml ?>
        <span class="aaaa">
            <?php echo number_format($totaling,2); ?>
        </span>
    </span>
</p>
<?php if($cleen_fee>0){ ?>
<p class="form-control-static">Cleaning Fee
    <span class="value">
        <?php echo $curesyml ?>
        <span class="bbbb">
            <?php echo number_format($cleen_fee,2); ?>
        </span>
    </span>
</p>
<?php }?>
<?php if($taxv>0){ ?>
<p class="form-control-static">Taxes (<?php echo $taxv.'%' ?>)
    <span class="value">
        <?php echo $curesyml . number_format($tax, 2); ?>
    </span>
</p>
<?php }?>
<p class="form-control-static">Number of Guests
    <span class="value" id="nguest">
        <span class="guest-number">
            <?php echo @$guests ;?>
        </span> Guests
    </span>
</p>
<?php if($total){ ?>
<p class="form-control-static">
    <strong>Total</strong>
    <span class="value">
        <?php echo $curesyml ?>
        <span class="cccc">
            <?php echo number_format($total,2); ?>
        </span>
    </span>
</p>
<div class="form-group">
    <div class="row">
        <?php $bstatus =Property::select('booking_status')->where('id',$pro_id)->first(); ?>
        <?php if($bstatus->booking_status==1) { ?>
        <div class="col-md-12">
            <button type="button" id="book_now" class="btn btn-warning btn-block">Book Now</button>
            <input type="hidden" id="data_amount" name="" value="<?php echo $total; ?>">
            <input type="hidden" name="" id="data_curr" value="<?php echo ($request->currency); ?>">
        </div>
        <?php }else{ ?>
        <div class="col-md-12">
            <button type="button" class="btn btn-warning btn-block" data-toggle="modal"
                data-target="#inquiry-modal">Send Inquiry</button>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php }
				}
			}     
		}
	}

	public function rateCalculation(Request $request){
		if(isset($request->last_date)){
			$startDate = date_format(date_create($this->test_input($request->first_date)),'Y-m-d');
			$endDate = date_format(date_create($this->test_input($request->last_date)),'Y-m-d');
			$guest = $this->test_input($request->guest);
			$child = $this->test_input($request->child);
			$proId = $this->test_input($request->pro_id);
			$curency=trim($request->currency);
			$request->session()->put('startDate',$startDate);
			$request->session()->put('endDate',$endDate);
			$request->session()->put('guest',$guest);
			$request->session()->put('child',$child);
			$request->session()->put('proId',$proId);
			$request->session()->put('curency',$curency);
			$curS = Currency::where(['short_code'=>$curency])->first();
			
			$curesyml = ($curS) ? $curS->symbol : '$';

			// Check Property is Exists
			$isProperty = Property::find($proId);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Property Not Available !!</span>";
			if(!$isProperty){ return ['status' => 1, 'message' => $message];}

			// All Guests
			$guests = $guest + $child;

			// Check Min Stay
			$minStay = ExtraFee::where(['propertyid' => $proId])->first();
			$minimumStay = ($minStay) ? $minStay->min_stay : 2;
			$daysInDates = $this->daysInDates(['startDate' => $startDate, 'endDate' => $endDate]);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Please Select Minimum ".$minimumStay." Days !!</span>";
			if($daysInDates < $minimumStay){ return ['status' => 1, 'message' => $message];}

			// Checking Booking Status
			$isBooked = $this->isBooked(['startDate' => $startDate, 'endDate' => $endDate, 'proId' => $proId]);
			if($isBooked['status']){ return $isBooked; }
    
			// Property Rates Calculation
			$rates = $this->getPropertyRates([ 
				'proId' => $proId,
				'startDate' => $startDate,
				'endDate' => $endDate,
				'daysInDates' => $daysInDates 
			]);

			if(isset($rates['isValid']) && $rates['isValid']){
				$totalAmount = intval($rates['data']);
				$tAmt = $totalAmount;
				$html = '<div id="calC"><p class="form-control-static"><span id="total-night">'.$daysInDates.'</span> Nights <span class="value" style="float:right">'.$curesyml.'<strong> &nbsp</strong><span class="aaaa">'.number_format($tAmt,2).'</span></span></p>';
				// Extra Fees
				$extraFee =ExtraFee::where('propertyid',$proId)->first(); 

				$cleanFee = $extraFee->clean ? $extraFee->clean : 0;
				$refund = $extraFee->refund ? $extraFee->refund : 0;
				$tax = $extraFee->tax ? $extraFee->tax : 0;
				$extraPerson = $extraFee->extraperson ? $extraFee->extraperson : 0;

				// Calculating Extra Person Charges
				if($extraPerson > 0 && $guests > $extraPerson){
					$extraGuest = $guests-$extraPerson;
					$extraPersonCharge = $extraGuest * $extraFee->extrafee * $daysInDates;
					$exPerChrgHtml = '('.$extraGuest.' Guest x '.$extraFee->extrafee.' Rate x '.$daysInDates.' Nights)'; 
					$totalAmount += $extraPersonCharge;
					$html .= '<p class="form-control-static">Additional Guests<span class="value" style="float:right" >'.$curesyml.'<strong> &nbsp;</strong>'.number_format($extraPersonCharge, 2).'</span><small style="font-size:10px; clear: both;display: block;">'.$exPerChrgHtml.'</small></p>';
				}

				// Calculating Tax
				if($tax > 0){
					$taxCharge = ( $totalAmount * $tax ) / 100 ;
					$totalAmount += $taxCharge;
					$html .= '<p class="form-control-static">Taxes ('.$tax.'%) <span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong>'.number_format($taxCharge, 2).'</span></p>';
				}

				// Adding Cleaning Fees
				if($cleanFee > 0){
					$totalAmount += $cleanFee;
					$html .= '<p class="form-control-static">Cleaning Fee<span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="bbbb">'.number_format($cleanFee,2).'</span></span></p>';
				}

				if($totalAmount){
					$html .= '<p class="form-control-static"><strong>Total Amount</strong><span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="cccc">'.number_format($totalAmount,2).'</span></span></p></div>';
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'" >';


					// Check Property Valid for Booking or Send Inquiry
					$html .= '<div class="form-group" id="BtnGroup"><div class="row">';
					if($isProperty->booking_status){
						$html .= '<div class="col-md-12"><a href="https://www.especialrentals.com/booking-details/" class="btn btn-warning btn-block">Book Now</a><input type="hidden" id="data_amount" name="" value="'.round($totalAmount).'"><input type="hidden" name="" id="data_curr" value="'.$curency.'"></div>';
				// 	<button type="button" id="book_now" class="btn btn-warning btn-block" >Book Now</button>
					    
					} else {
						$html .= '<div class="col-md-12"><a href="https://www.especialrentals.com/enquiry/" class="btn btn-warning btn-block">Send Inquiry</a> </div>';
					
					    /*<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#inquiry-modal">Send Inquiry</button>*/
					}
					$html .= '</div></div>';
				} else {
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'">';					
					$html .= '</div>';
				}
				
				return ['status' => 1, 'message' => $html];
			} else {
				return [ 'status' => 1, 'message' => $rates['data']];
			}
		}
	}

	public function isBooked($data){
		$dateOne = $data['startDate'];
		$dateTwo = $data['endDate'];
		$proId = $data['proId'];

		// $qur = "SELECT * FROM ical_events  WHERE (('$dateOne' BETWEEN start_date AND end_date) OR ('$dateTwo' BETWEEN start_date AND end_date)  or (start_date >='$dateOne' and 'end_date' <= '$dateTwo'))  AND propertyid='$proId'";

		$qur = "SELECT * FROM ical_events  WHERE ((start_date BETWEEN '$dateOne' AND '$dateTwo') OR (end_date BETWEEN '$dateOne' AND '$dateTwo')  or (start_date <= '$dateOne' AND end_date >= '$dateTwo'))  AND propertyid='$proId'";

		$query=DB::select($qur);
		$return = ['status'=>0];
		if($query){
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Some dates are already booked, Choose available dates only</span>";
			$return = ['status'=>1, 'message' => $message];
		}
		return $return;
	}

	public function daysInDates($dates){
		$datetime1 = new DateTime($dates['startDate']);
		$datetime2 = new DateTime($dates['endDate']);
		$difference = $datetime1->diff($datetime2);
		$days = $difference->format('%a');
		return $days;
	}

	public function getPropertyRates($data){
		$startDate = $data['startDate'];
		$endDate = $data['endDate'];
		$proId = $data['proId'];
		$totalNights = intval($data['daysInDates']);
		
		$startSeasonQur = "SELECT * FROM property_rates  WHERE (('$startDate' BETWEEN fromdate AND todate))  AND propertyid='$proId'";
		$endSeasonQur = "SELECT * FROM property_rates  WHERE (('$endDate' BETWEEN fromdate AND todate))  AND propertyid='$proId'";

		$startSeason=DB::select($startSeasonQur);
		$endSeason=DB::select($endSeasonQur);
		if($startSeason && $endSeason){
			if($startSeason[0]->id == $endSeason[0]->id){
				$return = $this->calRate([
					'startSeason' => $startSeason[0], 
					'overLap' => false, 
					'startDate' => $startDate,
					'endDate' => $endDate,
					'totalNights' => $totalNights,
					'proId' => $proId
				]);
			} else {
				$return = $this->calRate([
					'startSeason' => $startSeason[0], 
					'endSeason' => $endSeason[0],
					'overLap' => true,
					'startDate' => $startDate,
					'endDate' => $endDate,
					'totalNights' => $totalNights,
					'proId' => $proId
				]);
			}
			$message = $return;
		} else {
			$message = [ 'isValid' => false , 'data' => "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Rates are not available, Please contact the representative !!</span>" ];
		}

		return $message;
	}

	public function calRate($data){
		$totalNights = intval($data['totalNights']);
		if($data['overLap']){
			$isValid = false;
			$startSeason = $data['startSeason'];
			$startDate = $data['startDate'];

			$endSeason = $data['endSeason'];
			$endDate = $data['endDate'];

			// Calculating Start Days
			$startDays=$this->daysInDates(['startDate' => $startSeason->todate , 'endDate' => $startDate]);
			$startDays += 1; 

			// Calculating End Days
			$endDays=$this->daysInDates(['startDate' => $endDate , 'endDate' => $endSeason->fromdate]);
			$endDays = intval($endDays);

			$tRates = 0;

			// Start Season Variables
			$stDate = DateTime::createFromFormat('Y-m-d', $startDate);
			$stmonthly = $startSeason->monthrate ? $startSeason->monthrate : 0;
			$stweekly = $startSeason->weekrate ? $startSeason->weekrate : 0;
			$stweekEnd = $startSeason->weekend ? $startSeason->weekend : 0;
			$stperNight = $startSeason->nightrate ? $startSeason->nightrate : 0;

			// End Season Variables
			$enDate = DateTime::createFromFormat('Y-m-d', $endSeason->fromdate);
			$enmonthly = $endSeason->monthrate ? $endSeason->monthrate : 0;
			$enweekly = $endSeason->weekrate ? $endSeason->weekrate : 0;
			$enweekEnd = $endSeason->weekend ? $endSeason->weekend : 0;
			$enperNight = $endSeason->nightrate ? $endSeason->nightrate : 0;			

			if($totalNights >= 30){
				// Start Season Calculation
				$strate_cal=($stmonthly/30)*$startDays;
				$tRates += round($strate_cal);

				// End Season Calculation
				$enrate_cal=($enmonthly/30)*$endDays;
				$tRates += round($enrate_cal);

				$isValid = true;

			} elseif($totalNights<30 && $totalNights>=7){
				// Start Season Calculation
				$strate_cal=($stweekly/7)*$startDays;
				$tRates += round($strate_cal);

				// End Season Calculation
				$enrate_cal=($enweekly/7)*$endDays;
				$tRates += round($enrate_cal);

				$isValid = true;

			} elseif($totalNights<7 && $totalNights>0){
			    $one_rate=0;
				// Start Season Calculation
				for($i=1;$i<=$startDays;$i++){
					$stweekend=$stDate->format('D');
					if(($stweekend=="Sat") || ($stweekend=="Sun")){ 
						$one_rate+= $stweekEnd; 
					}else{
						$one_rate+=$stperNight;
					}
					$stDate->modify('+1 day');
				}
				// End Season Calculation
				for($i=1;$i<=$endDays;$i++){
					$enweekend=$enDate->format('D');
					if(($enweekend=="Sat") || ($enweekend=="Sun")){ 
						$one_rate+= $enweekEnd; 
					}else{
						$one_rate+=$enperNight;
					}
					$enDate->modify('+1 day');
				}

				$isValid = true;
				$tRates += round($one_rate);

			} else {
				$tRates = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>This Property Is Not Available for These Days !!</span>";
				$isValid = false;
			}

			// Calculation of Mid Seasons
			if($isValid){
				$tRates += $this->calMidSeason($data);
			}

			return [ 'isValid' => $isValid, 'data' => $tRates];
		} else {
			$isValid = false;
			$startSeason = $data['startSeason'];
			$stDate = date_create($data['startDate']);
			$monthly = $startSeason->monthrate ? intval($startSeason->monthrate) : 0;
			$weekly = $startSeason->weekrate ? $startSeason->weekrate : 0;
			$weekEnd = $startSeason->weekend ? $startSeason->weekend : 0;
			$perNight = $startSeason->nightrate ? $startSeason->nightrate : 0;
			if($totalNights >= 30){
				$rate_cal=($monthly/30)*$totalNights;
				$rates=round($rate_cal);
				$isValid = true;
			} elseif($totalNights<30 && $totalNights>=7){
				$rate_cal=($weekly/7)*$totalNights;
				$rates=round($rate_cal);
				$isValid = true;
			} elseif($totalNights<7 && $totalNights>0){
				$one_rate=0;
				for($i=1;$i<=$totalNights;$i++){
					$weekend=$stDate->format('D');
					if(($weekend==="Sat") || ($weekend==="Sun")){ 
						$one_rate+= $weekEnd; 
					}else{
						$one_rate+=$perNight;
					}
					$stDate->modify('+1 day');
				}
				$rates=round($one_rate);
				$isValid = true;
			} else {
				$rates = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>This Property Is Not Available for These Days !!</span>";
				$isValid = false;
			}

			return [ 'isValid' => $isValid, 'data' => $rates];
		}
	}

	public function calMidSeason($data){
		$totalNights = intval($data['totalNights']);
		$startDate = $data['startDate'];
		$endDate = $data['endDate'];
		$proId = $data['proId'];
		$tRates = 0;
		$midSeasonQur = "SELECT * FROM property_rates where fromdate > '$startDate' AND todate < '$endDate' and propertyid = '$proId'";
		$midSeason=DB::select($midSeasonQur);
		if(isset($midSeason) && count($midSeason)){
			foreach ($midSeason as $value) {

				// Calculating Start Days
				$startDays=$this->daysInDates(['startDate' => $value->fromdate , 'endDate' => $value->todate]);
				$startDays += 1; 

				// Mid Season Variables
				$stDate = date_create($value->fromdate);
				$stmonthly = $value->monthrate ? $value->monthrate : 0;
				$stweekly = $value->weekrate ? $value->weekrate : 0;
				$stweekEnd = $value->weekend ? $value->weekend : 0;
				$stperNight = $value->nightrate ? $value->nightrate : 0;

				if($totalNights >= 30){
					// Mid Season Calculation
					$strate_cal=($stmonthly/30)*$startDays;
					$tRates += round($strate_cal);

				} elseif($totalNights<30 && $totalNights>=7){
					// Mid Season Calculation
					$strate_cal=($stweekly/7)*$startDays;
					$tRates += round($strate_cal);

				} elseif($totalNights<7 && $totalNights>0){
					// Mid Season Calculation
					$one_rate=0;
					for($i=1;$i<=$startDays;$i++){
						$stweekend=$stDate->format('D');
						if(($stweekend==="Sat") || ($stweekend==="Sun")){ 
							$one_rate+= $stweekEnd; 
						}else{
							$one_rate+=$stperNight;
						}
						$stDate->modify('+1 day');
					}

					$tRates += round($one_rate);

				}
			}
		} 
		return $tRates;
	}
}	