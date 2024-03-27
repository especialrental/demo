<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Property;
use App\Model\Blog;
use App\Model\City;
use App\Model\Blog_Comments;
use App\Model\ExtraFee;
use App\Model\Currency;
##use App\Model\Property;
use App\Helpers\Common_helper;
use DateTime;
use DB;
use Session;

class IndexController extends Controller
{
     

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
     public function blogComments(Request $request){
		//return $request->all();
		$blog = array('blog_id'=>$request->blogid,'blogurl'=>$request->blogurl, 'name'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone, 'user_comment'=>$request->comment,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
		
		$b = Blog_Comments::insert($blog);
		
		if($b)
		{
		    echo "1";
		}
		else
		{
		    echo "2";
		}
        
    return $_SERVER["HTTP_REFERER"];
	}
	
	

	
    public function index()
    {
        $data=array();
        
        $data['meta_tag'] = 'Apartments for Rent in Dublin, London, Paris | Especial Rentals';
        $data['meta_description'] = 'We offer the largest selection of Luxury Apartments For Rent, Vacation Rentals and Holiday Homes in Paris, London, Dublin for Leisure and Corporate Travelers.';
        
        return view('index',$data);
    }
    
    public function demoUrl()
    {
        return view('demo');
    }
    
    public function enquiry(){
         $startDate = session('startDate');
         $endDate = session('endDate');
         $guest = session('guest');
         $child = session('child');
         $proId = session('proId');
         $curency= session('curency');
        $data['curency'] = $curency;
         $data['id'] = $proId;
		    $dataid =Property::find($proId);
		    $data=array();
    		$data['properties']= Property::where('id','=',$proId)->first();
    	    $data['city'] = City::orderBy('id', 'asc')->get();
            $curS = Currency::where(['short_code'=>$curency])->first();
			$curesyml = ($curS) ? $curS->symbol : '$';
			// Check Property is Exists
			$isProperty = Property::find($proId);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Property Not Available !!</span>";
			if(!$isProperty) return ['status' => 1, 'message' => $message];
			// All Guests
			$guests = $guest + $child;
			// Check Min Stay
			$minStay = ExtraFee::where(['propertyid' => $proId])->first();
			$minimumStay = ($minStay) ? $minStay->min_stay : 2;
			$daysInDates = $this->daysInDates(['startDate' => $startDate, 'endDate' => $endDate]);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Please Select Minimum ".$minimumStay." Days !!</span>";
			if($daysInDates < $minimumStay) return ['status' => 1, 'message' => $message];

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
				$data['tAmt'] = $totalAmount;
				$data['daysInDates'] = $daysInDates;
				$data['curesyml'] = $curesyml;
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
					$data['tax'] = $tax;
					$data['taxCharge'] = $taxCharge;
					$html .= '<p class="form-control-static">Taxes ('.$tax.'%) <span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong>'.number_format($taxCharge, 2).'</span></p>';
				}

				// Adding Cleaning Fees
				if($cleanFee > 0){
					$totalAmount += $cleanFee;
					$data['cleanFee'] = $cleanFee;
					$html .= '<p class="form-control-static">Cleaning Fee<span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="bbbb">'.number_format($cleanFee,2).'</span></span></p>';
				}
                $data['guests'] = $guests;
				if($totalAmount){
				    $data['totalAmount'] = $totalAmount;
				    $data['guests'] = $guests;
					$html .= '<p class="form-control-static"><strong>Total Amount</strong><span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="cccc">'.number_format($totalAmount,2).'</span></span></p></div>';
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'" >';


					// Check Property Valid for Booking or Send Inquiry
					$html .= '<div class="form-group" id="BtnGroup"><div class="row">';
					if($isProperty->booking_status){
					    $data['curency'] = $curency;
					    $data['startDate'] = $startDate;
                        $data['endDate'] = $endDate;
						$html .= '<div class="col-md-12"><input type="hidden" id="data_amount" name="" value="'.round($totalAmount).'"><input type="hidden" name="" id="data_curr" value="'.$curency.'"></div>';
					
					 
					} else {
						$html .= '';
					}
					$html .= '</div></div>';
				} else {
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'">';					
					$html .= '</div>';
				}
				$data['curency'] = $curency;
			    $data['startDate'] = $startDate;
                $data['endDate'] = $endDate;
				 return view('enquiry',$data);
				//return ['status' => 1, 'message' => $html];
			} 
			
    }
    public function bookingDetails()
    {
        $startDate = session()->get('startDate');
        $endDate = session()->get('endDate');
        $guest = session()->get('guest');
        $child = session()->get('child');
        $proId = session()->get('proId');
        $curency= session()->get('curency');
        $data['curency'] = $curency;
         $data['id'] = $proId;
		    $dataid =Property::find($proId);
		   $data=array();
		
    		$data['properties']= Property::where('id','=',$proId)->first();
    	    $data['city'] = City::orderBy('id', 'asc')->get();
         
         $curS = Currency::where(['short_code'=>$curency])->first();
			$curesyml = ($curS) ? $curS->symbol : '$';

			// Check Property is Exists
			$isProperty = Property::find($proId);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Property Not Available !!</span>";
			if(!$isProperty) return ['status' => 1, 'message' => $message];

			// All Guests
			$guests = $guest + $child;

			// Check Min Stay
			$minStay = ExtraFee::where(['propertyid' => $proId])->first();
			$minimumStay = ($minStay) ? $minStay->min_stay : 2;
			$daysInDates = $this->daysInDates(['startDate' => $startDate, 'endDate' => $endDate]);
			$message = "<span style='color:#ff3300;background: antiquewhite;padding: 5px;'>Please Select Minimum ".$minimumStay." Days !!</span>";
			if($daysInDates < $minimumStay) return ['status' => 1, 'message' => $message];

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
				$data['tAmt'] = $totalAmount;
				$data['daysInDates'] = $daysInDates;
				$data['curesyml'] = $curesyml;
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
					$data['tax'] = $tax;
					$data['taxCharge'] = $taxCharge;
					$html .= '<p class="form-control-static">Taxes ('.$tax.'%) <span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong>'.number_format($taxCharge, 2).'</span></p>';
				}

				// Adding Cleaning Fees
				if($cleanFee > 0){
					$totalAmount += $cleanFee;
					$data['cleanFee'] = $cleanFee;
					$html .= '<p class="form-control-static">Cleaning Fee<span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="bbbb">'.number_format($cleanFee,2).'</span></span></p>';
				}

				if($totalAmount){
				    $data['totalAmount'] = $totalAmount;
				    $data['guests'] = $guests;
					$html .= '<p class="form-control-static"><strong>Total Amount</strong><span class="value" style="float:right">'.$curesyml.'<strong> &nbsp;</strong><span class="cccc">'.number_format($totalAmount,2).'</span></span></p></div>';
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'" >';


					// Check Property Valid for Booking or Send Inquiry
					$html .= '<div class="form-group" id="BtnGroup"><div class="row">';
					if($isProperty->booking_status){
					    $data['curency'] = $curency;
					    $data['startDate'] = $startDate;
                        $data['endDate'] = $endDate;
						$html .= '<div class="col-md-12"><input type="hidden" id="data_amount" name="" value="'.round($totalAmount).'"><input type="hidden" name="" id="data_curr" value="'.$curency.'"></div>';
					
					 
					} else {
						$html .= '';
					}
					$html .= '</div></div>';
				} else {
					$html .= '<input type="hidden" class="guest-number" value="'.$guests.'">';					
					$html .= '</div>';
				}
				 return view('booking-details',$data);
				//return ['status' => 1, 'message' => $html];
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
							<span class="value" >
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
											<button type="button" id="book_now" class="btn btn-warning btn-block" >Book Now</button>
											<input type="hidden" id="data_amount" name="" value="<?php echo $total; ?>">
											<input type="hidden" name="" id="data_curr" value="<?php echo ($request->currency); ?>">
										</div>
									<?php }else{ ?>
										<div class="col-md-12">
											<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#inquiry-modal">Send Inquiry</button>
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
     
    public function vacationrentalsdublin()
    {
        return view('vacationdubling');
    }
     
    
    public function luxuryapartmentsdublin()
    {
        return view('luxuryapartmentsdublin');
    }
    
    public function shorttermrentalsparis(){
        return view('shorttermrentalsparis');
    }
     
    public function makeAnEnquiry(){
        $data['city'] = City::orderBy('id', 'asc')->get();
        return view('make-an-enquiry',$data);
    }
    
    public function luxuryapartmentsrentparis(){
        return view('luxuryapartmentsrentparis');
    }
    
    public function parisvacationrentals(){
        return view('parisvacationrentals');
    }
    
    public function Blog(){
        $data['bTitle'] = 'Especialrentals | Blog';
        $data['blog']=Blog::orderBy('id', 'desc')->paginate(100);
        return view('blog', $data);
    }
    
    public function getDetails(Request $request,$id){
	//	dd($id);
		$data=array();
		$b = Blog::Where('url','=',$id)->first();
		if(!empty($b)){
		$data['blog']= Blog::Where('url','=',$id)->first();
		$data['resent']=Blog::orderBy('id', 'desc')->paginate(100);
		$data['comment']= Blog_Comments::groupBy('name')->where('status', 1)->Where('blogurl','=',$id)->get();
		return view('blog-details',$data);
		}
		else{
		    return redirect('404');
		}
	}
	
	 
    public function AboutUs(){
        $data['bTitle'] = 'Especialrentals | About Us';
        return view('aboutus', $data);
    }
    public function ContactUs(){
        $data['bTitle'] = 'Especialrentals | Contact Us';
        $data['meta_tag'] = 'Contact ESPECIAL RENTALS for Holiday Homes, Serviced Apartments, Long Term Rentals';
        $data['meta_description'] = 'Find luxury holiday apartments for long and short stay in Paris, London, New York, Dublin. Contact us today';
        return view('contactus', $data);
    }
    public function WhoWeAre(){
        $data['bTitle'] = 'Especialrentals | Who We Are';
        return view('whoweare', $data);
    }
    public function TermsPrivacy(){
        $data['bTitle'] = 'Especialrentals | Terms and Privacy';
        return view('termsprivacy', $data);
    }
    public function WorkWithUs(){
        $data['bTitle'] = 'Especialrentals | Work With Us';
        return view('workwithus', $data);
    }
    public function Testimonals(){
        $data['bTitle'] = 'Especialrentals | Testimonials';
        return view('testimonals', $data);
    }
    public function getPolicies(){
        $data['bTitle'] = 'Especialrentals | Privacy Policy';
        return view('policies', $data);
    }
    public function getFaqs(){
        $data['bTitle'] = 'Especialrentals | FAQs';
        return view('faqs', $data);
    }
    
     public function Partnerwithus(){
        $data['bTitle'] = 'Especialrentals | Partner With Us';
        return view('partner-with-us', $data);
    }
    
    public function Reviews(){
        $data['bTitle'] = 'Especialrentals | Reviews';
        return view('review', $data);
    }
    
    public function pagenotfound()
	{
	    return view('404');
	}
    
}