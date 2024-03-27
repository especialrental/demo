
@extends('layouts.default')

@section('title', $meta->meta_tag??'')
@section('metatag', $meta->meta_tag??'')
 
@section('meta_description', $meta->meta_description??'')


<?php $url = $meta->url??'';?>



@section('content')

   <section id="property-search-result" class="sidebar-map">
        <div class="sidebar-map-content">
            <div class="map-wrapper">
                <div id="map"></div>
                <div class="loader">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-result-content" >

            <!-- Tabmenu Container / Default Bootstrap Structure -->
            <div class="container">
                <div class="search-tabmenu">

                    <div class="tabmenu-body">
                        <div class="tab-content">
                            <!-- Tabmenu Content 1 / Property For SALE -->
                            <div role="tabpanel" class="tab-pane active" id="for-sale">
                               <form novalidate="" id="my-form" method="get" action="#" enctype = "multipart/form-data" >
								   
                                    <div class="form-body">
                                        <!-- Property for Sale Content Row 1 -->
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 form-group">
                                                <!-- <label for="sale-location">Property Location</label> -->
                                                @php $cName = isset($countryName)? $countryName :'';
                                                   $companyId = isset($coId)? $coId :'';
                                                   $sdate = isset($sdate)? $sdate :'';
                                                   $edate = isset($edate)? $edate :'';
                                                 @endphp
                                                 
                                                <input type="text" class="form-control country_name" id="countryName" name="country_name" placeholder="What will be your next trip be?" value="{{$cName}}">
                                                
                                                <input type="hidden" class="form-control country_name" id="countryName" name="country_name1" placeholder="What will be your next trip be?" value="paris">
                                               
                                                <div id="countryList"></div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 form-group">
                                                <input id="nb-start-date" name="search_startdate" class="form-control" placeholder="Check-in Date" value="{{$sdate}}" autocomplete="off" required="">
                                            </div>
                                            <div class="col-md-6 col-lg-3 form-group">
                                                <input data-date-minDate="2020-04-07" id="nb-end-date" name="search_enddate" class="form-control" value="{{$edate}}" placeholder="Check-out Date" autocomplete="off" required="">
                                            </div>
                                            
                                        </div>
                                        <div class="advanced-search">
                                            <!-- Property for Sale Content Row 2 -->
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" id="property_type" name="property_type" required="">
                                                    <option value="" style="display:none;">Apartment Type</option>
                                                    @foreach($propertyTypeData as $ptypeData)
                                                      @php $selected = (isset($pType)) ? (($pType == $ptypeData->id) ? 'selected' : '') : '';
                                                      @endphp
                                                      <option value="{{ $ptypeData->id }} "{{$selected}}  >{{ $ptypeData->categoryname }}</option>
                                                     @endforeach
                                                </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" id="longterm" name="longterm" required="">
                                                    <option value="" style="display:none;">Select Duration</option>
                                                      <option <?php print (isset($_GET['longterm']) && $_GET['longterm']=='265')?'selected':''; ?> value="265">Long Term Rental</option>
                                                      <option <?php print (isset($_GET['longterm']) && $_GET['longterm']=='279')?'selected':''; ?> value="279">Short Term Rental</option>
                                                </select>
                                                </div>
                                                
                                                @php 
                                                if(isset($neighbourhood) && !empty($neighbourhood)){  
                                                  $nhood = implode(',', $neighbourhood);
                                                  
                                                  print_r($nhood);

                                                @endphp
                                                <input type="hidden" id="nhood" value="{{$nhood}}">
                                                @php } @endphp
                                                <div class="col-md-3 form-group ">
                                                    <div class="dropdown form-control neighbourhood" name="neighbourhood[]" id="Neighbourhood" title="Neighbour" multiple="multiple" style="padding: 6px 5px;"><input type="checkbox" id="unCheckNeighbour" style="margin-top: 10px; margin-right: 5px;"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: transparent;text-transform: capitalize; padding: 0; margin-top: -5px">All Neighbourhood</button>
                                                    <div class="dropdown-menu Neighbourhood" id="nHood" aria-labelledby="dropdownMenuButton" style="overflow-y: auto; max-height: 300px">
                                                      <label>Please Select Location</label>
                                                    </div>         
                                                 </div>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" id="bed" name="bed" required="">
                                                    <option value="" style="display:none;">Bedroom</option> 
                                                    <option value="">Any Bedroom</option> 
                                                    @php $selected = (isset($pBed)) ? (($pBed =='studio')?'selected':''):'';@endphp
                                                    <option value="studio"{{$selected}}>Studio</option>             
                                                    @for($a=1; $a<=7; $a++)
                                                    @php $selected = (isset($pBed)) ? (($pBed == $a)?'selected':''):'';@endphp
                                                    <option value="{{$a}}"{{$selected}}>{{$a}}</option>
                                                    @endfor
                                                </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" name="bath" id="bath" required="">
                                                    <option value="" style="display:none;">Baths</option>   
                                                    <option value="">Any Bathroom</option>
                                                    @for($b=1; $b<=7; $b++)
                                                     @php $selected = (isset($pBath)) ? (($pBath == $b)?'selected':''):'';@endphp
                                                    <option value="{{$b}}"{{$selected}}>{{$b}}</option>
                                                    @endfor
                                                </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" id="sleep" name="sleep" required="">
                                                    <option value="" style="display:none;">Sleeps</option>  
                                                    <option value="">Any Sleeps</option>
                                                    @for($c=1; $c<=12; $c++)
                                                    @php $selected = (isset($pSleep)) ? (($pSleep == $c)?'selected':''):'';@endphp
                                                    <option value="{{$c}}"{{$selected}}>{{$c}}</option>
                                                    @endfor
                                                </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="sale-range-price">Price</label>
                                                        <div class="range-box">
                                                            @php $srate = (isset($srate)) ? $srate: 100;@endphp
                                                            @php $erate = (isset($erate)) ? $erate: 5000;@endphp
                                                            <input id="sale-range-price" data-min="100" data-max="5000" data-from="{{$srate}}" data-to="{{$erate}}" readonly="">
                                                            <input type="hidden" name="srate" id="srate" value="">
                                                            <input type="hidden" name="erate" id="erate" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $sub = \App\Model\OtherFeature::orderBy('categoryname', 'asc')->get(); @endphp

                                            <label>Other Features</label>
                                            <ul class="checklist-box">
                                                @foreach($sub as $subData)
                                                
                                                @php $selectedCategory = array();  
                                                     $checked = '';      
                                                 if(isset($amenities) && !empty($amenities)) {
                                                  $checked = ((in_array($subData->categoryname, $amenities))?'checked':'') ;
                                                 }
                                                 
                                                @endphp
                                                <li><label><input type="checkbox" name="amenities[]" class="amenities" value="{{$subData->categoryname}}"{{$checked}}> {{$subData->categoryname}}</label></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="submit-box">
                                            <a href="#" class="btn-toggle-search pull-left">Show/Hide more filters</a>
                                            <button class="btn btn-primary pull-right btn-submit search_submit" type="button" id="advbutton"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
           {{-- @include('property.search_data') --}}
           
           <!--- contact form --->
           <h4 style="font-weight: 700;
    font-size: 18px;
    text-transform: uppercase;
    margin-left: 25px;
    color: #ff7226;display:none;" >Make an enquiry</h3>
            <div class="mainsec" style="display:none;">
                
               <form class="contact-form info" id="contactinfo">
                   <style>
                       :required:focus {
                          box-shadow: 0  0 6px rgba(255,0,0,0.5);
                          border: 1px red solid;
                          outline: 0;
                        }
                   </style>
               <div class="row">
                  <div class="col-lg-3">
                      <span class="message" id="msgfname"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="uname" placeholder="First Name" name="fname" required="">
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-3">
                      <span class="message" id="msglname"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="uname" placeholder="Last Name" name="lname" required="">
                     </div>
                     
                  </div>
                  
                  
                  <div class="col-lg-3">
                       <span class="message" id="msgemail"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="Last-Name" placeholder="Email" name="email" required="">
                     </div>
                    
                  </div>
                  
                  <div class="col-lg-3">
                      <span class="message" id="msgmobile"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="mobile" placeholder="Phone Number" max="10" min="10" name="mobile" required="">
                     </div>
                     
                  </div>
                  
                  
                  
                   <div class="col-lg-3">
                        <label style="margin:0px;">Check-in Date</label>
                       <span class="message" id="msgsearch_startdate"></span>
                     <div class="form-group">
                          <input id="search_startdate" type="date" name="search_startdate" class="form-control" placeholder="Check-in Date" required="">
                    </div>
                    </div>
                 <div class="col-lg-3">
                     <label style="margin:0px;">Check-out Date</label>
                     <span class="message" id="msgsearch_enddate"></span>
                     <div class="form-group">
                      <input type="date" id="search_enddate" name="search_enddate" class="form-control" placeholder="Check-out Date" required="">
                    </div>
                    </div>
                    <div class="row" style="margin-bottom:24px;z-index:1;margin-left: 3px; margin-right: 0;">
                  
                    
                    <div class="col-lg-3">
                        <label style="margin:0px;"></label>Adult
                        <span class="message" id="msgcount_guests"></span>
                     <div class="form-group">
                        <input type="number" class="form-control" id="count_guests" placeholder="Adult" name="count_guests" required="">
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-3">
                        <label style="margin:0px;"></label>Child
                         <span class="message" id="msgcount_children"></span>
                     <div class="form-group">
                        <input type="number" class="form-control" id="count_children" placeholder="Child" name="count_children" required="">
                     </div>
                    
                  </div>
                  
                </div>
               
               <div class="col-lg-12">
                   <span class="message" id="msgcity"></span>
                     <div class="form-group">
                        
                        <select class="form-control" id="city" name="city" required="">
                         
                        <option >Select Your Location </option>
                        <?php foreach($city as $c){?>
                        
                        <option value="<?php echo $c->city_name;?>">{{$c->city_name}}</option>
                        
                        <?php } ?>
                        
                        </select>
                        
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-12">
                      <span class="message" id="msgdes"></span>
                     <textarea class="form-control" rows="5" name="des" placeholder="Message" required=""></textarea>
                     
                      <!--<button type="submit" class="btn btn-primary pull-right btn-submit">Send Message</button>-->
                      <input type="button" id="isValidateContact" class="btn btn-primary pull-right btn-submit" value="Submit">
                  </div>
                 
                 
                                            
               </div>
            </form>
            </form>
            </div>
        <!---end---->
           
           
          
           
           
           <!-- ====== PAGE CONTENT ====== -->

            <div class="page-section" id="property">



                <div class="container">

 

                    <div class="panel filter-panel">

                        <div class="panel-body">
                           
                            <?php if(isset($paginate)){
                                $count=$properties->count();

                                $page=$properties->currentPage();
                                $start=$page*$paginate-$paginate+1;

                                $end=$page*$paginate+$count-$paginate;
                                $total=$properties->total();
                            }
                            else{
                                $start=0;
                                $total=$properties->count();
                                $end=$total; }  
                            ?>
                            @if($properties->count())
                            <h4 class="filter-title pull-left">{{$start}}-{{$end}} out of {{$total}} Properties</h4>
                            <div class="pull-right">
                                <span class="view-btn btn-grid" onclick="currentActiveTab('grid')"><i class="fa fa-th-large"></i></span>&nbsp;&nbsp;
                                <span class="view-btn btn-list" onclick="currentActiveTab('list')"><i class="fa fa-th-list"></i></span>
                            </div>
                            <div class="sortby" style="margin-left:50%;">
                            <label style="color:#ff7226;">Sort by:</label>
                            <select class="form-control" id="pricefilter" name="pricefilter" required="" style="display:inline-block; width:55%;">
                            <option>Select Price</option>
                            <option <?php print (isset($_GET['price']) && $_GET['price']=='lowtohigh')?'selected':''; ?> value="lowtohigh">Price-Low to High</option> 
                            <option <?php print (isset($_GET['price']) &&  $_GET['price']=='hightolow')?'selected':''; ?>  value="hightolow">Price-High to Low </option>
                        </select>
                        </div>
                        
                            @else
                            <h4 class="filter-title pull-left">Property Not Found</h4>
                            @endif

                            

                        </div>
                      

                    </div>

                    <!-- grid listing -->

                    <div class="property-list grid-view hide archive-flex archive-with-footer">

                        <div class="row">

                         @php if(isset($properties) && !empty($properties)){ @endphp

                            @foreach($properties as $data)

                            <div class="col-lg-6 col-md-6 col-sm-6">

                                <!-- Property Item -->

                                <div class="property-item">

                                    <div class="property-heading">

                                        @php
                                          $latlong=\App\Model\Googlemap::where('propertyid',$data->id)->get(); 
                                            $lat = isset($latlong->first()->lat)? $latlong->first()->lat :0;

                                            $longt = isset($latlong->first()->longt)? $latlong->first()->longt :0;
                                         $sub = \App\Model\PropertyRates::where('propertyid',$data->id)->orderby('nightrate','ASC')->first();

                                          //$subb = isset($sub->nightrate)? $sub->nightrate :'';
                                          $subb = isset($data->min_rate)? $data->min_rate :'';
                                          $currency= \App\Model\ExtraFee::where('propertyid',$data->id)->first();
                                          $nightstay = isset($currency->min_stay)? $currency->min_stay :'';

                                          $currency = isset($currency->currency)? $currency->currency :'';
                                          $rCurrency = App\Model\Currency::where(['short_code'=>$currency,'status'=>'1'])->first();

                                        @endphp

                                        @php
                                         $type = \App\Model\Area::where('id',$data->town)->first();
                						 $city = \App\Model\City::where('id',$data->city)->first();
                						 $type->area_name;
                						 
                						 $roomType = $data->room_type;
                                         $room = Str::slug($roomType, '-');
                						 $str = strtolower($type->area_name);
                						 $area =  Str::slug($str, '-');
                   
                						 $pro = $data->url;
                						 $proUrl = Str::slug($pro, '-');
                						 $cityUrl = Str::slug($city->city_name, '-');
                                        @endphp

                                        <span class="item-price">{{$rCurrency->symbol}}{{$subb}}/Night</span>

                                        <a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" class="item-detail btn" style="text-transform:capitalize!important;" target="_blank">Details <i class="fi flaticon-detail"></i></a>

                                    </div>

                                    @php
                                     $sub = \App\Model\PropertyGallery::where('propertyid',$data->id)->orderby('photoorder','ASC')->get();
                                     
                                    @endphp

                                    @php

                                     $type = \App\Model\PropertyType::where('id',$data->propertytype)->first();



                                    @endphp

                                    <div class="img-box">

                                        <div class="property-label">
                                            @if($type)
                                            <a href="javascript:;" class="property-label__type">
                                            {{$type->categoryname}}
                                            </a>
                                            @endif
                                            
                                        </div>

                                        

                                        <a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" class="img-box__image" target="_blank">

                                            @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp



                                            <img src="{{url('public/uploads/property_image')}}/{{$data->id}}/{{ $username }}" alt="{{$data->propertyname}}" class="img-responsive">

                                        </a>

                                    </div>

                                    <div class="property-content">

                                        <a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" class="property-title">{{$data->propertyname}}</a>

                                        <div class="property-addresses">

                                            {{$data->address}}

                                            <div class="rating pull-right" style="display:flex;align-items: center">
                                                <span style="font-size:12px;">{{$data->avg_rating}}</span>
                                                <div id="rateYo{{$data->id}}" style="margin-right:4px;"></div>

                                                <!-- <script type="text/javascript">

                                                    $("#rateYo{{$data->id}}").rateYo({

                                                        rating: {{$data->avg_rating}},

                                                        starWidth: "15px",

                                                        ratedFill: "#ff7200"

                                                      });

													  $("#rateYo{{$data->id}}").rateYo('option', 'readOnly', true);

                                                </script> -->

                                                <span style="font-size:12px;">({{$data->rating_counts}})</span>

                                            </div>

                                        </div>

                                        

                                        <div class="property-footer">

                                            <div class="item-wide" style="text-transform: capitalize;"><span class="fi flaticon-wide"></span> <strong>Beds:</strong> {{$data->bedrooms}}</div>

                                            <div class="item-room"> <span class="fi flaticon-bathroom"></span> <strong>Baths:</strong> {{$data->baths}}</div>

                                            <div class="item-bathroom"><span class="fi flaticon-room"></span><strong>Sleep:</strong> {{$data->sleepsno}}</div>

                                            <div class="item-bathroom"><span class="fa fa-moon-o"></span><strong>Min Night:</strong> {{$nightstay}}</div>
                                            

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endforeach

                        @php } @endphp    

                        </div>

                    </div>

                    <!-- grid listing END-->



                    <!-- list view START -->

                    @php if(isset($properties) && !empty($properties)){ @endphp

                        @foreach($properties as $data)

                        <div class="property-item property-archive list-view hide col-lg-12 col-md-6 col-sm-6">

                            @php

                             $sub = \App\Model\PropertyGallery::where('propertyid',$data->id)->orderby('photoorder','ASC')->get();

                            @endphp

                            @php

                             $type = \App\Model\PropertyType::where('id',$data->propertytype)->first();

                            @endphp

                            <div class="row">

                                <div class="col-lg-5">

                                    <!-- <a href="{{url('/property')}}/detail/{{$data->id}}" class="property-image" target="_blank"> -->
                                    <a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" class="property-image" target="_blank">

                                        @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp

                                        <img src="{{url('public/uploads/property_image')}}/{{$data->id}}/{{ $username }}" alt="{{$data->propertyname}}">

                                    </a>
                                </div>

                                <div class="col-lg-7">

                                    <div class="property-content">

                                        <h3 class="property-title"><a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" target="_blank">{{$data->propertyname}}</a></h3>

                                        <div class="col-md-12" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;padding:0px;">

                                            @php

                                             $sub = \App\Model\PropertyRates::where('propertyid',$data->id)->orderby('nightrate','ASC')->first();

                                              $subb = isset($sub->nightrate)? $sub->nightrate :'';

											  $currency= \App\Model\ExtraFee::where('propertyid',$data->id)->first();
											  $nightstay = isset($currency->min_stay)? $currency->min_stay :'';

                                          $currency = isset($currency->currency)? $currency->currency :'';
                                          $rCurrency = App\Model\Currency::where(['short_code'=>$currency,'status'=>'1'])->first();
                                          $curesyml = ($rCurrency) ? $rCurrency->symbol : '';
                                          

                                            @endphp

											<div>

                                            <span class="property-price">{{$curesyml}}{{$subb}}/night</span>

                                            <span class="property-label">
                                            @if($type)
                                            <a href="javascript:;" class="property-label__type">{{$type->categoryname}}</a>
                                            @endif

											

                                            <!-- <a href="#" class="property-label__status">Sold</a> -->

                                            

                                        </span>

                                </div>

                                            <div class="rating pull-right"  style="display:flex;align-items: center">
                                                <span style="font-size:12px;">{{$data->avg_rating}}</span>
                                                <div id="rateYoo{{$data->id}}" style="margin-right: 4px;"></div>

                                                 <!-- <script type="text/javascript">

                                                    $("#rateYoo{{$data->id}}").rateYo({

                                                        rating: {{$data->avg_rating}},

                                                        starWidth: "16px",

                                                        ratedFill: "#ff7200"

                                                      });

													  $("#rateYoo{{$data->id}}").rateYo('option', 'readOnly', true);

                                                 </script> -->

                                                  <span style="font-size:12px;">({{$data->rating_counts}}) Reviews</span>

                                                </div>

                                               

                                            </div>

                                        <div class="property-address">

                                            {{$data->address}}

                                        </div><div>

                                        <p class="property-description">{!! $data->short_description !!}</p></div>

                                        <div class="property-footer">

                                            <div class="item-wide" style="text-transform: capitalize;"><span class="fi flaticon-wide"></span> Beds: {{$data->bedrooms}}</div>

                                            <div class="item-room"> <span class="fi flaticon-bathroom"></span> Baths: {{$data->baths}}</div>

                                            <div class="item-bathroom"><span class="fi flaticon-room"></span>Sleep: {{$data->sleepsno}}</div>
                                            
                                            <div class="item-bathroom"><span class="fa fa-moon-o"></span>Min Night: {{$nightstay}}</div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    @php } @endphp  
                    
                    {{$properties->appends($filters)->links("pagination::bootstrap-4")}}






                
                 <?php if($url =='vacation-rental-in-paris'){?>
                <section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
					<h1 style="font-size: 23px;">Get Luxurious Apartments for Rent In Paris</h1>
					<p>Paris is the city of love and home to popular tourist destinations, like the Eiffel Tower. Every year, countless tourists from different corners of the globe visit the city to see the famous spots and feel the vibe. All these people look for the best Paris Apartments for rent where they can live comfortably and enjoy the place like a local.</p>
					
					<p>We have the best accommodation options if you also have plans for a Paris vacation! Get a Paris apartment rental from us, and rest assured that your stay will be memorable. You can find fully furnished Paris apartments for rent, located at prime locations well within your budget, and book your dreamy abode for the entire vacation.</p>
					
					<h3 style="font-size: 23px;">Know These Things Before Exploring Paris Apartments For Rent</h3>
					<p>Whether you are a solo traveler or visiting the place with family, comfortable accommodation is essential. Once you have booked the apartment for rent in Paris, you can focus on exploring every nook and corner of the city. You can find countless options for <a href="https://www.especialrentals.com/">Paris vacation rentals.</a> However, to ensure choosing the best-suited option, you should first sort out your requirements and direct your research toward the right decision.</p>
                    
                    <ul>
                        <li>Decide The Area Where You Wish To Stay and Look For Paris Apartment Rentals There Only.</li>
                        <li>Check the connectivity of the place to the places in your itinerary before making the final booking.</li>
                        <li>Check and ensure there is enough space inside the apartment for rent in Paris that you prefer to book.</li>
                        <li>Verify the availability of your preferred Paris rental apartments on the dates you plan to stay.</li>
                    </ul>
                    <p>Clarity About These Things Would Help You Find The Best Apartment Rentals In Paris And Make Your Stay Comfortable And Memorable.</p>
                    
                    <h3 style="font-size:23px">Secure The Best Paris Apartment Rental</h3>
                    <p><a href="https://www.especialrentals.com/blogs/paris-vacation-rentals-your-complete-handbook-for-short-term-apartment-in-rent">Best apartments for rent in Paris,</a> France, are always in huge demand. So, even though we have countless options in apartments in Paris for rent, the best ones only stay available for a short time. So, if you have found one that suits your requirements, don't think twice before booking the place for the duration you will visit. </p>
                    <p>At the same time, you should avoid making impulsive decisions that would lead to disappointments and might turn your experience sour. So, you should check the amenities that you can find in the apartment, the total property area, and every other detail. Then, once you are fully satisfied, make the final booking! </p>
                    
                    <h3 style="font-size:23px">Mistakes To Avoid While Finalizing The Apartment Rentals Paris</h3>
                    <p>If it is your first visit to the city of love, brace yourself for some deep research. Even if you have people who have visited previously to guide you, your choice of apartment should be your own. To help you make a fair decision, we have listed the mistakes you should avoid.</p>
                    <ul>
                        <li>Though the rental amount is a constraint, you shouldn't keep it a priority. Instead, pick a comfortable place over a cheap one.</li>
                        <li>Check the booking details before the final payment. Check the date, property booked, and every other minute detail.</li>
                        <li>In case you have any queries about your apartments for rent in Paris, France, call our team and get your confusion resolved.</li>
                    </ul>
                    
                    <h3 style="font-size:23px">Highlights Of Our Paris Vacation Rentals</h3>
                    <p>When you book a rental apartment with us, expect to get a place that makes your stay cozy and comfortable. Highlights of our property are:</p>
                    <ul>
                        <li>Fully Furnished place with all modern-day amenities that can make living comfortable</li>
                        <li>You get an apartment of every size, accommodating a solo traveler or a group.</li>
                        <li>Every apartment is at a prime location, with smoother connectivity to the rest of the city.</li>
                    </ul>
                    <h3 style="font-size:23px">Popular Locations For Apartments In Paris Ror Rent</h3>
                    <p>Every nook and corner of Paris is beautiful and worth spending time in! However, some areas are better than the rest of the city. So, while exploring apartment rentals in Paris, you can prefer the locations listed below.</p>
                    <ul>
                        <li>Rue Aubriot</li>
                        <li>Rue Jacques Louvel-Tessier</li>
                        <li>Square Sainte-Croix de la Bretonnerie</li>
                        <li>Rue du Temple</li>
                    </ul>
                    <p>You can find a comfortable and fully furnished apartment to stay and explore the city like a local. So, wait no more, and book your dream abode to enjoy your Paris vacation to the fullest. </p>
				</div>
			</div>
		</section>
		<?php } elseif($url =='dublin-vacation-rentals') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
				    
					<h1 style="font-size: 23px;">Dublin's Finest Rentals: Your Search Made Simple</h1>
					<p>Dublin, the celebrated capital of Ireland, is famed for its captivating landscapes, lively
                        nightlife, prosperous employment prospects, and delicious traditional Irish fare. This city is a
                        prime draw for globetrotters, eager to explore its renowned museums, vibrant art galleries,
                        and pulsating nightlife scene. In addition, the city's rich provision of work and education
                        opportunities has also appealed to ex-pats worldwide, leading to an increasing international
                        move towards Dublin.
                    </p>
					
					<p>
                        All those people planning to live in the city for a short duration often look for apartments to
