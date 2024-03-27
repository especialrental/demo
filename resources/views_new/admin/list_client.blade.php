@extends("admin.layouts.layout")

@section("title","Admin Dashboard | Market Place")

@section("header-page-script")   
    
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/jquery.dataTables.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/responsive.bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/jqueryui.min.css') !!}">

    <!-- others css -->
    <link rel="stylesheet" href="{!! asset('assets/css/typography.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/default-css.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/responsive.css') !!}">
    <!-- modernizr css -->
    <script src="{!! asset('assets/js/vendor/modernizr-2.8.3.min.js') !!}"></script>
@endsection

@section("content")            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ route('dashboard') }}">Home</a></li>
                                <li><span>Clients</span></li>
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
                                <h4 class="header-title">Clients</h4>
                                <div class="data-tables datatable-dark">
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
    <script src="{!! asset('assets/js/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('assets/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('assets/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('assets/js/responsive.bootstrap.min.js') !!}"></script>
    <!-- others plugins -->
    <script src="{!! asset('assets/js/plugins.js') !!}"></script>
    <script src="{!! asset('assets/js/scripts.js') !!}"></script>
    <script src="{!! asset('assets/js/admin.js') !!}"></script> 
    <script>
        $(function() {
            $('#sampleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/dashboard/client_data') }}',
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

                    $.post("{{ route('deleteclient') }}", postdata, function (response) {

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