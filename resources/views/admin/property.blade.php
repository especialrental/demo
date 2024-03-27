@extends('admin.layouts.admin')



@section('content') 

  

   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/frontend/css/stylee.css">
  <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/magnific-popup.css">
  <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/lightbox.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/royalslider.css">
  <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/royalslider2.css">
    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="{{url('/')}}/public/calender/css/style.css" />
  <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
  <!--- bootstrap -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'> -->
  <!-- Latest compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <!-- Optional theme -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
  <!-- Latest compiled and minified JavaScript -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script> -->  
  <style>
  #cursor
  {
    font-size: 20px;
    font-weight:600;
    color: #424bf4;
  }

  @media only screen and (max-width: 768px) {
  #prop_ical{
  height:100px !important;
  }
  }
  </style>
   <style type="text/css">
    /*.date-picker-wrapper.single-date.no-shortcuts.no-gap.single-month{
      display: block !important;
    }*/
  .month-wrapper {
    width: 100% !important;
  }
  .reorder_link {
    color: #3675B4;
    border-radius: 3px;
    text-transform: uppercase;
    background: #fff;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.35s;
    -moz-transition: all 0.35s;
    -webkit-transition: all 0.35s;
    -o-transition: all 0.35s;
    white-space: nowrap;
    margin-left:10px;
    margin-right:10px;
  }
  .reorder_link:hover {
      color: #fff;
      border: solid 2px #3675B4;
      background: #3675B4;
      box-shadow: none;
  }
  div#call-box-s{
    width: 100% !important;
  }
  .gallery{ width:100%; float:left; margin-top:10px;}
  .gallery ul{ margin:0; padding:0; list-style-type:none;}
  .gallery ul li{ padding:7px; border:2px solid #ccc; float:left; margin:10px 7px; background:none; width:auto; height:auto;}
  /*.gallery img{ width:250px;}*/

  /* NOTICE */
  .notice, .notice a{ color: #fff !important; }
  .notice { z-index: 8888; }
  .notice a { font-weight: bold; }
  .notice_error { background: #E46360; }
  .notice_success { background: #657E3F; }

  .booking-box.dangerbook {
    background: red none repeat scroll 0 0;
    color: #fff;
    border: 1px solid red;
  }

  </style> 
    

   <!--  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
     <script type="text/javascript" src="{{url('/')}}/public/frontend/js/moment.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/public/frontend/js/jquery.daterangepicker.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/public/frontend/js/slick.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/public/frontend/js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/public/frontend/js/apps.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/public/frontend/js/jquery.magnific-popup.js"></script> -->
    <script>
        /*$( "#startdate").datepicker({
          minDate: 0 });
          
        $( "#enddate").datepicker({
          });*/
         
    </script>
    

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper" style="min-height: 505px;">

        <section class="content">

            <div class="row">

                <!-- right column -->

                <div class="col-md-12">

                    <!-- Horizontal Form -->

                    <div class="box box-warning">

                        <span style="color: red;"></span>

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

                        <div class="box-body">

                            <form class="needs-validation" novalidate="" method="post" id="add-property-wizard" action="{{url('admin/property/save')}}" enctype = "multipart/form-data" autocomplete="off">

                                @csrf
                @if(isset($propertyId) && !empty($propertyId))
                     <button type="submit" style="background: #f3772d;color: #fff;display: block;padding: .5em 1em;text-decoration: none;-moz-border-radius: 5px;border-radius: 5px;position: absolute;bottom: 35px;left: 15px;border: none;z-index: 1000;">Save</button>
                   
                  @endif
                <div> 
                  @php
                  $propertyId = ((isset($propertyId))? $propertyId: 0) ; @endphp
                  <input type="hidden" name="pid" id="pid" value="{{$propertyId}}">

                  <h3>PropertyAddress</h3>

                    <section>

                      @include('admin.addproperty')

                    </section>

                  <h3>Property Details</h3>

                    <section>

                        @include('admin.detailsproperty')

                    </section>



                  <h3>Owner Details</h3>

                    <section>

                        @include('admin.ownerproperty')

                    </section>

                  <h3>Property Category</h3>

                    <section>

                        @include('admin.categoryproperty')

                    </section>

                  <h3>Rates</h3>

                    <section>

                       @include('admin.rates')

                    </section>

                  <h3>PropertyAmenities</h3>

                    <section>

                       @include('admin.amenityprop')

                    </section>

                  <h3>Gallery</h3>

                    <section>

                       @include('admin.gallery')

                    </section>

                  <h3>Calendar</h3>

                    <section>

                       @include('admin.calendar')

                    </section>

               </div>

                
                            </form>
                
                   
                   
                   
                   
                   
                   
                          
                    
                    
                        </div>

                        <!-- /.box-body -->

                    </div>

                    <!-- /.box -->

                </div>

                <!--/.col (right) -->

            </div>

            <!-- /.row -->


                    <div style="display:none;">
                             
                    <form method="post" action="{{url('admin/property/savemultiple')}}" enctype = "multipart/form-data">
                       @csrf
                        <div style="float: left;">
                            <input type="hidden" name="id" value="{{request()->route('id')}}">
                        <label>Property Multiple Photo</label>
                        <input type="file" class="form-control" id="images" name="uploads_image[]" multiple="" onchange="preview_image(this);" value="">
                        
                    </div>
                    
                    <button type="submit" style="background: #f3772d;color: #fff;padding: .5em 1em;text-decoration: none;-moz-border-radius: 5px;display: inline-block;margin-left: 35px;margin-top: 28px;border-radius: 5px;bottom: 35px;right: 15px;border: none;z-index: 1000;">Save</button>
                    </form>
                    
                    </div>
                    
                    
                    
                    
        </section>

        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->



<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<script src="{{url('public')}}/plugins/jquerysteps/jquery.steps.min.js"></script>



<script>

/*$("#add-property-wizard").steps({

    headerTag: "h3",

    bodyTag: "section",

    transitionEffect: "slideLeft"

});*/
  
 
  /*var url = $(location).attr("href");
  var parts = url.split("?index=");*/
  //var last_part = parts[parts.length-1];
  //var new_var = (parts) ? parts[parts.length-1] : "";  
  var currenturl = window.location.href;
  function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}
  var param = getURLParameter('index');
  //alert(param)
   var par = (param>0)?param:0;
var form = $("#add-property-wizard");

form.validate({

    errorPlacement: function errorPlacement(error, element) { element.before(error); },

    rules: {

        confirm: {

            equalTo: "#password"

        }

    }

});

form.children("div").steps({

    headerTag: "h3",

    bodyTag: "section",
    contentMode:'async',
    transitionEffect: "slideLeft",

    autoFocus:false,
    enableAllSteps:true,
    startIndex:parseInt(par),
    onStepChanging: function (event, currentIndex, newIndex)
       
    {   
        
        form.validate().settings.ignore = ":disabled,:hidden";

        

        /*if(currentIndex === 6){

               $('a[href="#finish"]').css("display","none");

               $('.actions li:last-child').append('<button type="submit" id="submit" class="btn btn-primary">Submit</button>');

        }*/

        return form.valid();

    },

    onFinishing: function (event, currentIndex)

    {   



        form.validate().settings.ignore = ":disabled";

        return form.valid();

    },

    onFinished: function (event, currentIndex)

    {

        form.submit();

    }

});



</script>

<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script> 

<script>

  CKEDITOR.replace('editor1');

  CKEDITOR.replace('editor2');

  CKEDITOR.replace('editor3');
  
  CKEDITOR.replace('editor4');
  
  CKEDITOR.replace('editor5');

</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

<script type="text/javascript">

google.maps.event.addDomListener(window,'load',intilize);

function intilize(){

  var autocomplete=new google.maps.places.Autocomplete(document.getElementById('pAddress'));



    google.maps.event.addListener(autocomplete,'place_changed', function() {



    var place =autocomplete.getplace();

    var location="<b>Location:</b>" + places.formatted_address + "<br/>";

    location += "Latitude: " + places.geometry.location.lat() + "<br/>";

    location += "Longitude: " + places.geometry.location.lng()+ "<br/>";

 

    document.getElementById('lblResult').innerHTML = location;

  });



};

</script>

<script src="{{url('public')}}/customjs/admin.js"></script>

<script type="text/javascript">

    

    /*$("#addmorerates").on("click", function(){

        

      alert("The paragraph was clicked.");

    });*/

    $('#prop_image').click(function(){

      var image = $('#image').val();

      var imageTitle = $('#caption').val();



      $('#propImg').val(image);

      $('#propCaption').val(imageTitle);

    });

     
    /*function fileuploadpreview(input) {  

        

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {

              $(input).next('div.previewimg').html('<img src="'+e.target.result+'" width="70px" height="50px">');            

            }

            reader.readAsDataURL(input.files[0]);       

        } else 

            $(input).next('div.previewimg').html('');

    }*/

    function preview_image() 
    {
     var total_file=document.getElementById("images").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.previewimg').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' width='200px' height='50px' style='margin: 10px 14px 3px 2px; height: 150px;'>");
     }
    }

   /* $(document).on('click', '.addMoreImages', function(){

    $(`<div class="panel panel-default">
                                <div class="panel-body"><div class="gallery"><button class="btn btn-icons btn-rounded btn-light removeImages pull-right" title="Remove" type="button"><i class="fa fa-times"></i></button><div class="form-group"><label>Property Photo (<strong>Note</strong>:- Maximum size of image file 2 MB is allowed.)</label><input type="file" class="form-control" id="image" name="images[]" multiple="" onchange="fileuploadpreview(this);"><div class="img-responsive previewimg"></div></div><div class="form-group"><label>Caption</label><input type="text" class="form-control" id="caption" placeholder="Enter caption" name="caption[]"></div></div></div></div>`).insertBefore($(this));



    });*/



    /*$(document).on('click', '.removeImages', function(){

    $(this).closest('.panel').remove();

    });*/
    
    /*$(document).on('click', '.editRates', function(){
      $(this).parents('tr').children('td').each(function(){
        //alert('#'+$(this).attr('class'));
        var getValue=$(this).text();
        $('#'+$(this).attr('class')).val(getValue);
      })
    });*/
    //var global_i = 0;
     $('#pro_add_offer').click(function(){
      var tds='';
      $('.popup_offer .form-control').each(function(){        
        var getValue=$(this).val();
         //console.log(getValue);
        
        tds+='<td class="'+$(this).attr("id")+'" >'+getValue+'<input type="hidden" class="'+$(this).attr("id")+'" name="'+$(this).attr("id")+'[]" value="'+getValue+'"></td>';
        
      })
       $('#tablenameOffer tbody').append(`
        <tr>
          ${tds}<td><button type="button" class="btn btn-primary btn-sm editofferbtn" data-toggle="modal" data-target="#addmoredeals"><i class="fa fa-pencil"></i></button><button type="button" class="btn btn-primary btn-sm deleteofferbtn" data-toggle="modal" data-target="#addmoredeals"><i class="fa fa-trash"></i></button></td>          
        </tr>

        `);
      
     });

     $(document).on('mouseup','.editofferbtn',function(){
      $('#pro_add_offer').addClass("hide");
            $('.updatesOfferBtn').removeClass('hide');
      //$(this).parents('tr').remove();
      $(this).parents('tr').siblings().removeClass('editableofferrow');
       $(this).parents('tr').addClass('editableofferrow');
       //$(this).parents('tr').removeClass('editableofferrow');
       $('.popup_offer .form-control').each(function(){        
        var getValue=$('tr.editableofferrow td.'+$(this).attr("id")).text();
        $(this).val(getValue);
      })
    });
    $(document).on('mouseup','.deleteofferbtn',function(){
      $(this).parents('tr').remove();
    });
    $(document).on('click','.updatesOfferBtn',function(e){
      $('.popup_offer .form-control').each(function(){        
        var getValue=$(this).val();

        $('html,body').find('tr.editableofferrow td.'+$(this).attr("id")+'').text(getValue);
        // $('html,body').find('tr.editableofferrow td.'+$(this).attr("id")+' input.'+$(this).attr("id")).val(getValue);
        //$('#tablenameOffer tr').removeClass('editableofferrow');
        $(this).val('');
      })
    });

    $('#pro_add_rates').click(function(){
  
     var tds='';

     
      $('.popup_rates input').each(function(){        
        var getValue=$(this).val();
        var id=$(this).attr('id');
        if(getValue == ''){
          tds = '';
          alert('Please Enter the Mandatory Fields !!');
          return false; 
        } else {
          tds+='<td class="'+$(this).attr("id")+'" >'+getValue+'<input type="hidden" class="'+$(this).attr("id")+'" name="'+$(this).attr("id")+'[]" value="'+getValue+'"></td>';
        }
        
       
      });
      if(tds !== ''){
       $('#tablename tbody').append(`
          <tr>
            ${tds}<td><button type="button" class="btn btn-primary btn-sm editratebtn" data-toggle="modal" data-target="#addmorerates"><i class="fa fa-pencil"></i></button><button type="button" class="btn btn-primary btn-sm deleteratebtn" data-toggle="modal" data-target="#addmorerates"><i class="fa fa-trash"></i></button></td>          
          </tr>

          `);
      }
     // $('.popup_offer input').val('');

    }); 


    //edit rate function 

    $(document).on('mouseup','.editratebtn',function(){
      $('#pro_add_rates').addClass("hide");
            $('.updatesRatesBtn').removeClass('hide');
      //$(this).parents('tr').remove();
      $(this).parents('tr').siblings().removeClass('editablerow');
       $(this).parents('tr').addClass('editablerow');
      
      $('.popup_rates input').each(function(){        
        var getValue=$('tr.editablerow td.'+$(this).attr("id")).text();
        $(this).val(getValue);
      })
    });
    $(document).on('mouseup','.deleteratebtn',function(){
      $(this).parents('tr').remove();
    });
    $(document).on('click','.updatesRatesBtn',function(e){
      $('.popup_rates input').each(function(){        
        var getValue=$(this).val();
        $('html,body').find('tr.editablerow td.'+$(this).attr("id")+'').text(getValue);
        //$('html,body').find('tr.editablerow td.'+$(this).attr("id")+' input.'+$(this).attr("id")).val(getValue);
        $(this).val('');
      })
    });
    /*$(document).on('click','table.month1 td div.last-date-selected',function(e){
        
     });*/
  $(document).ready(function(){
       
     /* $('#booking-calendar').dateRangePicker().bind("datepicker-change", function(event, obj){
        //
        var date=obj.value.split(' ');

        var startdate = date[0];
        var enddate = date[2];
        $('.startdatelabel').text(startdate);
        $('.enddatelabel').text(enddate);
        //console.log(obj);
        $('#start_date').val(startdate);
        $('#end_date').val(enddate);
         $('#booking-calendar').find('td div.booked.invalid').addClass('valid').removeClass('invalid booked first-date-booked has-tooltip last-date-booked');

        //$('#booking-calendar').attr('data-booked','')
      })
      $('#editbookingdate').click(function(){
        $('.bookedwrapper').remove();
       $('#booking-calendar').find('td div.booked.invalid').addClass('valid').removeClass('invalid booked first-date-booked has-tooltip last-date-booked');
        $('#booking-calendar').attr('data-booked','');
      })*/
    var token="{{csrf_token()}}";

    var url="{{url('admin')}}";

    $('#new_rate').mousedown(function(){
        $('.updatesRates').addClass("hide");
        $('.updatesRatesBtn').addClass("hide");
            $('#pro_add_rates').removeClass('hide');
       $('.popup_rates input[type="text"]').val('');
       $('.popup_rates input[type="date"]').val('');
       $('#updatePropRates').css('display','none');
    });

    $('#new_offer').mousedown(function(){
      $('.updatesOffer').addClass("hide");
      $('.updatesOfferBtn').addClass("hide");
            $('#pro_add_offer').removeClass('hide');
      $('.popup_offer input[type="text"]').val('');
      $('.popup_offer input[type="date"]').val('');
      $('.popup_offer').find('select').val('');
    })
    $('.editdbcal').click(function(){
      
      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      $.ajax({
           url:url+'/property/edit-db-cal',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
          
               if(data.status==1){
               var value=data.data;
                //$('#').val() 
               $('#calid').val(value.id); 
               $('#ustart').val(value.start_date);
               $('#uend').val(value.end_date);
               $('#my-cal').modal();
             }
             },
        failure:function(status){
           
        }

      });
      
    });
    
    $(document).on('click', '.update_cal', function(e){
         
      var id=$('#calid').val();
      var start=$('#ustart').val();
      var end=$('#uend').val();
      
      var data={_token:token,id:id,start:start,end:end};

      var status=confirm('Are Want to Update This Slot!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/update-cal',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Slot Updated Successfully !</h4>');
            
          }
           
          //$('#addmorerates').hide();


        },

        failure:function(status){

          console.log(status);

        }

      });

    });

    $('.editRates').click(function(){
      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      $.ajax({

        url:url+'/property/edit-rates',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               
          console.log(data);

          if(data.status==1){

            var value=data.data;
             var ff = value.fromdate;
             var d = new Date(ff);
             //console.log(value.fromdate);
             var year = d.getFullYear();
             var mm = (M = d.getMonth() + 1)<10?'0'+M:M;
             var dd = (D = d.getDate())<10?'0'+D:D;   
             //alert(mm+'/'+dd+'/'+year);
             var frate = year+'-'+mm+'-'+dd ;
             var tt = value.todate;
             var t = new Date(tt);
             var tyear = t.getFullYear();
             var tmm = (M = t.getMonth() + 1)<10?'0'+M:M;
             var tdd = (D = t.getDate())<10?'0'+D:D;
             var trate = tyear+'-'+tmm+'-'+tdd;

            $('#Season').val(value.season);
            
            $('#From_Date').val(frate);

            $('#To_Date').val(trate);
            $('#Nightly_Rate').val(value.nightrate);
            $('#weekend_rate').val(value.weekend);
            $('#Weekly_Rate').val(value.weekrate);
            $('#Monthly_Rate').val(value.monthrate);
            $('#minimum_stay').val(value.minimumstay);
            $('#Extra_Person').val(value.extraperson);
            $('#Other_Fees').val(value.otherfees);
            $('#rateId').val(value.id);
            
            $('#pro_add_rates').addClass("hide");
            $('.updatesRates').removeClass('hide');
            $('#addmorerates').modal();

          }



        },

        failure:function(status){

          console.log(status);

        }

      });
    });

    $('.editSpecial').click(function(){
      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      $.ajax({

        url:url+'/property/edit-special',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               
          console.log(data);

          if(data.status==1){

            var value=data.data;
            var ff = parseInt(value.specialfrom+123);
             var d = new Date(ff);
             //console.log(value.fromdate);
             var year = d.getFullYear();
             var mm = (M = d.getMonth() + 1)<10?'0'+M:M;
             var dd = (D = d.getDate())<10?'0'+D:D;   
             //alert(mm+'/'+dd+'/'+year);
             var ofrate = year+'-'+mm+'-'+dd ;
             var tt = parseInt(value.specialto+123);
             var t = new Date(tt);
             var tyear = t.getFullYear();
             var tmm = (M = t.getMonth() + 1)<10?'0'+M:M;
             var tdd = (D = t.getDate())<10?'0'+D:D;
             var otrate = tyear+'-'+tmm+'-'+tdd;


            $('#dealseason').val(value.tagline);

            $('#specialType').val(value.specialtype);

            $('#OFrom_Date').val(ofrate);
            $('#OTo_Date').val(otrate);
            $('#ONightly_Rate').val(value.nightrate);
            $('#OWeekly_Rate').val(value.weekrate);
            $('#OMonthly_Rate').val(value.monthrate);
            
            $('#offerId').val(value.id);
            
            $('#pro_add_offer').addClass("hide");
            $('.updatesOffer').removeClass('hide');

              $('#addmoredeals').modal();

          }



        },

        failure:function(status){

          console.log(status);

        }

      });
    });

    $('.deleteImage').click(function(){
         
      console.log($(this).attr('data-id'));

      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      var status=confirm('Are Want to Delete This Record!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/delete-image',

        data:data,

        method:'POST',

        success:function(data,status,xhr){

          console.log(data);

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');

          }



        },

        failure:function(status){

          console.log(status);

        }

      });

    });

    $('.deleteRates').click(function(){
         
      console.log($(this).attr('data-id'));

      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      var status=confirm('Are Want to Delete This Record!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/delete-rates',

        data:data,

        method:'POST',

        success:function(data,status,xhr){

          console.log(data);

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');

          }



        },

        failure:function(status){

          console.log(status);

        }

      });

    });

    $('.delete_db_cal').click(function(){
         
      console.log($(this).attr('data-id'));

      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      var status=confirm('Are Want to Delete This Record!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/delete-db-cal',

        data:data,

        method:'POST',

        success:function(data,status,xhr){

          console.log(data);

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');

          }



        },

        failure:function(status){

          console.log(status);

        }

      });

    });

    $('.deleteSpecial').click(function(){
         
      console.log($(this).attr('data-id'));

      var id=$(this).attr('data-id');

      var data={_token:token,id:id};

      var status=confirm('Are Want to Delete This Record!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/delete-special',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
            
          console.log(data);

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Record Deleted !</h4>');

          }



        },

        failure:function(status){

          console.log(status);

        }

      });

    });
    
    

    $('.editCaption').click(function(){
         
      console.log($(this).attr('data-id'));

      var id=$(this).attr('data-id');
      var editCaption=$('#editCaption'+id).val();
      var data={_token:token,id:id,caption:editCaption};

      var status=confirm('Are Want to Update This Caption!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/update-caption',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               
          console.log(data);

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Caption Updated Successfully !</h4>');

          }
 
          
        },

        failure:function(status){

          console.log(status);

        }

      });

    });
    $(document).on('click', '.updatesRates', function(e){
      var id=$('#rateId').val();
      var season=$('#Season').val();
      var from=$('#From_Date').val();
      var to=$('#To_Date').val();
      var night=$('#Nightly_Rate').val();
      var weekend=$('#weekend_rate').val();
      var weekly=$('#Weekly_Rate').val();
      var monthly=$('#Monthly_Rate').val(); 
      if(id == '' || season == '' || from == '' || to == '' || night == '' || weekend == '' || weekly == '' || monthly == ''){
        alert('All Fields Are Mendatory');
        return false;
      }

      var data={_token:token,id:id,season:season,from:from,to:to,night:night,weekend:weekend,weekly:weekly,monthly:monthly};

      var status=confirm('Are Want to Update This Rates!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/update-rates',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Rates Updated Successfully !</h4>');
            
          }
           
          //$('#addmorerates').hide();


        },

        failure:function(status){

          console.log(status);

        }

      });

    });

    $(document).on('click', '.updatesOffer', function(e){
         

      var id=$('#offerId').val();
      var season=$('#dealseason').val();
      var type =$('#specialType').val();
      var from=$('#OFrom_Date').val();
      var to=$('#OTo_Date').val();
      var night=$('#ONightly_Rate').val();
      var weekly=$('#OWeekly_Rate').val();
      var monthly=$('#OMonthly_Rate').val();

      var data={_token:token,id:id,season:season,type:type,from:from,to:to,night:night,weekly:weekly,monthly:monthly};

      var status=confirm('Are Want to Update This Offer!');

        if(!status){

          return false;

        }

      $.ajax({

        url:url+'/property/update-offer',

        data:data,

        method:'POST',

        success:function(data,status,xhr){
               

          if(data.status==1){

            $('#message').html('<h4 class="alert alert-success text-center">Offer Updated Successfully !</h4>');
            
          }
           
          //$('#addmorerates').hide();


        },

        failure:function(status){

          console.log(status);

        }

      });

    });



    $('.reorder_link').on('click',function(){
        
          $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
          $('.reorder_link').html('save reordering');
          $('.reorder_link').attr("id","save_reorder");
          $('#reorder-helper').slideDown('slow');
          $('.image_link').attr("href","javascript:void(0);");
          $('.image_link').css("cursor","move");
          $("#save_reorder").click(function( e ){
            
              if( !$("#save_reorder i").length ){
                
                  $(this).html('').prepend('<h4>Updated</h4>');
                  $("ul.reorder-photos-list").sortable('destroy');
                  $("#reorder-helper").html( "Reordering Photos - This could take a moment. Please don't navigate away from this page." ).removeClass('light_box').addClass('notice notice_error');
                    
                  var h = [];
                  $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                  
                  var id=$(this).attr('data-id');
                  //var data={_token:token, ids: " " + h + ""};
                  $.ajax({
                      type: "POST",
                      url: url+'/property/reorder-image',
                      data: {_token:token, ids:h},
                      success: function(data){
                          
                          //window.location.reload();
                          if(data.status==1){

                            $('#message').html('<h4 class="alert alert-success text-center">Image Reorder Successfully !</h4>');

                          }
                      }
                  }); 
                  return false;
              }   
              e.preventDefault();     
          });
      });

  });


