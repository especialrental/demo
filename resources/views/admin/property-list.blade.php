@extends('admin.layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 505px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1 style="display:flex;justify-content:space-between;align-items:center;">
                <span>
                    @if ($type == 0)
                        Active Property Listing
                    @else
                        Inactive Property Listing
                    @endif

                </span>
                <a href="{{ url('admin/property/add') }}"><button type="button" class="btn btn-info btn-lg">Add
                        Property</button></a>
            </h1>

            <div class="pull-left">

                <div id="message"></div>

            </div>

            @if (Session::get('message'))
                <h4 class="pull-left alert alert-success">{{ Session::get('message') }}</h4>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger col-md-6">

                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

        </section>

        <hr>

        <div style="border: none;padding:0px 15px;margin:0px;">
            <div class=" form-group">
                <input type="text" class="form-control" id="search" name="property" placeholder="Search Property"
                    value="">
                <div id="display"></div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content" id="property">

            <div class="rows">

                <span style="color:red;"></span>



                <div class="profile-area-content">



                  <div class="account-block">



                    <div class="my-property-listing">

                        <div class="rows">

                            <spam style="color:red;"></spam>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">

                                <div class="rows grid-row">
                                  <div class="prop_page">
                                    @php if(isset($property) && !empty($property)){ @endphp
                                    @foreach($property as $properties)

                                        <div class="item-wrap" style="width: 100%;background: white;padding: 10px;border-radius: 4px;border-bottom:1px solid #ccc;margin-bottom:5px;">

                                            @php

                                             $sub = \App\Model\PropertyGallery::where('propertyid',$properties->id)->orderby('photoorder','ASC')->get();
                                                
                                            @endphp

                                            <!-- foreach($sub as $subData) -->

                                            <div class="media my-property">

                                                <div class="media-left" style="width: 20%;">

                                                    <div class="figure-block">

                                                        <figure class="item-thumb">
                                                           @php

                                                             $sub_type = \App\Model\PropertyType::where('id',$properties->propertytype)->first();
                                                             
                                                             $subb_type = isset($sub_type->categoryname) ? $sub_type->categoryname : '';
                                                            @endphp
                                                            <span class="label-featured label label-warning" style="position:absolute;">{{$subb_type}}</span>
                                                            
                                                               @php $username = isset($sub->first()->photoname) ? $sub->first()->photoname : ''; @endphp
                                                               
                                                              

                                                                <img src="{{url('public/uploads/property_image')}}/{{$properties->id}}/{{ $username }}" style="width:200px;height:150px;">

                                                        </figure>

                                                    </div>

                                                </div>

                                                <div class="media-body media-middle">

                                                    <div class="my-description">

                                                        <h4 class="my-heading"><a href="{{url('admin/property/edit')}}/{{$properties->id}}" target="_blank">{{$properties->propertyname}}</a></h4>

                                                        <p class="address">{{$properties->address}}</p>

                                                        <!-- <p class="status">Email : </p> -->

                                                        <p style="font-size: 16px;"><i class="fa fa-bed" title="Bedrooms" style="font-size: 16px;"></i> {{$properties->bedrooms}} <i class="fa fa-building" title="Bath" style="margin-left: 12px;margin-right: 10px;font-size: 16px;"></i>{{$properties->baths}} <i class="fa fa-users" title="Number of sleeps" style="margin-left: 12px;margin-right: 10px;font-size: 16px;"></i>{{$properties->sleepsno}}</p>

                                                    </div>

                                                    <div class="my-actions">

                                                        <div class="btn-group">

                                                            <a href="{{url('admin/property/edit')}}/{{$properties->id}}" class="btn btn-default btn-sm" style="color:#000" data-toggle="tooltip" data-placement="top" title="Edit" target="_blank">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <a href="javascript:void(0);" style="color:#F00" class="btn btn-default btn-sm deleteProperty" data-id="{{$properties->id}}" data-toggle="tooltip" data-placement="top" title="Remove">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                            @php $active=($properties->status==0)?'Active':'Deactive'; @endphp
                                                            @php $title=($properties->status==0)?'Active':'Deactive'; @endphp 
                                                            @php $circle=($properties->status==0)?'act fa fa-circle':'act fa fa-circle'; @endphp
                                                            <?php if ($properties->status==0) { ?>
                                                                <a href="javascript:void(0);" style="color:#1dc308" class="btn btn-default btn-sm activeProperty" 
                                                                data-id="{{$properties->id}}" data-status="Active" data-toggle="tooltip" data-placement="top" 
                                                                title="{{$title}}">
                                                                <i class="{{$circle}}"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="javascript:void(0);" style="color:#F00" class="btn btn-default btn-sm activeProperty" 
                                                                data-id="{{$properties->id}}" data-status="Deactive" data-toggle="tooltip" data-placement="top" 
                                                                title="{{$title}}">
                                                                <i class="{{$circle}}"></i>
                                                                </a>
                                                            <?php } ?>
                                                            
                                                            





                                                        </div>

                                                        <div class="btn-group" style="display: flex;margin:10px 0px">

                                                            <!-- <button class="btn btn-sm bg-olive margin inCalender" data-href="{{url('admin/property/edit')}}/{{$properties->id}}" style="margin-top: 1px;margin-left: 6px;">Update Calender</button> -->

                                                            <!-- <a href="#" onclick="inquiry(658);"><button class="btn bg-olive margin" style="margin-top: 1px;margin-left: 6px;">View Inquiries</button></a> -->

                                                            <button class="btn btn-sm btn-info margin inRates" data-href="{{url('admin/property/edit')}}/{{$properties->id}}" style="margin-top: 1px;border-radius:4px;">Update Rates</button>

                                                            <button class="btn btn-sm btn-info margin inGallery" data-href="{{url('admin/property/edit')}}/{{$properties->id}}" style="margin-top: 1px;margin-left: 6px;border-radius:4px;">Update Gallery</button>

                                                            <button class="btn btn-sm btn-info margin inCalender" data-href="{{url('admin/property/edit')}}/{{$properties->id}}" style="margin-top: 1px;margin-left: 6px;border-radius:4px;">Update Calendar</button>

                                                            <!-- <select name="payment-type" class="form-control" onchange="location = this.value;" style="width: 18%;">

                                                               <option style="display:none;">Payment Type</option>

                                                                <option value="{{ url('admin/booking')}}">Booking</option>

                                                                <option value="{{ url('admin/customer/enquiries')}}">Enquiry</option> -->

                                                                <!--<option value="{{ url('admin/customer/reviews')}}">Guest Reviews</option>-->
                                                             <!-- </select> -->

                                                        </div>

                                                        <!--  <p class="expire-text"><strong>Expiration:</strong> 365 Days  Remaining</p>-->
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- endforeach -->

                                        </div>

                                    @endforeach      
                                      {{$property->links()}}
                                    @php }else{ @endphp

                                    <h4 style="border: 15px solid white;background-color: #fff;width: 99%;">No Property Available</h4> @php } @endphp
                                   </div>

                                </div>

                                

                            </div>

                        </div>

                    </div>
	<div class="clearfix"></div>
                  </div>



                    <hr>

                </div>

            </div>

        </section>
        {{-- @include('admin.search_data') --}}

        <!-- /.box -->

    </div>

    <!-- /.content-wrapper -->

    <script type="text/javascript">
        $(document).ready(function() {

            var token = "{{ csrf_token() }}";

            var url = "{{ url('admin') }}";
            //$('.inRates').click(function(){
            $(document).on('click', '.inRates', function(event) {

                window.location.href = $(this).data('href') + '?index=4';
            });
            //$('.inGallery').click(function(){
            $(document).on('click', '.inGallery', function(event) {

                window.location.href = $(this).data('href') + '?index=6';
            });
            //$('.inCalender').click(function(){
            $(document).on('click', '.inCalender', function(event) {

                window.location.href = $(this).data('href') + '?index=7';
            });
            $(document).on('click', '.deleteProperty', function() {

                console.log($(this).attr('data-id'));

                var id = $(this).attr('data-id');
                var data = {
                    _token: token,
                    id: id
                };
                var status = confirm('Are Want to Delete This Record!');
                if (!status) {
                    return false;
                }

                $.ajax({

                    url: url + '/property/delete',

                    data: data,

                    method: 'POST',

                    success: function(data, status, xhr) {

                        if (data.status == 1) {

                            $('#message').html(
                                '<h4 class="alert alert-success text-center">Record Deleted !</h4>'
                            );

                            //$( "#message" ).find('.alert-success').focus();

                            setTimeout(function() {
                                window.location.href = url + '/property'
                            }, 3000);

                        }

                    },

                    failure: function(status) {
                        console.log(status);
                    }

                });

            });

            $(document).on('click', '.activeProperty', function() {

                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                var prop_Status = (status.trim() == 'Active') ? 1 : 0;
                var pop_Status = (status.trim() == 'Active') ? 'Deactive' : 'Active';

                var data = {
                    _token: token,
                    id: id,
                    prop_Status: prop_Status
                };

                var status = confirm('Are Want to ' + pop_Status + ' This Record!');

                if (!status) {

                    return false;

                }

                $.ajax({

                    url: url + '/property/active',

                    data: data,

                    method: 'POST',

                    success: function(data, status, xhr) {

                        if (data.status == 1) {

                            $('#message').html(
                                '<h4 class="alert alert-success text-center">Status Updated Successfully !</h4>'
                            );

                            setTimeout(function() {
                                window.location.href = url + '/property'
                            }, 2000);

                        }



                    },

                    failure: function(status) {

                        console.log(status);

                    }

                });

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var token = "{{ csrf_token() }}";
            var url = "{{ url('admin') }}";
            //fetch_data();

            function fetch_data(query = '', page = '') {

                $.ajax({
                    url: url + '/property/prop-search',
                    method: 'POST',
                    data: {
                        _token: token,
                        search: query,
                        page: page
                    },

                    success: function(data) {

                        $('#property').html('');
                        $('#property').html(data);
                    }
                })
            }
            var query = '';
            // $(document).on('click', '.pagination a', function(event) {
            // alert(65);
            //     event.preventDefault();
            //     var query = $('#search').val();
            //     var page = $(this).attr('href').split('page=')[1];
            //     $('#hidden_page').val(page);

            //     $('li').removeClass('active');
            //     $(this).parent().addClass('active');
            //     fetch_data(query, page);
            // });
            $(document).on('keydown', '#search', function(e) {

                if (e.keyCode == 13) {
                    var query = $(this).val();
                    var page = '';
                    fetch_data(query, page);


                }
            });
        });
    </script>
@endsection
