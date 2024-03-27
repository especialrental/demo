
<?php $meta = $properties->meta_tag;
$metacontent = $properties->meta_description;
?>
@extends('layouts.default')

@section('title', $meta)
 
 
@section('meta_description',$metacontent )


@section('content')
 <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/newcss/assets/style.css">
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
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
            <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12">
                <div class="tab_nav">
                 <ol>
                   <li><a href="#">Home</a></li>
                   <li>></li>
                   <li><p style="text-transform: capitalize;">{{$cityUrl}}</p></li>
                   <li>></li>
                   <li><p>{{$properties->room_type}}</p></li>
                   <li>></li>
                   <li><p>{{$properties->propertyname}}</p></li>
                 </ol>
               </div>
               <div class="pr_top_sec">
                <div class="top-section-left">
                  <div class="first_line">
                    <h1>{{$properties->propertyname}}</h1>
                    <div class="f_icon">
                      <span><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span><i class="fa fa-star" aria-hidden="true"></i></span>
                      <span><i class="fa fa-star" aria-hidden="true"></i></span>
                    </div>
                  </div>
                  <div class="second_line">
                      <div class="b_icon">
                        <span>Property Type </span>
                        @php
                             $type = \App\Model\PropertyType::where('id',$properties->propertytype)->first();
                            @endphp
                        <span class="i_org">|</span>
                        @if($type)
                        <span>{{$type->categoryname}}</span>
                        @endif
                        <span class="i_org">|</span>
                        <span>{{$properties->bedrooms}} Beds</span>
                        <span class="i_org">|</span>
                        <span>{{$properties->baths}} Bath</span>
                        <span class="i_org">| <i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <span>{{$properties->address}}</span>
                      </div>
                      <!--<div class="max">-->
                      <!--  <i class="fa fa-train" aria-hidden="true"></i> Alma Marceau-->
                      <!--</div>-->
                  </div>
                </div> 
                <div class="top-section-right">
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
                  <div class="f_r_line">
                    <div class="t_rt">
                     Starting from<span class="cur"> {{$curesyml}}{{$subb}}/</span><span> Per Night</span>
                     <input type="hidden" name="curr" id="curr" value="{{$currency}}">
                     <input type="hidden" name="propertyid" id="propertyid" value="{{$propertyId}}">
                    </div>
                    <a href="#book_now11">Book</a>
                    <!--<button>Book</button>-->
                  </div>
                </div>
               </div>
                <section id="city_img">
                 <div class="container">
                   <div class="row">
                      <div class="btnxyz">
                     <div class="img_sec" id="open">
                         @php if(isset($properties) && !empty($properties)){ @endphp
                                    @foreach($images1 as $data)
                                    
                             <a href="#" class="image-item gallery__item--hor">  
                                 <img src="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}">
                             </a>
                             @endforeach
                      @php } @endphp
                      <!--<div class="image-item  gallery__item--hor">-->
                      <!--  <img src="https://www.especialrentals.com/public/uploads/property_image/1222/476499149.webp">-->
                      <!--</div>-->
                      @php if(isset($properties) && !empty($properties)){ @endphp
                                    @foreach($images as $data)
                      <a href="#" class="image-item" data-sub-html="<div class='lightGallery-captions'><p>{{$data->phototitle}}</p></div>"  >
                        <img src="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}" >
                      </a>
                      @endforeach
                      @php } @endphp
                      </div>
                    </div>
                    <div class="img_sec2" id="open2">
                         @php if(isset($properties) && !empty($properties)){ @endphp
                                    @foreach($imagesAll1 as $data)
                             <!--<a href="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}" class="image-item gallery__item--hor" data-sub-html="<div class='lightGallery-captions'><p>{{$data->phototitle}}</p></div>">  -->
                             <!--    <img src="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}">-->
                             <!--</a>-->
                             @endforeach
                      @php } @endphp
                      <!--<div class="image-item  gallery__item--hor">-->
                      <!--  <img src="https://www.especialrentals.com/public/uploads/property_image/1222/476499149.webp">-->
                      <!--</div>-->
                      @php if(isset($properties) && !empty($properties)){ @endphp
                                    @foreach($imagesAll as $data)
                      <a href="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}" class="image-item" data-sub-html="<div class='lightGallery-captions'><p>{{$data->phototitle}}</p></div>" >
                        <img src="{{url('public/uploads/property_image')}}/{{$data->propertyid}}/{{ $data->photoname }}">
                      </a>
                      @endforeach
                      @php } @endphp
                      
                      
                    </div>
                    <div class="view_container">
                      <div class="viewall">
                       <div class="icon">
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                       </div> 
                       <button class="view_button" id="btnxyz">All photos</button>
                      </div>
                    </div> 
                   </div>
                    
                 </div>
               </section> 
               <div class="property">
                       <div class="item">
                         <span><i class="fa fa-bed" aria-hidden="true"></i></span>
                          Beds: {{$properties->bedrooms}}
                       </div>
                       <div class="item">
                         <span><i class="fa fa-bath" aria-hidden="true"></i></span>
                          Baths:{{$properties->baths}}
                       </div>
                       <div class="item">
                         <span><i class="fa fa-bed" aria-hidden="true"></i></span>
                         Sleep: {{$properties->sleepsno}}
                       </div>
                       <div class="item">
                           @php $mnight = \App\Model\PropertyRates::where('propertyid',$properties->id)->orderby('nightrate','ASC')->first();
                             
                             @endphp
                         <span><i class="fa fa-bed" aria-hidden="true"></i></span>
                          Min Night: {{$nightstay}}
                       </div>
                     </div>
            </div>
            
            <div class="col-md-8">
                
                <div id="content">
                    <article class="post property-item">
                        <div class="tab_area">
                                      <div class="tab_box">
                                       <button class="tab_btn active">The Space</button>
                                       <button class="tab_btn">Description</button> 
                                       <button class="tab_btn">Area Info</button> 
                                       <button class="tab_btn">Transportation</button>
                                       <button class="tab_btn">Amenities</button>
                                       <button class="tab_btn">Cancelation Policy</button>
                                       <button class="tab_btn">Fee and Deposit</button>
                                       <button class="tab_btn">Reviews</button>
                                       <div class="line" style="width: 83px;"></div>
                                      </div>
                                      <div class="content_box">
                                       <div class="content active">
                                         <div class="row">
                                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                              <ul>
                                                  <li>Accommodates: <strong>{{$properties->sleepsno}}</strong></li>
                                                  <li>Bed type: <strong>{{$properties->bed_type}}</strong></li>
                                                  <li>Beds: <strong>{{$properties->bedrooms}}</strong></li>
                                                  <li>Check Out: <strong>{{$properties->check_out}}</strong></li>
                                              </ul> 
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                              <ul>
                                                  <li>Bathrooms: <strong>{{$properties->baths}}</strong></li>
                                                  <li>Bedrooms: <strong>{{$properties->bedrooms}}</strong></li>
                                                  <li>Check In: <strong>{{$properties->check_in}}</strong></li>
                                                  <li>Room type: <strong>{{$properties->room_type}}</strong></li>
                                              </ul> 
                                          </div> 
                                         </div>  
                                         
                                        </div>
                                        <div class="content transpot">
                                            
                                                <?php //$properties->description ?>
                                                
                                                <div id="toggleText" style="display: block;">{!! strip_tags(substr($properties->description,0, 520)) !!}...</div>
                                                <section id="toggleTexts" style="display: none;">{!! html_entity_decode($properties->description) !!}</section>
                                                <a id="displayText" href="javascript:toggle();">Read More</a>
                                        </div>
                                       <div class="content area">
                                        {!!$properties->area_info!!}
                                       </div> 
                                       <div class="content transpot">
                                         {!!$properties->transportation!!}
                                       </div>
                                       <div class="content">
                                           
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
                                                    <img src="{{url('public/uploads/amenity')}}/{{$val[0]['image']}}" width="20"> 
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
                                                               
                                                                
                                       </div>
                                       <?php $extra = \App\Model\ExtraFee::where('propertyid',$properties->id)->first();?>
                                        <?php  $term = isset($extra->extraNotes)? $extra->extraNotes :'';?>
                                       <div class="content transpot">
                                        <p>{!!$term!!}</p>
                                       </div>
                                       <div class="content">
                                         <div class="row">
                                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                              <?php $extra = \App\Model\ExtraFee::where('propertyid',$properties->id)->first();?>
                                              <ul>
                                                  <?php $clean = isset($extra->clean);?>
                                                  <li>Cleaning Fee: <strong><?php echo $curesyml; ?> <?php echo $extra->clean; ?></strong></li>
                                              </ul> 
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                              <ul>
                                                  <?php  $refund = isset($extra->refund);?>
                                                  <li>Refundable Deposit: <strong><?php //echo $curesyml; ?> <?php echo $extra->refund; ?></strong></li>
                                              </ul>
                                             
                                          </div> 
                                         </div>
                                       </div>
                                       <div class="content">
                                           @php $reviewData = \App\Model\Review::where(['pro_id'=>$properties->id])->where('status','=',1)->orderBy('journey_date', 'DESC')->get();
                                                if(isset($reviewData) && !empty($reviewData)){ @endphp
                                         <div id="comments" class="comments-area compact">
                                                <div class="entry-comments">
                                                    @if($reviewData->count()>0)
                                                @foreach($reviewData as $data)
                                                <ol class="comment-list">
                                        <!-- Comment Parent  -->
            							        <li class="comment">
                                                <div class="comment-body" style="display: flex">
                                                    <div class="comment-avatar">
                                                        <img src="{{url('/')}}/public/frontend/images/img_author_default.jpg" alt="">
                                                    </div>
                                        <div class="comment-content">
                                            <div class="comment-author">
                                                <a href="javascript:">{{$data->name}}</a>
                                                
                                                @php $date=date_create($data->journey_date);@endphp
                                                 <span class="comment-date fa fa-calendar-o">{{date_format($date,"d/m/Y")}}</span>
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
                                     
                                </li>
									@endforeach 
									@else
										<h4 class="color-gray text-center mtb-40"> No Reviews</h4>
									@endif
                                </ol>
                            </div>
                            @php } @endphp
                                                    </div>  
                                         </div>
                                      </div>
                                      
                                      
                                    </div>
                        
                        <!-- Facilities Section -->
                        
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
                    
                    </div>
                </div>
                <div class="col-md-4">

                    <!-- Sidebar -->
                    <div id="sidebar">
                        <!-- widget Booking -->
                        <div class="widget widget-booking">
                
                            
                            <!-- Panel Box -->
                            <div class="panel-box br_add">
                                <div class="panel-body">
                                    
                                    <div class="top_br" id="book_now11">
                                     <h5>{{substr($properties->propertyname,0,40)}}...</h5>
                                     <div class="f_icon">
                                          <!--<i class="fa fa-heart" aria-hidden="true"></i>-->
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                     </div>
                                    </div>
                                    <div class="bottom_br">
                                        <div class="b_rt">
                                          <button type="button" class="btn btn-warning btn-block" >Enter Your Travel Dates For Availability</button>    
                                          <!--Enter Your Travel Dates For Updated Availability.    -->
                                          <!--Starting from<span class="cur"> $345</span><span> per night</span> <span class="icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>-->
                                        </div>
                                        <div class="f_icon" style="display:none">
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                          <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                      </div>   
                                      <hr class="n_hr">
                                      
                                    <form action="#">
                                        @php $prop_id = isset($properties->id)? $properties->id :'';
                                             $prop_name = isset($properties->propertyname)? $properties->propertyname :''; 
                                        @endphp
                                        <input type="hidden" name="pro_id" id="pro_id" value="{{$prop_id}}">
                                        <input type="hidden" name="pro_head" id="pro_head" value="{{$prop_name}}">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 form-group">
                                                <input id="nb-start-date" name="search_startdate"  style="z-index:2" class="form-control scheckin clr_org" placeholder="Check-in Date"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6 col-lg-6 form-group" style="z-index:2">
                                                <input id="nb-end-date" name="search_enddate" class="form-control echeckout clr_org" placeholder="Check-out Date" autocomplete="off">
                                            </div>
                                            
                                        </div>
                                        <div class="row " style="margin-bottom:24px;z-index:1;">
                                            <div class="col-md-6 col-xs-6 text-center">
                                                <label style="margin:0px;">Adult</label>
                                                <div class="input-group sml_wt">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-default btn-number n_cl"  data-type="minus" data-field="count_guests">
                                                      <span class="fa fa-minus"></span>
                                                    </button>
                                                    </span>
                                                    <input type="text" id="guest" name="count_guests" class="form-control input-number text-center text-number eguest hsgde " style="border:none;" value="1" min="1" max="{{$properties->sleepsno}}">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-default btn-number n_cl" data-type="plus" data-field="count_guests">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 text-center">
                                                <label style="margin:0px;"></label>Child</label>
                                                <div class="input-group sml_wt">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-default btn-number n_cl"  data-type="minus" data-field="count_children">
                                                      <span class="fa fa-minus"></span>
                                                    </button>
                                                    </span>
                                                    <input type="text" id="child" name="count_children" class="form-control input-number text-center text-number eguest hsgdes" style="border:none;" value="0" min="0" max="{{$properties->sleepsno - 1}}">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-default btn-number n_cl" data-type="plus" data-field="count_children">
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
                            
                            <div class="panel-box" style="border-top: 23px solid #f6f6f6;">
                            <div class="panel-body br_add review-form" style="padding: 9px;">
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
                            
                            
                        </div>
                        
                        
                      


                    </div>
                </div>
                
                 
            </div>
        </div>
         <div class="container">
           <div class="panel-box" style="border-top: 10px solid #f6f6f6;margin-bottom: 24px;">
                                <div class="panel-header" style="display: flex;justify-content: space-between;align-items: center;">
                                    <h3 class="panel-title">LEAVE A REVIEW</h3>
                                    <button class="btn btn-default pull-right btn-sm review-showhide n_cl"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="panel-body review-form" style="display:none;">
                                    <form class="needs-validation" action="#" enctype = "multipart/form-data" id="prop_review">
                                        <div class="form-body">
                                            
                                            <h4>Your Information</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control clr_org" id="rname">
                                                </div>
                                                </div>
                                            <div class="col-md-4">    
                                            <div class="form-group">
                                                <label>Email<sup class="text-danger">*</sup></label>
                                                <input type="email" class="form-control clr_org" id="remail">
                                            </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date<sup class="text-danger">*</sup></label>
                                                    <input type="date" class="form-control clr_org" id="rdate">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                               
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                 <label>Review title<sup class="text-danger">*</sup></label>
                                                 <input type="text" class="form-control clr_org" id="rtitle">
                                                </div>
                                                </div>
                                                <div  class="col-md-4">
                                                    <div class="form-group">
                                                <label> Your review<sup class="text-danger">*</sup><p style="margin:0px;"></p></label>
                                                <textarea class="form-control clr_org" rows="2" id="rdes"></textarea>
                                            </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                <label>Rating<sup class="text-danger">*</sup></label>
                                                <div class='rating-stars text-center'>
                                                    
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
         
		
	</section>
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
    
    <script src="{{url('/')}}/public/newcss/assets/script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#open2').hide();
        });
    </script>
     <style>
        a {
        color: #0254EB
    }
    a:visited {
        color: #0254EB
    }
    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;
    }
    .comment {
        width: 840px;
        background-color: #f0f0f0;
        margin: 10px;
    }
    </style>
   <script type="text/javascript">
        $(document).ready(function(){
            $('.media-item').hide();
            $('.media-item').slice(0, 3).show();
            $('.view-less-text').hide();
            var length=$('.media-item').length;
            // $("ul li:nth-child(3)").append("<span class='media view-all-text'> Read More...</span>");
            // $('ul li:nth-child('+length+')').append("<span class='media view-less-text'> Read Less...</span>");
            $('.media').click(function () {
                var $relatedItems = $('.media-item').slice(3);
                if ($('.media-item').hasClass('show')) {
                    $relatedItems.hide().removeClass('show');
                    $('.view-all-text').show();
                    $('.view-less-text').hide();
                }
                else {
                    $relatedItems.slideDown('slow').addClass('show');
                    $('.view-all-text').hide();
                    $('.view-less-text').show();
                }
                return false;
            });
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     var showChar = 250; // Adjust the number of characters to show before "Read More."
        //     var ellipsestext = "...";
        //     var moretext = "Read more";
        //     var lesstext = "Read less";
            
        //     $('.more').each(function() {
        //         var content = $(this).html();
        //         if (content.length > showChar) {
        //             var c = content.substr(0, showChar);
        //             var h = content.substr(showChar);
        //             var html = c + '<span class="moreellipses">' + ellipsestext + '</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
        //             $(this).html(html);
        //         }
        //     });
        
        //     $(".morelink").click(function(e) {
        //         e.preventDefault();
        //         if ($(this).hasClass("less")) {
        //             $(this).removeClass("less");
        //             $(this).html(moretext);
        //         } else {
        //             $(this).addClass("less");
        //             $(this).html(lesstext);
        //         }
        //         $(this).prev().toggle();
        //         $(this).parent().prev().toggle();
        //     });
        // });
    </script>
    <script type="text/javascript">
    //   lightGallery(document.querySelector('.img_sec'),{
    //       download: false,
    //   });
      lightGallery(document.querySelector('.img_sec2'),{
          download: false,
      });

        $(".viewall").on("click", () => {
            $(".img_sec2 a:first-child > img").trigger("click");
        });
        
        
        $(".btnxyz").bind("click", (function () {
    
    	$(".viewall").trigger("click");
    			
    }));
      
    </script>
    <script type="text/javascript">
    </script>
    <script type="text/javascript">
      const tabs = document.querySelectorAll('.tab_btn');
      const all_content = document.querySelectorAll('.content'); 

      tabs.forEach((tab, index)=>{
          tab.addEventListener('click', (e)=>{
          tabs.forEach(tab=>{tab.classList.remove('active')});
          tab.classList.add('active');

          var line = document.querySelector('.line');
          line.style.width = e.target.offsetWidth + "px";
          line.style.left = e.target.offsetLeft + "px";

          all_content.forEach(content=>{content.classList.remove('active')});
          all_content[index].classList.add('active');

        })

      })
    </script>
    
    <script type="text/javascript">
        $(function(){
            $(document).on('click','#book_now',function(){
                $('#booknow-modal').modal();
                var amount=$(document).find('#data_amount').val();
                $('#submit_booking').attr('data-amount',amount);
            });
            $('#submit_booking').mousedown(function(){
                
                var fbname = $('#fbname').val();
                var lbname = $('#lbname').val();
                var bemail = $('#bemail').val();
                var bphone = $('#bphone').val();
                var bcomment = $('#bcomment').val();
            });
        });
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
    
    
    <script type="text/javascript">
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
        
                });
        
            });
         }); 
