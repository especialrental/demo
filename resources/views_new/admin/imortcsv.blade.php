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
Import csv file

</h1>






            



            




        </section>




        <!-- Main content -->



        <section class="content">



            <div class="row">



                <div class="col-xs-12">



                    <div class="box">


<form  method="post" action="{{url('admin/property/importCSVData')}}" enctype = "multipart/form-data">



                @csrf

                      <div class="form-group">

                        <label for="upload_image">CSV Import</label>

                        <input type="file" class="form-control" id="csv" name="csv">


                      </div> 

                                                    





            <div class="modal-footer">



              <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button> 



            </div>



                            



                </form>



                        



                        



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