</script>
<script>
/* MULTI-SELECT-SCRIPT */
    $(document).ready(function(){
      var token="{{csrf_token()}}";
      var url="{{url('admin')}}";
    //$('#my-form').hide();
    $('.before-today').click(function(event){
        event.stopPropagation();

    });
  $("div.full-book").parents("td").addClass('complete');
  $("div.first-half-book").parents("td").addClass('start');
  $("div.last-half-book").parents("td").addClass('end');

    $('.booking-box.complete').click(function(event){
        event.stopPropagation();
    });
  $(document).on('click',"div.ac", function(){
  //$('div.ac').click(function(){
    
    //var pro_id = <?php /*echo*/ /*$myVar*/ ?> ;
     var prop_id = 1;
     var aj = $(this).data('seq');
     var someVarName = aj ;
         localStorage.setItem("someVarName", someVarName);
     $('div.ac').removeClass('active');
     $(this).addClass('active');
     var k = $('#demo').append(aj+',');
  var ki = $('#demo').html();
  $.ajax({
    url:url+'/property/prop-dates',
  method: "POST",
  data: {_token:token,data: ki,id:0 }
  //data: $("div#myform :input").serializeArray()
   })

   .done(function( msg ) {
    
  if(msg !=" ")
  {
  var count = ki.split(',').length; // results 4
  if (count % 2 == 0)
  {
  var cc = 'even';
  }
  else
  {
  var cc = 'odd';
  } 

        $('.success-msg').html(msg);
  var msg2 = msg.trim();
  var msg1 = msg2.split(',');
  var arr1 = jQuery.makeArray( msg1 );
  var lastEl = msg1.slice(-1)[0];
  var one = msg1[0];
  var first_date = one.replace('#', '');
  var two = lastEl;
  var last_date = two.replace('#', '');
  fi = $("#first-date").val();
  la = $("#last-date").val();
  
  if((fi ==" ") || (la ==" ") || (arr1 ==" "))
  {
  $( ".booking-box" ).removeClass( "selected" );
  $("#dialog").dialog('close');
  }
  else
  {
  if(cc == 'even')
  {
  $( ".booking-box" ).removeClass( "selected" );
  $("#dialog").dialog('close');
  }

  if(cc == 'odd')
  {

var fvalues=first_date.trim();  
var lvalues=last_date.trim();

if(fvalues=='' || lvalues=='') {
alert('Checkout date should be greater than Checkin date.');
$('div.ac').removeClass('active');
} 
else {
if(fvalues=='zero' || lvalues=='zero') {
alert('Some dates are already booked,Choose another dates.');
$('div.ac').removeClass('active');
}
else if(fvalues=='two' || lvalues=='two') {
alert('Please choose two different dates for booking.');
$('div.ac').removeClass('active');
}
else
{
  
  $("#dialog").dialog({
        height: 1000,
        width: 550,
        resizable: false,
        title: "Get Instant Quote",
        show: {effect: 'drop', direction: "up"},
        close: function(event, ui) {
          $('div.ac').removeClass('active');
          $('.booking-box').removeClass('selected');
          localStorage.clear();
         }
         });
        var s = $("#first-date").val(first_date);
      var l = $("#last-date").val(last_date);
}
}
  
  
  
  jQuery.each( arr1, function( i, val) {
  $( val ).addClass( "selected" );
  // Will stop running after "three"
      //return ( val !== "three" );
  });

         }
      }
    }
    else
          {
    $( ".booking-box" ).removeClass( "selected" );
    $("#dialog").dialog('close');
    }
   });
  });
     });
