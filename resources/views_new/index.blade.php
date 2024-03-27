
@extends('layouts.default')

@section('title', $meta_tag)
 
@section('meta_description', $meta_description)

 
@section('content')
<style type="text/css">
	ul.dropdown-menu{
		display: block !important;
	    max-width: 300px !important;
	    position: absolute !important;
	    left: 15px !important;
	    width: 100% !important;
	}
	.theme-background-color {
    background: #333!important; 
    }
    .sr_flex{
        display:flex;
        
    }
    
    /* @media screen and (max-width: 991px){*/
    /*    .fslider{*/
    /*        width:367px!important;*/
    /*    }*/
    /*}*/
    /*@media screen and (max-width: 600px){*/
    /*    .fslider{*/
    /*        width:367px!important;*/
    /*    }*/
    /*}*/
</style>
<!-- ====== PAGE BUILDER TEMPLATE ====== -->

<section id="page-builder" class="page-section" style="position:relative">
	<div class="vdo-container">
		<video loop muted preload="auto" id="bannerVid" playsinline>
			<source src="{{url('/')}}/public/frontend/images/vdo1/backVideo.mp4" type='video/mp4'>
			
		</video>
		
	<!--<iframe src="{{url('/')}}/public/frontend/images/vdo1/backVideo.mp4" style="object-fit: fill;position: absolute;width: 100%;left: 0;right: 0;" scroll="true"></iframe>-->
	<!-- HERO IMAGE WITH SEARCH FORM --> 

	<div class="row tpb-row" style="padding-top: 65px;padding-bottom: 0px;margin: 0;background-size: cover;background-position: center center;">
		<div class="layer"></div>
		<div class="tpb tpb-property_simple_search col-md-12">
			<div class="property-simple-search"  style="padding: 22% 0px 10px 0px;">
				<div class="content-wrapper">
					 <h1 class="title">Plan Your Trip</h1>
					<p class="description" style="margin-bottom:10px;">Explore our collection of properties amongst the worlds best selections and begin booking your dream vacation.</p>
					<div class="property-search-form">
					
					    <form class="needs-validation form-inline" novalidate="" id="my-form advsearch" method="get" action="{{url('property')}}" enctype = "multipart/form-data" >

					        <div class="form-group">
					            <input type="text" class="form-control" id="country_name" name="country_name" placeholder="Where will your next journey be..." value="{{old('country_name')}}" autocomplete="off" required="required">
                                <div id="countryList"></div>
                                <!-- <input type="hidden" name="countryId" id="countryId" value="">
                            <input type="hidden" name="countryname" id="countryName" value=""> -->
					        </div>
					        
					        <div class="form-group form-group--date">
					            <input id="nb-start-date" name="search_startdate" class="form-control" placeholder="Check-in Date" autocomplete="off">
					        </div>
					        <div class="form-group form-group--date">
					            <input id="nb-end-date" name="search_enddate" class="form-control" placeholder="Check-out Date" autocomplete="off">
					        </div>
					        <div class="form-group submit-column">
					            <button type="submit" class="btn btn-primary btn-submit validate_front"><i class="fa fa-search"></i>Search</button>
					        </div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
