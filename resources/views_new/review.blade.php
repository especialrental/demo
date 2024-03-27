@extends('layouts.default')
@section('content')
    <section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                </ol>
            </nav>
            <!-- Section Title -->
            <div class="section-header">
                <h2 class="section-title">Reviews</h2>
            </div>

            <!-- Section Content -->
            <div class="panel-box">
                <div class="row">
                    <div class="col-md-4">
                        
                            <div id="comments" class="comments-area compact">
                                                <div class="entry-comments">
                            <ol class="comment-list">
                            <!-- Comment Parent  -->
							                                                            <li class="comment">
                                    <div class="comment-body" style="display: flex">
                                        <div class="comment-avatar">
                                            <img src="https://www.especialrentals.com/public/frontend/images/img_author_default.jpg" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-author">
                                                <a href="javascript:">Tang</a>
                                                                                                <span class="comment-date fa fa-calendar-o"> 08/10/2022</span>
                                            </div>
                                            <div class="rating">
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         <i class="fa fa-star" aria-hidden="true"></i> 
                                                                                       </div>
                                            <p>Overall, it feels okay. The location is speechless. Although it's a little noisy at night, it's still acceptable because it's in the heart of London!</p>
                                            <!-- <div class="comment-meta comment-meta-data">
                                                <a class="comment-edit-link" href="#">(Edit)</a>
                                            </div> -->
                                        </div>
                                    </div>
                                     
                                </li>
									                                    
                                </ol>
                            </div>
                                                    </div>
                    </div>
                    
                    <div class="col-md-4">
                        
                            <div id="comments" class="comments-area compact">
                                                <div class="entry-comments">
                            <ol class="comment-list">
                            <!-- Comment Parent  -->
							                                                            <li class="comment">
                                    <div class="comment-body" style="display: flex">
                                        <div class="comment-avatar">
                                            <img src="https://www.especialrentals.com/public/frontend/images/img_author_default.jpg" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-author">
                                                <a href="javascript:">Tang</a>
                                                                                                <span class="comment-date fa fa-calendar-o"> 08/10/2022</span>
                                            </div>
                                            <div class="rating">
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         <i class="fa fa-star" aria-hidden="true"></i> 
                                                                                       </div>
                                            <p>Overall, it feels okay. The location is speechless. Although it's a little noisy at night, it's still acceptable because it's in the heart of London!</p>
                                            <!-- <div class="comment-meta comment-meta-data">
                                                <a class="comment-edit-link" href="#">(Edit)</a>
                                            </div> -->
                                        </div>
                                    </div>
                                     
                                </li>
									                                    
                                </ol>
                            </div>
                                                    </div>
                    </div>
                    
                    <div class="col-md-4">
                        
                            <div id="comments" class="comments-area compact">
                                                <div class="entry-comments">
                            <ol class="comment-list">
                            <!-- Comment Parent  -->
							                                                            <li class="comment">
                                    <div class="comment-body" style="display: flex">
                                        <div class="comment-avatar">
                                            <img src="https://www.especialrentals.com/public/frontend/images/img_author_default.jpg" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-author">
                                                <a href="javascript:">Tang</a>
                                                                                                <span class="comment-date fa fa-calendar-o"> 08/10/2022</span>
                                            </div>
                                            <div class="rating">
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         
                                                <i class="fa fa-star color-theme theme-color" aria-hidden="true"></i>
                                                
                                                                                         <i class="fa fa-star" aria-hidden="true"></i> 
                                                                                       </div>
                                            <p>Overall, it feels okay. The location is speechless. Although it's a little noisy at night, it's still acceptable because it's in the heart of London!</p>
                                            <!-- <div class="comment-meta comment-meta-data">
                                                <a class="comment-edit-link" href="#">(Edit)</a>
                                            </div> -->
                                        </div>
                                    </div>
                                     
                                </li>
									                                    
                                </ol>
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

@endsection