</script>
<script>
 $(document).ready(function(){
  $("div.ac").on("click", function(){
  //$('div.ac').click(function(){
    
  var aj = $(this).data('seq');
  $('div.ac').removeClass('active');
 $(this).addClass('active');
});

  $("div.full-book").parents("td").addClass('complete');
 $("div.first-half-book").parents("td").addClass('start');
 $("div.last-half-book").parents("td").addClass('end');
  $('.booking-box.complete').click(function(event){
        event.stopPropagation();
    });
    });
</script>
<script>
    $(document).ready(function(){
      $(".leftButton").show();
    })
    </script>
    <?php

    $month_check=date('n');

    $year_check =date('Y');

    $count_month_len = strlen($month_check);

    if($count_month_len==1)
    {

      $new_month = "0".$month_check;

    }

    else

    {

      $new_month = $month_check;

    }
    ?>
<script>
    $(document).ready(function(){
      $(".leftButton").show();
    })
</script>
<script>
$(document).ready(function(){
//$("#tt").hide();
})

</script>

<script>

/*calender back button*/

function goLastMonth(month, year, propId){
  
$(".leftButton").show();

  if(month == 1)

  {
    --year;

    month = 13;

  }
  if(month == 2)

  {
    --year;

    month = 14;

  }

  --month;
    --month;
  var monthstring = ""+month+"";

  var monthlength = monthstring.length;

  if(monthlength <= 1)

  {

    monthstring = "0" + monthstring;

  }

  // document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;


  var element = document.getElementById("pp");
  element.setAttribute("onClick", "goLastMonth("+monthstring+","+year+","+propId+")"); 
  var element = document.getElementById("tt");
  element.setAttribute("onClick", "goNextMonth("+monthstring+","+year+","+propId+")");
  
           // var id = <?php /*echo $myVar*/ ?>;
            var month = monthstring ;
            var year = year ; // or get them from the user's choice. I am hardcoding them here
            var id = propId;
            var token="{{csrf_token()}}";
            var url="{{url('admin')}}";

            $.ajax({url:url+'/property/next-dates',
                'type' : 'post',
                'data' : {_token:token,'month' : month , 'year' : year , 'proId' : id } ,
                'success' : function(data){
                  
                    $('#tabl').html(data.data);
                }
            });

}

