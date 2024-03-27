<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">E-R</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{url('public')}}/frontend/images/header-logo-default.png" class="logo-image" alt="Logo Image" style="width: 47%;float:left;padding:2px 0px;"></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
           
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle no-cursor" data-toggle="dropdown" style="padding: 15px 17px 13px!important;">
              <img src="{{url('public')}}/dist/img/user2-160x160.jpg" class="user-image pull-left" alt="User Image">
              <span class="hidden-xs">ADMINISTRATOR</span>
            </a>
            <ul class="dropdown-menu" style="left:0;right:auto;">              

              <li class="user-footer">
                  
                  <a href="{{url('admin/change-password')}}" >Change Password</a>
                
              </li>
              
              <li class="user-footer">
                  
                  <a href="{{url('admin/logout')}}" >Logout</a>
                
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>

    </nav>
  </header>
  <script>
$(function(){
	$('.user-menu').click(function(){
		$(this).find('.dropdown-menu').slideToggle();
	})
})
</script>
<script type="text/javascript">
  function edit(){
    if(confirm('Are you sure active this property?')){
        window.location.href='unset.php';
    }
}
</script>