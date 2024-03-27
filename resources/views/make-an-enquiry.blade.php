@extends('layouts.default')
@section('content')
    <section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Make an enquiry</li>
                </ol>
            </nav>
            

            <!-- Section Content -->
            <div class="panel-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-description" style="padding: 25px;">
                            
            <div class="mainsec">
                
               <form class="contact-form info" id="contactinfo">
                   <style>
                       :required:focus {
                          box-shadow: 0  0 6px rgba(255,0,0,0.5);
                          border: 1px red solid;
                          outline: 0;
                        }
                   </style>
               <div class="row">
                  <div class="col-lg-3">
                      <span class="message" id="msgfname"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="uname" placeholder="First Name" name="fname" required="">
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-3">
                      <span class="message" id="msglname"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="uname" placeholder="Last Name" name="lname" required="">
                     </div>
                     
                  </div>
                  
                  
                  <div class="col-lg-3">
                       <span class="message" id="msgemail"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="Last-Name" placeholder="Email" name="email" required="">
                     </div>
                    
                  </div>
                  
                  <div class="col-lg-3">
                      <span class="message" id="msgmobile"></span>
                     <div class="form-group">
                        <input type="text" class="form-control" id="mobile" placeholder="Phone Number" max="10" min="10" name="mobile" required="">
                     </div>
                     
                  </div>
                  
                  
                  
                   <div class="col-lg-3">
                        <label style="margin:0px;">Check-in Date</label>
                       <span class="message" id="msgsearch_startdate"></span>
                     <div class="form-group">
                          <input id="search_startdate" type="date" name="search_startdate" class="form-control" placeholder="Check-in Date" required="">
                    </div>
                    </div>
                 <div class="col-lg-3">
                     <label style="margin:0px;">Check-out Date</label>
                     <span class="message" id="msgsearch_enddate"></span>
                     <div class="form-group">
                      <input type="date" id="search_enddate" name="search_enddate" class="form-control" placeholder="Check-out Date" required="">
                    </div>
                    </div>
                    <div class="row" style="margin-bottom:24px;z-index:1;margin-left: 3px; margin-right: 0;">
                  
                    
                    <div class="col-lg-3">
                        <label style="margin:0px;"></label>Adult
                        <span class="message" id="msgcount_guests"></span>
                     <div class="form-group">
                        <input type="number" class="form-control" id="count_guests" placeholder="Adult" name="count_guests" required="">
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-3">
                        <label style="margin:0px;"></label>Child
                         <span class="message" id="msgcount_children"></span>
                     <div class="form-group">
                        <input type="number" class="form-control" id="count_children" placeholder="Child" name="count_children" required="">
                     </div>
                    
                  </div>
                  
                </div>
               
               <div class="col-lg-12">
                     <div class="form-group">
                         <span class="message" id="msgcity"></span>
                        <select class="form-control" id="city" name="city" required="">
                        <option value="">Select Your Location </option>
                        <?php foreach($city as $c){?>
                        <option value="<?php echo $c->city_name;?>">{{$c->city_name}}</option>
                        <?php } ?>
                        </select>
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-12">
                     <div class="form-group">
                         <span class="message" id="msghow_did_you"></span>
                        <select class="form-control" name="how_did_you" id="how_did_you" required="">
                        <option value="">How did you hear about us?</option>
                          <option value="Google">Google</option>
                          <option value="Yahoo">Yahoo</option>
                          <option value="Airbnb">Airbnb</option>
                          <option value="Blog">Blog</option>
                          <option value="VRBO">VRBO</option>
                          <option value="Bookings.com">Bookings.com</option>
                          <option value="TripAdvisor">TripAdvisor</option>
                          <option value="Social media (Facebook, Twitter, Instagram etc)">Social media (Facebook, Twitter, Instagram etc)</option>
                          <option value="Recommendation from another guest.">Recommendation from another guest.</option>
                        </select>
                        
                     </div>
                     
                  </div>
                  
                  <div class="col-lg-12">
                      <span class="message" id="msgdes"></span>
                     <textarea class="form-control" rows="5" name="des" placeholder="Message" required=""></textarea>
                     
                      <!--<button type="submit" class="btn btn-primary pull-right btn-submit">Send Message</button>-->
                      <input type="button" id="isValidateContact" class="btn btn-primary pull-right btn-submit" value="Submit">
                  </div>
                 
                 
                                            
               </div>
            </form>
            </form>
            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
            .headerrelative.navbar.navbar-default {
            background: url({{url('/')}}/public/frontend/images/header_bg.jpg);
            .layer {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                background-color: rgba(0, 0, 0, 0.5);
            }
            video {
                position: absolute;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
            }
            footer {
                position: relative;
                z-index: 2;
            }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
        $(document).on('click','#isValidateContact', function() {
        	if (isValidateCity()) {
		        var token="{{csrf_token()}}";
                var url="{{url('')}}";
                var fname = $('input[name=fname]').val();
                var lname = $('input[name=lname]').val();
                var email = $('input[name=email]').val();
                var mobile = $('input[name=mobile]').val();
                var city = $('#city').val();
                 var how_did_you= $('#how_did_you').val();
                var des = $('textarea[name=des]').val();
                var search_startdate = $('#search_startdate').val();
                var search_enddate = $('#search_enddate').val();
                var count_guests = $('input[name=count_guests]').val();
                var count_children = $('input[name=count_children]').val();
		$.ajax({
			 url:url+'/property/info',
			data:{fname:fname,lname:lname,email:email,mobile:mobile,city:city,how_did_you:how_did_you,des:des,search_startdate:search_startdate,search_enddate:search_enddate,count_guests:count_guests,count_children:count_children, _token:token},
			type : 'POST',
			success : function(result) {
				if (result.indexOf("1") > -1) {
					window.location.href = url +'/property/contact-thank-you';
        			$( '#contactinfo' ).trigger('reset');
				}else if (result.indexOf("2") > -1) {
					$("#messagevalidate").show();
					$("#messagevalidate").html("Please try again later.");
				}
			}
		});
	}
});	
function isValidateCity() {
	var valid = true;
	var city = $("#city").val();
	var fname = $('input[name=fname]').val();
    var lname = $('input[name=lname]').val();
    var email = $('input[name=email]').val();
    var mobile = $('input[name=mobile]').val();
    var city = $('#city').val();
     var how_did_you= $('#how_did_you').val();
    var des = $('textarea[name=des]').val();
    var search_startdate = $('#search_startdate').val();
    var search_enddate = $('#search_enddate').val();
    var count_guests = $('input[name=count_guests]').val();
    var count_children = $('input[name=count_children]').val();
    
	$(".message").html("&nbsp;");
	$(".message").css("color", "red");
	$(".message").css("font-size", "10px");
	$(".message").css("display", "block");
	$(".message").hide();
	
	if (city.length == 0) {
		valid = false;
		$("#msgcity").html("Select your location");
		$("#msgcity").show();
	}
	if (fname.length == 0) {
		valid = false;
		$("#msgfname").html("Enter first name");
		$("#msgfname").show();
	}
	
	if (lname.length == 0) {
		valid = false;
		$("#msglname").html("Enter last name");
		$("#msglname").show();
	}

    // Email validation
    if (email.length == 0) {
        valid = false;
        $("#msgemail").html("Enter email");
        $("#msgemail").show();
    } else {
        var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!emailRegex.test(email)) {
            valid = false;
            $("#msgemail").html("Enter a valid email");
            $("#msgemail").show();
        }
    }
	
	if (mobile.length == 0) {
		valid = false;
		$("#msgmobile").html("Enter mobile");
		$("#msgmobile").show();
	}
	if (how_did_you.length == 0) {
		valid = false;
		$("#msghow_did_you").html("Select How did you hear about us?");
		$("#msghow_did_you").show();
	}
	
	if (des.length == 0) {
		valid = false;
		$("#msgdes").html("Enter comments");
		$("#msgdes").show();
	}
	
	if (search_startdate.length == 0) {
		valid = false;
		$("#msgsearch_startdate").html("Check-in Date");
		$("#msgsearch_startdate").show();
	}
	
	if (search_enddate.length == 0) {
		valid = false;
		$("#msgsearch_enddate").html("Check-out Date");
		$("#msgsearch_enddate").show();
	}
	
	if (count_guests.length == 0) {
		valid = false;
		$("#msgcount_guests").html("Enter adult");
		$("#msgcount_guests").show();
	}
	
	if (count_children.length == 0) {
		valid = false;
		$("#msgcount_children").html("Enter children");
		$("#msgcount_children").show();
	}
	
	return valid;
}

</script>

@endsection