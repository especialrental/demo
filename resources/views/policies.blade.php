@extends('layouts.default')
@section('content')
<?php if(\URL::full() =='https://www.especialrentals.com/policies'){ ?>
    <section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
            <!-- Section Title -->
            <div class="section-header">
                <h2 class="section-title">About Privacy Policy</h2>
            </div>

            <!-- Section Content -->
            <div class="panel-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-description" style="padding: 25px;">
                                                 
<p style="text-align:justify;">Especial Rentals is committed to ensuring that your privacy is protected. We fully respect your right to privacy, and have put in place this policy to ensure we protect your personal information. Any personal information provided by you to us, will be treated with the high standards of security and confidentiality, strictly in accordance with the Data Protection&nbsp;Act 1998.</p>
<p><strong class="color-theme"><u>What information do we collect?</u></strong></p>
<p>We may collect the following information:</p>
<ul>
  <li>Your name &amp; contact information, including email, Phone number and home address.</li>
  <li>Any other information relevant to your enquiry (i.e. area preference etc.)</li>
</ul>
<p><strong class="color-theme"><u>What we do with the information we collect?</u></strong></p>
<p style="text-align:justify;">Especial Rentals require this information to understand your needs and provide you with a better service, and in particular for the following ways:</p>
<ul>
  <li>To send you periodic email about your booking information and in addition to receiving occasional company updates, special offers, news or other related information which we think you may find interesting using the email address which you have provided.</li>
  <li>From time to time, we may also use your information to contact you for market research purposes.</li>
  <li>We may use the information to improve our services.</li>
</ul>
<p><strong class="color-theme"><u>Protect your information?</u></strong></p>
<p style="text-align:justify;">Especial Rentals have implemented a range of security measures to maintain the safety of your personal information when you add, submit, or access your personal information.</p>
<p><strong class="color-theme"><u>Cookies</u></strong></p>
<p style="text-align:justify;">Yes, small pieces of information, stored in simple text files, placed on your computer by a web site (if you allow). Cookies can be read by the web site on your subsequent visits. The information stored in a cookie may relate to your browsing habits on the web page, or a unique identification number so that the web site can &ldquo;remember&rdquo; you on your return visit. Generally, cookies do not contain personal information from which you can be identified, unless you have furnished such information to the web site.</p>
<p><strong class="color-theme"><u>Do we disclose personal information to third parties?</u></strong></p>
<p>Especial rentals do not sell or disclose or transfer or lease your personal information to third parties. This does not include our trusted parties or affiliates who assist us in conducting our business, or servicing you, so long as those parties agree to keep this information confidential. Especial rentals may also release your information when we believe release is appropriate to comply with the law, enforce our site policies, or protect ours or others&rsquo; rights, property, or security. However, non-personally identifiable visitor information may be provided to other parties for marketing purpose.</p>
<p><strong class="color-theme"><u>Online Privacy Policy Security</u></strong></p>
<p style="text-align:justify;">Especial Rentals are committed to ensuring that your personal information is secure. Online privacy policy security applies to information collected through our website and not to information collected offline.</p>
<p style="text-align:justify;"><strong>Especial Rentals may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes. This policy is effective from 2015.</strong></p>
<p><strong class="color-theme"><u>How you can contact us</u></strong></p>
<p style="text-align:justify;">If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us as soon as possible, at the below address. We will promptly correct any information found to be incorrect.</p>
<p><a href="{{url('/')}}">www.especialrentals.com</a><br />
    <strong>UK:</strong> + 44 (0) 208-099-7520<br />
    <strong>IN:</strong> + 91-844-766-6767<br>
    <strong class="color-theme">Office Address:</strong> 10th Floor, Tower-B,
Unitech Cyber Park,
Sector - 39, Gurgaon,
Haryana, INDIA - 122003.
</p>
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
<?php } else { ?>
<?php header('location:https://www.especialrentals.com/404');?>
<?php } ?>
@endsection