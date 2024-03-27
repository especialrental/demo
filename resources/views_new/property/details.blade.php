
<?php $meta = $properties->meta_tag;
$metacontent = $properties->meta_description;
?>
@extends('layouts.default')

@section('title', $meta)


@section('meta_description',$metacontent )


@section('content')

<style type="text/css">
    .rating-stars ul {
      list-style-type:none;
      padding:0;
      
      -moz-user-select:none;
      -webkit-user-select:none;
    }
    .rating-stars ul > li.star {
      display:inline-block;
      
    }
    /* Idle State of the stars */
    .rating-stars ul > li.star > i.fa {
      font-size:2.5em; /* Change the size of the stars */
      color:#ccc; /* Color on idle state */
    }
 
    /* Hover state of the stars */
    .rating-stars ul > li.star.hover > i.fa {
      color:#FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul > li.star.selected > i.fa {
      color:#FF912C;
    }
</style>
<style>
    span.error { color: #ff0000eb; }
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
  <!-- ====== SINGLE PROPERTY CONTENT ====== -->
  
<section class="page-section mtb-40">
    <div class="container mt-small-70">
        <div class="row">
            <div class="col-md-8">
                <div id="content">
                    <article class="post property-item">
                        <div class="post-property-header">
                            <div class="row"> 
                                <div class="col-md-8 col-sm-8">
                                    <h1 class="post-title" style="font-size:25px"><a href="#">{{$properties->propertyname}}</a></h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-right">
                                    @php
                                        $sub = \App\Model\PropertyRates::where('propertyid',$properties->id)->orderby('nightrate','ASC')->first();
                                        $subb = isset($sub->nightrate)? $sub->nightrate :'';
                                        $currency= \App\Model\ExtraFee::where('propertyid',$properties->id)->first();
                                        $nightstay = isset($currency->min_stay)? $currency->min_stay :'';
                                        $currency = isset($currency->currency)? $currency->currency :'';  
                                        $rCurrency = App\Model\Currency::where(['short_code'=>$currency,'status'=>'1'])->first();
                                        $curesyml = ($rCurrency) ? $rCurrency->symbol : '';
                                        $propertyId = isset($properties->id)? $properties->id :'';
                                    @endphp
                                    <span class="property-price">{{$curesyml}}{{$subb}}/Night</span>
                                    <input type="hidden" name="curr" id="curr" value="{{$currency}}">
                                    <input type="hidden" name="propertyid" id="propertyid" value="{{$propertyId}}">
                                </div>
                            </div>
                            <div class="property-address">
                                {{$properties->address}}
                            </div>
                            @php
                                $type = \App\Model\PropertyType::where('id',$properties->propertytype)->first();
                            @endphp
                            <div class="property-label w-100">
                                @if($type)
                                <a href="#" class="property-label__type">{{$type->categoryname}}</a>
                                @endif
								<div class="rating pull-right" style="display:flex;align-items: center">
                                    <span style="font-size:12px;margin-top:1px;">   
                                        {{$properties->avg_rating}}
                                    </span>
                                    <div id="rateYo{{$properties->id}}" style="margin-right:4px;"></div>
                                    <script type="text/javascript">
                                        $("#rateYo{{$properties->id}}").rateYo({
                                            rating: {{$properties->avg_rating}},
                                            starWidth: "15px",
                                            ratedFill: "#ff7200",
                                            
                                        });
                                        $("#rateYo{{$properties->id}}").rateYo('option', 'readOnly', true);
                                    </script>
                                    
                                    <span style="font-size:12px;margin-top:1px;">   
                                        ({{$properties->rating_counts}})
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="property-image">
                            <div id="gallery-1" class="royalSlider rsDefault">
                                @php if(isset($properties) && !empty($properties)){ @endphp
                                    @foreach($images as $data)
                                        <a class="rsImg" data-rsBigImg="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}" href="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}"> <img class="rsTmb" src="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}" />
                                            <div class="fotorama__caption__wrap">{{$data->phototitle}}</div> 
                                        </a>
                                    @endforeach
                                @php } @endphp
                            </div>
                        </div>
                            <!-- Property facility Detail -->
                        <div class="property-footer">
                            <div class="item-wide" style="text-transform: capitalize;"><span class="fi flaticon-wide"></span> Beds: {{$properties->bedrooms}}</div>
                            <div class="item-room"> <span class="fi flaticon-bathroom"></span> Baths: {{$properties->baths}}</div>
                            <div class="item-bathroom"><span class="fi flaticon-room"></span>Sleep: {{$properties->sleepsno}}</div>
                            @php $mnight = \App\Model\PropertyRates::where('propertyid',$properties->id)->orderby('nightrate','ASC')->first();
                             
                             @endphp
                            <div class="item-room"> <span class="fi flaticon-room"></span> Min Night: {{$nightstay}}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h3 class="heading-title">The Space</h3>
                            </div>
                            <div class="col-md-9 col-sm-9" style="padding:0px;">
                                <ul class="feature-list">
                                    <li>Accommodates: <strong>{{$properties->sleepsno}}</strong></li>
                                    <li>Bathrooms: <strong>{{$properties->baths}}</strong></li>
                                    <li>Bed type: <strong>{{$properties->bed_type}}</strong></li>
                                    <li style="text-transform: capitalize;">Bedrooms: <strong>{{$properties->bedrooms}}</strong></li>
                                    <li style="text-transform: capitalize;">Beds: <strong>{{$properties->bedrooms}}</strong></li>
                                    <li>Check In: <strong>{{$properties->check_in}}</strong></li>
                                    <li>Check Out: <strong>{{$properties->check_out}}</strong></li>
                                    <li>Room type: <strong>{{$properties->room_type}}</strong></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Facilities Section -->
                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h3 class="heading-title">Description</h3>
                            </div>
                            <div class="col-md-9 col-sm-9" style="padding:0px;">
                                <div id="toggleText" style="display: block;">{!! strip_tags(substr($properties->description,0, 300)) !!}...</div>
                                <section id="toggleTexts" style="display: none;">{!! html_entity_decode($properties->description) !!}</section>
                                <a id="displayText" href="javascript:toggle();">Read More</a> 
                            </div>
                        </div>
                        <hr>
                        <h3 class="heading-title">Amenities:</h3>
                        <!-- <span class="alert alert-warning w-100">Features</span> -->
                        @php $amenityData = \App\Model\PropertyAmenities::where(['propertyid'=>$properties->id])->orderBy('category', 'asc')->get();
                        @endphp
                        @foreach($amenityData as $ameData)
                            @php $sub = \App\Model\Amenity::where(['id'=>$ameData->category])->get(); @endphp
                            @if($sub)
                            <div class="row amenities-sections">
                            @foreach($sub as $subData)
                                <div class="col-md-3 col-sm-3">
                                    <h3 class="heading-title">{{ucwords(strtolower($subData->amen_value))}}</h3>
                                </div>
                                @php 
                                $selectedSubCategory = explode(',',$ameData->subcategory); 
                                @endphp
                                <div class="col-md-9 col-sm-9 detail-features" style="padding:0px;">
                                    <div class="row list-features" style="padding:0px;">
                                    @php $temps = [];@endphp
                                    @foreach($selectedSubCategory as $sub_ame)
                                        @php 
                                            $prop_Sub_Ame = \App\Model\SubAmenity::find($sub_ame); 
                                            if($prop_Sub_Ame){
                                                if($prop_Sub_Ame->image){
                                                    $image = $prop_Sub_Ame->image;
                                                } else {
                                                    $image = '';
                                                }
                                                
                                                if(!isset($temps[$prop_Sub_Ame->amenity])) {
                                                    $temps[$prop_Sub_Ame->amenity] = [];
                                                }
                                                array_push($temps[$prop_Sub_Ame->amenity], ['image' => $image, 'name' => $prop_Sub_Ame->amenity]);
                                            }
                                        @endphp
                                        
                                    @endforeach   
                                    
                                    @foreach($temps as $val)
                                    
                                    <div class="col-md-4 col-xs-6 col-sm-4 p-0">
                                        <div style="display: inline-flex;">
                                            <div style="margin-right:4px;">
                                                @if($val[0]['image'])
                                                    <img src="{{url('public/uploads/amenity')}}/{{$val[0]['image']}}" width="20"/> 
                                                @else 
                                                    <i class="fa fa-circle-o" style="width:20px;color:#ccc;"></i> 
                                                @endif
                                            </div>
                                            <a href="#">
                                                <span class="square-box"></span>{{$val[0]['name']}}
                                            </a>
                                        </div>
                                    </div> 
                                    @endforeach 
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            @endif
                        @endforeach
                        
                        
                        @php
                            $extra = \App\Model\ExtraFee::where('propertyid',$properties->id)->first();
                            $clean = isset($extra->clean)? '<li>Cleaning Fee: <strong>'.$curesyml.' '.$extra->clean.'</strong></li>' :'';
                            $refund = isset($extra->refund)? '<li>Refundable Deposit: <strong>'.$curesyml.' '.$extra->refund.'</strong></li>' :'';
                            $term = isset($extra->extraNotes)? $extra->extraNotes :'';
                        @endphp
                        @if($clean)
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h3 class="heading-title">Additional Rates Detail</h3>
                            </div>
                            <div class="col-md-9 col-sm-9" style="padding:0px;">
                                <ul class="feature-list">
                                    {!!$clean!!}
                                    {!!$refund!!}
                                </ul>
                            </div>
                        </div>
                        <hr>
                        @endif
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h3 class="heading-title">Terms & Conditions</h3>
                            </div>
                            <div class="col-md-9 col-sm-9" style="padding:0px;">
                                <ul class="feature-list">
                                    <li><strong>{!!$term!!}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    <!-- Property Location / Map -->
                    <div class="property-location widget panel-box">
                        <div class="panel-header">
                            <h3 class="panel-title">Property Location</h3>
                        </div>
                        <div class="panel-body">
                            <div id="map"></div>
                        </div>
                    </div>
                     
                    
                    <!-- Comments -->
                    <div id="comments" class="comments-area compact">
                        @php $reviewData = \App\Model\Review::where(['pro_id'=>$properties->id])->where('status','=',1)->get();
                        if(isset($reviewData) && !empty($reviewData)){ @endphp
                        <div class="entry-comments">
                            <div class="comment-header">
                                <h3 class="widget-title comment-title">Guest Reviews</h3>
                            </div>
                            <ol class="comment-list">
                            <!-- Comment Parent  -->
							@if($reviewData->count()>0)
                            @foreach($reviewData as $data)
                                <li class="comment">
                                    <div class="comment-body" style="display: flex">
                                        <div class="comment-avatar">
                                            <img src="{{url('/')}}/public/frontend/images/img_author_default.jpg" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-author">
                                                <a href="javascript:">{{$data->name}}</a>
                                                @php $date=date_create($data->journey_date);@endphp
                                                <span class="comment-date fa fa-calendar-o"> {{date_format($date,"d/m/Y")}}</span>
                                            </div>
                                            <div class="rating">
                                            @php 
                                              for($i=0;$i<$data->rating_number;$i++){ @endphp
                                             
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                            @php 
                                        	} 
                                            for($j=0;$j<(5-$data->rating_number);$j++){ 
                                            @endphp
                                             <i class="fa fa-star" aria-hidden="true"></i> 
                                           @php } 
                                            @endphp
                                            </div>
                                            <p>{{$data->description}}</p>
                                            <!-- <div class="comment-meta comment-meta-data">
                                                <a class="comment-edit-link" href="#">(Edit)</a>
                                            </div> -->
                                        </div>
                                    </div>
                                    @endforeach 
                                </li>
									@else
										<h4 class="color-gray text-center mtb-40"> No Reviews</h4>
									@endif
                                    
                                </ol>
                            </div>
                            @php } @endphp
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <!-- Sidebar -->
                    <div id="sidebar">
                        <!-- widget Booking -->
                        <div class="widget widget-booking">
                
                           <!--- contact form --->
            <div class="formdetail" style="display:none">
            <form class="contact-form info" id="contactinfo">
               <h3>Contact Info</h3>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group">
                         <label>Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="uname"  name="name" required="">
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                         <label>Email<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="Last-Name" name="email" required="">
                     </div>
                  </div>
                  <div class="col-lg-12">
                      <label>Message<sup class="text-danger">*</sup></label>
                     <textarea class="form-control" rows="5" name="des"></textarea>
                      <!--<button type="submit" class="btn btn-primary pull-right btn-submit">Send Message</button>-->
                      <input type="submit" class="btn btn-primary pull-right btn-submit" value="Submit">
                  </div>
                 
               </div>
            </form>
            </div>
<!---end---->
                            
                            <!-- Panel Box -->
                            <div class="panel-box">
                                <div class="panel-body">

                                    <form action="#">
                                        @php $prop_id = isset($properties->id)? $properties->id :'';
                                             $prop_name = isset($properties->propertyname)? $properties->propertyname :''; 
                                        @endphp
                                        <input type="hidden" name="pro_id" id="pro_id" value="{{$prop_id}}">
                                        <input type="hidden" name="pro_head" id="pro_head" value="{{$prop_name}}">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 form-group">
                                                <input id="nb-start-date" name="search_startdate"  style="z-index:2" class="form-control scheckin" placeholder="Check-in Date"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6 col-lg-6 form-group" style="z-index:2">
                                                <input id="nb-end-date" name="search_enddate" class="form-control echeckout" placeholder="Check-out Date" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom:24px;z-index:1;">
                                            <div class="col-md-6 col-xs-6">
                                                <label style="margin:0px;">Adult</label>
                                                <div class="input-group" style="max-width:130px;">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="count_guests">
                                                      <span class="fa fa-minus"></span>
                                                    </button>
                                                    </span>
                                                    <input type="text" id="guest" name="count_guests" class="form-control input-number text-center text-number eguest hsgde " style="border:none;" value="1" min="1" max="{{$properties->sleepsno}}">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="count_guests">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <label style="margin:0px;"></label>Child</label>
                                                <div class="input-group" style="max-width:130px;">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="count_children">
                                                      <span class="fa fa-minus"></span>
                                                    </button>
                                                    </span>
                                                    <input type="text" id="child" name="count_children" class="form-control input-number text-center text-number eguest hsgdes" style="border:none;" value="0" min="0" max="{{$properties->sleepsno - 1}}">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="count_children">
                                                    <span class="fa fa-plus"></span>
                                                    </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="calInProgress" class="text-center text-success" style="display: none">Calculating Rate...</div>
                                        <div class="form-group" id="status"></div>
                                    </form>
                                </div>
                            </div>
                            <?php $events = \App\Model\Ical_Events::where('propertyid',$properties->id)->get();
                                  //dd($events);
                                  $outArray = array();
                                   if(isset($events) && !empty($events)){  
                                        foreach($events as $eve){ 
                                       $sdate = $eve->start_date;
                                       //dd($sdate);
                                       $edate = $eve->end_date;
                                  $sdate = isset($sdate)? $sdate :'';
                                     $date_from = strtotime($sdate); 
                                     $edate = isset($edate)? $edate :'';
                                     
                                     $date_to = strtotime($edate);
                                     
                                     for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                                          $outArray[] = '"'.date("Y-m-d", $i).'"';
                                          
                                      }  
                                      $allDate =implode(",",$outArray);


                                      }
                                 }
                                    //dd($allDate);
                             ?>
                            <div class="panel-box" style="border-top: 10px solid #f6f6f6;">
                                <div class="panel-body">
                                    <div class="col-12 p-0">
                                        <span class="booked"></span> <span class="pull-left" style="margin-right: 15px;">Booked</span>
                                        <span class="startdate"></span> <span class="pull-left" style="margin-right: 15px;">Start Date</span>
                                        <span class="enddate"></span> <span class="pull-left">End Date</span>
                                    </div>
                                    <div class="clearfix"></div><br>
                                    <div class="bookingreadonly" style="position:relative;">
                                        <div class="disablecalendar"></div>
                                        @php $adate = isset($allDate)? $allDate :''; @endphp
                                        <div id="booking-calendar" class="select-first midday readonly-cal" readonly='true' data-booked='[{{$adate}}]' ></div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-box" style="border-top: 10px solid #f6f6f6;">
                            <div class="panel-body review-form" style="padding: 9px;">
                                <!--<img src="https://www.especialrentals.com/img/travelwithcon.png" title="Luxury Vacation Rentals, Serviced Apartments, Holiday Homes" class="img-responsive">-->
								<div class="secure col-md-12" style="padding:0px;">
								<h1 class="text-center" style="margin-bottom:0px;"><i class="fa fa-shield shields"></i></h1>
								<h3 class="text-center" style="margin-top:10px;">Travel with confidence</h3>
								<ul class="secure-point-ul" style="padding:8px;">
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span><span class="features"> We ensure the best quality of properties & services</span></li>
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span> <span class="features">Secure payment gateway, your payment is under guarantee until you check-in</span></li>
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span> <span class="features">Easy refunds and partial payment options for a hassle free booking experience.</span></li>
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span> <span class="features">Comfort of home coupled with luxury of a hotel.</span></li>
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span> <span class="features">Dedicated  & experienced stay manager.</span></li>
									<li><span><img src="{{url('/')}}/public/frontend/images/tick_2.png" width="20"/></span> <span class="features">Verified Properties</span></li>
								</ul>
								</div>
                                </div>
                            </div>
                            <div class="panel-box" style="border-top: 10px solid #f6f6f6;">
                                <div class="panel-header" style="display: flex;justify-content: space-between;align-items: center;">
                                    <h3 class="panel-title">Property Search</h3>
                                    <button class="btn btn-default pull-right btn-sm review-showhide"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="panel-body review-form" style="display: none">
                                    <form novalidate="" method="get" action="{{url('property')}}" enctype = "multipart/form-data" >
                                        <div class="form-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control country_name" id="country_name" name="country_name" placeholder="What will be your next trip be?" value="{{old('country_name')}}" autocomplete="off">
                                                <div id="countryList"></div>
                                                <!-- <input type="hidden" name="countryId" id="countryId" value="">
                                                <input type="hidden" name="countryname" id="countryName" value=""> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 form-group">
                                                    <input id="nb-start-date2" name="search_startdate" class="form-control" placeholder="Check-in Date" autocomplete="off">
                                                </div>
                                                <div class="col-md-6 col-lg-6 form-group">
                                                    <input id="nb-end-date2" name="search_enddate" class="form-control" placeholder="Check-out Date" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                @php
                                                 $type = \App\Model\PropertyType::select('id', 'categoryname')->get();
                                                @endphp
                                                <label for="sale-type">Property Type</label>
                                                <select class="form-control" name="property-type" required="">
                                                    <option value="" style="display:none;">Select Type</option>      
                                                    @foreach($type as $ptypeData)
                                                     <option value="{{ $ptypeData->id }}"  >{{ $ptypeData->categoryname }}</option>
                                                    @endforeach          
         
                                                </select>
                                            </div>
                                            <div class=" form-group ">
                                                <div class="dropdown form-control neighbourhood" name="neighbourhood[]" id="Neighbourhood" title="Neighbour" multiple="multiple"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;background: transparent;padding: 6px 0 0 0;text-transform: capitalize;">All Neighbourhood</button>
                                                <div class="dropdown-menu Neighbourhood" aria-labelledby="dropdownMenuButton" style="height: 300px;overflow-y: auto;z-index:1;">
                                                </div>         
                                             </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sale-bathroom">Bath Room</label>
                                                <select class="form-control" name="property-type" required="">
                                                    <option value="" style="display:none;">Baths</option>   
                                                    <option value="Apartment">Any Bathroom</option>
                                                    @for($a=1; $a<=7; $a++)
                                                    <option value="{{$a}}">{{$a}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sale-bedroom">Bed Room</label>
                                                <select class="form-control" name="property-type" required="">
                                                    <option value="" style="display:none;">Bedroom</option> 
                                                    <option value="studio">Studio</option>
                                                    @for($b=1; $b<=7; $b++)
                                                    <option value="{{$b}}">{{$b}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sale-keyword">Select Number of Sleeps</label>
                                                <select class="form-control" name="property-type" required="">
                                                        <option value="" style="display:none;">Sleep</option>  
                                                        @for($c=1; $c<=12; $c++)
                                                        <option value="{{$c}}">{{$c}}</option>
                                                        @endfor
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="sale-range-price">Price</label>
                                                <div class="range-box">
                                                    <input id="sale-range-price" data-min="100" data-max="5000" readonly="">
                                                    <input type="hidden" name="srate" id="srate" value="">
                                                    <input type="hidden" name="erate" id="erate" value="">
                                                </div>
                                            </div>
                                            @php $sub = \App\Model\OtherFeature::get(); @endphp
                                            <div class="form-group">
                                                <label>Amenities</label>
                                                <ul class="checklist-box">
                                                    @foreach($sub as $subData)
                                                    <li><label><input type="checkbox" name="amenities[]" class="amenities" value="{{$subData->categoryname}}"> {{$subData->categoryname}}</label></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-submit" type="submit"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="panel-box" style="border-top: 10px solid #f6f6f6;">
                                <div class="panel-header" style="display: flex;justify-content: space-between;align-items: center;">
                                    <h3 class="panel-title">Guest Review</h3>
                                    <button class="btn btn-default pull-right btn-sm review-showhide"><i class="fa fa-minus"></i></button>
                                </div>
                                <div class="panel-body review-form">
                                    <form class="needs-validation" action="#" enctype = "multipart/form-data" id="prop_review">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>When did you stay at this property?<sup class="text-danger">*</sup></label>
                                                <input type="date" class="form-control" id="rdate">
                                            </div>
                                            <div class="form-group">
                                                <label>Please enter a title for your review<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" id="rtitle">
                                            </div>
                                            <div class="form-group">
                                                <label> Your review<sup class="text-danger">*</sup><p style="margin:0px;"><em>(the more detail you can provide the better)</em></p></label>
                                                <textarea class="form-control" rows="5" id="rdes"></textarea>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Where do you live?<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" id="rloc">
                                            </div> -->
                                            <h4>Your Information</h4>
                                            <div class="form-group">
                                                <label>Name<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" id="rname">
                                            </div>
                                            <div class="form-group">
                                                <label>Email<sup class="text-danger">*</sup></label>
                                                <input type="email" class="form-control" id="remail">
                                            </div>
                                            <div class="form-group">
                                                <label>Rating<sup class="text-danger">*</sup></label>
                                                <div class='rating-stars text-center'>
                                                    <!-- <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i> -->
                                                    <ul id='stars'>
												      <li class='star' title='Poor' data-value='1'>
												        <i class='fa fa-star fa-fw'></i>
												      </li>
												      <li class='star' title='Fair' data-value='2'>
												        <i class='fa fa-star fa-fw'></i>
												      </li>
												      <li class='star' title='Good' data-value='3'>
												        <i class='fa fa-star fa-fw'></i>
												      </li>
												      <li class='star' title='Excellent' data-value='4'>
												        <i class='fa fa-star fa-fw'></i>
												      </li>
												      <li class='star' title='WOW!!!' data-value='5'>
												        <i class='fa fa-star fa-fw'></i>
												      </li>
												    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- modal for book now START -->
    <div id="booknow-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding:0px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:0px;">
                    @php
                     $img = \App\Model\PropertyGallery::where('propertyid',$properties->id)->orderby('photoorder','ASC')->get();
                     $username = isset($img->first()->photoname) ? $img->first()->photoname : '';
                    @endphp
                    <img src="{{url('public/uploads/property_image')}}/{{$properties->id}}/{{ $username }}" class="w-100" style="width:100%;">
                    <div class="col-md-12">
                        <h3>{{$properties->propertyname}}</h3>

                        <form class="">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" class="form-control" id="fbname" placeholder="First Name" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" class="form-control" id="lbname" placeholder="Last Name" required="required">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="email" class="form-control" id="bemail" placeholder="Email ID" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" class="form-control" id="bphone" placeholder="Phone Number" required="required">
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-12">
                                            <sup class="pull-right text-danger">*</sup>
                                            <textarea class="form-control" id="bcomment" placeholder="Comments" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-12">
                                            <input type="checkbox" id="bookcheck" value=""> I agree to the <a href="{{url('testimonals')}}" target="_blank">Terms & Conditions</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit_booking" class="btn btn-warning btn-block buy_now" data-amount="">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for book now END -->
    <script>
        $(function(){
            $(document).on('click','#book_now',function(){
                $('#booknow-modal').modal();
                var amount=$(document).find('#data_amount').val();
                $('#submit_booking').attr('data-amount',amount);
            })
            $('#submit_booking').mousedown(function(){
                
                var fbname = $('#fbname').val();
                var lbname = $('#lbname').val();
                var bemail = $('#bemail').val();
                var bphone = $('#bphone').val();
                var bcomment = $('#bcomment').val();
            })
        })
    </script>


    <!-- modal for inquiry START -->
    <div id="inquiry-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding:0px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:0px;">
                    
                    <img src="{{url('public/uploads/property_image')}}/{{$properties->id}}/{{ $username }}" class="w-100" style="width:100%;">
                    <div class="col-md-12">
                        <h3>{{$properties->propertyname}}</h3>
                         <form class="needs-validation" action="#" enctype = "multipart/form-data" id="prop_enquiry">
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" name="fname" class="form-control" placeholder="First Name" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" name="email" class="form-control" placeholder="Email ID" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <sup class="pull-right text-danger">*</sup>
                                            <input type="text" name="mob" class="form-control" placeholder="Phone Number" required="required">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-12">
                                            <sup class="pull-right text-danger">*</sup>
                                            <textarea class="form-control" id="enq_comment" name="comment" placeholder="Message" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:30px">
                                        <div class="col-md-12">
                                            <input type="checkbox" id="bookecheck" value=""> I agree to the <a href="{{url('testimonals')}}" target="_blank">Terms & Conditions</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-warning btn-block">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal for inquiry END -->
    
    
    <script>
            $(document).ready(function(){
                
              var token="{{csrf_token()}}";
              var url="{{url('')}}";  
             
             $( '#contactinfo' ).on( 'submit', function(e) {
                debugger;
                e.preventDefault();
                
                var name = $(this).find('input[name=name]').val();
                var email = $(this).find('input[name=email]').val();
                var des = $(this).find('textarea[name=des]').val();
                 
                $.ajax({
                    url:url+'/property/info',
                    data:{name:name,email:email,des:des, _token:token},
                    method:"POST",
                     
                }).done(function( msg ) {
                  debugger;
                    window.location.href = url +'/property/contact-thank-you';
        			$( '#contactinfo' ).trigger('reset');
        			/*$( '#prop_contact input,#prop_contact textarea' ).trigger('change');
        			$( '#prop_contact input,#prop_contact textarea' ).removeAttr('value');*/
                    //$('#enq_res').html(msg);
        
                });
        
            });
         }); 
</script>

    <script>
        $(function() {
            // var adlt=0;
            // var chld=0;
            // $('.quantity-left-minus').click(function() {
            //     var inputval = $(this).parent().next().val();
            //     if (inputval <= 0) $(this).parent().next().val(inputval + 1)

            // })
            $('.review-showhide').click(function() {
                $(this).find('i').toggleClass('fa-plus fa-minus');
                $(this).parent().next('.review-form').slideToggle();
            })
            $('.readonly-cal td div').removeClass('valid').addClass('invalid');
            $('.btn-list').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                $('.grid-view').addClass('hide');
                $('.list-view').removeClass('hide');
            })
            $('.btn-grid').click(function() {
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
                //alert('hi');

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
          @php $latlong=\App\Model\Googlemap::where('propertyid' , $properties->id)->first(); 
               //dd($latlong);
            @endphp
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                scrollwheel: false,
                center: new google.maps.LatLng('{{$latlong->lat}}', '{{$latlong->longt}}'),
            });

            var iconBase = "{{url('/public/uploads/')}}/";
            var icons = {
                property: {
                    icon: iconBase + 'icon_marker.png'
                },
            };

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
                    <a href="${proplink}" class="property-link">detail <i class="fa fa-long-arrow-right"></i></a></div>
                    </div>
                    `
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }

            function initialize(){
                var input = document.getElementById('country_name');
                new google.maps.places.Autocomplete(input);
            }
           google.maps.event.addDomListener(window, 'load', initialize);

            var features = [ 
                 <?php $sub=\App\Model\PropertyGallery::where('propertyid',$properties->id)->orderby('photoorder','ASC')->get();
                    $latlong=\App\Model\Googlemap::where('propertyid',$properties->id)->first();
                    $type = \App\Model\PropertyType::where('id',$data->properties)->first();
                   ?>
                { 
                position: new google.maps.LatLng('{{$latlong->lat}}', '{{$latlong->longt}}'),
                type: 'property',
                imgurl:'{{url("public/uploads/property_image")}}/{{$properties->id}}/{{ $sub->first()->photoname }}',
                title:'{{$properties->propertyname}}' ,
                link:'{{url("/property")}}/detail/{{$properties->id}}'},
            
             ];

            for (var i = 0, feature; feature = features[i]; i++) {
                addMarker(feature);
            }
        }
    </script>  
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLtF6MPFfrge7gJ0sTP8Vjv8cOA1Acy3k&callback=initMap&libraries=places"></script>
    <script type="text/javascript" src="{{url('/')}}/public/frontend/js/lightbox-plus-jquery.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/public/frontend/js/royalslider.js"></script>
    <script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport':true,
      'alwaysShowNavOnTouchDevices':true
    })
</script>
<script>
      jQuery(document).ready(function($) {


  $('#gallery-1').royalSlider({
    fullscreen: {
      enabled: true,
      nativeFS: true
    },
    controlNavigation: 'thumbnails',
    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 650,
    loop: false,
    imageScaleMode: 'fit-if-smaller',
    navigateByClick: true,
    numImagesToPreload:2,
    arrowsNav:true,
    arrowsNavAutoHide: true,
    arrowsNavHideOnTouch: true,
    keyboardNavEnabled: true,
    fadeinLoadedSlide: true,
    globalCaption: true,
    globalCaptionInside: false,
    thumbs: {
      appendSpan: true,
      firstMargin: true,
      paddingBottom: 4
    }
  });

  $('.rsContainer').on('touchmove touchend', function(){});
  
 });

  
</script>
<script type="text/javascript">
    var enddate,startdate=null;
    var token="{{csrf_token()}}";
    var url="{{url('/')}}";
    
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

    });
    function rateCalculation(){
        if(startdate!==null && enddate>startdate){
            $('#calInProgress').show();
            var pro_id = "{{$properties->id}}";
            var first_date = startdate;
            var last_date = enddate;
            var guest = $("#guest").val();
            var child = $("#child").val();
            var currency= "{{$currency}}";
             var token="{{csrf_token()}}";
            $.ajax({
                url:'https://www.especialrentals.com/property/cal-rate',
                data: {pro_id:pro_id, first_date :first_date, last_date:last_date, guest:guest,child: child, currency:currency, _token:token},
                method:"POST",
                success: function(response){
                    $('#status').html(response.message);
                    $('#calInProgress').hide();

                } 
            });
        }   
    }
</script>
<script> 
$(document).ready(function() {
    $('.hsgde').change(function(e) {
        
        var txtVal = $(this).val();
       
       $(function(){
                       
        var vart= <?php echo $properties->sleepsno; ?>;
        var teVal = vart - txtVal;
        //alert(teVal);
        $(".hsgdes").prop('max', teVal);
       });
    });
    
 $('.hsgdes').change(function(e) {
    
        var txtVal = $(this).val();
       
       $(function(){          
        
        var vart= <?php echo $properties->sleepsno ?>;
        var teVal = vart - txtVal;
        //alert(teVal);
        $(".hsgde").prop('max', teVal);
        });
        
    });  
     
});
</script>
<script type="text/javascript">
    //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                $('.btn-number').attr('disabled', false);
            } else if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            } else {
            	$('.btn-number').attr('disabled', false);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
                $('.btn-number').attr('disabled', false);
            }else if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }else {
            	$('.btn-number').attr('disabled', false);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }); </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{URL::to('')}}';
        var token="{{csrf_token()}}";
        $('body').on('click', '#submit_booking', function(e){
            $('.scheckin').bind("datepicker-change", function(event, obj){
                startdate=obj.value; 
            });
            $('.echeckout').on("datepicker-change", function(event, obj){
                enddate=obj.value; 
            }); 
            var totalAmount = $(this).attr("data-amount");
            var product_id =  $(this).attr("data-id");
            var propertyid = $('#propertyid').val();
            var first_date = startdate;
            var last_date = enddate;
            var fbname = $('#fbname').val();
            var lbname = $('#lbname').val();
            var bemail = $('#bemail').val();
            var bphone = $('#bphone').val();
            var bcomment = $('#bcomment').val();
            var nguest = $('#guest').val();
            var nchild = $('#child').val();
            var currency = "{{$currency}}";
            var pro_name = '{{$properties->propertyname}}';
            var night = $('#total-night').text();
            var cnightAmt = $('.aaaa').text();
            var cleanAmt = $('.bbbb').text();
            var ctotalAmt = $('.cccc').text();
            $(".error").remove();
            if (fbname.length < 1) {
              $('#fbname').after('<span class="error">This field is required</span>');
              return false;
            }
            if (lbname.length < 1) {
              $('#lbname').after('<span class="error">This field is required</span>');
              return false;
            }
            if (bemail.length < 1) {
              $('#bemail').after('<span class="error">This field is required</span>');
            } else {
              var regEx = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              var validEmail = regEx.test(bemail);
              if (!validEmail) {
                $('#bemail').after('<span class="error">Enter a valid email</span>');
                return false;
              }
            }
            if (bphone.length < 1) {
              $('#bphone').after('<span class="error">This field is required</span>');
            } else {
              var regEx = /^\d*(?:\.\d{1,2})?$/;
              var validPhone = regEx.test(bphone);
              if (!validPhone) {
                $('#bphone').after('<span class="error">Enter a valid Phone Number</span>');
                return false;
              }
            }
            if (bcomment.length < 1) {
              $('#bcomment').after('<span class="error">This field is required</span>');
              return false;
            }
            if ($('#bookcheck').prop("checked") == false){
              return false;
            }

            var extraHtml = $('#status #calC').html();

            var payPacket = {
                razorpay_payment_id: '', 
                totalAmount : totalAmount,
                product_id : product_id,
                propertyid : propertyid,
                first_date : first_date,
                last_date:last_date, 
                fbname:fbname,
                lbname:lbname,
                bemail:bemail,
                bphone:bphone,
                bcomment:bcomment,
                nguest:nguest, 
                nchild:nchild,
                pro_name:pro_name, 
                night:night,
                cnightAmt:cnightAmt, 
                cleanAmt:cleanAmt, 
                ctotalAmt:ctotalAmt, 
                extraHtml: extraHtml,
                _token:token
            }
            saveBeforePayment(payPacket);
        });
         /*document.getElementsClass('buy_plan1').onclick = function(e){
           rzp1.open();
           e.preventDefault();
         }*/
      </script>
     <script>
    $(document).ready(function(){
        
      var token="{{csrf_token()}}";
      var url="{{url('')}}";  

       $('#stars li').on('mouseover', function(){
       	
	    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
	   
	    // Now highlight all the stars that's not after the current hovered star
	    $(this).parent().children('li.star').each(function(e){
	      if (e < onStar) {
	        $(this).addClass('hover');
	      }
	      else {
	        $(this).removeClass('hover');
	      }
	    });
	    
	  }).on('mouseout', function(){
	    $(this).parent().children('li.star').each(function(e){
	      $(this).removeClass('hover');
	    });
	  });
	  
	  
	  /* 2. Action to perform on click */
	 var ratingValue=null;
	  $('#stars li').on('click', function(){
	    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
	    var stars = $(this).parent().children('li.star');
	    
	    for (i = 0; i < stars.length; i++) {
	      $(stars[i]).removeClass('selected');
	    }
	    
	    for (i = 0; i < onStar; i++) {
	      $(stars[i]).addClass('selected');
	    }
	    
	    // JUST RESPONSE (Not needed)
	    ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	    /*alert(ratingValue);*/
        });    
     
     $( '#prop_enquiry' ).on( 'submit', function(e) {
        
        e.preventDefault();
        $('.scheckin').bind("datepicker-change", function(event, obj){
                startdate=obj.value; 
         });
         $('.echeckout').on("datepicker-change", function(event, obj){
              enddate=obj.value; 
         });
         
        var pro_id = {{$properties->id}};
        var pro_name = '{{$properties->propertyname}}';
        var fname = $(this).find('input[name=fname]').val();
        var lname = $(this).find('input[name=lname]').val();
        var email = $(this).find('input[name=email]').val();
        var mob = $(this).find('input[name=mob]').val();
        var comment = $('#enq_comment').val();
        var checkin = startdate;
        var checkout = enddate;
        var guest = $('.guest-number').val();
        var night = $('#total-night').text();

        if ($('#bookecheck').prop("checked") == false)
        {
          return false;
        }
         
        $.ajax({
            url:url+'/property/enquiry',
            data:{pro_id:pro_id,pro_name:pro_name,fname:fname,lname:lname,email:email,mob:mob,comment:comment,checkin:checkin, checkout:checkout, guest:guest, night:night, _token:token},
            method:"POST",
             
        }).done(function( msg ) {
            window.location.href = SITEURL +'/property/enquiry-thank-you';
            $('#inquiry-modal').modal('hide');
            //$('#enq_res').html(msg);
			$('#prop_enquiry').trigger("reset"); 
				$('#prop_enquiry select').trigger("change");

        });

    });

    $( '#prop_review' ).on( 'submit', function(e) {
            e.preventDefault();
           var token="{{csrf_token()}}";
           var url="{{url('')}}"; 
           var date = $('#rdate').val();
            var title=$('#rtitle').val();  
            var rdes= $('#rdes').val();
            var location = '{{$properties->address}}';
            var name = $('#rname').val();
            var email = $('#remail').val();
            var pro_name = '{{$properties->propertyname}}';
            var pro_id = '{{$properties->id}}';
            var rate = parseInt($('#stars li.selected').last().data('value'), 10);
            //alert(parseInt($('#stars li.selected').last().data('value'), 10));
            
            $.ajax({
            url:url+'/property/review',
            data:{journey_date:date,title:title,description:rdes,location:location,name:name,email:email,pro_name:pro_name, pro_id:pro_id, rate:rate, _token:token},
            method:"POST",
             
            }).done(function( msg ) {
                alert( msg.message );
                //$('#inquiry-modal').modal('hide');
                //$('#enq_res').html(msg);
				$('#prop_review').trigger("reset"); 
				$('#prop_review select').trigger("change");
				$('#stars li').removeClass('selected');
            });

        }); 

        $(document).on('change', '.country_name', function(){ 
            
           var token="{{csrf_token()}}";
           var url="{{url('')}}"; 
           /*var id=$('a.autosearch').data('id'); 
           var country=$(this).text();
           var cityname = country.split(",").pop(-3);
            $('#countryName').val(country); 
            $('#countryId').val(id);
            $('#country_name').val($(this).text());  
            $('#countryList').fadeOut();*/

            var data = $('#country_name').val();
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

        });  

        var $d3 = $("#sale-range-price");
        $d3.on("change", function () {
        var $inp = $(this);
        var from = $inp.data("from"); // reading input value
        var from2 = $inp.data("to"); // reading input data-from attribute
        $('#srate').val(from);
        $('#erate').val(from2);
        });
        if($('#country_name').val()){
        getNeighbour();
        }
    });

    function getNeighbour(){
            var token="{{csrf_token()}}";
           var url="{{url('')}}"; 

            var data = $('#country_name').val();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <script type="text/javascript">
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };
    </script>
<script type="text/javascript">
    function toggle() {
        var ele = document.getElementById("toggleText");
        var eles = document.getElementById("toggleTexts");
        var text = document.getElementById("displayText");
        if(ele.style.display == "block") {
            ele.style.display = "none";
            eles.style.display = "block";
            text.innerHTML = "Show Less";
        }
        else {
            ele.style.display = "block";
            eles.style.display = "none";
            text.innerHTML = "Read More";
        }
    } 
</script>
<?php //echo $orderid = Session::get('order_id');?>
<script type="text/javascript">
    function saveBeforePayment(data){
        $('.loader').show();
        $.ajax({
            url: '{{url("/property/savebeforepayment")}}',
            type: 'post',
            dataType: 'json',
            data:  data, 
            success: function (response) {
                console.log(response);
                $('.loader').hide();
                if(response.status){
                    razorPay(response.id);
                }
            }
        });
    }

    function razorPay(id){
        var totalAmount = $('#submit_booking').attr('data-amount');
        var _token = "{{csrf_token()}}";
        var pro_id = "{{request()->id}}";
        var options = {
            "key": "rzp_live_Zx06Ob9agoXD8R",
            "amount": (totalAmount*100),
            "name": "{{$properties->propertyname}}",
            "description": "{{$properties->address}}",
            "currency": "{{$currency}}",
            "order_id": "<?php echo session('razorpay_order_id');?>",
            "handler": function (response){
                $.ajax({
                    url: SITEURL + '/property/paysuccess',
                    type: 'post',
                    dataType: 'json',
                    data: { id : id, razorpay_payment_id: response.razorpay_payment_id, _token : _token, pro_id :  pro_id }, 
                    success: function (response) {
                        console.log(response);
                       window.location.href = SITEURL +'/property/razor-thank-you';
                    }
                });
            }, 
            "prefill": {
                "contact": $('#bphone').val(),
                "email": $('#bemail').val(),
            },
            "theme": {
                "color": "#f3772c"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
</script>
@endsection
