@extends("admin.layouts.layout")

@section("content")
@section("header-page-script")
    
@endsection            
   <!-- page title area start -->
       <div class="content-wrapper" style="min-height: 505px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Country
            
          </h1>     
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
                  <!-- right column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              
              <!-- general form elements disabled -->
              <div class="box box-warning"> 
              <span style="color:red;"></span>           
                <div class="box-body">
                  <h4 class="header-title"><span>Update</span> User</h4>
                                <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveCountry')}}" enctype = "multipart/form-data">
                                    <input type="hidden" name="countryid" value="{{ $country->id }}">
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
                                            <input type="text" class="form-control" id="country_name" name="country_name" placeholder="Enter country Name" value="{{ $country->country_name }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid country name.
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="callingcode">Calling Code</label>
                                            <input type="text" class="form-control" id="callingcode" name="callingcode" placeholder="Enter callingcode" value="{{ $country->callingcode }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Calling Code.
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="country_code">Country Code</label>
                                            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Enter Country Code" value="{{ $country->country_code }}" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Country Code.
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="country_flag">Country Flag</label>
                                            <input type="file" class="form-control" id="country_flag" name="country_flag" value="{{ $country->country_flag }}"  required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Country Flag.
                                            </div>
                                        </div>                                 
                                    
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
       </div>
   <!-- /.content-wrapper -->

@endsection


@section("footer-page-script")


    <!-- others plugins -->
    <script src="{!! asset('public/assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('public/assets/js/scripts.js') !!}"></script>

@endsection