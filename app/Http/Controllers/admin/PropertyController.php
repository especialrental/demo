<?php

namespace App\Http\Controllers\admin;

use App\Model\Property;
use App\Model\PropertyType;
use App\Model\Amenities;
use App\Model\Amenity;
use App\Model\PropertyCategory;
use Illuminate\Support\Facades\File; 
use App\Model\Ical_Events;
use App\Model\PropertyRates;

use App\Model\PropertyAmenities;

use App\Model\PropertyGallery;

use App\Model\PropertySpecials;

use App\Model\ExtraFee;
use App\Model\Googlemap;

use Illuminate\Http\Request;

use Hash;

use App\Http\Controllers\Controller;

use Validator;

//use Datatables;
use Carbon\Carbon;
use DB;
use DateTime;
use App\Helpers\Common_helper;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables; 



class PropertyController extends Controller

{

    public function index(){
          
        $data['property'] = Property::orderby('id','desc')->where('status',0)->paginate(5);
        $data['type'] = 0;
        //dd($data['property']);
        return view("admin.property-list",$data)->render();

    }
    public function inactive(){
          
        $data['property'] = Property::orderby('id','desc')->where('status',1)->paginate(5);
        //dd($data['property']);
        $data['type'] = 1;
        return view("admin.property-list",$data)->render();

    }

 public function prop_search(Request $request){
        //dd(2);
 
        $query = $request->search;
        if($query != '')
        {
         $data['property'] = Property::where('propertyname', 'like', '%'.$query.'%')
           ->orWhere('address', 'like', '%'.$query.'%')
           ->orWhere('owner_name', 'like', '%'.$query.'%')
           ->orWhere('owner_address', 'like', '%'.$query.'%')
           ->paginate(10);
           
        }else{
         $data['property'] = Property::orderBy('propertyname', 'desc')
           ->paginate(10);
        }
        return view('admin.search_data',$data)->render();
     }

    public function create(){

        



        $data['propertyTypeData']  = DB::table('property_type')->select('id', 'categoryname')->get();

        $data['productCategory'] = DB::table('category')->select('id','name')->get();

        $data['countryData'] = DB::table('country')->select('id','country_name')->orderby('country_name','asc')->get();

        //dd($countryData);

        $data['zoneData'] = DB::table('timezones')->select('id','timezone')->get();

        $data['amenityData'] = DB::table('amenity')->select('id','amen_value')->orderBy('amen_value','asc')->get();



            /*$amenityData = DB::table('amenity')

            ->leftJoin('sub_amenity', 'amenity.id', '=', 'sub_amenity.aid')

            ->get();*/



        //dd($amenityData);

        

        return view("admin.property",$data);



    }



    public function edit(Request $request,$id){

     //dd($id);

     $data['propertyTypeData']  = DB::table('property_type')->select('id', 'categoryname')->get();

     //dd($propertyTypeData);

        $data['productCategory'] = DB::table('category')->select('id','name')->get();

        $data['countryData'] = DB::table('country')->select('id','country_name')->orderby('country_name','asc')->get();

        //dd($countryData);

        $data['zoneData'] = DB::table('timezones')->select('id','timezone')->get();

        $data['amenityData'] = DB::table('amenity')->select('id','amen_value')->get();

        $data['property'] = Property::find($id);
        
        $data['propertyCat'] = DB::table('property_category')
        ->select(DB::raw("GROUP_CONCAT(DISTINCT categoryid) AS ids"))
        ->where(['propertyid'=>$id])->get();  
        $data['proAmenity'] = DB::table('property_amenities')
        ->select(['id','propertyid','category','subcategory'])
        ->where(['propertyid'=>$id])->get(); 
          
        PropertyAmenities::Where('propertyid','=',$id)->get();
        $data['propGallery'] = PropertyGallery::Where('propertyid','=',$id)->orderby('photoorder','asc')->get();
        $data['propRates'] = PropertyRates::Where('propertyid','=',$id)->orderBy('fromdate', 'asc')->get();
        $data['propSpecial'] = PropertySpecials::Where('propertyid','=',$id)->get();
        $data['extraRates'] = ExtraFee::Where('propertyid','=',$id)->first();
        $data['events'] = Ical_Events::Where('propertyid','=',$id)->get();

        $data['latlan'] = Googlemap::Where('propertyid','=',$id)->first();
        $data['propertyId'] = $id;
        //dd($data['events']);

     return view("admin.property",$data);   

    

    }

