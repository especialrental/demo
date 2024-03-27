<!-- ====== PAGE CONTENT ====== -->

            <div class="page-section" id="property">


 
                <div class="container">

 

                    <div class="panel filter-panel">
                        <div class="sortby" style="margin-left:50%;" style="display:none">
                            <label style="color:#ff7226;">Sort by:</label>
                            <select class="form-control" id="pricefilter" name="pricefilter" required="" style="display:inline-block; width:55%;">
                            <option>Select Price</option>
                            <option <?php print (isset($_GET['price']) && $_GET['price']=='lowtohigh')?'selected':''; ?> value="lowtohigh">Price-Low to High</option> 
                            <option <?php print (isset($_GET['price']) &&  $_GET['price']=='hightolow')?'selected':''; ?>  value="hightolow">Price-High to Low </option>
                        </select>
                        </div>

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



                </div>

            </div>
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
            });
            $('#pricefilter').on('change', function(){

              	window.location.href = addOrReplace('price', $(this).val());
         });

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
    
function addOrReplace(key, value) {
		var oldUrl =  window.location.href;
		var  data_val = value ;
		var r =  /^(.+price=).+?(&|$)(.*)$/i ;
		var  newUrl = "";

		var matches =  oldUrl.match(r) ;
		if(matches===null){
		newUrl = oldUrl +  ((oldUrl.indexOf("?")>-1)?"&":"?")  + "price=" + data_val ;
		}else{
		newUrl =  matches[1]+data_val+matches[2]+matches[3]  ;
		}
		return (newUrl);
	}
   
    </script>           