rent in Dublin. While some are lucky enough to find the perfect abode, others might need
help finding Dublin apartments for rent for a short term. Needless to mention here, if the
stay is uncomfortable, your vacation will get spoilt! So, if you have also planned your next
holiday in this beautiful city, we are here to help you find a perfect place to stay.
                    </p>
					
					<h2 style="font-size: 23px;">The Things to Know Before Looking for Apartments to Rent in Dublin</h2>
					
					<p>Whether looking for a luxury vacation rental in Dublin or a house for a long-term stay, you
                        should have a strategic approach. Start by sorting your requirements and getting clarity
                        about what exactly you want. Once you know everything, you can start exploring your
                        options. Next, decide where you want to live based on your preferences. For example, if you
                        are there to explore the city, choose a central location with easy access to top tourist
                        attractions. Additionally, ensure the nearby restaurants and bakeries serve local food to
                        satisfy your taste buds.
                    </p>
                    
                    <p>
                        Secondly, finalize the property type and the total number of rooms you require before
exploring the Dublin vacation rentals. While a studio apartment would be enough for solo
travellers, a family would need more bedrooms. Similarly, while few people like a city vibe,
others prefer a countryside abode. So, sort your requirements first and use those
parameters as constraints to filter the <a href="https://www.especialrentals.com/" style="color:blue;">houses to rent in Dublin.</a>
                    </p>
					
					<h3 style="font-size: 23px;">Securing Best Apartments for Rent in Dublin Ireland</h3>
                    <p>
                        As Dublin is a popular holiday destination, the best apartments get booked in no time! So,
