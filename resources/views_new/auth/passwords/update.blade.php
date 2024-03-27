@extends('admin.layouts.admin')
@section('content')
<div class="content-wrapper" style="min-height: 505px;">
    <section class="content-header">
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
    <section class="content">
        <div class="row">
            <div class="col-md-12" >
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Change Password</h3>
                    </div>
                    <div class="box-body pad">
                        <form class="needs-validation" novalidate="" method="post" action="{{url('admin/change-password')}}">
                            @csrf
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Current Password </label>
                                    <input type="password" name="current_pwd" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label>New Password </label>
                                    <input type="password" name="new_pwd" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input type="password" name="cnf_pwd" class="form-control"> 
                                </div>
                               <button type="submit" class="btn btn-info pull-right">Submit</button> 
                            </div>
                         </form>
                        </div>

                    </div>

                </div>

                <!-- /.col-->

            </div>

            <!-- ./row -->

         </section>
@endsection