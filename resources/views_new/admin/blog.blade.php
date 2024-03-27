@extends('admin.layouts.admin')







@section('content')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
        <script>
        
          tinymce.init({
            selector:'.editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });

        </script> 

<style>
    .cazary{
        width:100% !important;
    }
</style>
<link rel="stylesheet" href="{{url('editor')}}/editor/themes/flat/style.css">
    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper" style="min-height: 505px;">



        <!-- Content Header (Page header) -->



        <section class="content-header">



            <h1 style="display:flex;justify-content:space-between;align-items:center;">
Blog List

            <div class="pull-right">   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#areaModal">Add Blog</button>
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
                                        <th>Image</th>
                                        <th>Posted By</th>

                                        <th>Short Description</th>
                                        <!--<th>Description</th>-->

                                        <th style="display:none">Url</th>

                                        <th style="display:none">Post date</th>

                                        <th width="90">Action</th>



                                    </tr>



                                </thead>



                                <tbody>

                                   
                                   @php if(isset($blog) && !empty($blog)){ @endphp
                                   @php $i=0 @endphp
                                    @foreach($blog as $data)



                                        <tr>


                                            <td>{{++$i}}</td>
                                            <td>{{$data->heading}}</td>
                                            <?php $image = ($data->pic !== '')? '<img src="'. url('public/uploads/blog').'/'.$data->pic.'" width="20"/>' :'';
                                            ?>
                                            <td>{!! $image !!}</td>
                                            <td>{{$data->posted_by}}</td>
                                            <td>{{$data->short_content}}</td>
                                            <td>{{--$data->description--}}</td>
                                            <td style="display:none">
                                              <a href="{{$data->url}}">{{$data->url}}</a>
                                            </td>
                                            <td style="display:none">{{date_format($data->created_at,"Y-m-d")}}</td>
                                            <td><button class="editBlog" data-id="{{$data->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;<button class="deleteBlog" data-id="{{$data->id}}"><i class="fa fa-trash" aria-hidden="true" ></i></button></td>







                                        </tr> 



                                    @endforeach    
                                   @php } @endphp  


                                </tbody>



                                <tfoot>




                                </tfoot>



                            </table>

{{$blog->links()}}




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



        <div class="modal fade" id="areaModal" role="dialog" style="margin-left: 50%;height: 100%;">



        <div class="modal-dialog">



        



          <!-- Modal content-->



          <div class="modal-content">



            <div class="modal-header">



              <button type="button" class="close" data-dismiss="modal">&times;</button>



              <h4 class="modal-title">Add Blog</h4>



            </div>



               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{url('admin/blog/save')}}" enctype = "multipart/form-data">



                @csrf



            <div class="modal-body" style="overflow: hidden;">



                    



                    <!-- text input -->



                    <div class="col-lg-12" id="editarea">

                      <div class="form-group">

                          <label>Heading</label>

                          <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading" required="">

                          <input type="hidden" name="id" id="id" value="0">

                      </div>





                      <div class="form-group">

                        <label for="upload_image">Image</label>

                        <input type="file" class="form-control" id="upload_image" name="upload_image" required="">

                        <div class="invalid-feedback">

                            Please provide a valid image.

                        </div>

                      </div> 

                      <div class="form-group">

                          <label>Posted By</label>

                          <input type="text" class="form-control" name="posted_by" id="posted_by" placeholder="Posted By" required="">

                          

                      </div>
                      
                      
                      <div class="form-group">

                          <label>Short Description</label>

                          <textarea id="short_content" name="short_content" class="form-control"></textarea>

                      </div>
                      
                      

                      <div class="form-group">

                          <label>Description</label>
 
                          <textarea  id="description" class="editor" style="height:200px;" name="description" class="form-control description "></textarea>

                      </div>

                      <div class="form-group">

                          <label>URL</label>

                          <input type="text" class="form-control" name="url" id="url" placeholder="Url" required="">

                          

                      </div>
                      
                      
                       <div class="form-group">

                          <label>Meta Tag</label>

                          <input type="text" class="form-control" name="metatag" id="metatag" placeholder="Meta Tag" required="">

                          

                      </div>
                      
                      
                      
                       <div class="form-group">

                          <label>Meta Description</label>

                          <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description" required="">

                          

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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
 <script>

$(document).ready(function(){



      var token="{{csrf_token()}}";



      var url="{{url('admin')}}";



      $('.editBlog').click(function(){

       debugger;
        var id=$(this).attr('data-id');

        var data={_token:token,id:id};


        $.ajax({



          url:url+'/blog/edit',



          data:data,



          method:'POST',



          success:function(data,status,xhr){
            debugger;
            if(data.status==1){
              var value=data.data;
                
              $('#heading').val(value.heading);
              /*$('#upload_image').val(value.image);*/
              $('#posted_by').val(value.posted_by);        
/*              $('#editor2').val(value.description);
*/ 
           
               $("#description").val(value.description);

              $('#short_content').val(value.short_content);
              $('#url').val(value.url);
              $('#id').val(value.id);

                $('#areaModal').modal();



            }







          },



          failure:function(status){



            console.log(status);



          }



        });



      });



      $('.deleteBlog').click(function(){


        var id=$(this).attr('data-id');



        var data={_token:token,id:id};



        var status=confirm('Are Want to Delete This Record!');



          if(!status){



            return false;



          }



        $.ajax({



          url:url+'/blog/delete',



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
  
  <script src="{{url('editor')}}/ckeditor/ckeditor.js"></script>
	<script src="{{url('editor')}}/ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="{{url('editor')}}/ckeditor/samples/css/samples.css"> 
	<script>
		initSample();
	</script>

@endsection