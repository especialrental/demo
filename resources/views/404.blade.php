@extends('layouts.default')





@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/blog/css/main.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="page-section" style="margin-top:25px;">

        <div class="container mt-small-70">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">404</li>

                </ol>

            </nav>

            <!-- Section Title -->

            <!--<div class="section-header">

                <h2 class="section-title">404</h2>

            </div>-->



            <!-- Section Content -->

            <div class="container">

                <div class="row" style="text-align:center;">

                   <!--<img class="img-responsive" src="{{url('/')}}/public/404-page-not-found.svg" alt="">-->
                   
                   <img class="img-responsive" src="{{url('/')}}/public/NOT FOUND.jpg" alt="" style="margin: 0 auto;">
                   
                   <!--<h1 style="text-align: center;color: #ff7226;">404 Page not Found</h1>-->
                    <a href="https://www.especialrentals.com/" class="home btn-submit btn-primary btn" style="background-color: #ff7226;">Go to home</a>



                </div>

            </div>

        </div>

    </section>
    <style>
        .home {
            text-align: center;
        }
    </style>
@endsection
