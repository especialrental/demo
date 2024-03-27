@extends("admin.layouts.layout")

@section("title","Admin Dashboard | Market Place")

@section("header-page-script")
    <!-- others css -->
    <link rel="stylesheet" href="{!! asset('public/assets/css/typography.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/default-css.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/responsive.css') !!}">
    <!-- modernizr css -->
    <script src="{!! asset('public/assets/js/vendor/modernizr-2.8.3.min.js') !!}"></script>
@endsection

@section("content")            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ route('dashboard') }}">Home</a></li>
                                <li><span>Aminities</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">

                    <!-- Server side start -->
                    <div class="col-12">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h4 class="header-title"><span>Update</span> Aminities</h4>
                                <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveCountry')}}" enctype = "multipart/form-data">
                                    <input type="hidden" name="countryid" value="{{ $amenity->id }}">
                                    <div class="form-row">
                                        @if(session("msg"))
                                        <div class="alert-dismiss">
                                            <div class="alert alert-success alert-dismissible fade show">
                                                <span>{{session("msg")}}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span class="fa fa-times"></span> </button><br/>
                                            </div>
                                        </div>
                                        @endif
                                        @if(count($errors)>0)
                                        <div class="alert-dismiss">
                                            <div class="alert alert-danger alert-dismissible fade show">
                                                @foreach($errors->all()  as $error)
                                                    <span>{{$error}}</span><br/>
                                                @endforeach
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span class="fa fa-times"></span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                        <input type="hidden" name="hiddenval" class="hiddenval" value="0">
                                        {!!csrf_field()!!}
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="first_name">Country Name</label>
                                            <input type="text" class="form-control" id="country_name" name="country_name" placeholder="Enter country Name" value="{{ $amenity->country_name }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid country name.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="callingcode">Calling Code</label>
                                            <input type="text" class="form-control" id="callingcode" name="callingcode" placeholder="Enter callingcode" value="{{ $amenity->callingcode }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Calling Code.
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Server side end -->
                </div>
            </div>

@endsection


@section("footer-page-script")


    <!-- others plugins -->
    <script src="{!! asset('public/assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('public/assets/js/scripts.js') !!}"></script>

@endsection