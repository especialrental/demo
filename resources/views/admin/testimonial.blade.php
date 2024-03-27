@extends('admin.layouts.admin')







@section('content')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper" style="min-height: 505px;">



        <!-- Content Header (Page header) -->



        <section class="content-header">



            <h1 style="display:flex;justify-content:space-between;align-items:center;">
Testimonial List

            <div class="pull-right">   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#areaModal">Add Testimonial</button>
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
                                        <th>Client Name</th>
                                        <th>Image</th>
                                        <th>Title</th>

                                        <th>Description</th>

                                        <th>Url</th>

                                        <th>Post date</th>

                                        <th width="90">Action</th>



                                    </tr>



                                </thead>



                                <tbody>

                                   
                                   @php if(isset($testimonial) && !empty($testimonial)){ @endphp
                                   @php $i=0 @endphp
                                    @foreach($testimonial as $data)



                                        <tr>


                                            <td>{{++$i}}</td>
                                            <td>{{$data->name}}</td>
                                            <?php $image = ($data->image !== '')? '<img src="'. url('public/uploads/testimonial').'/'.$data->image.'" width="20"/>' :'';
                                            ?>
                                            <td>{!! $image !!}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->description}}</td>
                                            <td>
                                              <a href="{{$data->url}}">{{$data->url}}</a>
                                            </td>
                                            <td>{{date_format($data->created_at,"Y-m-d")}}</td>
                                            <td><button class="editTestimonial" data-id="{{$data->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;<button class="deleteTestimonial" data-id="{{$data->id}}"><i class="fa fa-trash" aria-hidden="true" ></i></button></td>







                                        </tr>



                                    @endforeach    
                                   @php } @endphp  


                                </tbody>



                                <tfoot>







                                </tfoot>



                            </table>



                        </div>



                        



                    </div>



                    <div class="pull-right">



                       <!-- $area->links() -->



                    </div>



                    <!-- /.box -->



                </div>



                <!-- /.col -->



            </div>



            <!-- /.row -->



        </section>



        <!-- /.content -->



        <div class="modal fade" id="areaModal" role="dialog">



        <div class="modal-dialog">



        



          <!-- Modal content-->



          <div class="modal-content">



            <div class="modal-header">



              <button type="button" class="close" data-dismiss="modal">&times;</button>



              <h4 class="modal-title">Add Testimonial</h4>



            </div>



               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/testimonals/save')}}" enctype = "multipart/form-data">



                @csrf



            <div class="modal-body" style="overflow: hidden;">



                    



                    <!-- text input -->



                    <div class="col-lg-12" id="editarea">

                      <div class="form-group">

                          <label>Client Name</label>

                          <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Client Name" required="">

                          <input type="hidden" name="tid" id="tid" value="0">

                      </div>





                      <div class="form-group">

                        <label for="upload_image">Image</label>

                        <input type="file" class="form-control" id="upload_image" name="upload_image" required="">

                        <div class="invalid-feedback">

                            Please provide a valid image.

                        </div>

                      </div> 

                      <div class="form-group">

                          <label>Title</label>

                          <input type="text" class="form-control" name="title" id="title" placeholder="Title Name" required="">

                          

                      </div>

                      <div class="form-group">

                          <label>Description</label>

                          <textarea id="description" name="description" class="form-control"></textarea>

                      </div>

                      <div class="form-group">

                          <label>URL</label>

                          <input type="text" class="form-control" name="url" id="url" placeholder="Url" required="">

                          

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



      $('.editTestimonial').click(function(){

       debugger;
        var id=$(this).attr('data-id');

        var data={_token:token,id:id};


        $.ajax({



          url:url+'/testimonals/edit',



          data:data,



          method:'POST',



          success:function(data,status,xhr){
            debugger;
            if(data.status==1){
              var value=data.data;
                
              $('#client_name').val(value.name);
              /*$('#upload_image').val(value.image);*/
              $('#title').val(value.title); 
              $('#description').val(value.description);
              $('#url').val(value.url);
              $('#tid').val(value.id);

                $('#areaModal').modal();



            }







          },



          failure:function(status){



            console.log(status);



          }



        });



      });



      $('.deleteTestimonial').click(function(){


        var id=$(this).attr('data-id');



        var data={_token:token,id:id};



        var status=confirm('Are Want to Delete This Record!');



          if(!status){



            return false;



          }



        $.ajax({



          url:url+'/testimonals/delete',



          data:data,



          method:'POST',



          success:function(data,status,xhr){

            if(data.status==1){
              $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');
            }
            location.reload();

          },

          failure:function(status){

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
          "paging":   false,
          "info":     false
        });
    });
  </script>


@endsection