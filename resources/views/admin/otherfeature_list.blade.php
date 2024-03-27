@extends('admin.layouts.admin')



@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  

  <!-- Content Wrapper. Contains page content -->

 <div class="content-wrapper" style="min-height: 505px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

     <h1 style="display:flex;justify-content:space-between;align-items:center;">
        Other Features List
      <div class="pull-right">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Other Feature</button>
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
                  <th>Other Feature Name</th>

                  <th>Addedon</th>

                  <th>Action</th>                  

                </tr>

                </thead>

                <tbody>
                  @php $i=0 @endphp 
                  @foreach($otherfeature as $feature)                     

                <tr>
                  <td>{{++$i}}</td>
                  <td>{{$feature->categoryname}}</td>

                  <td>{{$feature->description}}</td>

                  <td><button class="editfeature" data-id="{{$feature->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;<button class="deletefeature" data-id="{{$feature->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

                  

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

          <div class="pull-right">

            

          </div>

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

              <h4 class="modal-title">Modal Header</h4>

            </div>

               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/otherfeature/save')}}" enctype = "multipart/form-data">

                @csrf

            <div class="modal-body" style="overflow: hidden;">

                    

                    <!-- text input -->

                    <div class="col-lg-12">

                     <div class="form-group">

                      <label>Other Feature Name</label>

                      <input type="text" class="form-control" name="name" id="otherFeature" placeholder="Enter Other Feature Name">

                      <input type="hidden" name="fid" id="fid" value="0">

                    </div>



                    <div class="form-group">

                      <label>Other Feature Description</label>

                      <input type="text" class="form-control" name="description" id="description" placeholder="Enter Property Type Description">

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

      $('.editfeature').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        $.ajax({

          url:url+'/otherfeature/edit',

          data:data,

          method:'POST',

          success:function(data,status,xhr){

            console.log(data);

            if(data.status==1){

              var value=data.data;

              $('#otherFeature').val(value.categoryname);

              $('#description').val(value.description);

              $('#fid').val(value.id);



                $('#myModal').modal();

            }



          },

          failure:function(status){

            console.log(status);

          }

        });

      });

      $('.deletefeature').click(function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');

        var data={_token:token,id:id};

        var status=confirm('Are Want to Delete This Record!');

          if(!status){

            return false;

          }

        $.ajax({

          url:url+'/otherfeature/delete',

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