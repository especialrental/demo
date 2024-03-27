@extends('admin.layouts.admin')



@section('content')  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
 <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 505px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1 style="display:flex;justify-content:space-between;align-items:center;">

        Amenity List

      <div class="pull-right">

        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Amenities</button>

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
                  <th>Amenity Name</th>

                <th>Sub Amenity Name</th>

                  <th>Action</th>                  

                </tr>

                </thead>

                <tbody>
                   @php $i=0 @endphp
                @foreach($amenity as $ame)                    

                <tr>
                 <td>{{++$i}}</td>
                  <td>{{$ame->amen_value}}</td>

                  <td><a href="{{url('admin/amenity')}}/{{$ame->id}}">{{App\Model\SubAmenity::where('aid',$ame->id)->count()}}</a></td>

                  <td><button class="edit" data-id="{{$ame->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button><button class="delete" data-id="{{$ame->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

                  

                </tr>

                @endforeach                    

                

                                

                </tbody>

                <tfoot>

               

                </tfoot>

              </table>

            </div>

            <!-- /.box-body -->
             
          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

        

          <!-- Modal content-->

          <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <h4 class="modal-title">Add Amenities</h4>

            </div>

               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/amenity/save')}}" enctype = "multipart/form-data">

                @csrf

            <div class="modal-body" style="overflow: hidden;">

                    

                    <!-- text input -->

                    <div class="col-lg-12">

                     <div class="form-group">

                      <label>Amenity Name</label>

                      <input type="text" class="form-control" name="name" id="amenityId" placeholder="Enter amenity name ...">
                      
                      <input type="hidden" name="amid" id="amid" value="0">

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

      $('.edit').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        $.ajax({

          url:url+'/amenity/edit',

          data:data,

          method:'POST',

          success:function(data,status,xhr){

            console.log(data);

            if(data.status==1){

              var value=data.data;

              $('#amenityId').val(value.amen_value);

              $('#amid').val(value.id);



                $('#myModal').modal();

            }



          },

          failure:function(status){

            console.log(status);

          }

        });

      });

      $('.delete').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        var status=confirm('Are Want to Delete This Record!');

          if(!status){

            return false;

          }

        $.ajax({

          url:url+'/amenity/delete',

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
          "info":     true
        });
    });
  </script>
@endsection



