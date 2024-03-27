@extends('admin.layouts.admin')

@section('content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 505px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display:flex;justify-content:space-between;align-items:center;">Coupan List	        <div class="pull-right">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Coupan</button>
      </div>	  </h1>

    </section>
    <span style="color:red;"> </span>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Coupan Name</th>
                  <th>Discount</th>
                  <th>Action</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach($coupan as $cdata)                      
                <tr>
                  <td>{{$cdata->coupan_code}}</td>
                  <td>{{$cdata->coupan_discount}}</td>
                  <td><a onclick="del(1)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  
                </tr>
                @endforeach                
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="pull-right">
             {{$coupan->links()}}
            </div>
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
              <h4 class="modal-title">Modal Header</h4>
            </div>
               <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveCountry')}}" enctype = "multipart/form-data">
            <div class="modal-body" style="overflow: hidden;">
                    <div class="form-row">
                        @if(session("msg"))
                        <div class="alert-dismiss">
                            <div class="alert alert-success alert-dismissible fade show">
                                <span>{{session("msg")}}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span> </button><br/>
                            </div>
                        </div>
                        @endif
                        @if(count($errors)>0)
                        <div class="alert-dismiss">
                            <div class="alert alert-danger alert-dismissible fade show">
                                @foreach($errors->all()  as $error)
                                    <span>{{$error}}</span><br/>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <input type="hidden" name="hiddenval" class="hiddenval" value="0">
                        {!!csrf_field()!!}
                    </div>
                    <div class="form-row">
                        @if(session("msg"))
                        <div class="alert-dismiss">
                            <div class="alert alert-success alert-dismissible fade show">
                                <span>{{session("msg")}}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span> </button><br/>
                            </div>
                        </div>
                        @endif
                        @if(count($errors)>0)
                        <div class="alert-dismiss">
                            <div class="alert alert-danger alert-dismissible fade show">
                                @foreach($errors->all()  as $error)
                                    <span>{{$error}}</span><br/>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <input type="hidden" name="hiddenval" class="hiddenval" value="0">
                        {!!csrf_field()!!}
                    </div>
                    <!-- text input -->
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Coupan Code</label>
                        <input type="text" class="form-control" name="name" placeholder="Coupan code" required="">
                      </div>
                      <div class="form-group">
                        <label>Coupan Discount %</label>
                        <input type="text" class="form-control" name="code" placeholder="Coupan discount (without use %)" required="">
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
  <script type="text/javascript">
  function del(id){
    if(confirm('Are you sure delete coupan.')){
      window.location.href="delete-coupan.php?id="+id;
    }
  }
</script>
@endsection