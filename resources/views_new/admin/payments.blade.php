@extends('admin.layouts.admin')

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 505px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">
           <h1>Payment Details</h1>
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
                                        <th>Payment ID</th>
                                        <th>Property Name</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Date</th>
                                        <th>Booking ID</th>
                                    </tr>

                                </thead>

                                <tbody>
                                      @php $i=0 @endphp
                                     @foreach($paymentData as $data)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$data->razorpay_payment_id}}</td>
                                            @php
                                             $sub = \App\Model\Property::where('id',$data->propertyid)->first();
                                            @endphp
                                            <td>
                                                @if($sub && $sub->count())
                                                {{ $sub->propertyname }}
                                                @else Property Deleted
                                                @endif
                                            </td>
                                            <td>{{$data->totalAmount}} {{$data->currency}} </td>
                                            <td>{{date_format($data->created_at,"Y-m-d")}}</td>
                                            <td><a href="{{url('/')}}/admin/booking">{{$data->id}}</a></td>


                                        </tr>
                                    @endforeach
 

                                </tbody>

                                <tfoot>



                                </tfoot>

                            </table>
                           </div>
                        </div>

                       <div class="pull-right">
                        {{$paymentData->links()}}
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