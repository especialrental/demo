@extends("admin.layouts.layout")

@section("title","Admin Dashboard | Market Place")

@section("header-page-script")
    <!-- others css -->
    <link rel="stylesheet" href="{!! asset('assets/css/typography.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/default-css.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/responsive.css') !!}">
    <!-- modernizr css -->
    <script src="{!! asset('assets/js/vendor/modernizr-2.8.3.min.js') !!}"></script>
@endsection

@section("content")            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ route('dashboard') }}">Home</a></li>
                                <li><span>Clients</span></li>
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
                                <h4 class="header-title"><span>Add New</span> Client</h4>
                                <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveclient')}}" enctype = "multipart/form-data" >
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
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid first name.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid last name.
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid phone number.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid email address.
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="dob">Date Of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required="">
                                            <div class="invalid-feedback">
                                                Please choose date of birth.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender"  required="">
                                                <option value="">Select gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please choose gender.
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="address_line_1">Address Line 1</label>
                                            <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Enter Address Line 1" value="{{ old('address_line_1') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a address.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="address_line_1">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="Enter Address Line 2" value="{{ old('address_line_2') }}">
                                        </div>                                       
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="{{ old('city') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid city.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" value="{{ old('state') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" value="{{ old('country') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid country.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="pincode">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" value="{{ old('pincode') }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid pincode.
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="upload_image">Image</label>
                                            <input type="file" class="form-control" id="upload_image" name="upload_image"  required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid image.
                                            </div>
                                        </div>                                 
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid password.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid confirm password.
                                            </div>
                                        </div>                                
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
    <script src="{!! asset('assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('assets/js/scripts.js') !!}"></script>

@endsection