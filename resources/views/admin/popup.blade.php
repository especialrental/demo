@extends('admin.layouts.admin')



@section('content')  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="min-height: 505px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1 style="display:flex;justify-content:space-between;align-items:center;">
        Home Popup

        

      <div class="pull-right">

        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cityModal">Add City</button>-->

      </div>

      </h1>

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
                <th>Heading</th>
                <th>Offer</th>
                <th>Image</th>
                <th>Popup Disable</th>
                <th>Create date</th>
                <th width="90">Action</th>                  

                </tr>

                </thead>

                <tbody>
                @php if(isset($popup) && !empty($popup)){ @endphp
               @php $i=0 @endphp
                @foreach($popup as $data)                    

                  <tr>
                    <td>{{++$i}}</td>
                    <td>{{$data->heading}}</td>
                    <td>{{$data->offer}}</td>
                    <?php $image = ($data->image !== '')? '<img src="'. url('public/uploads/blog').'/'.$data->image.'" width="76"/> ' :'';
                    ?>
                    <td>{!! $image !!}</td>
                    <?php if($data->popup_disable=='1'){?>
                    <td>Active</td>
                    <?php } else { ?>
                    <td>Inactive</td>
                    <?php } ?>
                    <td>{{date_format($data->created_at,"Y-m-d")}}</td>
                    <td><button class="editCity" data-id="{{$data->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>

                    

                  </tr>

                 @endforeach    
                                   @php } @endphp              

                </tbody>

                <tfoot>

               

                </tfoot>

              </table>

            </div>

            <div class="pull-right">

            

          </div>

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

    <div class="modal fade" id="cityModal" role="dialog">

        <div class="modal-dialog">

        

          <!-- Modal content-->

          <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <h4 class="modal-title">Update Popup</h4>

            </div>

               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/popup/save')}}" enctype = "multipart/form-data">

                @csrf

            <div class="modal-body" style="overflow: hidden;">



                    



                    <!-- text input -->



                    <div class="col-lg-12" id="editcity">

                      <div class="form-group">

                          <label>Heading</label>

                          <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading" required="">

                          <input type="hidden" name="id" id="id" value="0">

                      </div>


                      <div class="form-group">

                        <label>Popup Disable</label>

                        <select class="form-control" name="popup_disable" id="popup_disable" placeholder="Popup Disable" required="">
                            <option>Select Popup Disable</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                            </select> 

                        

                        </div>



                      <div class="form-group">

                        <label for="upload_image">Image</label>

                        <input type="file" class="form-control" id="image" name="image" required="">

                        <div class="invalid-feedback">

                            Please provide a valid image.

                        </div>

                      </div> 

                      <div class="form-group">

                          <label>Offer</label>

                          <textarea class="form-control" name="offer" id="offer" placeholder="Offer" required=""></textarea>

                          

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

      $('.editCity').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        $.ajax({

          url:url+'/popup/edit-popup',

          data:data,

          method:'POST',

          success:function(data,status,xhr){

            console.log(data);

            if(data.status==1){
              $('#editcity').html('');

              $('#editcity').html(data.data);

                $('#cityModal').modal();



            }



          },

          failure:function(status){

            console.log(status);

          }

        });

      });


    });

  </script>

  <script src="{{url('public')}}/customjs/admin.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#myDataTable').DataTable({
          "paging":   true,
          "info":     true
        });
    });
  </script>
@endsection