    private function isModelRecordExist($model, $recordId)
    {
        if (!$recordId) return false;

        $count = $model->where(['propertyid' => $recordId])->count();

        return $count ? true : false;
    }
    
    private function returnDates($fromdate, $todate) {
	    $fromdate = \DateTime::createFromFormat('m-d-Y', $fromdate);
	    $todate = \DateTime::createFromFormat('m-d-Y', $todate);
	    return new \DatePeriod(
	        $fromdate,
	        new \DateInterval('P1D'),
	        $todate->modify('+1 day')
	    );
	} 
	
    public function dates(Request $request){
    	if(isset($request->data)){
    		$a = $request->data;
    		$b = explode(",", $a);
            array_pop($b);
            for ($i=0; array_key_exists($i, $b); $i+=2) {
			    $aa[] = $b[$i];
			}
				for ($j=1; array_key_exists($j, $b); $j+=2) {
			   $zz[] = $b[$j];
			}

			if(isset($aa)){
			$startDate[] = end($aa);
			}
			if(isset($zz)){
			$endDate[] = end($zz);
			}

    	if(isset($startDate) && isset($endDate)){
		  $date1 = $startDate[0];
		  $date2 = $endDate[0];

		  $sdate = DateTime::createFromFormat('m-d-Y', $date1);
		  $start_date = $sdate->format('Y-m-d');
		  $edate = DateTime::createFromFormat('m-d-Y', $date2);
		  $end_date = $edate->format('Y-m-d');
          
          

		  $datePeriod = $this->returnDates($date1, $date2);
			foreach($datePeriod as $date) {
			    $ad[] = $date->format('m-d-Y');
			}
		if(isset($ad))
		{
		$count = count($ad);
		$aaa = "";
		$bbb = "";
		$seperator = ",";
		foreach($ad as $val)
		{
			$aaa .= "'".$val."'".$seperator;
			$bbb .= "#".$val.$seperator;
		}
		
      $t = rtrim($aaa, $seperator);
		$s = rtrim($bbb, $seperator);
		/*$sel = mysqli_query($conn, "SELECT * FROM ".$ical_events." WHERE end_date <= '".$end_date."' AND start_date >= '".$start_date."' AND event_pid='".$property_id."'");
		$row=mysqli_num_rows($sel);*/
		$row = Ical_Events::Where('propertyid','=',$request->id)->first();
		if($row)
		{
		echo "zero";		
		}
		else
		{
			if($count>1) //if select more than one date
			{
		         echo $s;
			}
			else
			{
			echo "two";
			}
		} //if select more than one date ends 
		}  //else row > 0 ends
		} // if isset $ad ends
      }  
     
    }
    
    public function selected_dates(Request $request){
    	//dd($request->all());
       $data['start_date'] = $request->first_date;
       $data['end_date'] = $request->last_date;
       //return view("admin.property",$data);
       //$this->set('admin.property', $data);
    }

    private function GetDays($sStartDate, $sEndDate){  

              $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  

              $sEndDate = gmdate("Y-m-d", strtotime($sEndDate)); 

              // Start the variable off with the start date  

             $aDays[] = gmdate("m-d-Y", strtotime($sStartDate)); 
             // Set a 'temp' variable, sCurrentDate, with  

             // the start date - before beginning the loop  

             $sCurrentDate = $sStartDate;  
             // While the current date is less than the end date  

             while($sCurrentDate < $sEndDate){
               // Add a day to the current date  

               $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
               // Add this new day to the aDays array  
               $date = DateTime::createFromFormat('Y-m-d', $sCurrentDate);
               $nice_date = $date->format('m-d-Y');
               $aDays[] = $nice_date; 

             }

             // Once the loop has finished, return the  

             // array of days.  

             return $aDays;  

           }

