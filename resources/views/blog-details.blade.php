
@extends('layouts.default')


@section('title', $blog->metatag)
 
@section('meta_description', $blog->meta_description)

@section('content')
 

<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/main.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <style>
   .main-commentform h3 {
	font-weight: 500;
	font-size: 20px;
	text-transform: uppercase;
	color: #ff7226;
}
   .main-commentform .form-control {
	border-radius: 0;
	text-shadow: none;
	height: 48px;
	border: 1px solid #ccc;
	outline: none;
	font-size: 14px;
	line-height: 1.7142857143;
	color: #555;
}
.main-commentform #submit-btn {
	color: #fff;
	background-color: #161f28;
	border-color: #161f28;
	padding: 11px 15px;
	font-size: 14px;
	line-height: 1.7142857143;
}
.main-commentform #txt_Message_7 {
	height: 150px;
	resize: none;
}
   </style>
   
  <!-- ====== SINGLE PROPERTY CONTENT ====== -->
<section class="page-section mtb-40">
    <div class="blog-page">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-sm-8">
            <div class="blog-detail">
			<img class="img-responsive" src="{{url('/')}}/public/uploads/blog/{{$blog->pic}}" alt="">
               <h3><?=$blog->heading?></h3>
               <p><?=$blog->description?></p>
                  
            </div>
            <div class="comment_text">
                <h3>Commments</h3>
                <?php foreach($comment as $cm){?>
               <div class="reviews_meta">
                <p><strong><?=$cm->name?> </strong>-  <?=$cm->created_at?></p>
                   <span><?=$cm->user_comment?></span>
               </div>
               <?php } ?>
               </div>
              <div class="main-commentform">
               <h3>Your Commments</h3>
               <form id="cmfrm">
                   <input type="hidden" id="blogid" name="blogid" value="<?=$blog->heading;?>">
                   <input type="hidden" id="blogurl" name="blogurl" value="<?=$blog->url;?>">
                  <div class="form-group">
                     <label>Name</label>
                     <input id="name" name="name" type="text" class="form-control " placeholder="Full Name">
                     <span class="message" id="msgname"></span>
                  </div>
                  <div class="form-group">
                      <label>Phone Number</label> 
                     <input id="phone" name="phone" type="text" class="form-control" placeholder="Mobile Number">
                     <span class="message" id="msgphone"></span>
                  </div>
                  <div class="form-group">
                      <label>Email Address</label> 
                     <input id="email" name="email" type="text" class="form-control" placeholder="Email Address">
                     <span class="message" id="msgemail"></span>
                  </div>
                  <div class="form-group">
                       <label>Comments</label> 
                     <textarea id="comment" name="comment" class="form-control" placeholder="Comments"></textarea>
                     <span class="message" id="msgcomment"></span>
                  </div>
                  <div class="form-group">
                     <input type="button" id="isValidateComments" class="btn btn-primary btn-submit" value="Submit">
                  </div>
               </form>
               <div id="showmsg" style="color: #ff7226;margin-top: -41px;margin-left: 97px;"></div>
            </div>
         </div>
         <div class="col-md-4 col-sm-4 sticky">
            <div class="blog-sidebar-post ">
               <div class="sidebar-title">
                  <h4 class="title">Recent Post</h4>
               </div>
               <ul class="post-items">
                   <?php if(!empty($resent)){
                        foreach($resent as $res){?>
                  <li>
                     <div class="single-post">
                        <div class="post-thumb">
                           <a href="{{url('/')}}/blogs/{{$res->url}}"><img src="{{url('/')}}/public/uploads/blog/{{$res->pic}}" style="width:57px;height:57px;" alt=""></a>
                        </div>
                        <div class="post-content">
                           <h4 class="post-title"><a href="{{url('/')}}/blogs/{{$res->url}}"><?=$res->heading?></a></h4>
                        </div>
                     </div>
                  </li>
                  <?php }} ?>
                  
                  
                  
                  
               </ul>

            </div>

         </div>
      </div>
   </div>
</div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
   
   <script>
       
     
	$(document).on('click','#isValidateComments', function() {
        	if (isValidate()) {
		        var token="{{csrf_token()}}";
                var url="{{url('')}}";
                var name = $('input[name=name]').val();
                var email = $('input[name=email]').val();
                var phone = $('input[name=phone]').val();
                var blogid = $('#blogid').val();
                var blogurl = $('#blogurl').val();
                var comment = $('textarea[name=comment]').val();
        		$.ajax({
        			 url:url+'/blogcomments',
        			data:{name:name,email:email,phone:phone,blogid:blogid,blogurl:blogurl,comment:comment, _token:token},
        			type : 'POST',
        			success : function(result) {
        				if (result.indexOf("1") > -1) {
        					$('#showmsg').html('Your comments sucssefully add');
                			$( '#cmfrm' ).trigger('reset');
        				}else if (result.indexOf("2") > -1) {
        					$("#showmsg").show();
        					$("#showmsg").html("Please try again later.");
        				}
        			}
        		});
        	}
        });
function isValidate() {
	var valid = true;
	var name = $("input[name='name']").val();
	var phone = $("input[name='phone']").val();
	var email = $("input[name='email']").val();
	var comment = $("#comment").val();
	$(".message").hide();
	$(".message").css("color", "red");
	$(".message").css("font-size", "12px");
	$(".message").css("display", "block");
	
	if (name.length == 0) {
		valid = false;
		$("#msgname").html("* Please enter name");
		$("#msgname").show();
	}
	if (phone.length == 0) {
		valid = false;
		$("#msgphone").html("* Please enter your phone no.");
		$("#msgphone").show();
	}
	
	if (comment.length == 0) {
		valid = false;
		$("#msgcomment").html("* Please enter your comment.");
		$("#msgcomment").show();
	}
	
	if (email.length == 0) {
		valid = false;
		$("#msgemail").html("* Please enter your email.");
		$("#msgemail").show();
	}
	
	return valid;
}

   </script>

   <!--FAQ -->
   <script type="text/javascript">
      function toggleIcon(e) {
         $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
      }
      $('.panel-group').on('hidden.bs.collapse', toggleIcon);
      $('.panel-group').on('shown.bs.collapse', toggleIcon);
   </script>
   <!-- END -->

   <!-- slider -->
   <script type="text/javascript">
      $(document).ready(function () {
         $('.customer-logos').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            Loop: true,
            pauseOnHover: true,
            responsive: [{
               breakpoint: 768,
               settings: {
                  slidesToShow: 4
               }
            }, {
               breakpoint: 520,
               settings: {
                  slidesToShow: 3
               }
            }]
         });
      });
   </script>
    </section>

     
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    
@endsection