@extends('admin.layouts.admin')

@section('content') 
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 505px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display:flex;justify-content:space-between;align-items:center;">
        Add Property Type
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
              <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          
          <!-- general form elements disabled -->
          <div class="box box-warning"> 
          <span style="color:red;"></span>           
            <div class="box-body">
              <form method="POST">
                <!-- text input -->
                <div class="form-group">
                  <label>Property Type Name</label>
                  <input type="text" class="form-control" name="catname" placeholder="Enter Property Type Name">
                </div>                
                <button type="submit" name="submit" class="btn btn-info pull-right">Add Property Type </button>            
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection