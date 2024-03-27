<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{!! asset('public/dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Especial Rentals</p>
          
        </div>
      </div> -->
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <li class="active treeview">
          <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
             
          </a>
          
        </li>
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="categories.php"><i class="fa fa-circle-o"></i>Add Category</a></li>
            <li><a href="categories-list.php"><i class="fa fa-circle-o"></i>Category-List</a></li>
            <li><a href="sub-category.php"><i class="fa fa-circle-o"></i>Sub-Category</a></li>
            <li><a href="sub-category-list.php"><i class="fa fa-circle-o"></i>Sub-Category-List </a></li>
          </ul>
        </li>-->

       <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Neighborhood</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="neighbourhood.php"><i class="fa fa-circle-o"></i>Add Neighborhood</a></li>
            <li><a href="neighbourhood_list.php"><i class="fa fa-circle-o"></i>Neighborhood-List</a></li>
    
          </ul>
        </li>-->
       <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage Property Type</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/property/property-type')}}"><i class="fa fa-circle-o"></i>Property Type</a></li>
    
          </ul>
        </li>
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage Features</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/otherfeature/other-feature')}}"><i class="fa fa-circle-o"></i>Other Features</a></li>
    
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage Destinations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <!--  <li><a href="javascript:;"><i class="fa fa-circle-o"></i>Add Country</a></li> -->
            <li><a href="{{url('admin/destination/country')}}"><i class="fa fa-circle-o"></i>Country</a></li>
            <li><a href="{{url('admin/destination/state')}}"><i class="fa fa-circle-o"></i> State</a></li>
            <li><a href="{{url('admin/destination/city')}}"><i class="fa fa-circle-o"></i>City</a></li>
            <li><a href="{{url('admin/destination/area')}}"><i class="fa fa-circle-o"></i>Area</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage Amenities</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/amenity')}}"><i class="fa fa-circle-o"></i>Amenities</a></li>
            <!--<li><a href="sub-amenity.php"><i class="fa fa-circle-o"></i>Sub-Amenity</a></li>
            <li><a href="sub-amenity-list.php"><i class="fa fa-circle-o"></i>Sub-Amenity-List </a></li>-->
          </ul>
        </li> 
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Manage Journey</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/journey')}}" ><i class="fa fa-circle-o "></i>Add Journey </a></li>
            <li><a href="{{ url('admin/journey/list')}}" ><i class="fa fa-circle-o "></i>Journey List</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Manage Properties</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/property/add')}}" ><i class="fa fa-circle-o"></i>Add Property</a></li>
            <li><a href="{{url('admin/property/')}}"><i class="fa fa-circle-o"></i>Properties List</a></li>
             <li><a href="{{url('admin/property/booked-property')}}"><i class="fa fa-circle-o"></i>Booked Properties List</a></li>
            
          </ul>
        </li>  
        
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Coupan Code</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/coupan')}}"><i class="fa fa-circle-o"></i>Coupan</a></li>
          </ul>
        </li>-->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="user.php"><i class="fa fa-circle-o"></i>Add User</a></li>
            <li><a href="user-list.php"><i class="fa fa-circle-o"></i>User-List</a></li>            
          </ul>
        </li> -->  
             
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>--> 
        
      <!-- <li class="header">LABELS</li> -->
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Booking & Inquiries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/booking')}}"><i class="fa fa-circle-o"></i>Customer Booking</a></li>
            <li><a href="{{ url('admin/customer/enquiries')}}"><i class="fa fa-circle-o"></i>Customer Inquiries</a></li>
            <li><a href="{{ url('admin/payments')}}"><i class="fa fa-circle-o"></i>Payments</a></li>
          </ul>
        </li>
        
        
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/blog/')}}"><i class="fa fa-circle-o"></i>Blog</a></li>
           
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Blog Comments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/blogcomment/')}}"><i class="fa fa-circle-o"></i>Comments</a></li>
           
          </ul>
        </li>
        
        

		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Reviews & Testimonials</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/testimonals/')}}"><i class="fa fa-circle-o"></i>Testimonials</a></li>
            <li><a href="{{ url('admin/customer/reviews')}}"><i class="fa fa-circle-o "></i>Customer Reviews</a></li>
           
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Subscribed Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/customer/sub_email')}}"><i class="fa fa-circle-o"></i>Users</a></li>
          </ul>
        </li>
       <li class="treeview">
          <a href="#"><i class="fa fa-th"></i>General Inquiries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="{{ url('admin/customer/contact')}}"><i class="fa fa-circle-o"></i>Inquiries</a></li>
          </ul>
        </li>
        
        
        <li class="treeview">
          <a href="#"><i class="fa fa-th"></i>Popup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="{{url('admin/popup/')}}"><i class="fa fa-circle-o"></i>Popup</a></li>
          </ul>
        </li>
        
        
        
       <li><a href="{{ url('admin/logout')}}"><i class="fa fa-circle-o text-yellow"></i> <span>Logout</span></a></li>
        <!--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul> -->
    </section>
    <!-- /.sidebar -->
  </aside>