</script>

    <script type="text/javascript">
        $(function() {
            $('.review-showhide').click(function() {
                $(this).find('i').toggleClass('fa-plus fa-minus');
                $(this).parent().next('.review-form').slideToggle();
            });
            $('.readonly-cal td div').removeClass('valid').addClass('invalid');
            $('.btn-list').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                $('.grid-view').addClass('hide');
                $('.list-view').removeClass('hide');
            });
            $('.btn-grid').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                $('.list-view').addClass('hide');
                $('.grid-view').removeClass('hide');
            });
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
            });

        });

        function initMap() {
          @php $latlong=\App\Model\Googlemap::where('propertyid' , $properties->id)->first(); 
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
    
    <script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport':true,
      'alwaysShowNavOnTouchDevices':true
    });
</script>
<script type="text/javascript">
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
            $.ajax({
                url:url+'/property/cal-rate',
                data: {pro_id:pro_id, first_date :first_date, last_date:last_date, guest:guest,child: child, currency:currency, _token:token},
                method:"post",
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
        $(".hsgdes").prop('max', teVal);
       });
    });
    
 $('.hsgdes').change(function(e) {
        var txtVal = $(this).val();
       $(function(){  
        var vart= <?php echo $properties->sleepsno ?>;
        var teVal = vart - txtVal;
        $(".hsgde").prop('max', teVal);
        });
    });  
     
});
</script>
<script type="text/javascript">
$('.btn-number').click(function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
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
    }); 
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">
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
      </script>
     <script type="text/javascript">
    $(document).ready(function(){
      var token="{{csrf_token()}}";
      var url="{{url('')}}";  
       $('#stars li').on('mouseover', function(){
	    var onStar = parseInt($(this).data('value'), 10);
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
	 var ratingValue=null;
	  $('#stars li').on('click', function(){
	    var onStar = parseInt($(this).data('value'), 10);
	    var stars = $(this).parent().children('li.star');
	    for (i = 0; i < stars.length; i++) {
	      $(stars[i]).removeClass('selected');
	    }
	    for (i = 0; i < onStar; i++) {
	      $(stars[i]).addClass('selected');
	    }
	    ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
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
            $.ajax({
            url:url+'/property/review',
            data:{journey_date:date,title:title,description:rdes,location:location,name:name,email:email,pro_name:pro_name, pro_id:pro_id, rate:rate, _token:token},
            method:"POST",
             
            }).done(function( msg ) {
                alert( msg.message );
				$('#prop_review').trigger("reset"); 
				$('#prop_review select').trigger("change");
				$('#stars li').removeClass('selected');
            });
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

    
    </script>
    <script>
        $(document).on('change', '.country_name', function(){ 
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
            $('.Neighbourhood').html(data);
              }
             });
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
