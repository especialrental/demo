@extends("admin.layouts.layout")

@section("header-page-script")

@endsection

@section("content")            
  
  <div class="content-wrapper" style="min-height: 505px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Country
        
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
              <form class="needs-validation" novalidate="" id="my-form" method="post" action="{{route('saveCountry')}}" enctype = "multipart/form-data">
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
                <div class="col-md-6">
                <div class="form-group">
                  <label>Country Name</label>
                  <input type="text" class="form-control" name="country_name" id="country_name" placeholder="Country Name" value="{{ old('country_name') }}" required="">
                  <div class="invalid-feedback">
                     Please provide a valid country name.
                  </div>
                </div>
                <div class="form-group">
                  <label for="country_code">Country Code</label>
                  <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Country code" value="{{old('country_code')}}" required>
                  <div class="invalid-feedback">
                     Please provide a valid Country Code.
                  </div>

                </div>
                </div>
                <div class="col-md-6">                
                <div class="form-group">
                  <label for="callingcode">Calling code</label>
                  <input type="text" class="form-control" id="callingcode" name="callingcode" placeholder="Calling code" required>
                  <div class="invalid-feedback">
                        Please provide a valid Calling Code.
                  </div>
                </div>                
                <div class="form-group">
                  <label for="country_flag">Country Flag</label>
                  <input type="file" class="form-control" name="country_flag" placeholder="Country Flag">
                  <div class="invalid-feedback">
                    Please provide a valid Country Flag.
                  </div>
                </div>
               </div>                                
                <button type="submit" name="submit" class="btn btn-info pull-right">Add Country</button>            
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

@endsection

@section("footer-page-script")



@endsection
