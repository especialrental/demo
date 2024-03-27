@extends('admin.layouts.admin')

 
@section("content")            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ route('dashboard') }}">Home</a></li>
                                <li><span>Users</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">

                    <!-- Server side start -->
                    <div class="col-12">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h4 class="header-title"><span>Update</span> User</h4>
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
                    <!-- Server side end -->
                </div>
            </div>

@endsection


@section("footer-page-script")


    <!-- others plugins -->
    <script src="{!! asset('assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('assets/js/scripts.js') !!}"></script>

@endsection