    public function next_dates(Request $request){
    	if(isset($request->proId)){
    		$dataCal = Ical_Events::Where('propertyid','=',$request->proId)->get();
    		foreach($dataCal as $eve){ 
              $sdate = DateTime::createFromFormat('Y-m-d', $eve->start_date);
               $start_dates = $sdate->format('m-d-Y');
              $edate = DateTime::createFromFormat('Y-m-d', $eve->end_date);
               $end_dates = $edate->format('m-d-Y');      
              @$start[] = $start_dates;
              @$end[] = $end_dates;
             @$ful[] = $this->GetDays($eve->start_date, $eve->end_date);
    		}
    		if(@$ful!="" ){
            foreach($ful as $val)

            {
                array_shift($val);

                array_pop($val);

                @$kd[] = $val;
           
              //$array ='';
              $array  = @$kd;
              $full = Arr::flatten($array);

              @$s_count = count($start);

              @$e_count = count($end);

              @$f_count = count($full);
               }

            }
    	}
    	$html='';
    	if ( isset( $request->month ) ) {
        $month = $request->month;
	    }
	    if ( isset( $request->year ) ) {
	        $year = $request->year;
	    }
	    $day              = cal_days_in_month( CAL_GREGORIAN, $month, $year );
	    $currentTimeStamp = strtotime( "$year-$month-$day" );
	    $monthName        = date( "F", $currentTimeStamp );
	    $numDays          = date( "t", $currentTimeStamp );
	    $counter          = 0;

	    $html.='<div class ="row"><div class="tabl_1 col-xs-6 width2">
			  <table id="table-1">
			    <tr class="hea">
			      <td><div class="cell"></div></td>
			      <td class="cell5" id="nn">'. $monthName .', ' . $year.'</td>
			      <td><div class="cell"></div></td>
			    </tr>
			    <tr class="day_name">
			      <td><div class="cell">Sun</div></td>
			      <td><div class="cell">Mon</div></td>
			      <td><div class="cell">Tues</div></td>
			      <td><div class="cell">Wed</div></td>
			      <td><div class="cell">Thu</div></td>
			      <td><div class="cell">Fri</div></td>
			      <td><div class="cell">Sat</div></td>
			    </tr>';
			    
		$html.='<tr>';
			    for ( $i = 1; $i < $numDays + 1; $i++, $counter++ ) {
			        $timeStamp = strtotime( "$year-$month-$i" );
			        if ( $i == 1 ) {
			            $firstDay = date( "w", $timeStamp );
			            for ( $j = 0; $j < $firstDay; $j++, $counter++ ) {
			                //blank space
			                $html.='<td><div class="cell"></div></td>';
			            }
			        }
			        if ( $counter % 7 == 0 ) {
			            $html.='</tr><tr>';
			        }
			        $monthstring = $month;
			        $monthlength = strlen( $monthstring );
			        $daystring   = $i;
			        $daylength   = strlen( $daystring );
			        if ( $monthlength <= 1 ) {
			            $monthstring = "0" . $monthstring;
			        }
			        if ( $daylength <= 1 ) {
			            $daystring = "0" . $daystring;
			        }
			        $todaysDate = date( "m-d-Y" );
			        $bookdate   =  $monthstring."-".$daystring."-".$year ;
			        $format     = "m-d-Y";
			        $date1      = DateTime::createFromFormat( $format, $todaysDate );
			        $date2      = DateTime::createFromFormat( $format, $bookdate );
			        $html.='<td ';
			        if ( $date2 < $date1 ) {
			            $html.='class="before-today" id="'.$bookdate.'"';
			        } elseif ( $todaysDate == $bookdate ) {
			            $html.= "class='today' id='" . $bookdate . "'";
			        } else {
			            $html.= "class='booking-box' id='" . $bookdate . "'";
			        }
			        $html.= "><div class='ac cell' id='book-" . $bookdate . "' data-theme='div' data-seq='" . $bookdate . "' href=''>" . $i . "</div>";
			        if ( isset( $start ) ) {
			            for ( $k = 0; $k < $s_count; $k++ ) {
			                if ( $start[$k] == $bookdate ) {
			                    $html.= "<div class='first-half-book'><img src='".url('/public/calender/img/left.png')."'/></div>";
			                }
			            }
			        }
			        if ( isset( $full ) ) {
			            for ( $l = 0; $l < $f_count; $l++ ) {
			                if ( $full[$l] == $bookdate ) {
			                    $html.= "<div class='full-book'><img src='".url('/public/calender/img/full.png')."' /></div>";
			                }
			            }
			        }
			        if ( isset( $end ) ) {
			            for ( $m = 0; $m < $e_count; $m++ ) {
			                if ( $end[$m] == $bookdate ) {
			                    $html.= "<div class='last-half-book'><img src='".url('/public/calender/img/right.png')."' /></div>";
			                }
			            }
			        }
			        $html.= "</td>";
			    }
			    $html.= "</tr>
			  </table>
			</div>";

		if ( isset( $request->month ) ) {
        $month = $request->month + 1;
        if ( $request->month == 12 ) {
            $month = 1;
        }
	    } 
	    //return $request->year;
	    if ( isset( $request->year ) ) {
	        if ( $request->month == 12 ) {
	            $year = $request->year + 1;
	        } else {
	            $year = $request->year;
	        }
	    }

	    $day              = cal_days_in_month( CAL_GREGORIAN, $month, $year );
	    $currentTimeStamp = strtotime( "$year-$month-$day" );
	    $monthName        = date( "F", $currentTimeStamp );
	    $numDays          = date( "t", $currentTimeStamp );
	    $counter          = 0;	
	    $html.= '<div class="tabl_2 col-xs-6 width2">
				  <table id="table-2">
				    <tr class="hea">
				      <td><div class="cell"></div></td>
				      <td class="cell5">'.$monthName.','.$year.'</td>
				      <td><div class="cell"></div></td>
				    </tr>
				    <tr class="day_name">
				      <td><div class="cell">Sun</div></td>
				      <td><div class="cell">Mon</div></td>
				      <td><div class="cell">Tues</div></td>
				      <td><div class="cell">Wed</div></td>
				      <td><div class="cell">Thu</div></td>
				      <td><div class="cell">Fri</div></td>
				      <td><div class="cell">Sat</div></td>
				    </tr>';
				    
				    $html.="<tr>";
				    for ( $i = 1; $i < $numDays + 1; $i++, $counter++ ) {
				        $timeStamp = strtotime( "$year-$month-$i" );
				        if ( $i == 1 ) {
				            $firstDay = date( "w", $timeStamp );
				            for ( $j = 0; $j < $firstDay; $j++, $counter++ ) {
				                //blank space
				                $html.= "<td><div class='cell'></div></td>";
				            }
				        }
				        if ( $counter % 7 == 0 ) {
				           $html.="</tr><tr>";
				        }
				        $monthstring = $month;
				        $monthlength = strlen( $monthstring );
				        $daystring   = $i;
				        $daylength   = strlen( $daystring );
				        if ( $monthlength <= 1 ) {
				            $monthstring = "0" . $monthstring;
				        }
				        if ( $daylength <= 1 ) {
				            $daystring = "0" . $daystring;
				        }
				        $todaysDate = date( "m-d-Y" );
				        $bookdate   = $monthstring."-".$daystring."-".$year ;
				        $format     = "m-d-Y";
				        $date1      = DateTime::createFromFormat( $format, $todaysDate );
				        $date2      = DateTime::createFromFormat( $format, $bookdate );
				        $html.= "<td ";
				        if ( $date2 < $date1 ) {
				            $html.= "class='before-today' id='" . $bookdate . "'";
				        } elseif ( $todaysDate == $bookdate ) {
				            $html.= "class='today' id='" . $bookdate . "'";
				        } else {
				            $html.= "class='booking-box' id='" . $bookdate . "'";
				        }
				        $html.= "><div class='ac cell' id='book-" . $bookdate . "' data-theme='div' data-seq='" . $bookdate . "' href=''>" . $i . "</div>";
				        if ( isset( $start ) ) {
				            for ( $k = 0; $k < $s_count; $k++ ) {
				                if ( $start[$k] == $bookdate ) {
				                    $html.= "<div class='first-half-book'><img src='".url('/public/calender/img/left.png')."' /></div>";
				                }
				            }
				        }
				        if ( isset( $full ) ) {
				            for ( $l = 0; $l < $f_count; $l++ ) {
				                if ( $full[$l] == $bookdate ) {
				                    $html.= "<div class='full-book'><img src='".url('/public/calender/img/full.png')."' /></div>";
				                }
				            }
				        }
				        if ( isset( $end ) ) {
				            for ( $m = 0; $m < $e_count; $m++ ) {
				                if ( $end[$m] == $bookdate ) {
				                    $html.= "<div class='last-half-book'><img src= '".url('/public/calender/img/right.png')."' /></div>";
				                }
				            }
				        }
				        $html.= "</td>";
				    }
				    $html.= "</tr>
				
				  </table>
				</div></div>";
		return array('status'=>1,'data'=>$html);
    } 