<!-- ====== ADVANTAGES ====== -->
	<section id="advantages" class="page-section">
		<div class="container">

			<!-- Section Title -->
			<div class="section-header">
				<h2 class="section-title">Services We Provide</h2>
			</div>
			<!-- Section Content -->
			<div class="row">
			    <div class="sr_flex">
			    <div class="serve">
					<!-- Panel Icon Box / This is general class can be use everywhere -->
					<div class="panel icon-box min-height-2271">
						<i class="fa fa-home icon-item"></i>
						<h4 class="icon-title">Vacation Rental Management</h4>
						<p class="icon-description serv">No Management Fee, No Minimum Term, No Contract, No Surprise</p>
					</div>
				</div>
				
				<div class="serve">
					<!-- Panel Icon Box / This is general class can be use everywhere -->
					<div class="panel icon-box min-height-2271">
						<i class="fa fa-map-marker icon-item"></i>
						<h4 class="icon-title">Destination Experts</h4>
						<p class="icon-description serv">Find a local advisor to assist you</p>
					</div>
				</div>
				<div class="serve">
					<!-- Panel Icon Box / This is general class can be use everywhere -->
					<div class="panel icon-box min-height-2271">
						<i class="fa fa-money icon-item"></i>
						<h4 class="icon-title">Value For Your Money </h4>
						<p class="icon-description serv">Offering distinctive local experiences and comforts of home for all budgets</p>
					</div>
				</div>
				<div class="serve">
					<!-- Panel Icon Box / This is general class can be use everywhere -->
					<div class="panel icon-box min-height-2271">
						<i class="fa fa-shield icon-item"></i>
						<h4 class="icon-title">Secure Payment</h4>
						<p class="icon-description serv">Providing a secure payment gateway to ensure your payments are protected</p>
					</div>
				</div>
				<div class="serve">
					<!-- Panel Icon Box / This is general class can be use everywhere -->
					<div class="panel icon-box min-height-2271">
						<i class="fa fa-credit-card icon-item"></i>
						<h4 class="icon-title">Flexible Payment Options</h4>
						<p class="icon-description serv">Payment Plans & easy refunds, which provide a hassle free booking experience</p>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ====== SELECT WHERE TO START YOUR JOURNEY ====== -->
	<section id="explore" class="page-section" style="background-color: #FFF">
		<div class="container">
			
			<!-- Section Title -->
			<div class="section-header header-center hide">
				<h2 class="section-title">Select Where to Start Your Journey</h2>
			</div>

			<!-- Section Content -->
			<!--<div class="row">
				<div class="col-md-8">
					<div class="explore-item">
						<a href="#" style="background-image: url({{url('/')}}/public/frontend/images/London.jpg);"></a>
						<h3 class="item-title"><a href="#">London <i class="fi flaticon-more"></i></a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="explore-item">
						<a href="#" style="background-image: url({{url('/')}}/public/frontend/images/NewYork.jpg);"></a>
						<h3 class="item-title"><a href="#">Newyork <i class="fi flaticon-more"></i></a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="explore-item">
						<a href="#" style="background-image: url({{url('/')}}/public/frontend/images/Rome.jpg);"></a>
						<h3 class="item-title"><a href="#">Rome <i class="fi flaticon-more"></i></a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="explore-item">
						<a href="#" style="background-image: url({{url('/')}}/public/frontend/images/Dublin.png);"></a>
						<h3 class="item-title"><a href="#">Dublin <i class="fi flaticon-more"></i></a></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="explore-item">
						<a href="#" style="background-image: url({{url('/')}}/public/frontend/images/paris.png);"></a>
						<h3 class="item-title"><a href="#">Paris <i class="fi flaticon-more"></i></a></h3>
					</div>
				</div>
			</div>-->
			<div class="section-header header-center">
				<h2 class="section-title">Select Where to Start Your Journey</h2>
			</div>
			<section class="center">
			@php
                 $journey = \App\Model\Journey::get();                 
            @endphp
            @php if(isset($journey) && !empty($journey)){ @endphp
                        @foreach($journey as $data)
			<div class="col-md-12">
				   @php $cityData= \App\Model\City::where('id',$data->city)->first(); @endphp
					<div class="explore-item">
						<a href="{{url($cityData->url)}}" style="background-image: url({{url('public/uploads/journey')}}/{{$data->image}});"></a>
						<h3 class="item-title"><a href="{{url($cityData->url)}}">{{$cityData->city_name}} <i class="fi flaticon-more"></i></a></h3>
					</div>
		    </div>
		    @endforeach
            @php } @endphp	
			</section>
		</div>
	</section>
	<!-- ====== Our Rooms ====== -->
	<section id="featured-room" class="page-section" style="padding-bottom: 48px;">
		<div class="container">
			<!-- Section Header / Title with Column Slider Control / Add 'header-column' to use this style -->
			<div class="section-header header-column">
				<h2 class="section-title">Featured Properties</h2>
			</div>
			<div class="property-list archive-flex">
				<div class="row center2">
				@php
                 $feature = \App\Model\Property::where('feature_properties',1)->get();                 
                @endphp
                @php if(isset($feature) && !empty($feature)){ @endphp
                            @foreach($feature as $data)
				<div class="col-lg-12" style="width: 367px;">
						<!-- Property Item -->
						@php
                         $sub = \App\Model\PropertyGallery::where('propertyid',$data->id)->orderby('photoorder','ASC')->get();
                        @endphp
                        @php
                         $type = \App\Model\PropertyType::where('id',$data->propertytype)->first();
                        @endphp
                        @php

						
                         $type1 = \App\Model\Area::where('id',$data->town)->first();
						 $city = \App\Model\City::where('id',$data->city)->first();
						 $type1->area_name;
						 
						 $roomType = $data->room_type;
                         $room = Str::slug($roomType, '-');
						 $str = strtolower($type1->area_name);
						$area =  Str::slug($str, '-');
   
						 $pro = $data->url;
						  $proUrl = Str::slug($pro, '-');
						 $cityUrl = Str::slug($city->city_name, '-');
                        @endphp
						<div class="property-item">
							<div class="property-heading">
								<span class="item-price"><span class="props">BR- {{$data->bedrooms}}</span> <span class="props">BA- {{$data->baths}}</span><span class="props">SLEEPS- {{$data->sleepsno}}</span></span>
								<a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" class="item-detail btn" target="_blank" style="text-transform:capitalize!important;">Details <i class="fi flaticon-detail"></i></a>
							</div>
							<div class="img-box">
								<div class="property-label">
								    @if($type)
									<a href="javascript:;" class="property-label__type">{{$type->categoryname}}</a>
									@endif
									<a href="javascript:;" class="property-label__status">Available</a>
								</div>
								<!--<a href="#" class="btn-compare" title="Compare Property"><i class="fa fa-exchange"></i></a>-->
                                @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp

								<a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" target="_blank" class="img-box__image"><img src="{{url('public/uploads/property_image')}}/{{$data->id}}/{{ $username }}" alt="Property" class="img-responsive"></a>
							</div>
							<div class="property-content">
								<a href="{{url('/')}}/{{$cityUrl}}/{{$room}}/{{$area}}/{{$pro}}" target="_blank" class="property-title">{{$data->propertyname}}</a>
								<div class="property-address">
									{{$data->address}}
									<div class="rating pull-right" style="display:flex;align-items: center">
                                        <div id="rateYo{{$data->id}}" style="margin-right:4px;"></div>
                                        <script type="text/javascript">
                                            $("#rateYo{{$data->id}}").rateYo({
                                                rating: {{$data->avg_rating}},
                                                starWidth: "15px",
                                                ratedFill: "#ff7200",
												
                                              });
											 $("#rateYo{{$data->id}}").rateYo('option', 'readOnly', true);
                                        </script>
                                        <span style="font-size:12px;">({{$data->rating_counts}}) Reviews</span>
                                    </div>
									<!--<a href="#" class="property-label__location"></a>-->		
								</div>
							</div>
						</div>
					</div>
				@endforeach
                @php } @endphp	
					
				</div>
			</div>
		</div>
	</section>

	<!-- ====== TESTIMONIAL SECTION ====== -->
	<section id="testimony" class="page-section bg-image" style="    padding-top:15px!important;background: white;/*background-image: url({{url('/')}}/public/frontend/images/main_default.jpg);*/">
		<div class="container">

			<!-- Section Header / Title with Column Slider Control / Add 'header-column' to use this style -->
			<div class="section-header header-column" style="background:#fbfbfb">
				<h2 class="section-title">What they say about us</h2>
				<!-- Slider Control -->
				<div class="slide-control">
					<button id="content-left" class="slide-left content-left"><i class="fa fa-angle-left"></i></button>
					<button id="content-right" class="slide-right content-right"><i class="fa fa-angle-right"></i></button>
				</div>
			</div>
			<!-- Testimony Slider Content -->
			<div id="content-slider" class="content-slider testimony-wrapper">
			 @php($testimonials=App\Model\Testimonial::orderBy('id', 'desc')->get())
			
				<!-- Testimony Slider Item -->
				@php($i=0)
				
				@foreach($testimonials as $testimonial)
				<div class="slider-item" >		 
					<!-- Testimony Left -->
					@if($i%2==0)
					<div class="testimony-item  item-right" style="margin-top: 10px; ">
						<a href="{{$testimonial->url}}">
							<div class="row">
								<div class="col-md-9">
									<div class="testimony-text">
										<p>{{$testimonial->description}}</p> 
									</div>
								</div>
								<div class="col-md-3">
									<div class="testimony-profile text-center">
										@if($testimonial->image)
										<img src="{{url('/')}}/public/uploads/testimonial/{{$testimonial->image}}" alt="{{$testimonial->image}}">
										@else
										<img src="{{url('public/frontend/images')}}/img_author_default.jpg" alt="{{$testimonial->image}}">
										@endif
										<h5 style="color:#333">{{$testimonial->name}}</h5>
										<span>{{$testimonial->title}}</span>
									</div>
								</div>
							</div>
						</a>
					</div>
					@else
					<div class="testimony-item  item-left" style="margin-top: 10px; ">
						<a href="{{$testimonial->url}}">
							<div class="row">
								<div class="col-md-3">
									<div class="testimony-profile text-center">
										@if($testimonial->image)
										<img src="{{url('/')}}/public/uploads/testimonial/{{$testimonial->image}}" alt="{{$testimonial->image}}">
										@else
										<img src="{{url('public/frontend/images')}}/img_author_default.jpg" alt="{{$testimonial->image}}">
										@endif
										<h5 style="color:#333">{{$testimonial->name}}</h5>
										<span>{{$testimonial->title}}</span>
									</div>
								</div>
								<div class="col-md-9">
									<div class="testimony-text">
										<p>{{$testimonial->description}}</p> 
									</div>
								</div>
							</div>
						</a>
					</div>
					@endif
				</div>
				@php($i++)
				@endforeach 
			</div>
		</div>
	</section>

	

	<!-- ====== PARTNER SECTION ====== -->
	<section id="partner" class="page-section no-pattern" style="background-image: url({{url('/')}}/public/frontend/images/bg_partner_default.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-xs-2 col-sm-2  px-2">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/trip.png" alt="Partner"></a>
					</div>
				</div>
				<div class="col-md-2 col-xs-2 col-sm-2  px-2 ">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/booking.png" alt="Partner"></a>
					</div>
				</div>
				<div class="col-md-2 col-xs-2 col-sm-2  px-2">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/airbnb.png" alt="Partner"></a>
					</div>
				</div>
				<div class="col-md-2 col-xs-2 col-sm-2  px-2">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/homeaway.png" alt="Partner"></a>
					</div>
				</div>
				<div class="col-md-2 col-xs-2 col-sm-2  px-2">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/vrbo.png" alt="Partner"></a>
					</div>
				</div>
				<div class="col-md-2 col-xs-2 col-sm-2  px-2">
					<!-- Partner Item -->
					<div class="partner-item">
						<a href="#"><img src="{{url('/')}}/public/frontend/images/9flat.png" alt="Partner"></a>
					</div>
				</div>
			</div>  
		</div>
	</section>