once you have decided to visit the city, you should immediately start looking for apartments
for rent in Dublin Ireland and secure the one you like the most.
                    </p>
			        
			        <p>
                        There are enough options for a luxury vacation rental in Dublin at all popular locations.
However, starting your research before time can fetch you the best deal. Ensure you check
all the details, including amenities and property area, to avoid confusion later. Moreover,
you should confirm the place's availability for the duration of your stay in the city. Once you
get satisfied, book your Dublin vacation rentals.
                    </p>
			
			        <h4 style="font-size: 23px;">Rental Houses in Dublin: Mistakes to Avoid</h4>
			        
			        <p>If you are going to visit the city for the first time, you would not have any experience in
                        locating apartments for rent in Dublin, Ireland. A lack of knowledge or impulsiveness can
                        lead to poor decision-making. So, it would help if you avoided the mistakes that most
                        travellers make.</p>
			        
			        <ul>
			            <li>Do not choose the houses to rent in Dublin solely based on the rental amount.</li>
			            <li>Always check the booking details carefully and confirm with the team to avoid
                            confusion.</li>
			            <li>If you have any queries about the neighbourhood, get clarity from the team before
                            renting the place.</li>
			        </ul>
			        
			        <p>Understand that not getting a perfect stay can ruin your entire holiday! So, pick a
                        comfortable and safe property that accommodates all your needs.</p>
			
			
			        <h4 style="font-size: 23px;">Holiday Rentals in Dublin: Preferred Locations</h4>
			        
			        <p>For tourists, the location of their houses for rent in Dublin, Ireland matters a lot! You would
                        require easy accessibility to the top tourist destinations and get the best food and vibe of
                        the city. Based on the choices of our previous clients, some of the most preferred locations
                        in the city are:</p>
			        
			        <ul>
			            <li>Pembroke Road</li>
			            <li>Ormond Quay Lower</li>
			            <li>Wood Street</li>
			            <li>Leopardstown</li>
			        </ul>
			        
			        <p>You can pick a property in any of the above locations based on your interest, budget, and
                        availability. You can conveniently find long-term rental apartments in Dublin in these
                        locations even if you plan to stay in the city for a long. All you have to do is be careful with
                        the choices and book the houses for rent in Dublin, Ireland through a trusted company to
                        enjoy a smoother and fuss-free stay!</p>
				</div>
			</div>
		</section>
		
		
		<?php } elseif($url =='vacation-rental-in-london') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
					<h1 style="font-size: 23px;">London Calling: Your Ultimate Apartment Rental Guide</h1>
					<p>London is widely recognized for its impressive architectural styles, ranging from art Deco to
                        Gothic. It is renowned for iconic landmarks such as Big Ben, and it offers an abundance of
                        attractions for tourists. Plan a London holiday and be prepared for endless discoveries every
                        time you visit. If you are a first-time traveler to London, the task of planning might feel
                        overwhelming. However, Especial Rentals is here to assist you! We provide exceptional
                        options for apartments for rent in London, allowing you to experience the city like a true
                        local.</p>
                    
                    <p>We have a wide range of London apartments for rent, catering to the diverse needs of our
                        customers. You can find a fully-furnished place with all the essential amenities at prime
                        locations in the city. So whether you are a solo traveler or coming for a family vacation, we
                        can offer you a place that can accommodate you and fit right within your budget.</p>
					
					<h2 style="font-size: 23px;">Checklist to Consider while Exploring Apartments for Rent in London</h2>
					
					<p>
                        Choosing perfect London apartments for rent from a huge list is a daunting task when each option looks equally beautiful and apt. So, it is crucial that you have a checklist of the things you must check before booking the apartment for your stay during your vacation. Here is
