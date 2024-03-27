
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
                                                    <option value="" style="display:none;">Select Type</option>
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
                                            <a href="#" class="btn-toggle-search pull-left">Show/Hide Advanced Search</a>
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
    color: #ff7226;" >Make an enquiry</h3>
            <div class="mainsec">
                
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
                     <div class="form-group">
                        <span class="message" id="msgcity"></span>
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
                      <input type="button" id="isValidateContact" class="btn btn-primary pull-right btn-submit" value="Submit">
                  </div>
                 
                                            
               </div>
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
                                <span class="view-btn btn-grid" onclick="currentActiveTab('grid')"><i class="fa fa-th-large"></i></span>
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

                                          $subb = isset($sub->nightrate)? $sub->nightrate :'';
                                          $currency= \App\Model\ExtraFee::where('propertyid',$data->id)->first();
                                          $nightstay = isset($currency->min_stay)? $currency->min_stay :'';

                                          $currency = isset($currency->currency)? $currency->currency :'';
                                          $rCurrency = App\Model\Currency::where(['short_code'=>$currency,'status'=>'1'])->first();

                                        @endphp

                                        

                                        <span class="item-price">{{$rCurrency->symbol}}{{$subb}}/Night</span>

                                        <a href="{{url('/property')}}/detail/{{$data->id}}" class="item-detail btn" style="text-transform:capitalize!important;" target="_blank">Details <i class="fi flaticon-detail"></i></a>

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

                                       

                                        <a href="{{url('/property')}}/detail/{{$data->id}}" class="img-box__image" target="_blank">

                                            @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp



                                            <img src="{{url('public/uploads/property_image')}}/{{$data->id}}/{{ $username }}" alt="Property" class="img-responsive">

                                        </a>

                                    </div>

                                    <div class="property-content">

                                        <a href="{{url('/property')}}/detail/{{$data->id}}" class="property-title">{{$data->propertyname}}</a>

                                        <div class="property-addresses">

                                            {{$data->address}}

                                            <div class="rating pull-right" style="display:flex;align-items: center">
                                                <span style="font-size:12px;">{{$data->avg_rating}}</span>
                                                <div id="rateYo{{$data->id}}" style="margin-right:4px;"></div>

                                                <script type="text/javascript">

                                                    $("#rateYo{{$data->id}}").rateYo({

                                                        rating: {{$data->avg_rating}},

                                                        starWidth: "15px",

                                                        ratedFill: "#ff7200"

                                                      });

													  $("#rateYo{{$data->id}}").rateYo('option', 'readOnly', true);

                                                </script>

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

                                    <a href="{{url('/property')}}/detail/{{$data->id}}" class="property-image" target="_blank">

                                        @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp

                                        <img src="{{url('public/uploads/property_image')}}/{{$data->id}}/{{ $username }}" alt="Post list 1">

                                    </a>

                                   

                                </div>

                                <div class="col-lg-7">

                                    <div class="property-content">

                                        <h3 class="property-title"><a href="{{url('/property')}}/detail/{{$data->id}}" target="_blank">{{$data->propertyname}}</a></h3>

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

                                                 <script type="text/javascript">

                                                    $("#rateYoo{{$data->id}}").rateYo({

                                                        rating: {{$data->avg_rating}},

                                                        starWidth: "16px",

                                                        ratedFill: "#ff7200"

                                                      });

													  $("#rateYoo{{$data->id}}").rateYo('option', 'readOnly', true);

                                                 </script>

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
					<h1 style="font-size: 23px;">Make Your Vacations Memorable At Holiday Homes in Paris</h1>
					<p>Holiday homes are always the best options during vacationing in the city. After all, it means long naps, breakfasts on the terrace, time spent playing and reading in the backyard, and late-night barbecues at the house.</p>
					<h2 style="font-size: 23px;">Book The Best Vacation Rental Apartment in Paris</h2>
					<p>Why not book a vacation rental with Especial Rentals and have the calmest and most rejuvenating vacation? With a vacation home, you and your loved ones can relax and unwind while spending quality time together.
                    With so many possibilities for entertainment, kids won't be bored, while parents may take a break from their duties! We have a wide selection of accommodations in beautiful settings
                    </p>
					<h3 style="font-size: 23px;">Extend Your City Stay with Long Term Furnished Rentals in Paris</h3>
					<p>We have the most exceptional holiday homes that are approved and included in our list after thorough research and check. It has never been easier to find the perfect vacation. Do you want to go on a vacation where you can see new things? The best way to experience France's rich heritage and culture is to spend an extended holiday at furnished rentals. Explore the world with our exclusive travel suggestions and make your online reservation in minutes, securely and conveniently.
                    Your vacation home should be a place where you can relax and unwind and feel at home.
                    <p style="font-size:23px">Feel Like Home at Short Term Rentals in Paris</p>
                    With short term rentals, you have the freedom to spend your time as you like. There will be no interruptions from other guests or hotel personnel so that you can enjoy your vacation. Despite the nature of travel commitment, whether for business or pleasure, peaceful vacation with loved ones is always possible with Especial Rentals. Relax and unwind in ample space, adaptability, and unrestricted autonomy.
                    </p>
				</div>
			</div>
		</section>
		<?php } elseif($url =='dublin-vacation-rentals') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
				    
					<h1 style="font-size: 23px;">Amplify Your Tourism Experience with Holiday Homes in Dublin</h1>
					<p>Our holiday homes are paired with bespoke local experiences suited to our guests' needs. Especial Rentals is dedicated to providing a personalized experience beyond beautiful vacation homes. We ensure that our guests enjoy a memorable stay by matching them with the right holiday apartments for their travel dreams. </p>
					
					<h2 style="font-size: 23px;">Our Holiday Apartments Dublin Offers A Luxurious Experience</h2>
					
					<p>Every short break, family vacation, romantic retreat, and special event can be made better by our concierge service, which comes with the luxury self-catering vacations we offer.
                    Our establishment has made it as easy as possible for you to find the perfect getaway. We do a lot of research on each property's surroundings and character to ensure you get the most out of your vacation.
                    </p>
                    
					
					<p style="font-size: 23px;">Receive World Class Amenities At Our Dublin Holiday Apartments</p>
                    <p>Whether you're looking for magnificent contemporary holiday apartments or a spacious waterside getaway, our high-end properties come complete with exquisite amenities like private pools, hot tubs, and game rooms. We love to show off the best of Dublin to our guests, and we go to great lengths to ensure that they have a trip to remember.
                    <p style="font-size:23px">Searching for the Comforts of Home, Look No Further Than Our Long Term Rentals In Dublin</p>
                    Looking for a long-term rental in town used to be a time-consuming and hectic process before. But thanks to Especial Rentals, the process is now simplified. We offer you the coziest and homey rental apartments for your long stay in Dublin. We offer the best holiday experiences with an array of well-decorated apartments and luxurious houses on our listings. No middlemen, no unlimited rental viewing, no complications! We have made traveling and accommodation easier for our clients.
                   
                   <p style="font-size: 23px;">Celebrate With Friends for a Long Week or Weekend, Look No Further Than These Fun Dublin Apartments Rentals</p>
                    In addition, we can help you host a party that everyone can attend. Find a home in a party town where everyone knows your name, or plan a getaway for the ideal small group vacation. If you are looking for an apartment for extended stay rent, you now know where to head!
                    To ensure that every vacation home is up to the high standards for you, and ourselves each one of our apartments must pass more than 300 quality tests. In the same way, we do a thorough background check on every new tenant so that homeowners feel at ease. 
                    </p>
				</div>
			</div>
		</section>
		
		
		<?php } elseif($url =='vacation-rental-in-london') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
					<h1 style="font-size: 23px;">Find The Perfect Vacation Home in London And Enjoy The British Capital</h1>
					<p>Staying in a vacation home is the ideal way to absorb the awe-inspiring British culture. We're proud to be one of the UK's most renowned homestay providers, and can offer you a destination experience unlike any other.</p>
					
					<h2 style="font-size: 23px;">Reduce Your Travel Time By Being Centrally Rental Accommodations in London</h2>
					
					<p>We offer different styles of rental accommodations based on your travel desires. We let you enjoy relaxation of nature and the place with utmost aesthetically or centrally located accommodation to the city’s most popular attractions right outside your doorstep. Whatever, the reason for travel our rental properties are sure to make you feel at home!</p>
					
					<h3 style="font-size: 23px;">Looking For Long Term Rentals in London? Contact Us!</h3>
					
					<p>Staying in London for an extended amount of time? No worries! We have the place for you! Rather than looking for expensive hotel accommodations – we know you would be much more comfortable in a space you can make you own. A Long Term Rental is more cost-effective and give you the necessities of feeling at home. We have verified and certified apartment rentals for students, professionals and expats.
                   
                    <p style="font-size: 23px;">Contact Especial Rentals for Top Corporate Rentals in London</p>
                    
                    If you are planning to stay in London for quite a long time due to any business needs, you will be glad to know that we also offer corporate apartments for rent. So, the next time you are here on a business trip, make sure to blend work and fun with us! 
                    <p style="font-size: 23px;">Expect Complete Hygiene at Our London Corporate Apartments for Rent</p>
                    We understand your health is of utmost importance when traveling. As a result, we adhere to strict cleaning processes. Our rental properties are meticulously cleaned to ensure your safety and comfort. If you're looking for an unforgettable self-catering vacation experience in London, Especial Rentals is the only choice.

                    </p>
                    
                    <h4 style="font-size: 23px;">What 4 Qualities Should You Look Out For In An Accommodation For Rent In London?</h4>
                    <p>Finding the perfect <strong>accommodation for rent in London</strong> is not easy, and you have to check out various metrics! Therefore, if you are due to travel to London, do not forget to check on these:</p>
                        <ul>
                        <li>Safety</li>
                        <li>Location</li>
                        <li>Amenities</li>
                        <li>Costs</li>
                        </ul>
                        <p>Especial Rentals provides you with the best choices for rental apartments in the British capital!
                        </p>
				</div>
			</div>
		</section>
		
		
		<?php } elseif($url =='holiday-rental-in-newyork') {?>
		
		
		<section class="mt-5 mb-5">
			    <div class="container">
				<div class="blogDetailWrapper">
					<h1 style="font-size: 23px;">For the Finest Vacation Experience, Choose Our Holiday House in New York</h1>
					<p>New York is a lively place and a full experience of the place would need a couple of days. If you are looking for an ideal escape to a long-lived vacation in NYC, then our holiday house in New York will be the perfect choice. With large living areas, grand interiors, personal space, and easy accessibility to all major locations, we always have the best properties listed on our site. Take a break from hiring the conventional venues and hotel rooms and make a smart choice with holiday homes from Especial Rentals. We offer customized accommodation alterations as per your requests and our pricing is competitive in the industry. </p>
					
					<h2 style="font-size: 23px;">Find Budgeted Holiday Rental in New York</h2>
					
					<p>Don't know where to look for a vacation rental? Especial Rentals can end your accommodation hunt by offering various options at competitive rates. You can even choose the location of your rental apartments, as most visitors prefer to stay in Manhattan. But if you are looking for other neighborhoods, you can also get some best deals with Especial Rentals.</p>
					
					<h3 style="font-size: 23px;">We Offer Well Designed New York Apartments For Rent Long Term </h3>
					
					<p>Our long-term rentals will provide you with all necessary amenities that a hotel will provide yet will give you a feel like home. The well-decorated and spacious homey atmosphere is ideal for an extended vacation.</p>
                    
                    <p><p style="font-size:23px">Especial Rentals Provides Holiday Homes in New York Throughout The Year</p>

                    New York City has a global tourist base. Therefore, holiday homes are open to all, even during festivals like Thanksgiving & Good Friday when the cost of hotels is prohibitive with less availability. With Especial Rentals, you will be getting the best staycation that will make your vacation more affordable & glamorous.

                    </p>
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
	$(".message").hide();
	if (city.length == 0) {
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
                imgurl:'{{url("public/uploads/property_image")}}/{{$property->id}}/{{ $sub->first()->photoname }}',
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
