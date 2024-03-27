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
                                <li><span>Users</span></li>
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
                                <h4 class="header-title"><span>Update</span> User</h4>
                                <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveclient')}}" enctype = "multipart/form-data">
                                    <input type="hidden" name="userid" value="{{ $client->id }}">
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
                                            <label for="first_name">Heading</label>
                                            <input type="text" class="form-control" id="heading" name="heading" value="{{ $client->heading }}" required="">
                                            
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name">Offer</label>
                                            <input type="text" class="form-control" id="offer" name="offer" value="{{ $client->offer }}" required="">
                                          
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone">Upload Image</label>
                                            <input type="file" class="form-control" id="upload_image" name="upload_image" required="">
                                            <?php $image = ($client->image !== '')? '<img src="'. url('public/uploads/blog').'/'.$client->image.'" width="20"/>' :'';?>
                                            
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Popup Disable</label>
                                            <input type="text" class="form-control" id="popup_disable" name="popup_disable" value="{{ $client->popup_disable }}" required="">
                                            
                                        </div>                                        
                                    </div>
                                
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="upload_image">Image</label>
                                              <!-- @if($client->image)
                                              <img src="{{ url('uploads/' . $client->image) }}" />
                                                @else
                                                        <p>No image found</p>
                                             @endif -->
                                            <input type="file" class="form-control" id="upload_image" name="upload_image" value="{{ $client->image }}" required="">
                                            
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
    <script src="{!! asset('assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('assets/js/scripts.js') !!}"></script>

@endsection