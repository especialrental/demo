@extends("admin.layouts.layout")

@section("title","Admin Dashboard | Market Place")

@section("header-page-script")   
    
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/jquery.dataTables.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/responsive.bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/jqueryui.min.css') !!}">

    <!-- others css -->
    <link rel="stylesheet" href="{!! asset('public/assets/css/typography.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/default-css.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/responsive.css') !!}">
    <!-- modernizr css -->
    <script src="{!! asset('public/assets/js/vendor/modernizr-2.8.3.min.js') !!}"></script>
@endsection

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
                    <!-- Dark table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Users</h4>
                                <div class="data-tables datatable-dark">
                                    <!-- <table id="my-dataTable" class="text-center"> -->
                                    <table class="table my-dataTable table-hover table-bordered" id="sampleTable" class="text-center">    
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Phone</th>
                                                <th>Create Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dark table end -->
                </div>
            </div>

@endsection


@section("footer-page-script")
    <!-- Start datatable js -->
    <script src="{!! asset('public/assets/js/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('public/assets/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('public/assets/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('public/assets/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('public/assets/js/responsive.bootstrap.min.js') !!}"></script>
    <!-- others plugins -->
    <script src="{!! asset('public/assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('public/assets/js/scripts.js') !!}"></script>
    <script src="{!! asset('public/assets/js/admin.js') !!}"></script>
    <script>
        $(function() {
            $('#sampleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboard/user_data') }}',
                columns: [
                { data: 'image', name: 'image' },
                { data: 'first_name', name: 'first_name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
    
    <script>
        $(function () {

            $(document).on("click", ".btn-delete", function () {

                var conf = confirm("Are you sure want to delete ?");

                if (conf) {

                    // ajax call functions
                    var delete_id = $(this).attr("data-id"); // delete id of delete button

                    var postdata = {
                        "_token": "{{ csrf_token() }}",
                        "hiddenval": delete_id
                    }

                    $.post("{{ route('deleteuser') }}", postdata, function (response) {

                        var data = $.parseJSON(response);

                        if (data.status == 1) {

                            location.reload();
                        } else {

                            alert(data.message);
                        }
                    })
                }
            });

        });
       
    </script>
@endsection