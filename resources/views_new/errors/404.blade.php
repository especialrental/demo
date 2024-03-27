@extends('layouts.default')


@section('content')


<section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">404</li>
                </ol>
            </nav>
            <!-- Section Title -->
            <div class="section-header">
                <h2 class="section-title">404</h2>
            </div>

            <!-- Section Content -->
            <div class="container">
         <div class="row">
             <h1 style="text-align: center;color: #ff7226;">404 Page not Found</h1>
          
               </div>
            </div>
        </div>
    </section>


@endsection