the list of parameters you must keep in mind.
                    </p>
					<ul>
					    <li>
                            Have clarity about the space you need and filter the property options having that
much area. For example, a studio apartment would be apt for solo travelers, while a
family might need more space.
                        </li>
					    <li>
                            Check to verify that the apartment location has better connectivity with the rest of
the city for an easy commute.</li>
					    <li>
                            Confirm the availability of the place for the time duration when you will be visiting
the city.
                        </li>
					</ul>
					<p>The idea is to sort out your requirements before searching for London apartments for rent.</p>
					
					<h3 style="font-size: 23px;">Booking Mistakes to Avoid while Finalizing London rentals apartments</h3>
					
					<p>If you plan everything in a rush, you may make poor choices. The impulse would make you
                        skimp on the research, and you would only pick any random option without proper
                        research. Then, when you reach the place, you realize what blunder you have committed.
                        So, to ensure your vacation spirit stays alive, here are a few mistakes you should avoid while
                        booking London apartment rentals.</p>
					
					<ul>
					    <li>Always double-check the dates and the property details before making final
                            payments for London vacation rentals. If you have any queries, get them resolved by
                            the customer support team.</li>
					    <li>Budget is definitely a significant concern, but it should never be the deciding factor.
                            Choose a property that fits your budget and caters to your requirements, not
                            something that is cheap.</li>
					</ul>
                   
                    <h4 style="font-size: 23px;">Secure Your Favorite Vacation Rentals in London</h4>

                    <p>We have already mentioned that the demand for <a href="https://www.especialrentals.com/" style="color:blue;">apartments for rent in London</a> is
                        increasing rapidly. So, if you have found a place that resonates with your vacation idea, do
                        not waste time booking it! Always make sure to finalize two to three options and compare
                        them to narrow your research to one property. Then, once you are satisfied with what you
                        found, make the final booking.</p>

                    <h4 style="font-size: 23px;">Highlights of all Our London Vacation Rentals</h4>
                    
                    <p>We have multiple options for rental apartments in London, England. Every property speaks
                        finesse and offers the utmost comfort and warmth to the guests. You get a fully furnished
                        apartment with all the modern-day amenities you would require during your stay. Some of
                        the highlights of our serviced apartments London are:</p>

                    <ul>
                        <li>All the London vacation rentals are fully furnished, so you actually would not have to
                            worry about comfort</li>
                        <li>Apartments are located at prime spots, with better connectivity with the rest of the
                            city.</li>
                        <li>You can find a small studio apartment or a bigger place according to your
                            requirements.</li>
                    </ul>

                    <p>All you have to do is spend some time exploring the most beautiful serviced apartments
                        London and choose the one you like the most.</p>


                    
                    <h5 style="font-size: 23px;">Popular Locations for serviced apartments London</h5>
                    
                    <p>Though the entire city has a vibe you would enjoy, a few locations are popular for London
                        apartment rentals and highly in demand. Some of them are:</p>
                    <ul>
                        <li>Great Tower Street</li>
                        <li>Saint George's Road</li>
                        <li>North Tenter Street</li>
                        <li>Millharbour</li>
                        <li>Charing Cross Road</li>
                    </ul>
                    <p>If you also prefer any of these locations for rental apartments, rest assured that there will
                        be enough options! So, start exploring to find your holiday abode in London.</p>
                    
                    </div>
			</div>
		</section>
		
		
		<?php } elseif($url =='holiday-rental-in-newyork') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
					<h1 style="font-size: 23px;">Exploring the Best Holiday Apartments in New York: A Comprehensive Guide to Vacation Rentals</h1>
					<p>New York City, often referred to as "The Big Apple," is a city that never sleeps, and it remains at the top of everyone's travel bucket list. While there is no shortage of hotels in the city, an increasing number of travelers are now opting for a more homey and cost-effective option – holiday apartments. You have come to the right place if you are looking for a world of holiday apartments in New York, apartments for rent in New York, serviced apartments, long-term rental apartments, and short-term New York apartments for rent. You will find the perfect vacation rental here, in the heart of the city that never sleeps.
                    </p>
					
					<h2 style="font-size: 23px;">The Rise of New York Vacation Rentals</h2>
					
					<p>New York City is where dreams come true, and experiencing the city from a vacation rental adds a layer of authenticity that many travelers desire. Holiday apartments offer more than just a place to sleep; they provide an immersive experience in the heart of this vibrant metropolis. But what makes New York vacation rentals so appealing?</p>
					
                    <h2 style="font-size: 23px;">1. A Home Away from Home</h2>
					
					<p>Unlike hotels that offer confined spaces, vacation rentals provide an entire apartment or condo to call your own. This means you will have a spacious living area, a fully equipped kitchen, and, many times, a balcony. After a long day exploring the city, you can unwind in your very own home away from home.</p>

                    <h2 style="font-size: 23px;">2. Budget-Friendly Options</h2>
					
					<p>New York City is known for its high living costs, and accommodations are no exception. Many hotels in prime locations come with a hefty price tag. In contrast, vacation rentals cater to a range of budgets, from luxury apartments to cozy studios. This cost-effective alternative allows you to allocate your resources elsewhere, such as experiencing the city's incredible attractions and dining options.</p>

                    <h2 style="font-size: 23px;">3. Living Like a Local</h2>
					
					<p>Staying in a vacation rental offers you the opportunity to live like a local. You can shop at nearby markets, dine at local eateries, and immerse yourself in the unique neighborhoods that make up this diverse city. This local experience adds depth to your visit and allows you to connect with the city and its people.</p>

                    <h2 style="font-size: 23px;">4. Unparalleled Flexibility</h2>
					
					<p>Hotels often impose rigid check-in and check-out times. Vacation rentals, on the other hand, offer flexibility. You can come and go as you please, following your schedule rather than adhering to hotel rules. This flexibility enhances your overall travel experience.</p>

					<h3 style="font-size: 23px;">The Spectrum of Apartments for Rent in New York </h3>
					
					<p>Having highlighted the appeal of vacation rentals, let us now explore the different types of holiday apartments available in New York. Whether planning a short visit or an extended stay, we have the perfect rental for you. Our serviced apartments in New York are not to be missed. </p>

                    <h3 style="font-size: 23px;">1. Short-Term Apartments for Rent </h3>
					
					<p>Short term New York apartments for rent are an excellent choice for travelers planning a brief stay in the city. These apartments come fully furnished and equipped with all the amenities you need for a comfortable and convenient stay. Whether you are a solo traveler or a family, you will find short-term rentals to suit your requirements. They provide the flexibility to explore the city at your own pace without a long-term commitment.</p>

                    <h3 style="font-size: 23px;">2. Long-Term Rental Apartments in New York</h3>
					
					<p>For those planning an extended stay, long-term rental apartments in New York are an ideal choice. These rentals typically involve lease agreements that span several months or even a year. They offer a stable and homey environment for individuals or families looking to live in the city for an extended period. These rentals provide a sense of belonging, enabling you to truly experience life in New York.</p>

                    <h3 style="font-size: 23px;">3. Serviced Apartments in New York</h3>
					
					<p>Serviced apartments offer a unique blend of hotel-like amenities with the space and comfort of an apartment. These apartments are regularly cleaned and well-maintained, ensuring a hassle-free stay. In addition, you can enjoy services such as room service and a concierge, creating a luxurious experience in the heart of the city. Serviced apartments are a perfect choice for those seeking both comfort and convenience.</p>

                    <p>New York City is a destination like no other, and your choice of accommodation can significantly impact your overall experience. Staying in <a href="https://www.especialrentals.com/">holiday apartments in New York </a> offer a unique and immersive perspective of the city. Whether you opt for short-term New York apartments for rent, long-term rental apartments, or serviced apartments in New York, we offer a holiday apartment perfectly suited to your needs. So, pack your bags and prepare to explore the city that never sleeps while enjoying the comforts of your own New York home. Your adventure awaits!   </p>
				</div>
			</div>
		</section>
        <?php } elseif($url =='udaipur') {?>
            <section class="mt-5 mb-5">
			    <div class="container">
                    <div class="blogDetailWrapper">
                        <h1 style="font-size: 23px;">Experience the Richness of Udaipur with Diverse Accommodation Options</h1>
                        <p>Famous as the 'Venice of the East'- Udaipur, also known as a city of lakes, is located around sky-blue water lakes at the backdrop of lush green Aravalli hills. Visiting Udaipur, offers you the opportunity to explore the royal Rajasthani culture and the historic forts and monuments. There are many hotels in the city offering accommodation to visitors. But, now there is a popular trend among travelers to choose a homely and cost-effective option – vacation stays or homestays. 
                        </p>
                        <p>The rental accommodations have a unique atmosphere. More than just providing a place to stay, they are also the key that unlocks a home away from home experience for you. Whether you choose a villa on rent for one day in Udaipur or wish to enjoy a longer stay at Vacation Villas, whichever you choose, your eyes will feast upon the beauty of this town.</p>
                        
                        <h2 style="font-size: 23px;">Udaipur’s Villas: A stay full of elegance</h2>
                        
                        <p>For special occasions, demand for a suitable location arises. The <a href="https://www.especialrentals.com/">Villa on rent for one day in Udaipur</a> will offer luxury and exclusivity combined.</p>
                        <p>Experience the magical dawn overlooking a lake, and enjoy playing in your private garden or by an azure-blue pool reflecting the clear blue skies of heaven. You can enjoy supper on a candlelit terrace, watching as Hangzhou's ancient palaces slowly begin to glow. The available villas provide all this and more, making your one-day stay a memory to last.</p>
                        
                        <h2 style="font-size: 23px;">Short-Term Rental Villas: Ideal for Quick Trips</h2>
                        
                        <p>The short term rental Villa in Udaipur is perfect for people only here on a brief stay. These villas offer a realistic option, providing all the comforts and conveniences needed to enjoy your short stay. Every space is adorned with traditional Rajasthani art and modern luxury, and everyone has the story of an elegant comfort.</p>

                        <h2 style="font-size: 23px;">Vacation Villas offer Long-Stay Comfort</h2>
                        
                        <p>If you plan to stay longer in Udaipur, the vacation Villas for rent in Udaipur offer the ideal option. These villas, which combine the convenience of home with Udaipur's exotic beauty and tranquillity, are suitable for families or groups keen to take things a little slower.</p>

                        <h2 style="font-size: 23px;">Homestay Rentals: A Window to Udaipur’s Soul</h2>
                        
                        <p>A Homestay rental in Udaipur is the best way to get a taste of how the people of Udaipur live. Rentals like these let travelers experience and see the city's culture and traditions up close. They can do so in comfort, too. </p>

                        <h2 style="font-size: 23px;">Luxury Villas: A Declaration of Elegance and Comfort</h2>
                        
                        <p>Luxury Villas in Udaipur, Rajasthan, is for people with unique tastes. Only those who will settle for nothing less than the best will go for such a home away from home! The epitomes of elegance and comfort are these villas, which offer luxurious facilities to ensure a royal comfortable stay.</p>
                        <P>These villas make excellent home bases for day trekkers who want to be close to the home atmosphere. It makes it convenient for them when exploring Udaipur's sights.</P>

                        <h3 style="font-size: 23px;">Holiday Apartments: Udaipur the Urban Way</h3>
                        
                        <p>The holiday apartments to rent in Udaipur are available for those who wish to be in the midst of all the activities and attractions. Conveniently situated near major landmarks, these apartments combine the benefits of city life with spacious privacy. Your private city villa is but a stone's throw away from the imposing City Palace, while everywhere surrounding Lake Pichola protrudes boats. Traditional streets are ideal for walking through as well.</p>

                        <h3 style="font-size: 23px;">The Right Rental for Your Udaipur Adventure</h3>
                        
                        <p>Choosing an appropriate rental in Udaipur can add a lot to your trip. Whether it's a short-term rental Villa in Udaipur or a luxurious stay, we offer accommodation that conforms to your taste and requirements.</p>

                        <h3 style="font-size: 23px;">Udaipur: A Mosaic of Cultural Experiences</h3>
                        
                        <p>Udaipur is not just about historic sites; it's a kaleidoscope of rich cultural haunts. Go to a local bazaar or try some traditional Rajasthani cuisine, and you'll be staying in Udaipur, whether it is with a Homestay rental or a Luxury Villa--all part of rich cultural life. It is a chance to experience the royal life of Udaipur and create memories that last forever, all squeezed into one day.</p>

                        <h3 style="font-size: 23px;">Udaipur Awaits You</h3>
                        
                        <p>You get a glimpse of Udaipur's soul through all its comfort. Travelers seeking this type of experience should rent the Vacation Villas for rent in Udaipur and Homestay rental in Udaipur. We are here to help you find the best rental stay within budget.</p>

                        <p>The Luxury Villas in Udaipur Rajasthan provide a substitute universe where you can relax in the solitude of Spain's lush natural beauty, all modern comforts. Ranging from spacious living rooms to private pools every villa is thoughtfully designed. The rooms are designed to offer Udaipur's comfortable lifestyle. But our holiday apartments to rent in Udaipur are suitable for those who prefer the color of city life.</p>
                    </div>
			    </div>
		    </section>
        <?php } elseif($url =='ramgarh') {?>
            <section class="mt-5 mb-5">
			    <div class="container">
                    <div class="blogDetailWrapper">
                        <h1 style="font-size: 23px;">Ramgarh Vacation Rentals: Your Gateway to Tranquillity</h1>
                        <p>Ramgarh, with its quiet orchards and calm atmosphere, is becoming a favored destination for travelers looking to enjoy a quiet holiday away from the busy city. Are you looking for a Vacation Villa for rent in Ramgarh? Your search ends here. The villas of Ramgarh combine comfort, privacy, and the simplicity of mountain life.
                        </p>
                        <h1 style="font-size: 23px;">Rise of Vacation Rentals in Ramgarh</h1>
                        <p>What about a vacation rental in Ramgarh? A rental home has a more authentic and laid-back feeling than traditional hotel stays, which the visitors or guests appreciate. Here's why:</p>
                        
                        <h1 style="font-size: 23px;">1. A Personal Touch</h1>
                        <p>The vacation villa for rent in Ramgarh is not where you can sleep only but also a place to live with a homely feel. While hotels are impersonal, rentals provide a homier feel with private living quarters and full kitchens along with the amenity of living when you want and how you choose.</p>
                        
                        <h1 style="font-size: 23px;">2. Cost-Effective Comfort</h1>
                        <p>At Ramgarh, you get to experience the peace and beauty of nature, but not at tourist prices. The <a href="https://www.especialrentals.com/">apartments for rent in Ramgarh </a> offer something for every budget so that you can enjoy luxury and the local lifestyle at a bargain price. </p>
                        
                        <h1 style="font-size: 23px;">3. Living Like a Local</h1>
                        <p>A Homestay rental in Ramgarh, Nainital, gives you a real mountain life experience. Shop at local markets, enjoy home-style food, and relax in a familiar but unfamiliar space.</p>
                        
                        <h1 style="font-size: 23px;">4. Flexibility for Your Schedule</h1>
                        <p>With short term apartments for rent in Ramgarh, you can choose your schedule. Blessed with the freedom to come and go as your will, structure your stay any way that suits you.</p>
                        
                        <h1 style="font-size: 23px;">A Diversity of Rentals in Ramgarh</h1>
                        <p>Having listed the advantages of vacation rentals, let's look at what options are available in Ramgarh. Whether you are only stopping in for a visit or staying longer, we will offer what suits your needs.</p>


                        <h1 style="font-size: 23px;">1. Short-Term Apartments</h1>
                        <p>The fully furnished short term apartments for rent in Ramgarh are perfect for the nature explorer or weekend visitor.</p>

                        <h1 style="font-size: 23px;">2. Long-Term Stays</h1>
                        <p>If the charms of Ramgarh have encouraged you for a longer stay, the apartments for rent in Ramgarh are available for long-term lease, which combines stability and beauty.</p>

                        <h1 style="font-size: 23px;">3. Luxury Villas</h1>
                        <p>Looking for a luxurious touch in your stay? Staying at the Luxury Villas in Ramgarh, Nainital makes your stay one of grandeur and exclusivity.</p>
                        <p>Ramgarh is an ideal spot; the right rental will make your stay even more idyllic. In Ramgarh, there are plenty of vacation villas for rent. When you stay there, it's more than just a visit--it's an experience. Book your stay and unlock the mountain peace waiting in the Himalayan foothills.</p>



                        <h1 style="font-size: 23px;">Functional Elegance: Villas and Apartments in Ramgarh</h1>
                        <p>The rental villas for a holiday at the heart of Ramgarh are available with all their simplicity and elegance. By incorporating essential amenities with the peace of the hills, these villas allow for a seamless living experience. Practical and restful, the villas are all furnished to act as your home.</p>


                        <h1 style="font-size: 23px;">Practical Homestay and Apartment Options</h1>
                        <p>Those who like the feel of a space with great hospitality can get immersed into local life with Homestay rental in Ramgarh, Nainital. Likewise, the apartments for rent in Ramgarh have comfortable kitchen facilities and workable desktop space that combines leisure with business.</p>
               

                        <h1 style="font-size: 23px;">A Day in Ramgarh's Villas</h1>
                        <p>Renting the Villa on rent for one day in Ramgarh can provide a comfortable experience. Guests can come and enjoy a day of peace, comfortably equipped with all facilities, without the long-term commitment of renting this place.</p>



                        <h1 style="font-size: 23px;">Luxury Villas: A Blend of Comfort and Usefulness</h1>
                        <p>The Luxury Villas in Ramgarh, Nainital, has been designed for those looking to enjoy the balance of comfort and pragmatism. By devoting attention to detail, these villas offer a high standard of living while avoiding extremes in extravagance. You'll enjoy the best life and avoid glitzy decadence simultaneously.</p>



                        <h1 style="font-size: 23px;">The Discerning Traveler's Short-Term Apartments</h1>
                        <p>The short-term apartments for rent in Ramgarh are exactly what the discerning traveler look for. These apartments combine the convenience of a hotel with the warm atmosphere of individual accommodation, making them an ideal home base from which to explore Ramgarh's beautiful natural setting.</p>



                        <h1 style="font-size: 23px;">Your Stay, Customized</h1>
                        
                        <p>The commitment to attend to the needs of each guest is at the heart of what we offer in Ramgarh. To this end, we seek to customize every aspect of your stay according to your wishes, whether it's for a Villa on rent for one day in Ramgarh or an entire month. In many respects, the rentals in Ramgarh are more than a place to live. They are petite getaways into the hills where your stay can be as simple and relaxed as you like.</p>

                        <p>You can select from the varied collection of Vacation villas for rent in Ramgarh and take the first step toward a stay marked by relaxation and reality. Book with us today and see Ramgarh in its purest form.</p>
                    </div>
			    </div>
		    </section>
        <?php } elseif($url =='jaipur') {?>
            <section class="mt-5 mb-5">
			    <div class="container">
                    <div class="blogDetailWrapper">
                        <h1 style="font-size: 23px;">Discover the Best Vacation Rentals for Rent in Jaipur: A Gateway to Royal Experiences</h1>
                        <p>As you enter Jaipur, the city of royal India with its historic palaces and myriad woven strands of culture, welcomes you. It is the 'Pink City' of India that offers visitors a chance to breathe its proud heritage. If you're planning on exploring this royal getaway, finding the right accommodation is important for an authentic experience. Your Home Away from Home you will get rental accommodations with modern conveniences in a delightful Rajasthani atmosphere.
                        </p>
                        <h1 style="font-size: 23px;">The appeal of Jaipur Vacation Rentals</h1>
                        <p>Selecting a vacation rental in Jaipur involves more than just finding somewhere to rest. It's about plunging into a lifestyle saturated with history and gloriousness. So, just what is it that sets your Jaipur vacation rentals apart?</p>
                        
                        <h1 style="font-size: 23px;">1. A Home in Heritage</h1>
                        <p>The <a href="https://www.especialrentals.com/">Vacation rentals for rent in Jaipur</a> are more than just accommodation; they provide you with a living experience wrapped up in the city's royal history. With living rooms of spacious proportions, and balconies overlooking ancient forts--everyone is a bridge to the soul of this city.</p>
                        
                        <h1 style="font-size: 23px;">2. Cost-Effective Elegance</h1>
                        <p>But Jaipur is all about luxury, whereas the short term rental apartment in Jaipur offers budget-friendly options that do not scrimp on a regal experience. Jaipur offers choices from luxury apartments to cozy studios. No matter what your preference is, these rentals will let you spend enjoying everything that Jaipur has to offer on a budget.</p>
                        
                        <h1 style="font-size: 23px;">3. Living Like Royalty</h1>
                        <p>Why not take a well-maintained Villa on rent for one day in Jaipur and enjoy life like the Maharaja? Shop at local markets, eat traditional Rajasthani foods and experience the flavor of Jaipur's distinctive neighborhood life.</p>
                        
                        <h1 style="font-size: 23px;">4. Flexibility on Your Terms</h1>
                        <p>Whereas hotels have relatively strict schedules, the homestay rentals in Jaipur and Rajasthan will allow you to explore the city on your schedule. Through the eyes of a local: See Jaipur at your leisure; come and go as you deem fit.</p>
                        
                        <h1 style="font-size: 23px;">Renting options in Jaipur</h1>
                        <p>To discover Jaipur's vacation rentals, we examined several varieties before recommending the best to you. Whether you're visiting for a week or moving in permanently, we have made the right rental available for your needs. The serviced apartments in Jaipur are particularly noteworthy.</p>


                        <h1 style="font-size: 23px;">1.	For the Modern Traveler, Short-term Apartments</h1>
                        <p>These rentals in Jaipur are all furnished and equipped with everything you need. Suited to the desires of single travelers or families, these rentals offer all kinds of convenience.</p>

                        <h1 style="font-size: 23px;">2.	Apartments for Immersive Living: Long-Term Rentals</h1>
                        <p>For those who want to experience more of Jaipur's everyday life, there is an option for a short term rental apartment in Jaipur. These give a stable and comfortable living atmosphere. Long-term rental will enable you to feel at home and experience life as a resident of Jaipur.</p>


                        <h1 style="font-size: 23px;">3.	Serviced Apartments for Ultimate Comfort</h1>
                        <p>Combining hotel-quality facilities with the convenience of an apartment, the serviced residences offer a stress-free stay. Routine cleaning, room service, and concierge services create an atmosphere of luxury and convenience.</p>
                        <p>Jaipur is a city of wonders, and the quality of your accommodation determines what kind of journey you experience in the city. Renting one of the villas on rent for one day in Jaipur provides a different vantage point of the city. You can choose a short-term apartment or go for the long haul with us and rent an apartment. Need something more luxurious? How about renting a serviced apartment?</p>



                        <h1 style="font-size: 23px;">Discover the Local Flavor with Homestay Rental in Jaipur</h1>
                        <p>The homestay rental in Jaipur, Rajasthan, provides an authentic dive into the heart of Rajasthani culture. Live with local families, learn to cook traditional Rajasthani foods, and listen to tales that shape the city. These homestays aren't just places to stay out the night; they are about connection and sympathy. They provide a lens through which you can see Jaipur as it is.</p>


                        <h1 style="font-size: 23px;">Apartments for Rent in Jaipur: Your Base for Exploration</h1>
                        <p>For adventurers eager to explore, the apartments for rent in Jaipur, Rajasthan are a great starting point. From cozy studios to large three-bedroom flats, you're sure to find a space that feels like it belongs. Whether bringing your children for a morning walk to the local chai stand or making that short tuk-tuk ride over to see the magnificent Amber Fort, each apartment has been carefully placed with convenience in mind.</p>
               

                        <h1 style="font-size: 23px;">Vacation Home for Rent in Jaipur: Your Sanctuary in the City</h1>
                        <p>The vacation home for rent in Jaipur lets you experience the joy of your own space. These homes are designed for peace and privacy--here, you can relax undisturbed after a day on the bustling streets. Its first-class facilities are private gardens, rooftop terraces, and a full staff complement. At Jaipur, your stay is both restful and rewarding.</p>



                        <h1 style="font-size: 23px;">Concluding Your Jaipur Journey</h1>
                        <p>Allow us to be the paper on which you write your story that unfolds as you journey in Jaipur. We boast many rental options to cover all tastes and requirements, so your time in this historic city is nothing less than extraordinary. So, book the Vacation rentals for rent in Jaipur through us today and let every moment of your trip become a wonder to cherish.</p>
                    </div>
			    </div>
		    </section>
		<?php } else { $meta->url??'';}?>
                </div>
                
                
                
               

            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script>
        $(document).on('click','#isValidateContact', function() {
        	if (isValidateCity()) {
		        var token="{{csrf_token()}}";
                var url="{{url('')}}";
                var fname = $('input[name=fname]').val();
                var lname = $('input[name=lname]').val();
                var email = $('input[name=email]').val();
                var mobile = $('input[name=mobile]').val();
                var city = $('#city').val();
                var des = $('textarea[name=des]').val();
                var search_startdate = $('#search_startdate').val();
                var search_enddate = $('#search_enddate').val();
                var count_guests = $('input[name=count_guests]').val();
                var count_children = $('input[name=count_children]').val();
		$.ajax({
			 url:url+'/property/info',
			data:{fname:fname,lname:lname,email:email,mobile:mobile,city:city,des:des,search_startdate:search_startdate,search_enddate:search_enddate,count_guests:count_guests,count_children:count_children, _token:token},
			type : 'POST',
			success : function(result) {
				if (result.indexOf("1") > -1) {
					window.location.href = url +'/property/contact-thank-you';
        			$( '#contactinfo' ).trigger('reset');
				}else if (result.indexOf("2") > -1) {
					$("#messagevalidate").show();
					$("#messagevalidate").html("Please try again later.");
				}
			}
		});
	}
});	
function isValidateCity() {
	var valid = true;
	var city = $("#city").val();
	var fname = $('input[name=fname]').val();
    var lname = $('input[name=lname]').val();
    var email = $('input[name=email]').val();
    var mobile = $('input[name=mobile]').val();
    var city = $('#city').val();
    var des = $('textarea[name=des]').val();
    var search_startdate = $('#search_startdate').val();
    var search_enddate = $('#search_enddate').val();
    var count_guests = $('input[name=count_guests]').val();
    var count_children = $('input[name=count_children]').val();
    
	$(".message").html("&nbsp;");
	$(".message").css("color", "red");
	$(".message").css("font-size", "10px");
	$(".message").css("display", "block");
	$(".message").hide();
	
	if (city == 0) {
		valid = false;
		$("#msgcity").html("Select city name");
		$("#msgcity").show();
	}
	if (fname.length == 0) {
		valid = false;
		$("#msgfname").html("Enter first name");
		$("#msgfname").show();
	}
	
	if (lname.length == 0) {
		valid = false;
		$("#msglname").html("Enter last name");
		$("#msglname").show();
	}
	
	if (email.length == 0) {
		valid = false;
		$("#msgemail").html("Enter email");
		$("#msgemail").show();
	}
	
	if (mobile.length == 0) {
		valid = false;
		$("#msgmobile").html("Enter mobile");
		$("#msgmobile").show();
	}
	if (des.length == 0) {
		valid = false;
		$("#msgdes").html("Enter comments");
		$("#msgdes").show();
	}
	
	if (search_startdate.length == 0) {
		valid = false;
		$("#msgsearch_startdate").html("Check-in Date");
		$("#msgsearch_startdate").show();
	}
	
	if (search_enddate.length == 0) {
		valid = false;
		$("#msgsearch_enddate").html("Check-out Date");
		$("#msgsearch_enddate").show();
	}
	
	if (count_guests.length == 0) {
		valid = false;
		$("#msgcount_guests").html("Enter adult");
		$("#msgcount_guests").show();
	}
	
	if (count_children.length == 0) {
		valid = false;
		$("#msgcount_children").html("Enter children");
		$("#msgcount_children").show();
	}
	
	return valid;
}




