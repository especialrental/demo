<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Especial Rentals Admin</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  

  <link rel="stylesheet" href="{{url('public')}}/plugins/jquerysteps/steps.css">

  <!-- Bootstrap 3.3.6 -->

  <link rel="stylesheet" href="{{url('public')}}/bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- jvectormap -->

  <link rel="stylesheet" href="{{url('public')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <link rel="stylesheet" href="{{url('public')}}/bootstrap/css/style.css">



  <!-- Theme style -->

  <link rel="stylesheet" href="{{url('public')}}/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="{{url('public')}}/dist/css/skins/_all-skins.min.css">

  

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 



<!-- include summernote css/js-->

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<!-- jQuery 2.2.3 -->

<script src="{{url('public')}}/plugins/jQuery/jquery-2.2.3.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  @include('admin.layouts.topheader')

  @include('admin.layouts.sidebar')

  @yield('content')

</div>



  <footer class="main-footer">

    <div class="pull-right hidden-xs">

     &nbsp;

    </div>

    <strong>Copyright &copy; 2017 Especial Rentals .</strong> All rights

    reserved.

  </footer>



  

</div>

<!-- ./wrapper -->





<!-- Bootstrap 3.3.6 -->

<script src="{{url('public')}}/bootstrap/js/bootstrap.min.js"></script>

<!-- FastClick -->

<script src="{{url('public')}}/plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="{{url('public')}}/dist/js/app.min.js"></script>

<!-- Sparkline -->

<script src="{{url('public')}}/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- jvectormap -->

<script src="{{url('public')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="{{url('public')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- SlimScroll 1.3.0 -->

<script src="{{url('public')}}/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- ChartJS 1.0.1 -->

<script src="{{url('public')}}/plugins/chartjs/Chart.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{url('public')}}/dist/js/pages/dashboard2.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="{{url('public')}}/dist/js/demo.js"></script>

<!-- Wizard js -->

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">

        var BASEURL = "{{url('/')}}";

</script>



</body>

</html> 