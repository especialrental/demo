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
Blog Comments List

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
                                        <th>Blog</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Comments</th>

                                        <th width="90">Status</th>



                                    </tr>



                                </thead>



                                <tbody>

                                   
                                   @php if(isset($blog) && !empty($blog)){ @endphp
                                   @php $i=0 @endphp
                                    @foreach($blog as $data)



                                        <tr>


                                            <td>{{++$i}}</td>
                                            <td>{{$data->blog_id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->user_comment}}</td>
                                            <td><input data-id="{{$data->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $data->status ? 'checked' : '' }}></td>







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



      



    </div>



    <!-- /.content-wrapper -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
 <script>


 $(function() {
    $('.toggle-class').change(function() {
        var token="{{csrf_token()}}";
        var url="{{url('admin')}}";
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         console.log(status);
        $.ajax({
            type: "GET",
            dataType: "json",
            url:url+'/blogcomment/active',
            data: {'status': status, 'id': id},
            success: function(data){
              if(data)
              {
                  alert("Status change successfully");
              }
              
            }
        });
    });
  });


$(document).on('click','.activeProperty',function(){
        var token="{{csrf_token()}}";

        var url="{{url('admin')}}";
        var id=$(this).attr('data-id');
        var status=$(this).attr('data-status');
        var commentStatus=(status.trim()=='Active')?1:0;
        var commentStatus=(status.trim()=='Deactive')?0:1;

        var data={_token:token,id:id,commentStatus:commentStatus};

        var status=confirm('Are Want to '+commentStatus+' This Record!');

          if(!status){

            return false;

          }

        $.ajax({

          url:url+'/blogcomment/active',

          data:data,

          method:'POST',

          success:function(data,status,xhr){
                    
            if(data.status==1){

              $('#message').html('<h4 class="alert alert-success text-center">Status Updated Successfully !</h4>');

              //setTimeout(function(){ window.location.href = url+'/property'}, 2000);

            }



          },

          failure:function(status){

            console.log(status);

          }

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