</script>
            
            
 <script>
        $(function() {
          $('#property-search-result.sidebar-map .map-wrapper #map').css('height',$(window).height()-120);
            $('.review-showhide').click(function() {
                $(this).find('i').toggleClass('fa-plus fa-minus');
                $(this).parent().next('.review-form').slideToggle();
            })
            $('.readonly-cal td div').removeClass('valid').addClass('invalid');
            $(document).on('click', '.btn-list', function(event){ 
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                $('.grid-view').addClass('hide');
                $('.list-view').removeClass('hide');
            })
            $(document).on('click', '.btn-grid', function(event){    
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                $('.list-view').addClass('hide');
                $('.grid-view').removeClass('hide');
            })
            if ($(window).scrollTop() > 100) {
                $('.main-top-nav').removeClass('headerrelative');
                $('.main-top-nav').addClass('headerstat');
            } else {
                $('.main-top-nav').removeClass('headerstat');
                $('.main-top-nav').addClass('headerrelative');
            }
            $(window).scroll(function() {
                
                if ($(window).scrollTop() > 100) {
                    $('.main-top-nav').removeClass('headerrelative');
                    $('.main-top-nav').addClass('headerstat');
                } else {
                    $('.main-top-nav').removeClass('headerstat');
                    $('.main-top-nav').addClass('headerrelative');
                }
            })

        })
		
        function initMap() {
			@if($properties->count()>0)
			@php $i=1; @endphp
       @foreach ($properties as $property)
                 @php 
				 if($i==1){
                    $latlong=\App\Model\Googlemap::where('propertyid',$property->id)->get();
					$lat=$latlong->first()->lat;
					$longt=$latlong->first()->longt;
				}$i++;
                   @endphp
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    zoomControl: true,
                    scaleControl: true,
                    center: new google.maps.LatLng('{{$lat}}', '{{$longt}}'),
                });
				   
		@endforeach
		@else
		    var input = document.getElementById('countryName');
		    if(input){
                var geocoder =  new google.maps.Geocoder();
                geocoder.geocode( { 'address': input.value }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var myLat = results[0].geometry.location.lat().toFixed(6);
                        var myLong = results[0].geometry.location.lng().toFixed(6);
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            zoomControl: true,
                            scaleControl: true,
                            center: new google.maps.LatLng(myLat, myLong),
                        });
                    }
                });
		    }
		    
	   @endif
            var iconBase = "{{url('/public/uploads/')}}/";
            var icons = {
                property: {
                    icon: iconBase + 'icon_marker.png'
                },
            };
            var propimgurl,proptitle,proplink=null;

            function addMarker(feature) {
                
                propimgurl=feature.imgurl;
                proptitle=feature.title;
                proplink=feature.link;
               
                var marker = new google.maps.Marker({
                    position: feature.position,
                    
                    icon: icons[feature.type].icon,
                    map: map,
                    

                });
                

                var infowindow = new google.maps.InfoWindow({
                    content: `
                        <div class="property-info">
                        <a href="${proplink}" class="property-image"><img src="${propimgurl}"></a>
                    <div class="property-content">
                    <h3 class="property-title"><a href="${proplink}">${proptitle}</a></h3>
                    <a href="${proplink}" class="property-link" style="text-transform:capitalize!important;">Details <i class="fa fa-long-arrow-right"></i></a></div>
                    </div>
                    `
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker,propimgurl,proptitle);
                });
            }
            
            function initialize(){
                var input = document.getElementById('countryName');
                var autoComplete = new google.maps.places.Autocomplete(input);

                autoComplete.addListener('place_changed', function(){
                    let place=autoComplete.getPlace();
                    var pickup=place.formatted_address;   
                    if(pickup) findNeighbour(pickup);
                })
            }
            google.maps.event.addDomListener(window, 'load', initialize);
            var features = [ 
             @foreach ($properties as $property)
                 <?php $sub=\App\Model\PropertyGallery::where('propertyid',$property->id)->orderby('photoorder','ASC')->get();
                    $latlong=\App\Model\Googlemap::where('propertyid',$property->id)->get();
                    $type = \App\Model\PropertyType::where('id',$property->propertytype)->first();
                    
                    //echo $property->id;
                   ?>
                { 
                position: new google.maps.LatLng('{{$latlong->first()->lat}}', '{{$latlong->first()->longt}}'),
                type: 'property',
                imgurl:'{{url("public/uploads/property_image")}}/{{$property->id}}/{{ $sub->first()->photoname??'' }}',
                title:'{{$property->propertyname}}' ,
                link:'{{url("/property")}}/detail/{{$property->id}}'},
            @endforeach
             ];
             //console.log(features);
			 @if(isset($properties) && !empty($properties))
            for (var i = 0, feature; feature = features[i]; i++) {
                addMarker(feature);
            }
			@endif
        }


        function findNeighbour(data){ 
            var token="{{csrf_token()}}";
            var url="{{url('/')}}";  
            var result=data.split(',');  
            var cityname = result[0];
            var neighbourhood = $('#neigh').val();
            var neighbourhoodids = $('#nhood').val();
            if(cityname != '')
            {
             $.ajax({
              url:url+'/property/propty-neighbour',
              data:{cityname:cityname, neighbourhood:neighbourhood, neighbourhoodids:neighbourhoodids, _token:token},
              method:"POST",
              success:function(data){
                    $('.Neighbourhood').html(data);
              }
             });
            }
        };  
    function currentActiveTab(tab){
        localStorage.setItem('esCurrentTab', tab);
    }
    
    window.onload = function(){
        var tab = localStorage.getItem('esCurrentTab');
        if(tab){
            if(tab == 'grid'){
                $('.btn-grid').addClass('active').siblings().removeClass('active');
                $('.list-view').addClass('hide');
                $('.grid-view').removeClass('hide');
            } else {
                $('.btn-list').addClass('active').siblings().removeClass('active');
                $('.list-view').removeClass('hide');
                $('.grid-view').addClass('hide');
            }
        } else {
            $('.btn-grid').addClass('active').siblings().removeClass('active');
            $('.list-view').addClass('hide');
            $('.grid-view').removeClass('hide');
        }
    }
    </script>           

            
        </div>

    </section>