/*calender forward button */
function goNextMonth(month, year, propId){
  
  var id=$(this).attr('data-id');
  if(month == 11)
  {
    ++year;
    month = -1;
  }

  if(month == 12)
  {
    ++year;
    month = 0;
  }
  ++month;
  ++month;
  var monthstring = ""+month+"";
  var monthlength = monthstring.length;
  if(monthlength <= 1)
  {
    monthstring = "0" + monthstring;
  }
  // document.location.href = "<?php $_SERVER['PHP_SELF'] ;?>?month="+monthstring+"&year="+year;
   var element = document.getElementById("tt");
  element.setAttribute("onClick", "goNextMonth("+monthstring+","+year+","+propId+")"); 
  var element = document.getElementById("pp");
  element.setAttribute("onClick", "goLastMonth("+monthstring+","+year+","+propId+")"); 
            //var id = <?php /*echo $myVar*/ ?>;
            var month = monthstring ;
            var year = year ; // or get them from the user's choice. I am hardcoding them here
            var id = propId;
            var token="{{csrf_token()}}";
            var url="{{url('admin')}}";

            $.ajax({url:url+'/property/next-dates',
                'type' : 'post',
                'data' : {_token:token,'month' : month , 'year' : year , 'proId' : id } ,
                'success' : function(data){
                  
                    $('#tabl').html(data.data);
                }
            });
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0DaKGlV-AAL09UAREeyUD_DOgEEyLwnU&sensor=false"></script>
<!-- http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false -->
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script>
$(document).ready(function(e) {
  var token="{{csrf_token()}}";
  var url="{{url('admin')}}";
  $('#lati').click(function(){
    
    var address = $('#pAddress').val();
    var city = $('#city option:selected').text();
    var country  = $('#country option:selected').text();
    var area = $('#area option:selected').text();
     var geocoder =  new google.maps.Geocoder();
    geocoder.geocode( { 'address': +address+','+area+','+city+', ' +country }, function(results, status) {
          
          if (status == google.maps.GeocoderStatus.OK) {
            //alert("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng());
            var lat = results[0].geometry.location.lat().toFixed(6);
            var long = results[0].geometry.location.lng().toFixed(6);
            $('#lati').val(lat);
            $('#longi').val(long); 
          } else {
            alert("Something got wrong " + status);
          }
        });
  });
  $('#book-sub').click(function(){
   
  var first_date = $('#first-date').val();
  var last_date = $('#last-date').val();
  var d = new Date();
  var month = d.getMonth() + 1;
  var day = d.getDate();
  var year = d.getFullYear();
  var today = (month<10?'0':'')+ month + '-'  +(day<10?'0':'')+ day + '-' +year; 
   var tdc='';
   tdc+='<td class="fDate" >'+first_date+'<input type="hidden" name="search_startdate[]" value="'+first_date+'"></td><td class="lDate">'+last_date+'<input type="hidden" name="search_enddate[]" value="'+last_date+'"></td><td class="tDate" >'+today+'</td>';
   var num = Math.round(Math.random() * 10);
   $('#hcal tbody').append(`
    <tr>
      ${tdc}<td><button type="button" class="btn btn-primary btn-sm deletecalbtn" data-id="${num}"><i class="fa fa-trash"></i></button></td>          
    </tr>

    `);
     
   //$('#search_startdate').val(first_date);
   //$('#search_enddate').val(last_date);
   $('div.ac').closest('.selected').addClass('dangerbook '+num);
   $('div.ac').closest('.selected').removeClass('selected');
   $('div.ac').removeClass('active');
   $("#dialog").dialog('close');


});
  $(document).on('mouseup','.deletecalbtn',function(){
    
     var cl_S = $(this).attr('data-id');
     $('.'+cl_S).removeClass('dangerbook '+cl_S);
      $(this).parents('tr').remove();
      
    });
  });
</script>
<script>
$(document).ready(function(e) {
window.onbeforeunload = function () {
localStorage.clear();
 }
})
</script>
@endsection