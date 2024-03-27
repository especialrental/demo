@extends('layouts.default')
@section('content')
<?php if(\URL::full() =='https://www.especialrentals.com/about-us'){ ?>
    <section class="page-section" style="margin-top:25px;">
        <div class="container mt-small-70">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
            <!-- Section Title -->
            <div class="section-header">
             <div class="tab_area">
              <div class="tab_box">
               <button class="tab_btn " style="display:none;">About Us</button>
               <button class="tab_btn active">Who We Are</button> 
               <button class="tab_btn">Why Book With Us</button>
               <div class="line"></div>
              </div>
              <div class="content_box">
               <div class="content" style="display:none;">
                 <p>We are a vacation rental agency based in New Delhi. We offer carefully hand-picked vacation rentals to our business or leisure travelers, from short term to long term rentals in London, Paris, New York, Rome, Dublin and different parts of the world.</p>
                 <p>With our wide portfolio of the vacation rentals in all locations, we can meet all your needs, whether you are travelling for business or for pleasure, as a couple or family we can offer you the perfect Vacation rental.</p>
                 <p>As a modern day Vacation Rental agency we have adopted an approach that differs from more traditional agents. We also recognize that our clients are our judge and jury, and it is this philosophy that shapes and drives our commitment for you.</p>
                 <p>At Especial Rentals we believe that our business is not just about offering best Vacation rentals but also to ensure that our professional and dedicated staff works hard to make the entire process as simple and efficient as possible for all parties concerned.</p>
                 <P>We aim to give all of our guests a truly unforgettable experience with the personal touch. It is our pleasure to be able to share our Vacation rentals of the top most quality with you, while you take in the wonders and hidden treasures of the World’s greatest cities – we look forward to welcoming you to one of our apartments.</P>
               </div>
               <div class="content active">
                   <p> We are a property management company that caters to the needs of homeowners and
                    tourists alike. We have a wide range of property options in popular destinations in different
                    parts of the world. So while a traveler gets a cozy and comfortable apartment to stay during
                    their holiday, the homeowners get a chance to get monetary perks from their vacation
                    homes.</p>
                    
                    <p>Every property listed under us has bespoke interiors and is fully equipped with all the latest
                    amenities. So whichever property you pick, rest assured that you will get all the essentials to
                    make your stay utterly comfortable and get a luxurious experience.</p>
                    
                    <p>At Especial Rentals, we take care of the varied requirements of our clients. We offer small
                    studio apartments equipped with luxury for solo travelers and a multi-bedroom property for
                    families who would love their peaceful time together during their vacation. All you have to
                    do is explore the options and see which aptly resonates with your requirements.</p>
               </div> 
               <div class="content">
                 <p> We understand that people plan vacations to relax and rejuvenate themselves, and
                    accommodation plays a significant role in achieving that peace. Hence, we emphasize
                    offering properties that meet the idea of peace, luxury, comfort, and connectivity. Every
                    property is a perfect amalgamation of homely vibes and luxurious amenities. When at
                    Especial Rentals, rest assured your choices will only get better and best. There is no way you
                    would regret renting a place.</p>
                    
                    <p>Our key highlight is our accessibility and customer-friendly approach. We manage the
                    vacation rentals offline and online, so anybody traveling from a far-off place can make prior
                    bookings and travel peacefully, knowing they have a perfect place to break in as they land!
                    Our website shows all the property options and their details which travelers can check and
                    easily book online.</p>
                    
                    <p>We proudly boast our wide range of properties in some of the most popular cities around
                    the globe. Places where you would want to come over and over again as they have
                    something new to offer every time you visit them. The best part is that our vacation rentals
                    are located at places from where the connectivity to the rest of the city is excellent. So, the
                    commute will never be an issue. You can visit the top tourist attractions and explore the
                    place like locals.</p>
                    
                    <p>Apart from a wide range of options and luxurious apartment choices, our staff ensures that
                    every guest visiting our vacation rentals gets an unforgettable experience. We are here to
                    answer all your queries and provide whatever assistance you require for your stay. It is like
                    having somebody just a call away if you face any issues.</p>
                    
                    <h4 style="color: #ff7226;">Sense Of Security</h4>
                    
                    <p>Traveling to a foreign land, your concern about safety is understandable. You would want a
                        safe and secure place for yourself and your loved ones, eliminating every chaos that can
                        turn your experience sour. Working on this vision, we do everything possible to ensure your
                        safety.</p>
                        
                        <ul>
                            <li>Our dedicated team verifies every property before listing it on the platform, and only the best ones pass their stringent quality and safety check</li>
                            <li>We collaborate with homeowners who share the same values in terms of commitment to providing the best experience to the guests</li>
                            <li>The entire focus is on giving a balanced vibe of a cozy home and a luxurious hotel</li>
                            <li>There is a secured payment gateway, so you do not have to worry about payment failures</li>
                            <li>We have an easy refund policy to cover the situations if you have to cancel the booking for some reason</li>
                            <li>You get a dedicated stay manager who accommodates your requests and resolves your queries during the stay</li>
                        </ul>
                        
                        <p>Especial Rentals leaves no stone unturned in ensuring all the guests enjoy a safer and more comfortable stay.</p>
                        
                        <h4 style="color: #ff7226;">Corporate Packages</h4>
                        
                        <p>We cater to our corporate clients, accommodating their business needs through our customized packages. We understand that organizations have varied requirements. They
                        need per night stays for their staff who visit for a conference or a meeting, a short-term stay
                        for people who have relocated to another destination, and likewise.</p>
                        
                        <p>With our corporate packages, all of these requirements get better catered. After sharing
                        their requirements with our team, companies can rent a home for whatever duration they
                        want. Renowned companies worldwide have been our priced guests and have availed of our
                        corporate packages. The legacy of more than a decade and a huge clientele speaks for us
                        and indicates how well we have performed over the years.</p>
                        
                        <p>So, if you also have your team traveling places for work, we have got your stay sorted.
                        Discuss all your requirements in detail with our team, and they will provide you with all the
                        possible arrangements. We would be delighted to customize the packages for you, covering
                        your specific needs and fitting your budget constraints.</p>
                        
                        <p>Want to get a tailor-made corporate stay arrangement? Then, get in touch with us!</p>
               </div>
               
              </div>
            </div> 
            </div>
            

        </div>
    </section>
    <style>
.section-header .tab_area{
    width: 100%;
    margin: 0;
    padding: 0px;
}
 .section-header .tab_area .tab_box{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content:left;
    font-size: 18px;
    position: relative;
    margin-bottom: 20px;
    margin-top: 15px;
}
 .section-header .tab_area .tab_box button{
    max-width: 360px;
    background-color: transparent;
    outline: 0;
    border: 0;
    margin: 0;
    border-radius: 0;
    /*position: relative;*/
    padding: 12px 16px;
    min-height: 48px;
}
 .section-header .tab_area .tab_box .tab_btn.active{
    color:#ff7226;
}
 .section-header .tab_area .tab_box .line{
    position: absolute;
    top: 45px;
    left: 8px;
    width: 103px;
    height:2px;
    background: #ff7226;
    transition: all .3s ease-in-out;
}
 .section-header .tab_area .content_box .content{
    display: none;
    animation: moving .5s ease;
}
@keyframes moving{
    from{transform: translateX(50px);opacity: 0;}
    to{transform: translateX(0px);opacity: 1;}
}
 .section-header .tab_area .content_box .content.active{
    display: block;
}
    </style>
            
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
    <script type="text/javascript">
      const tabs = document.querySelectorAll('.tab_btn');
      const all_content = document.querySelectorAll('.content'); 

      tabs.forEach((tab, index)=>{
          tab.addEventListener('click', (e)=>{
          tabs.forEach(tab=>{tab.classList.remove('active')});
          tab.classList.add('active');

          var line = document.querySelector('.line');
          line.style.width = e.target.offsetWidth + "px";
          line.style.left = e.target.offsetLeft + "px";

          all_content.forEach(content=>{content.classList.remove('active')});
          all_content[index].classList.add('active');

        })

      })
    </script>
<?php } else { ?>
<?php header('location:https://www.especialrentals.com/404');?>
<?php } ?>
@endsection 