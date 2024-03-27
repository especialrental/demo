@extends('layouts.default')
@section('content')
     <section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                    </ol>
                </nav>
                <div class="col-md-12">
                @php
                 $testimonial = \App\Model\Testimonial::get();                 
                @endphp
                @php if(isset($testimonial) && !empty($testimonial)){ @endphp
                            @foreach($testimonial as $data)
                    <div class="media">
                        <div class="media-body testimonial-body">
                            <div class="row">
                                <div class="col-md-2 left-part-usr">
                                    @php if(isset($data->image) && !empty($data->image)){ @endphp
                                    <img class="align-self-start" src="{{url('public/uploads/testimonial')}}/{{$data->image}}" alt="img_author_default.jpg" width="110">
                                    @php }else{@endphp
                                    <img class="align-self-start" src="{{url('public/frontend/images')}}/img_author_default.jpg" alt="img_author_default.jpg">
                                    @php } @endphp
                                    <p style="margin-top:15px;"><label>{{$data->name}}</label></p>
                                </div>
                                <div class="col-md-10" style="padding: 0px 25px;">
                                    <a href="{{$data->url}}"><h4 style="margin-bottom:0px;">{{$data->title}}</h4></a>
                                    <div class="rating">
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                    <p>{{$data->description}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @php } @endphp 
                    <!-- <div class="media">
                        <div class="media-body testimonial-body">
                            <div class="row">
                                <div class="col-md-2 left-part-usr">
                                    <img class="align-self-start" src="{{url('/')}}/public/frontend/images/img_author_default.jpg" alt="img_author_default.jpg">
                                    <p style="margin-top:15px;"><label>SMITH RUSSELL</label></p>
                                </div>
                                <div class="col-md-10" style="padding: 0px 25px;">
                                    <h4 style="margin-bottom:0px;">A STONE THROW AWAY FROM LOUVRE-GORGEOUS2BR-2BA</h4>
                                    <div class="rating">
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star color-theme" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                    <p>
                                        Check-in went smoothly. We were welcomed by the apartment manager, who took the time to show us how everything worked in the apartment. She was available to us at any time during our stay, just a phone call away. We loved the croissants, wine and beautiful
                                        fresh flowers as a welcome gift. The place is a good size, nicely decorated with comfortable sofas. Having a washer/dryer was much appreciated, as well as the large laundry room area. The location is great, close
                                        to grocery stores, cafes and the metro. Many restaurants just steps away.</p>

                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
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
@endsection