    public function importCSVData()
    {
        //$users = [];

        if (($open = fopen(storage_path() . "/blog_comments.csv", "r")) !== FALSE) {
            
           /* $data = fgetcsv($open, 1000, ",");
            
            foreach($data as $row){
                echo $id = $row[0];
                $meta = $row[1];
                $metadescription = $row[2];
            }*/

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                 $ids = $data[0];
                $metatag = $data[1];
                $metadescription = $data[2];
                Property::where("id", $ids)
                ->update([
                    'meta_tag' => $metatag,
                    'meta_description' => $metadescription
                ]);
            }

            fclose($open);
        }

         
        }
        
 

    public function savemultiple(Request $request)
    {
         $images=array();
        if($files=$request->file('uploads_image')){
         $i=0;
          foreach($files as $file){
            $name = rand().'.'.$file->getClientOriginalExtension();
            $folder=public_path('uploads/property_image/'.$request->id.'/');
            if (!file_exists('uploads/property_image/'.$request->id)){
             $desired_dir = mkdir('uploads/property_image/'.$request->id, 0777, true);
            }

            $file->move(public_path('uploads/property_image/'.$request->id), $name);
             $images[]=$name;
            //$capTion = $caption[$i];

            $a = $i + 0;

            DB::table('property_gallery')->insert([

            'propertyid'=>$request->id, 'photoname' => $name, 'photoorder'=>$a

            ]);

            $i++;

          }  

        }
        return back()->with('message','Property Add/Update Successfully !');
        
    }
    public function save(Request $request){

       //dd($request->all());

        

        $validator =$request->validate(

            array(

                "praddress"=>"required",

                "zip"=>"required",

                "propertyname"=>"required"

            ) 

        );



        if($request->pid){

            $property = Property::find($request->pid);

        }

        else{

            $property = new Property;

            

        } 

        

        $property->address=$request->praddress;

        $property->country=$request->country;
        
        $property->area_info=$request->area_info;

        $property->transportation=$request->transportation;

        $property->state=$request->state;

        $property->city=$request->city;  

        $property->town=$request->area;

        $property->zipcode=$request->zip;

        //lat,lan,timezone

        $property->propertyname=$request->propertyname;
        
        $property->url =$request->url;

        $property->propertytype=$request->propertytype;

        $property->bedrooms=$request->bedrooms;

        $property->baths=$request->baths;

        $property->sleepsno=$request->sleepsno;

        $property->tags=$request->instantbooking;

        $property->short_description=$request->sdescription;

        $property->description=$request->description;

        $property->owner_name=$request->owner;

        $property->owner_email=$request->email;

        $property->owner_address=$request->ownaddr;

        $property->numowner_mobile=$request->maddress1; 

        $property->numowner_alt_phone=$request->paddress1;
        
        $property->meta_tag=$request->meta_tag;
        $property->meta_description=$request->meta_description;

        // Detail Page (The Space Content)
        $property->bed_type=$request->bed_type;
        $property->check_in=$request->check_in;
        $property->check_out=$request->check_out;
        $property->room_type=$request->room_type;
        // Detail Page (The Space Content)

        $property->owner_fax=$request->fax;
        $property->vlink=$request->videos;
        $property->booking_status=($request->instantbooking) ? $request->instantbooking : 0;
        $property->feature_properties=$request->feature_properties;
        $lastInsertId = $property->id;

        $data['propertyId'] = $lastInsertId;         

 

        if($property->save()){

                if(isset($property->id) && $property->id){
                 
                    $status = $this->isModelRecordExist( (new PropertyCategory()), $property->id);
                    if($status){
                        
                       $deleteCat = PropertyCategory::where('propertyid','=',$property->id)->delete();
                       //dd($deleteCat);
                       
                         $category=$request->category;

                            if(isset($category) && !empty($category)){

                            foreach($category as $cat) {

                             $propertyCategory = new PropertyCategory;
                      
                             $propertyCategory->propertyid=$property->id;
                     
                             $propertyCategory->categoryid=$cat;

                             $propertyCategory->save();

                            } }
                       
                       
                    }
                    else{ 
                    $category=$request->category;

                    if(isset($category) && !empty($category)){

                    foreach($category as $cat) {

                     $propertyCategory = new PropertyCategory;
              
                     $propertyCategory->propertyid=$property->id;
             
                     $propertyCategory->categoryid=$cat;

                     $propertyCategory->save();

                    } }}
          //$statusRates = $this->isModelRecordExist( (new PropertyRates()), $property->id);
          $mapdata = array('propertyid'=>$property->id,'lat'=>$request->lat,'longt'=>$request->long,'timezone'=>$request->time);
          if($request->propertyMap > 0){
            Googlemap::where('id','=',$request->propertyMap)->update($mapdata);
          }
           else{
              Googlemap::insert($mapdata);  
           }  
          if(isset($request->Season) && !empty($request->Season)){        
          foreach ($request->Season as $key => $valRates) {  
          $ratesdata = array('propertyid'=>$property->id,'season'=>$valRates,'fromdate'=>$request->From_Date[$key],'todate'=>$request->To_Date[$key],'nightrate'=>$request->Nightly_Rate[$key],'weekrate'=>$request->Weekly_Rate[$key],'weekend'=>$request->weekend_rate[$key],'monthrate'=>$request->Monthly_Rate[$key],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
           
          //dd($ratesdata);  
          /*if(isset($request->season) && !empty($request->season)){*/
          if($request->propertyRates > 0){
            PropertyRates::where('id','=',$request->propertyRates)->update($ratesdata);
          }
           else{
              PropertyRates::insert($ratesdata);  
           }}} 

        //DB::table('property_rates')->insert($data);   
        //PropertyRates::create($data)->save();
        //$statusSpeical = $this->isModelRecordExist( (new PropertySpecials()), $property->id);
        if(isset($request->dealseason) && !empty($request->dealseason)){   
        foreach ($request->dealseason as $key => $valOffer) { 
        $specialdata = array('propertyid'=>$property->id,'specialfrom'=>strtotime($request->OFrom_Date[$key]),'specialto'=>strtotime($request->OTo_Date[$key]),'specialtype'=>$request->specialType[$key],'nightrate'=>$request->ONightly_Rate[$key],'weekrate'=>$request->OWeekly_Rate[$key],'monthrate'=>$request->OMonthly_Rate[$key],'tagline'=>$valOffer,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
        //dd($specialdata);
        /*if(isset($request->dealseason) && !empty($request->dealseason)){*/
        if($request->propertySpecial > 0){
            PropertySpecials::where('id','=',$request->propertySpecial)->update($specialdata);
          }
           else{
              PropertySpecials::insert($specialdata);  
           }}}
        //DB::table('property_specials')->insert($data);
        
        //$statusExtra = $this->isModelRecordExist( (new ExtraFee()), $property->id);
        $min_stay = ($request->min_stay) ? $request->min_stay : 1;  
        $extradata = array('propertyid'=>$property->id,'clean'=>$request->clean,'refund'=>$request->refund,'extraperson'=>$request->person,'extrafee'=>$request->fee,'tax'=>$request->tax,'extraNotes'=>$request->extrafeenotes,'currency'=>$request->currency,'min_stay'=>$min_stay,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
         if($request->statusExtra > 0){
            ExtraFee::where('id','=',$request->statusExtra)->update($extradata);
          }
           else{
              ExtraFee::insert($extradata);  
           }
        //DB::table('extrafee')->insert($data);

        $statusAme = $this->isModelRecordExist( (new PropertyAmenities()), $property->id);        
        if($statusAme){
            $deleteAmenities = PropertyAmenities::where('propertyid','=',$property->id)->delete();
            if(isset($request->subAmenity) && !empty($request->subAmenity)){

             foreach ($request->subAmenity as $key => $ame) {

                 $propAmenity= new PropertyAmenities;
                   $propAmenity->propertyid= $property->id;
                    $propAmenity->category=$key;
                   $propAmenity->subcategory=implode(',', $ame);
                  $propAmenity->save(); 
             }
           }
          }
        else{
         if(isset($request->subAmenity) && !empty($request->subAmenity)){

            foreach ($request->subAmenity as $key => $ame) {

                 $propAmenity= new PropertyAmenities;
                   $propAmenity->propertyid= $property->id;
                    $propAmenity->category=$key;
                   $propAmenity->subcategory=implode(',', $ame);
                  $propAmenity->save(); 
            } 
          }
        }
 
        //$caption=$request->caption;
        $images=array();
        if($files=$request->file('images')){
         $i=0;
          foreach($files as $file){
            $name = rand().'.'.$file->getClientOriginalExtension();
            $folder=public_path('uploads/property_image/'.$property->id.'/');
            if (!file_exists('uploads/property_image/'.$property->id)){
             $desired_dir = mkdir('uploads/property_image/'.$property->id, 0777, true);
            }

            $file->move(public_path('uploads/property_image/'.$property->id), $name);
             $images[]=$name;
            //$capTion = $caption[$i];

            $a = $i + 0;

            DB::table('property_gallery')->insert([

            'propertyid'=>$property->id, 'photoname' => $name, 'photoorder'=>$a

            ]);

            $i++;

          }  

        }
        
        //dd($request->daterange);
        if(isset($request->search_startdate) && !empty($request->search_startdate)){
        	//$sdate = DateTime::createFromFormat('m-d-Y', $request->search_startdate);
        	
         foreach ($request->search_startdate as $key => $valcal) {
          //$date = str_replace("-", "", $valcal);
          //$input = $date->format('Y-m-d');
          $ymd = DateTime::createFromFormat('m-d-Y', $valcal)->format('Y-m-d');
          $eymd = DateTime::createFromFormat('m-d-Y', $request->search_enddate[$key])->format('Y-m-d');

        $eventdata = array('propertyid'=>$property->id, 'start_date'=>$ymd, 'end_date'=>$eymd,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
        //dd($eventdata);
        if($request->events > 0){
            Ical_Events::where('id','=',$request->events)->update($eventdata);
        }
        else{
            Ical_Events::insert($eventdata);
        }
        }}

        }


         return back()->with('message','Property Add/Update Successfully !');

        }
        //dd($property->id);
    }

    public function delete_Image(Request $request){
    	if($request->id){
            $image =PropertyGallery::find($request->id); 
           
            if($image->delete()){
                return array('status'=>1,'data'=>'Record Deleted!');
            }else{
                return array('status'=>0,'data'=>'Record Not Deleted!');
            }  		
    	}else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function edit_rates(Request $request){
        if($request->id){
            $rates =PropertyRates::find($request->id);
            return array('status'=>1,'data'=>$rates);
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function edit_cal(Request $request){

        if($request->id){
            $rates =Ical_Events::find($request->id);
            return array('status'=>1,'data'=>$rates);
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function edit_special(Request $request){
        if($request->id){
            $rates =PropertySpecials::find($request->id);
            return array('status'=>1,'data'=>$rates);
        }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }
    
    public function delete_Rates(Request $request){
      if($request->id){
            $image =PropertyRates::find($request->id); 
           
            if($image->delete()){
                return array('status'=>1,'data'=>'Record Deleted!');
            }else{
                return array('status'=>0,'data'=>'Record Not Deleted!');
            }     
      }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function delete_cal(Request $request){
      if($request->id){
            $cal =Ical_Events::find($request->id); 
            if($cal->delete()){
                return array('status'=>1,'data'=>'Record Deleted!');
            }else{
                return array('status'=>0,'data'=>'Record Not Deleted!');
            }     
      }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function delete_Special(Request $request){

      if($request->id){
            $image =PropertySpecials::find($request->id); 
            if($image->delete()){
                return array('status'=>1,'data'=>'Record Deleted!');
            }else{
                return array('status'=>0,'data'=>'Record Not Deleted!');
            }     
      }else{
            return array('status'=>0,'message'=>'ID Not found !');
        }
        return array('status'=>0,'message'=>'Some Thing Went Wrong!');
    }

    public function reorder_Image(Request $request){
    	if($request->ids){
          $idArray = $request->ids;
          
          $count = count($idArray);
          for($i=0;$i<$count;$i++){
          	$m =1+$i;
            PropertyGallery::where('id','=',$idArray[$i])->update(array('photoorder' => $m));
          }
          return array('status'=>1,'message'=>'Image Reorder Successfully !');
    	}
    }

    public function update_Caption(Request $request){
    	//return $request->all();
    	if($request->id){
            PropertyGallery::where('id','=',$request->id)->update(array('phototitle' => $request->caption));
    	}
    	return array('status'=>1,'message'=>'Caption Updated Successfully !');
    }
    
    public function active(Request $request){
      //return $request->all();
      if($request->id){
          $first = Property::where('id','=',$request->id)->first();
          if($first->status == 1)
          {
            Property::where('id','=',$request->id)->update(array('status' => 0));
          }else{
            Property::where('id','=',$request->id)->update(array('status' => 1));
          }
          
      }
      return array('status'=>1,'message'=>'Status Updated Successfully !');
    }
    public function update_rates(Request $request){
      //return $request->all();
      if($request->id){
            PropertyRates::where('id','=',$request->id)->update(array('season' => $request->season, 'fromdate' => $request->from, 'todate' =>$request->to, 'nightrate' =>$request->night, 'weekrate' =>$request->weekly, 'weekend' =>$request->weekend, 'monthrate' =>$request->monthly));
      }
       //$data=PropertyRates::where('id','=',$request->id)->get();
      return array('status'=>1,'message'=>'Rates Updated Successfully !');
    }

    public function update_cal(Request $request){
      //return $request->all();
      if($request->id){
            Ical_Events::where('id','=',$request->id)->update(array('start_date' => $request->start,'end_date' => $request->end));
      }
       //$data=PropertyRates::where('id','=',$request->id)->get();
      return array('status'=>1,'message'=>'Slot Updated Successfully !');
    }

    public function update_offer(Request $request){
      //return $request->all();
      if($request->id){
            PropertySpecials::where('id','=',$request->id)->update(array('specialfrom' => strtotime($request->from), 'specialto' =>strtotime($request->to), 'specialtype' => $request->type, 'nightrate' =>$request->night, 'weekrate' =>$request->weekly, 'monthrate' =>$request->monthly, 'tagline'=>$request->season));
      }
      return array('status'=>1,'message'=>'Offer Updated Successfully !');
    } 

    public function delete(Request $request){

        if($request->id){

            

            DB::table('property_category')->where('propertyid', $request->id)->delete();

            DB::table('property_rates')->where('propertyid', $request->id)->delete();

            DB::table('property_specials')->where('propertyid', $request->id)->delete();

            DB::table('extrafee')->where('propertyid', $request->id)->delete();

            DB::table('property_amenities')->where('propertyid', $request->id)->delete();

            DB::table('ical_events')->where('propertyid', $request->id)->delete();
            
            $image_path = "uploads/property_image/".$request->id;
            File::deleteDirectory(public_path($image_path));
            DB::table('property_gallery')->where('propertyid',  $request->id)->delete();

            $property =Property::find($request->id);



            if($property->delete()){

                return array('status'=>1,'data'=>'Record Deleted!');

            }else{

                return array('status'=>0,'data'=>'Record Not Deleted!');

            }

        }else{

            return array('status'=>0,'message'=>'ID Not found !');

        }

        return array('status'=>0,'message'=>'Some Thing Went Wrong!');

    }
    public function booked_property(){
        $data['bookedPropertyData']  = Ical_Events::Where('role','=',0)->get();
        //dd($data['bookedPropertyData']);
       return view("admin.booked_property",$data);
    }
   
    public function delete_booked_property(Request $request){

        if($request->id){

            $booked =Ical_Events::find($request->id);

            if($booked->delete()){

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