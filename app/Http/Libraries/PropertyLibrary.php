<?php



namespace App\Http\Libraries;

//use Illuminate\Support\Facades\Auth;

use File;

use Form;

use DB;

use App\Model\Property;
use App\Model\Ical_Events;
use App\Model\SubAmenity;
use App\Model\PropertyAmenities;
use App\Model\Area;
use App\Model\State;
use App\Model\Country;
use App\Model\City;
use DateTime;

class PropertyLibrary {

  public function propertydata($data,$arg,$arg1,$arg2,$arg3){
//       dd($data, $arg, $arg1, $arg2, $arg3);
        $direction = 'ASC';
     if(isset($data['price']) && !empty($data['price'])){
        $direction = ($data['price']=='hightolow')?'DESC':'ASC';
      }
    DB::enableQueryLog();
    $data['isBooked'] = $this->isBooked($data);
    $property= DB::table('property')
    ->leftjoin('property_rates','property.id','=','property_rates.propertyid')
    ->leftjoin('property_amenities','property.id','=','property_amenities.propertyid')
    ->leftjoin('extrafee','property.id','=','extrafee.propertyid')
    ->whereNotIn('property.id', $data['isBooked'])
    ->where(function($query) use ($data,$arg,$arg1,$arg2,$arg3){
      $query = $query->where('property.status','0');
      if(isset($arg) && $arg != [] && $arg !=""){
        $query->where('property.country', $arg);
      }
      if(isset($arg1) && $arg1 != ""){
        $query->where('property.state', $arg1)->where('property.country',$arg);
      }
      if(isset($arg2) && $arg2 != ""){
        $query->where('property.city', $arg2)->where('property.state',$arg1)->where('property.country',$arg);
      }
      if(isset($arg3) && $arg3 != ""){
        $query->where('property.town', $arg3)
        ->where('property.city',$arg2)
        ->where('property.state',$arg1)
        ->where('property.country',$arg);
      }
       
      
      if(isset($data['property_type']) && $data['property_type']!=''){
        $query->where('property.propertytype', $data['property_type']);
      }
      
      if(isset($data['neighbourhood']) && $data['neighbourhood']!=''){
        $nhood = $data['neighbourhood'];
        $query->whereIn('property.town', $nhood);
      }
      if(isset($data['bed']) && $data['bed']!=''){
        $query->where('property.bedrooms','=', $data['bed']);
      }
      if(isset($data['bath']) && $data['bath']!=''){
        $query->where('property.baths','=', $data['bath']);
      }
      if(isset($data['sleep']) && $data['sleep']!=''){
        $query->where('property.sleepsno','=', $data['sleep']);
      }
    })->where(function($query) use ($data){
      if(isset($data['search_startdate']) && $data['search_startdate']!='' && isset($data['search_enddate']) && $data['search_enddate']!=''){
          $startDate = $data['search_startdate'];
          $endDate = $data['search_enddate'];
          // $query->whereRaw("(property_rates.fromdate > '$startDate' AND property_rates.todate < '$endDate')");
          $query->whereRaw("('$startDate' BETWEEN fromdate AND todate) or ('$endDate' BETWEEN fromdate AND todate) or (fromdate > '$startDate' AND todate < '$endDate')");
      }
    })->where(function($query) use ($data){
        if(isset($data['search_startdate']) && $data['search_startdate']!='' && isset($data['search_enddate']) && $data['search_enddate']!=''){
            $noOfDays = $this->daysInDates(['startDate' => $data['search_startdate'], 'endDate' => $data['search_enddate']]);
            $query->where('extrafee.min_stay', '<=', $noOfDays);
        }
    })->where(function($query) use ($data) {
        if(isset($data['srate']) && $data['srate']!=''){
            $query->whereBetween('property_rates.nightrate',[$data['srate'],$data['erate']]);
            $query->groupBy('property_rates.propertyid');
        } 
    })->where(function($query) use ($data){
    //print_r($data);exit;
      if(isset($data['amenities']) && count($data['amenities'])){
        $ame = $data['amenities'];
        $temp = array();
        foreach ($ame as $value) {
          $subame = SubAmenity::where('amenity' ,'like', '%'.$value.'%')->get();
          if($subame->count()){
              array_push($temp,$subame->first()->id);
          }
        }
        foreach ($temp as $subvalue) {
          $query->where('property_amenities.subcategory','like','%'.$subvalue.'%');
        }
      }
      
      if(isset($data['longterm']) && !empty($data['longterm'])){
        $longterm = $data['longterm'];
        $query->where('property_amenities.subcategory','like','%'.$longterm.'%');
      }
      
    })->select('property.*',DB::raw('property_rates.nightrate as min_rate'))->groupBy('property.id')->orderBy('property_rates.nightrate', $direction)->paginate(9);

//$quries = DB::getQueryLog();
//dd($quries);
    return $property;
  }


  public function isBooked($data){
    $isBooked = [];
    if(isset($data['search_startdate']) && $data['search_startdate']!='' && isset($data['search_enddate']) && $data['search_enddate']!=''){
      $startDate = $data['search_startdate'];
      $endDate = $data['search_enddate'];
      $isBookedQur = Ical_Events::select('propertyid')->distinct()
      ->whereRaw("(('$startDate' BETWEEN start_date AND end_date) or ('$endDate' BETWEEN start_date AND end_date)) or ( start_date > '$startDate' AND end_date < '$endDate' )")->get();
      if($isBookedQur){
        $temp = [];
        foreach ($isBookedQur as $value) {
          array_push($temp, $value->propertyid);
        }
        $isBooked = $temp;
      }
    }
    return $isBooked;
  }
  
    public function daysInDates($dates){
		$datetime1 = new DateTime($dates['startDate']);
		$datetime2 = new DateTime($dates['endDate']);
		$difference = $datetime1->diff($datetime2);
		$days = $difference->format('%a');
		return $days;
    }
}
