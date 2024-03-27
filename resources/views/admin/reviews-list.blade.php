@extends('admin.layouts.admin')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 505px;">
        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>Property Reviews List</h1>
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
                            <table id="myDataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th>Sr. No.</th>
                                        <th>Property Name</th>
                                        <th>Customer Name</th>
                                        <th>Email ID</th>
                                        <th>Journey Date</th>
                                        <th>Title</th>
                                        <th>Review Details</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php $i=1; if(isset($reviewData) && !empty($reviewData)){ @endphp
                                     @foreach($reviewData as $data)
                                        @php $rowClass = ($data->status == 0) ? 'success' : '' @endphp
                                        <tr class="{{$rowClass}}">
                                          <td>{{$i}}</td>
                                            <td>{{$data->pro_name}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->journey_date}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->description}}</td>
                                            <td>{{$data->rating_number}}</td>
                                            <td>
                                              @if($data->status==1)
                                                <label class="text-success">Approved</label>
                                              @elseif($data->status==2)
                                                <label class="text-danger">Not Approved</label>
                                              @else
                                                <label class="text-default">Pending</label>
                                              @endif
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#reviewModal" class ="remodel" data-id="{{$data->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                <br/><button class="deleteReview" data-id="{{$data->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </td>

                                        </tr>
                                        @php $i++; @endphp
                                     @endforeach
                                     @php } @endphp

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>

                    </div>

                    <!-- /.box -->
                </div>



                <!-- /.col -->



            </div>



            <!-- /.row -->



        </section>
        
        <div class="modal fade" id="reviewModal" role="dialog">

        <div class="modal-dialog">

        

          <!-- Modal content-->

          <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <h4 class="modal-title">Update Review For Frontpage</h4>

            </div>

               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/customer/updatestatus')}}" enctype = "multipart/form-data">

                @csrf

            <div class="modal-body" style="overflow: hidden;">

                    <div class="col-lg-12" id="editreview">
                        <input type="hidden" id="rid" name="rid" value="">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status" required="">
                          <option value="">-- Select --</option>
                          <option value="1" >Approved</option> 
                          <option value="0" >Not Approved</option> 
                        </select>
                      </div>

                    </div>                               
            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button> 

            </div>

                            

                </form>

          </div>

          

        </div>

    </div>

    </div>



    <!-- /.content-wrapper -->
 <script>

    $(document).ready(function(){

      var token="{{csrf_token()}}";

      var url="{{url('admin')}}";
      
      $('.remodel').click(function(){
      var id=$(this).attr('data-id');
        $('#rid').val(id);
      });

      $('.deleteReview').click(function(){
        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        var status=confirm('Are Want to Delete This Record!');

          if(!status){

            return false;

          }

        $.ajax({

          url:url+'/customer/delete-review',

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
          "paging":   true,
          "info":     false,
          "order": [],
        });
    });
  </script>

 



@endsection