</section>

<style>
    .overlay{
		position: fixed;
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.7);
  z-index: 999;
	}
     .popup{
     	position: fixed;
     	top: 50%;
     	left: 50%;
     	transform: translate(-50%,-50%);
     	display: none;
     	transition: 0.5s ease-in-out;
      }
      .contentbox{
      	position: relative;
      	width: 600px;
      	height: 400px;
      	background: #fff;
      	border-radius: 20px;
      	display: flex;
      	box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      .contentbox .imgbx{
      	position: relative;
      	width: 300px;
      	height: 400px;
      	display: flex;
      	justify-content: center;
      	/*align-items: center;*/
      }
      /*.contentbox .imgbx::before{
      	content: '';
      	position: absolute;
      	width: 250px;
      	height: 250px;
      	background: #f4efe1;
      	border-radius: 50%;
      }*/
      .contentbox .imgbx img{
      	position: relative;
      	width: 100%;
      	border-top-left-radius: 20px;
      	border-bottom-left-radius: 20px;
      	/*z-index: 1;*/
      }
      .contentbox .content{
      	position: relative;
      	width: 300px;
      	height: 400px;
      	display: flex;
      	justify-content: center;
      	align-items: center;
      }
      .contentbox .content .info{
      	padding: 0px 30px 0px 30px;
      }
      .contentbox .content .info h1{
      	color: #f3772d; 
		  font-size: 34px;
      }
      .contentbox .content .info p{
      	text-align: center;
      }
      .contentbox .content .info p span{
      	color: #f3772d;
      	font-size: 22px;
      	font-weight: 700;
      }
      .close{
      	position: absolute;
      	top: 0px;
      	right: 20px;
      	font-size: 25px;
      	cursor: pointer;
      }
      .close i{
      	color: #f3772d;
      }
      @media (max-width: 767px){
      	.contentbox{
      	 width: 300px;
      	 height: auto;
      	 flex-direction: column;
      	}
      	.contentbox .imgbx{
      	  height: 200px;
      	  transform: translateY(-50px);
      	}
      	.contentbox .imgbx img {
		   position: relative;
		   width: 100%;
		   border-top-right-radius: 20px;
		   border-bottom-right-radius: 20px;
		}
      	.contentbox .content{
      	   height: auto;
      	   text-align: center;
      	   padding: 20px;
      	   width: auto;
      	}
      	.contentbox .content .info{
      	   padding: 0px;
      	}
      	.contentbox .content .info p{
      	   text-align: center;
      	}
      	.close {
           top: -30px;
        }
      	.close i {
		   color: #ffffff;
		}
      }
    </style>
    
    @php($popup=App\Model\Popup::where('popup_disable',1)->orderBy('id', 'desc')->get())
			
			<!-- Testimony Slider Item -->
			@php($i=0)
			
			@foreach($popup as $pop)
			<?php if($pop->popup_disable=='1') { ?>
			
	<section class="overlay">
	
<div class="popup">
  	 <div class="contentbox">
  	  <div class="imgbx">
  	      <?php $image = ($pop->image !== '')? '<img src="'. url('public/uploads/blog').'/'.$pop->image.'" width="76"/> ' :'';?>
  	   <!--<img src="https://www.especialrentals.com/public/uploads/journey/1906796581.jpg">-->
  	   {!! $image !!}
  	  </div>
  	  <div class="content">
  	  	<div class="info">
  	  	 <h1>{{$pop->heading}} </h1>
  	  	 <p>{{$pop->offer}}</p>
  	  	</div>
  	  </div>
  	  <div class="close">
		<i class="fa fa-times"></i>
  	  </div>
  	 </div>	
  	</div>
  	
  	
	</section>
<script>
   	const popup = document.querySelector('.popup');
	const overlay = document.querySelector('.overlay');
   	const close = document.querySelector('.close');
   	    window.onload = function(){
   		setTimeout(function(){
   			popup.style.display = "block"
   		},1000)
   	}
   	close.addEventListener('click', () => {
   		popup.style.display = "none";
		overlay.style.display ="none";
   	})
   </script>
<?php } else { ?>
  	
  	
  	
  	<section class="overlay">
	
<div class="popup">
  	 <div class="contentbox">
  	  <div class="imgbx">
  	      <?php $image = ($pop->image !== '')? '<img src="'. url('public/uploads/blog').'/'.$pop->image.'" width="76"/> ' :'';?>
  	   <!--<img src="https://www.especialrentals.com/public/uploads/journey/1906796581.jpg">-->
  	   {!! $image !!}
  	  </div>
  	  <div class="content">
  	  	<div class="info">
  	  	 <h1>{{$pop->heading}} </h1>
  	  	 <p>{{$pop->offer}}</p>
  	  	</div>
  	  </div>
  	  <div class="close">
		<i class="fa fa-times"></i>
  	  </div>
  	 </div>	
  	</div>
  	
  	
	</section>
<script>
   	const popup = document.querySelector('.popup');
	const overlay = document.querySelector('.overlay');
   	const close = document.querySelector('.close');
   	    window.onload = function(){
   		setTimeout(function(){
   			popup.style.display = "block"
   		},1000)
   	}
   	close.addEventListener('click', () => {
   		popup.style.display = "none";
		overlay.style.display ="none";
   	})
   </script>
   
   
  	<?php } ?>
  	
  	
  @php($i++)
	@endforeach 
<script>
        $(function() {

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
            
            var iconBase = 'http://demo.tonjoostudio.com/kensington-property/assets/images/';
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
                        
                    </div>
                    `
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker,propimgurl,proptitle);
                });
            }

            function initialize(){
                var input = document.getElementById('country_name');
                new google.maps.places.Autocomplete(input);
            }
           google.maps.event.addDomListener(window, 'load', initialize);
           
        } 
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLtF6MPFfrge7gJ0sTP8Vjv8cOA1Acy3k&callback=initMap&libraries=places"></script>
    <script>
    $(document).ready(function(){
        
      var token="{{csrf_token()}}";
      var url="{{url('')}}";  

    /* $('#country_name').keyup(function(){ 
        
            var query = $(this).val();
            if(query != '')
            {
             $.ajax({
              url:url+'/property/propty-search',
              data:{query:query, _token:token},
              method:"POST",
              success:function(data){
                
               $('#countryList').fadeIn();  
                        $('#countryList').html(data);
              }
             }); 
            }
        });*/

        
 
        $(document).on('click', 'li.asearch', function(){ 
            
           var token="{{csrf_token()}}";
           var url="{{url('')}}"; 
           var id=$('a.autosearch').data('id'); 
           var country=$(this).text();
           var cityname = country.split(",").pop(-1);
            $('#countryName').val(country); 
            $('#countryId').val(id);
            $('#country_name').val($(this).text());  
            $('#countryList').fadeOut();  
            if(cityname != '')
            {
             $.ajax({
              url:url+'/property/propty-neighbour',
              data:{cityname:cityname, _token:token},
              method:"POST",
              success:function(data){
                  
                        $('#Neighbourhood').html(data);
              }
             });
            }

        });  

        // $(document).on('onload','.search_submit',function(){
        //     
        
           
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
            var token="{{csrf_token()}}";
           var url="{{url('')}}"; 
        var country = $('#countryName').val();
           var cityname = country.split(",").pop(-1);
           if(cityname != '')
            {
             $.ajax({
              url:url+'/property/propty-neighbour',
              data:{cityname:cityname, _token:token},
              method:"POST",
              success:function(data){
                  
                        $('#Neighbourhood').html(data);
              }
             });
            }
    }
    </script>
    <script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/56b8841a87faab5426a383e7/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<script type="text/javascript">

		$('.validate_front').on('click', function(e){
			
		e.preventDefault();
		  if($('#country_name').val()==''){
				return false;
		  }
		  $('form').submit();   
	    });
	    
	    $(document).ready(function() {
          var video = document.getElementById("bannerVid");
            video.autoplay = true;
            video.load();
        });
	</script>
    
@endsection
