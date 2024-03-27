@extends('admin.layouts.admin')



@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 505px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">
           <h1>Booking Details</h1>
           <div class="pull-left">
             <div id="message"></div>
            </div> 

            @if(Session::get('message'))
            <h4 class="pull-left alert alert-success">{{Session::get('message')}}</h4>
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

        <span style="color:red;"> </span>

        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-xs-12">

                    <div class="box">

                        <!-- /.box-header -->

                        <div class="box-body">
                              <div class="table-responsive">
                            <table id="myDataTable" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>Sr. No.</th> 
                                        <th>Property Name</th> 
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Mobile No.</th>
                                        <th>Details</th>
                                        <th>Adults</th>
                                        <th>Child</th>
                                        <th>Payment ID</th>
                                        <th>CheckIn Date</th>
                                        <th>CheckOut Date</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>
                                      @php $i=0 @endphp
                                     @foreach($bookingData as $data)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            @php
                                             $sub = \App\Model\Property::where('id',$data->propertyid)->first();
                                            @endphp
                                            <td>
                                                @if($sub && $sub->count())
                                                {{ $sub->propertyname }}
                                                @else Property Deleted
                                                @endif
                                            </td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->mob}}</td>
                                            <td>{{$data->comment}}</td>
                                            <td>{{$data->guest}}</td>
                                            <td>{{$data->child}}</td>
                                            <td><a href="{{url('/')}}/admin/payments">{{$data->razorpay_payment_id}}</td>
                                            <td>{{$data->start_date}}</td>
                                            <td>{{$data->end_date}}</td>
                                            <td>{{date_format($data->updated_at,"Y-m-d")}}</td>
                                            <td>
                                              @if($data->status)
                                                Success
                                              @else
                                                Failed
                                              @endif
                                            </td>
                                            <td><button class="deletePayment" data-id="{{$data->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                </tfoot>

                            </table>
                           </div>
                        </div>

                       <div class="pull-right">
                        {{$bookingData->links()}}
                       </div> 
                    </div>
                    <!-- /.box -->

                </div>

                <!-- /.col -->

            </div>

            <!-- /.row -->

        </section>

        <!-- /.content -->

        

    </div>

    <!-- /.content-wrapper -->
  <script>

    $(document).ready(function(){

      var token="{{csrf_token()}}";

      var url="{{url('admin')}}";

      $('.deletePayment').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');
        var data={_token:token,id:id};
        var status=confirm('Are Want to Delete This Record!');
          if(!status){
            return false;
          }

        $.ajax({
          url:url+'/customer/delete-booking',
          data:data,
          method:'POST',
          success:function(data,status,xhr){
            console.log(data);
            if(data.status==1){
              $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');
            }
            location.reload();
          },

          failure:function(status){
            console.log(status);
          }

        });

      });

    });

  </script> 
 <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#myDataTable').DataTable({
          "paging":   false,
          "info":     false
        });
    });
  </script>

@endsection