@extends("admin.layouts.admin")
 

@section("content")
           <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>

            <div class="info-box-content">@php($propertycount = App\Model\Property::orderby('id','desc')->count())				
              <span class="info-box-text">Total Listed Properties</span>
              <span class="info-box-number"><a href="{{url('/')}}/admin/property">{{$propertycount}}</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <!-- /.col -->

        <!-- fix for small devices only -->
         
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">@php($bookingcount = App\Model\Payment::orderby('id','desc')->count())
              <span class="info-box-text">Total Property Bookings</span>
              <span class="info-box-number"><a href="{{url('/')}}/admin/booking">{{$bookingcount}}</a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->	  
      <div class="row">        
        <div class="col-md-6 col-sm-6 col-xs-12">          
            <div class="info-box">            
            <span class="info-box-icon bg-purple"><i class="fa fa-ticket"></i></span>            
            <div class="info-box-content">@php($properyenquirycount = App\Model\Enquiry::orderby('id','desc')->count())<span class="info-box-text">Total Property Enquiries</span>              <span class="info-box-number"><a href="{{url('/')}}/admin/customer/enquiries">{{$properyenquirycount}}</a></span>            </div>            <!-- /.info-box-content -->          </div>          <!-- /.info-box -->        </div>		 <div class="col-md-6 col-sm-6 col-xs-12">          <div class="info-box">            <span class="info-box-icon bg-teal"><i class="fa fa-star"></i></span>            <div class="info-box-content">				@php($generalenquirycount = App\Model\Contact::orderby('id','desc')->count())              <span class="info-box-text">Total General Enquiries</span>              <span class="info-box-number"><a href="{{url('/')}}/admin/customer/contact">{{$generalenquirycount}}</a></span>            </div>            <!-- /.info-box-content -->          </div>          <!-- /.info-box -->        </div>		</div>
    </section>
    <!-- /.content -->
    @endsection

