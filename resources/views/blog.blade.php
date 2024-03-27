@extends('layouts.default')





@section('content')

<?php if(\URL::full() =='https://www.especialrentals.com/blog'){ ?>

<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/bootstrap.css">

   <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/main.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link href="https://fonts.googleapis.com/css2?family=Rubik&amp;display=swap" rel="stylesheet">

   

    <section class="page-section" style="margin-top:25px;">

        <div class="container mt-small-70">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>

                </ol>

            </nav>

            <!-- Section Title -->

            <div class="section-header">

                <h4 class="section-title" style="color: #ff7226;">Blogs</h4>

            </div>



            <!-- Section Content -->

            <div class="container">

         <div class="row">

             

             <?php if(!empty($blog)){

             foreach($blog as $b){?>

            <div class="col-lg-4 col-md-6">

               <div class="single-blog ">

                  <div class="blog-image" style="height: 210px !important;"> 

                     <a href="{{url('/')}}/blogs/{{$b->url}}"> 

                        <img class="img-responsive" src="{{url('/')}}/public/uploads/blog/{{$b->pic}}" alt="blog">

                     </a>

                  </div> 

                  <div class="blog-content" style="height: 188px;>

                     <h4 class="blog-title"><a href="{{url('/')}}/blogs/{{$b->url}}"><?=$b->heading?></a></h4>

                     <p><?=substr($b->short_content,0,50)?>

                     </p>

                     <a href="{{url('/')}}/blogs/{{$b->url}}" class="more">Read more <i class="fa fa-angle-right" aria-hidden="true"></i>

                     </a>

                  </div>

               </div>

            </div>

            <?php } } ?>

            

            

            

            

            

          

               </div>

            </div>

        </div>

    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!-- menu -->

   <script type="text/javascript">

      $(window).scroll(function () {

         if ($(this).scrollTop() > 5) {

            $(".navbar-me").addClass("fixed-me");

         } else {

            $(".navbar-me").removeClass("fixed-me");

         }

      });

   </script>

   <!-- end -->



   <!-- <script type="text/javascript" src="js/jquery.fancybox.js"></script> -->
   <!-- jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Fancybox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


   <script>

      $(document).ready(function () {

         $('.fancybox').fancybox({

            padding: 0,

            maxWidth: '100%',

            maxHeight: '100%',

            width: 560,

            height: 315,

            autoSize: true,

            closeClick: true,

            openEffect: 'elastic',

            closeEffect: 'elastic'

         });

      });

   </script>



   <!-- logo slider -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

   <script type="text/javascript">

      $(document).ready(function () {

         $('.customer-logos').slick({

            slidesToShow: 4,

            slidesToScroll: 1,

            autoplay: true,

            autoplaySpeed: 1500,

            arrows: false,

            dots: false,

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

<?php } else { ?>

<?php header('location:https://www.especialrentals.com/404');?>

<?php } ?>

@endsection