<style>
            .headerrelative.navbar.navbar-default {
            background: url({{url('/')}}/public/frontend/images/header_bg.jpg);
            .layer {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                background-color: rgba(0, 0, 0, 0.5);
            }
            video {
                position: absolute;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
            }
            footer {
                position: relative;
                z-index: 2;
            }
    </style>
     
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLtF6MPFfrge7gJ0sTP8Vjv8cOA1Acy3k&callback=initMap&libraries=places"></script>
    <script type="text/javascript" src="{{url('/')}}/public/frontend/js/lightbox-plus-jquery.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/public/frontend/js/royalslider.js"></script>
    <script>
    $(document).ready(function(){
        
      var token="{{csrf_token()}}";
      var url="{{url('/')}}";  

    /* $('#country_name').keyup(function(){ 
        debugger;
            var query = $(this).val();
            if(query != '')
            {
             $.ajax({
              url:url+'/property/propty-search',
              data:{query:query, _token:token},
              method:"POST",
              success:function(data){
                debugger;
               $('#countryList').fadeIn();  
                        $('#countryList').html(data);
              }
             }); 
            }
        });*/
 
        

        // $(document).on('onload','.search_submit',function(){
        //     debugger;
        
           
        // });

        var $d3 = $("#sale-range-price");
         
        $d3.on("change", function () {
        var $inp = $(this);
        var from = $inp.data("from"); // reading input value
        var from2 = $inp.data("to"); // reading input data-from attribute
        $('#srate').val(from);
        $('#erate').val(from2);
    });
        if($('#countryName').val()){
        getNeighbour();
        }
    });

    function getNeighbour(){
		$('#unCheckNeighbour').prop('checked',false);
            var token="{{csrf_token()}}";
           var url="{{url('')}}"; 

            var data = $('#countryName').val();
            var result=data.split(',');  
            var cityname = result[0];
            var neighbourhood = $('#neigh').val();
            var neighbourhoodids = $('#nhood').val();
           if(cityname != '')
            {
             $.ajax({
              url:url+'/property/propty-neighbour',
              data:{cityname:cityname, neighbourhood:neighbourhood, neighbourhoodids:neighbourhoodids, _token:token},
              method:"POST",
              success:function(data){
                 
                        $('.dropdown-menu').html(data);
              }
             });
            }
    }
    </script>
    <script>
      $(document).ready(function(){
       var token="{{csrf_token()}}";
       var url="{{url('')}}";
       //fetch_data();

       // function fetch_data(country_name='',search_startdate='',search_enddate='',property_type='',bed='',bath='',sleep='',srate='',erate='',page='')
       // {
       //   debugger;
       //  $.ajax({
       //   url:url+'/property/filter-property',
       //   method:'POST',
       //   data:{_token:token, country_name:country_name,search_startdate:search_startdate,search_enddate:search_enddate,property_type:property_type,bed:bed,bath:bath,sleep:sleep,srate:srate,erate:erate , page:page},
         
       //   success:function(data)
       //   {
       //    debugger;
       //    $('#property').html('');
       //    $('#property').html(data);
       //   }
       //  })
       // }
       // var query='';
       // $(document).on('click', '.pagination a', function(event){
       //  debugger;
       //        event.preventDefault();
       //        var page = $(this).attr('href').split('page=')[1];
       //        var cname = $('#country_name').val();

       //        var splitRowObject = cname.split(',');
       //        /*if(splitRowObject.length > 0)*/
       //         //alert(splitRowObject[0]);
       //         var country_name = splitRowObject[0];
       //         var search_startdate = $('#nb-start-date').val();
       //         var search_enddate = $('#nb-end-date').val();
       //         var property_type = $('#property_type').val();
       //         var bed = $('#bed').val();
       //         var bath = $('#bath').val();
       //         var sleep = $('#sleep').val();
       //         var srate = $('#srate').val();
       //         var erate = $('#erate').val();
       //         /*var amenities = $('').val();*/
       //        $('#hidden_page').val(page);
            
       //        $('li').removeClass('active');
       //              $(this).parent().addClass('active');
       //        fetch_data(country_name,search_startdate,search_enddate,property_type,bed,bath,sleep,srate,erate,page);
       //       });
       /*$(document).on('keydown', '#search', function(e){
          if(e.keyCode==13){              
        var query = $(this).val();
        var page='';
        fetch_data(query,page);
        
       
       }
      });*/
      });
    </script>
    <script type="text/javascript">
        (function($){
			$('#unCheckNeighbour').prop('checked',false);
          $.fn.getFormData = function(){
            var dataArray = $(this).serializeArray();
            var url = '';
            for(var i=0;i<dataArray.length;i++){
              url += (i == 0) ? '?' : '&';
              url += dataArray[i].name+'='+dataArray[i].value;
            }
            return url;
          }
        })(jQuery);
        $('#advbutton').click(function(){
            getFormData();
        });
        $("#my-form select ").on('change', function(){
            getFormData();
        });
        $(".amenities").on('change', function(){
            getFormData();
        });
        $('#sale-range-price').on('change',function(){
           getFormData();
        });
        
        // $('#longterm').on('change',function(){
        //   getFormData();
        // });
        
        /*$(document).on('change','.dropdown-menu .advchechk',function(){*/
        $(document).on('change', '.advcheck', function(event){
        getFormData();
        })

        function getFormData(){
            var myData = $("#my-form").getFormData();
            //alert(myData);
            location.href = "{{url('/property')}}" + myData; 
        }

        $('#unCheckNeighbour').on('change', function(){
          if($(this).prop("checked") == true){
			  $('#nHood input.advcheck').each(function(){
				  $(this).prop('checked', true);
			  })
          }
          else{
			  $('#nHood input.advcheck').each(function(){
				  $(this).prop('checked',false);
			  })
          }
        })

    $(document).ready(function(){    
        $('.eguest').on("change", function(){
            $('.scheckin').bind("datepicker-change", function(event, obj){ startdate=obj.value; });
            $('.echeckout').bind("datepicker-change", function(event, obj){ enddate=obj.value; });
            rateCalculation();
        });
 
        $('.scheckin').bind("datepicker-change", function(event, obj){
            startdate=obj.value; 
            rateCalculation();
        });

        $('.echeckout').on("datepicker-change", function(event, obj){
            enddate=obj.value;
            rateCalculation();
        });

        $('.echeckout').on('change', function(){
            rateCalculation();
        });
         $('#pricefilter').on('change', function(){
                //console.log(newUrl+"---------------");
		window.location.href = addOrReplace('price', $(this).val());
		
		 
         });

    });
    
	 function addOrReplace(key, value) {
		var oldUrl =  window.location.href;
		var  data_val = value ;
		var r =  /^(.+price=).+?(&|$)(.*)$/i ;
		var  newUrl = "";

		var matches =  oldUrl.match(r) ;
		console.log(matches);
		if(matches===null){
		newUrl = oldUrl +  ((oldUrl.indexOf("?")>-1)?"&":"?")  + "price=" + data_val ;

		}else{
		newUrl =  matches[1]+data_val+matches[2]+matches[3]  ;

		}
		
		return (newUrl);
	}
    
    
    </script>
   
@endsection
