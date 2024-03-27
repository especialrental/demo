@extends('admin.layouts.admin')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 505px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1 style="display:flex;justify-content:space-between;align-items:center;">
                <span>Property Listing</span>
				<a href="{{url('admin/property/add')}}"><button type="button" class="btn btn-info btn-lg">Add Property</button></a>
            </h1>

            <div class="pull-left">

         <div id="message"></div>

        </div> 

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

<hr>

        <div style="border: none;padding:0px 15px;margin:0px;">
                <div class=" form-group">
                    <input type="text" class="form-control" id="search" name="property" placeholder="Search Property" value="">
                    <div id="display"></div>
                </div>
        </div>

        <!-- Main content -->

       @include('admin.search_data')

        <!-- /.box -->

    </div>

    <!-- /.content-wrapper -->

    <script type="text/javascript">

       $(document).ready(function(){

        var token="{{csrf_token()}}";

        var url="{{url('admin')}}";
        //$('.inRates').click(function(){
        $(document).on('click', '.inRates', function(event){  
         
          window.location.href = $(this).data('href')+'?index=4';
        });
        //$('.inGallery').click(function(){
        $(document).on('click', '.inGallery', function(event){
         
          window.location.href = $(this).data('href')+'?index=6';
        });
        //$('.inCalender').click(function(){
        $(document).on('click', '.inCalender', function(event){  
         
          window.location.href = $(this).data('href')+'?index=7';
        });
         $(document).on('click','.deleteProperty', function(){

        console.log($(this).attr('data-id'));

        var id=$(this).attr('data-id');
        var data={_token:token,id:id};
        var status=confirm('Are Want to Delete This Record!');
          if(!status){
            return false;
          }

        $.ajax({

          url:url+'/property/delete',

          data:data,

          method:'POST',

          success:function(data,status,xhr){

            if(data.status==1){

              $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');

              //$( "#message" ).find('.alert-success').focus();

              setTimeout(function(){ window.location.href = url+'/property'}, 3000);

            }

          },

          failure:function(status){
            console.log(status);
          }

        });

       });

       $(document).on('click','.activeProperty',function(){
        
        var id=$(this).attr('data-id');
        var status=$(this).attr('data-status');
        var prop_Status=(status.trim()=='Active')?1:0;
        var pop_Status=(status.trim()=='Active')?'Deactive':'Active';

        var data={_token:token,id:id,prop_Status:prop_Status};

        var status=confirm('Are Want to '+pop_Status+' This Record!');

          if(!status){

            return false;

          }

        $.ajax({

          url:url+'/property/active',

          data:data,

          method:'POST',

          success:function(data,status,xhr){
                    
            if(data.status==1){

              $('#message').html('<h4 class="alert alert-success text-center">Status Updated Successfully !</h4>');

              setTimeout(function(){ window.location.href = url+'/property'}, 2000);

            }



          },

          failure:function(status){

            console.log(status);

          }

        });

       }); 

      });

    </script>
    <script>
      $(document).ready(function(){
       var token="{{csrf_token()}}";
       var url="{{url('admin')}}";
       //fetch_data();

       function fetch_data(query = '',page = '')
       {
         
        $.ajax({
         url:url+'/property/prop-search',
         method:'POST',
         data:{_token:token, search:query , page:page},
         
         success:function(data)
         {
          
          $('#property').html('');
          $('#property').html(data);
         }
        })
       }
       var query='';
       $(document).on('click', '.pagination a', function(event){
              event.preventDefault();
              var query = $('#search').val();
              var page = $(this).attr('href').split('page=')[1];
              $('#hidden_page').val(page);
            
              $('li').removeClass('active');
                    $(this).parent().addClass('active');
              fetch_data(query,page);
             });
       $(document).on('keydown', '#search', function(e){
        
		  if(e.keyCode==13){			  
        var query = $(this).val();
        var page='';
        fetch_data(query,page);
		
       
	   }
      });
      });
    </script>

   @endsection