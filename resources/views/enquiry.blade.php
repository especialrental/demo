@extends('layouts.default')

@section('content')
    <style>
        .pr_img {

            width: 100%;

            height: 404px;

        }

        .pr_img img {

            width: 100%;

            height: 100%;

            object-fit: cover;

        }

        .fr_make h3 {

            margin-top: 0px;

            margin-bottom: 35px;

            color: #ff7226;

            font-size: 22px;

            font-weight: 600;

        }

        .section-header2 {

            position: relative;

            background-color: #fff;

            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);

            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);

            padding: 24px;

            margin-bottom: 24px;

        }

        .booking-form {

            width: 100%;

            margin-top: 30px;

        }

        .pr_top_sec {

            padding: 0px;

        }

        .pr_top_sec .top-section-left .first_line h1 {

            font-size: 20px;

        }

        .value {

            font-weight: 700;

        }

        .property .item {

            width: 32% !important;

        }

        .pr-info {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: space-between;

            flex-wrap: wrap;

            position: absolute;

            left: -58px;

            top: 27px;

            background: #fff;

            padding: 15px;

        }

        .pr-info .date-info {

            margin-left: 50px;

        }

        .form-control,
        #comments #respond .comment-form p textarea,
        #comments #respond .comment-form p input:not(.submit) {

            display: block;

            width: 100%;

            height: 48px;

            padding: 6px 12px;

            font-size: 14px;

            line-height: 1.7142857143;

            color: #555;

            background-color: #fff;

            background-image: none;

            border: 1px solid #ccc;

            outline: none;

        }

        .booking-progress-wrap {

            position: relative;

            padding: 16px 0 30px;

        }



        .booking-progress-wrap .progress-bar {

            background: #ff7226 !important;

            /*border-radius: 3px;*/

        }

        .booking-progress-wrap .progress {

            height: 3px;

            background-color: #ff7226;

            /*border-radius: 3px;*/

        }

        .booking-progress-step {

            position: absolute;

            left: 0;

            top: -2px;

            width: 100%;

        }

        .booking-progress-step ul {

            display: flex;

            align-items: center;

            justify-content: space-evenly;
            ;

        }

        .booking-progress-step ul li {

            text-align: center;

            list-style: none;

            display: flex;

            justify-content: space-evenly;

            align-items: baseline;

            background: #ffff;

            padding: 0px 15px;

        }

        .booking-progress-step ul li .icon {

            width: 37px;

            height: 37px;

            flex: 0 0 37px;

            /* margin: 0 auto 8px; */

            background: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            border: 3px solid #ff7226;

            font-size: 14px;

            font-weight: 800;

            color: #222222;

        }

        .booking-progress-step ul li>span {

            display: block;

            font-size: 14px;

            font-weight: 700;

            color: #222222;

            line-height: 1;

            margin-left: 15px;

        }

        @media screen and (max-width: 767px) {

            .pr-info {

                position: relative;

                left: 0;

                padding: 15px 0px;

            }

            .pr-info .date-info {

                margin-left: 0px;

            }

            .pr_img {

                height: 300px;

            }

        }

        @media (min-width: 1200px) {

            .stay-info {

                width: 68%;

            }



            .pr_top_sec .top-section-left .first_line h1 {

                font-size: 18px;

            }

            .pr-info .date-info {

                margin-left: 0px;

            }

            textarea.form-control {

                height: 98px;

            }

        }
    </style>

    <section class="page-section" style="margin-top:25px;">

        <div class="container mt-small-70">

            <!--<nav aria-label="breadcrumb">-->

            <!--    <ol class="breadcrumb">-->

            <!--        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>-->

            <!--        <li class="breadcrumb-item active" aria-current="page">Make An Enquiry</li>-->

            <!--    </ol>-->

            <!--</nav>-->



            <!-- Section Title -->

            <div class="section-header2">

                <!--<div class="row">-->

                <!-- <div class="booking-progress-wrap">-->

                <!--     <div class="progress">-->

                <!--         <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->

                <!--     </div>-->

                <!--     <div class="booking-progress-step">-->

                <!--        <ul>-->

                <!--            <li class="active">-->

                <!--                <div class="icon">1</div>-->

                <!--                <span>Your Stay</span>-->

                <!--            </li>-->

                <!--            <li>-->

                <!--                <div class="icon">2</div>-->

                <!--                <span>Payment</span>-->

                <!--            </li>-->

                <!--        </ul>-->

                <!--    </div>-->

                <!-- </div>     -->

                <!--</div>    -->







                <div class="row">

                    @php

                        $img = \App\Model\PropertyGallery::where('propertyid', $properties->id)
                            ->orderby('photoorder', 'ASC')
                            ->get();

                        $username = isset($img->first()->photoname) ? $img->first()->photoname : '';

                    @endphp

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                        <div class="pr_img">

                            <img src="{{ url('public/uploads/property_image') }}/{{ $properties->id }}/{{ $username }}">

                        </div>

                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                        <div class="pr-info">

                            <div class="stay-info">

                                <div class="pr_top_sec">

                                    <div class="top-section-left">

                                        <div class="first_line">

                                            <h1>{{ $properties->propertyname }}</h1>

                                            <div class="f_icon">

                                                <span><i class="fa fa-star" aria-hidden="true"></i></span>

                                                <span><i class="fa fa-star" aria-hidden="true"></i></span>

                                                <span><i class="fa fa-star" aria-hidden="true"></i></span>

                                                <span><i class="fa fa-star" aria-hidden="true"></i></span>

                                                <span><i class="fa fa-star" aria-hidden="true"></i></span>

                                            </div>

                                        </div>





                                        <div class="second_line">

                                            <div class="b_icon">

                                                <span>Property Type </span>

                                                @php

                                                    $type = \App\Model\PropertyType::where('id', $properties->propertytype)->first();

                                                @endphp

                                                <span class="i_org">|</span>

                                                @if ($type)
                                                    <span>{{ $type->categoryname }}</span>
                                                @endif

                                                <span class="i_org">| <i class="fa fa-map-marker"
                                                        aria-hidden="true"></i></span>

                                                <span>{{ $properties->address }}</span>

                                            </div>

                                            <!--<div class="max">-->

                                            <!--  <i class="fa fa-train" aria-hidden="true"></i> Alma Marceau-->

                                            <!--</div>-->

                                        </div>

                                    </div>



                                </div>



                                <div id="calC">

                                    <p class="form-control-static">

                                        <span id="total-night">{{ $daysInDates }}</span> Nights

                                        <span class="value" style="float:right">{{ $curesyml }}<strong> &nbsp;</strong>

                                            <span class="aaaa">{{ number_format($tAmt, 2) }}</span></span>
                                    </p>

                                    <p class="form-control-static">Taxes ({{ $tax }}%) <span class="value"
                                            style="float:right">{{ $curesyml }}<strong>
                                                &nbsp;</strong>{{ number_format($taxCharge, 2) }}</span></p>

                                    <p class="form-control-static">Cleaning Fee<span class="value"
                                            style="float:right"><?php if(!empty($cleanFee)){?>{{ $curesyml }}<strong>
                                                &nbsp;</strong><span
                                                class="bbbb">{{ number_format($cleanFee, 2) }}<?php } else{?> No
                                                Cleaning Fee<?php } ?></span></span></p>

                                    <p class="form-control-static"><strong>Total Amount</strong><span class="value"
                                            style="float:right">{{ $curesyml }}<strong> &nbsp;</strong><span
                                                class="cccc">{{ number_format($totalAmount, 2) }}</span>

                                        </span>

                                    </p>

                                </div>



                                <div class="property">

                                    <div class="item">

                                        <span><i class="fa fa-bed" aria-hidden="true"></i></span>

                                        Beds: {{ $properties->bedrooms }}

                                    </div>

                                    <div class="item">

                                        <span><i class="fa fa-bath" aria-hidden="true"></i></span>

                                        Baths: {{ $properties->baths }}

                                    </div>

                                    <div class="item">

                                        <span><i class="fa fa-bed" aria-hidden="true"></i></span>

                                        Sleep: {{ $properties->sleepsno }}

                                    </div>

                                    <!--<div class="item">-->

                                    <!--  <span><i class="fa fa-bed" aria-hidden="true"></i></span>-->

                                    <!--   Min Night: 30-->

                                    <!--</div>-->

                                </div>

                            </div>

                            <div class="date-info">



                                <?php $date = session()->get('startDate');
                                
                                $endDate = session()->get('endDate');
                                
                                ?>



                                @php

                                @endphp

                                <p>From <strong><?php echo date('l', strtotime($date)); ?>, <?php echo date('d-M-Y ', strtotime($date)); ?> </strong></p>

                                <p>To <strong><?php echo date('l', strtotime($endDate)); ?>, <?php echo date('d-M-Y ', strtotime($endDate)); ?></strong></p>

                            </div>

                            <div class="form-group" id="status"></div>



                            <?php //echo $html;
                            ?>



                        </div>



                    </div>

                </div>



                <div class="row">

                    <div class="booking-form">

                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                            <div class="fr_make">

                                <h3>Booking Enquiry</h3>



                                <form class="needs-validation" action="#" enctype="multipart/form-data"
                                    id="prop_enquiry">

                                    @csrf

                                    <input type="hidden" name="guest" id="guest" value="{{ $guests }}">

                                    <input type="hidden" name="night" id="night" value="{{ $daysInDates }}">

                                    <div class="form-body">

                                        <div class="form-group">

                                            <div class="row" style="margin-bottom:30px">

                                                <div class="col-md-2">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <select name="gen" id="gen" required
                                                        class="form-select form-select-sm form-control"
                                                        aria-label=".form-select-sm example">

                                                        <option value="">Gender</option>

                                                        <option value="Mr.">Mr.</option>

                                                        <option value="Mrs.">Mrs.</option>

                                                        <option value="Ms.">Ms.</option>

                                                    </select>

                                                    <span class="message" id="msggen"></span>

                                                </div>

                                                <div class="col-md-5">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <input type="text" id="fname" name="fname"
                                                        class="form-control" placeholder="First Name"
                                                        required="required">

                                                    <span class="message" id="msgfname"></span>

                                                </div>

                                                <div class="col-md-5">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <input type="text" id="lname" name="lname"
                                                        class="form-control" placeholder="Last Name" required="required">

                                                    <span class="message" id="msglname"></span>

                                                </div>

                                            </div>

                                            <div class="row" style="margin-bottom:30px">

                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <select name="mformate" id="mformate"
                                                        class="form-select form-select-sm form-control"
                                                        aria-label=".form-select-sm example">

                                                        <option value="">Country Code</option>

                                                        <option value="93">Afghanistan +93</option>

                                                        <option value="358">Aland Islands +358</option>

                                                        <option value="355">Albania +355</option>

                                                        <option value="213">Algeria +213</option>

                                                        <option value="1684">American Samoa +1684</option>

                                                        <option value="376">Andorra +376</option>

                                                        <option value="244">Angola +244</option>

                                                        <option value="1264">Anguilla +1264</option>

                                                        <option value="672">Antarctica +672</option>

                                                        <option value="1268">Antigua and Barbuda +1268</option>

                                                        <option value="54">Argentina +54</option>

                                                        <option value="374">Armenia +374</option>

                                                        <option value="297">Aruba +297</option>

                                                        <option value="61">Australia +61</option>

                                                        <option value="43">Austria +43</option>

                                                        <option value="994">Azerbaijan +994</option>

                                                        <option value="1242">Bahamas +1242</option>

                                                        <option value="973">Bahrain +973</option>

                                                        <option value="880">Bangladesh +880</option>

                                                        <option value="1246">Barbados +1246</option>

                                                        <option value="375">Belarus +375</option>

                                                        <option value="32">Belgium +32</option>

                                                        <option value="501">Belize +501</option>

                                                        <option value="229">Benin +229</option>

                                                        <option value="1441">Bermuda +1441</option>

                                                        <option value="975">Bhutan +975</option>

                                                        <option value="591">Bolivia +591</option>

                                                        <option value="599">Bonaire, Sint Eustatius and Saba +599
                                                        </option>

                                                        <option value="387">Bosnia and Herzegovina +387</option>

                                                        <option value="267">Botswana +267</option>

                                                        <option value="55">Bouvet Island +55</option>

                                                        <option value="55">Brazil +55</option>

                                                        <option value="246">British Indian Ocean Territory +246</option>

                                                        <option value="673">Brunei Darussalam +673</option>

                                                        <option value="359">Bulgaria +359</option>

                                                        <option value="226">Burkina Faso +226</option>

                                                        <option value="257">Burundi +257</option>

                                                        <option value="855">Cambodia +855</option>

                                                        <option value="237">Cameroon +237</option>

                                                        <option value="1">Canada +1</option>

                                                        <option value="238">Cape Verde +238</option>

                                                        <option value="1345">Cayman Islands +1345</option>

                                                        <option value="236">Central African Republic +236</option>

                                                        <option value="235">Chad +235</option>

                                                        <option value="56">Chile +56</option>

                                                        <option value="86">China +86</option>

                                                        <option value="61">Christmas Island +61</option>

                                                        <option value="672">Cocos (Keeling) Islands +672</option>

                                                        <option value="57">Colombia +57</option>

                                                        <option value="269">Comoros +269</option>

                                                        <option value="242">Congo +242</option>

                                                        <option value="242">Congo, Democratic Republic of the Congo +242
                                                        </option>

                                                        <option value="682">Cook Islands +682</option>

                                                        <option value="506">Costa Rica +506</option>

                                                        <option value="225">Cote D'Ivoire +225</option>

                                                        <option value="385">Croatia +385</option>

                                                        <option value="53">Cuba +53</option>

                                                        <option value="599">Curacao +599</option>

                                                        <option value="357">Cyprus +357</option>

                                                        <option value="420">Czech Republic +420</option>

                                                        <option value="45">Denmark +45</option>

                                                        <option value="253">Djibouti +253</option>

                                                        <option value="1767">Dominica +1767</option>

                                                        <option value="1809">Dominican Republic +1809</option>

                                                        <option value="593">Ecuador +593</option>

                                                        <option value="20">Egypt +20</option>

                                                        <option value="503">El Salvador +503</option>

                                                        <option value="240">Equatorial Guinea +240</option>

                                                        <option value="291">Eritrea +291</option>

                                                        <option value="372">Estonia +372</option>

                                                        <option value="251">Ethiopia +251</option>

                                                        <option value="500">Falkland Islands (Malvinas) +500</option>

                                                        <option value="298">Faroe Islands +298</option>

                                                        <option value="679">Fiji +679</option>

                                                        <option value="358">Finland +358</option>

                                                        <option value="33">France +33</option>

                                                        <option value="594">French Guiana +594</option>

                                                        <option value="689">French Polynesia +689</option>

                                                        <option value="262">French Southern Territories +262</option>

                                                        <option value="241">Gabon +241</option>

                                                        <option value="220">Gambia +220</option>

                                                        <option value="995">Georgia +995</option>

                                                        <option value="49">Germany +49</option>

                                                        <option value="233">Ghana +233</option>

                                                        <option value="350">Gibraltar +350</option>

                                                        <option value="30">Greece +30</option>

                                                        <option value="299">Greenland +299</option>

                                                        <option value="1473">Grenada +1473</option>

                                                        <option value="590">Guadeloupe +590</option>

                                                        <option value="1671">Guam +1671</option>

                                                        <option value="502">Guatemala +502</option>

                                                        <option value="44">Guernsey +44</option>

                                                        <option value="224">Guinea +224</option>

                                                        <option value="245">Guinea-Bissau +245</option>

                                                        <option value="592">Guyana +592</option>

                                                        <option value="509">Haiti +509</option>

                                                        <option value="39">Holy See (Vatican City State) +39</option>

                                                        <option value="504">Honduras +504</option>

                                                        <option value="852">Hong Kong +852</option>

                                                        <option value="36">Hungary +36</option>

                                                        <option value="354">Iceland +354</option>

                                                        <option value="91">India +91</option>

                                                        <option value="62">Indonesia +62</option>

                                                        <option value="98">Iran, Islamic Republic of +98</option>

                                                        <option value="964">Iraq +964</option>

                                                        <option value="353">Ireland +353</option>

                                                        <option value="44">Isle of Man +44</option>

                                                        <option value="972">Israel +972</option>

                                                        <option value="39">Italy +39</option>

                                                        <option value="1876">Jamaica +1876</option>

                                                        <option value="81">Japan +81</option>

                                                        <option value="44">Jersey +44</option>

                                                        <option value="962">Jordan +962</option>

                                                        <option value="7">Kazakhstan +7</option>

                                                        <option value="254">Kenya +254</option>

                                                        <option value="686">Kiribati +686</option>

                                                        <option value="850">Korea, Democratic People's Republic of +850
                                                        </option>

                                                        <option value="82">Korea, Republic of +82</option>

                                                        <option value="381">Kosovo +383</option>

                                                        <option value="965">Kuwait +965</option>

                                                        <option value="996">Kyrgyzstan +996</option>

                                                        <option value="856">Lao People's Democratic Republic +856
                                                        </option>

                                                        <option value="371">Latvia +371</option>

                                                        <option value="961">Lebanon +961</option>

                                                        <option value="266">Lesotho +266</option>

                                                        <option value="231">Liberia +231</option>

                                                        <option value="218">Libyan Arab Jamahiriya +218</option>

                                                        <option value="423">Liechtenstein +423</option>

                                                        <option value="370">Lithuania +370</option>

                                                        <option value="352">Luxembourg +352</option>

                                                        <option value="853">Macao +853</option>

                                                        <option value="389">Macedonia, the Former Yugoslav Republic of
                                                            +389</option>

                                                        <option value="261">Madagascar +261</option>

                                                        <option value="265">Malawi +265</option>

                                                        <option value="60">Malaysia +60</option>

                                                        <option value="960">Maldives +960</option>

                                                        <option value="223">Mali +223</option>

                                                        <option value="356">Malta +356</option>

                                                        <option value="692">Marshall Islands +692</option>

                                                        <option value="596">Martinique +596</option>

                                                        <option value="222">Mauritania +222</option>

                                                        <option value="230">Mauritius +230</option>

                                                        <option value="262">Mayotte +262</option>

                                                        <option value="52">Mexico +52</option>

                                                        <option value="691">Micronesia, Federated States of +691
                                                        </option>

                                                        <option value="373">Moldova, Republic of +373</option>

                                                        <option value="377">Monaco +377</option>

                                                        <option value="976">Mongolia +976</option>

                                                        <option value="382">Montenegro +382</option>

                                                        <option value="1664">Montserrat +1664</option>

                                                        <option value="212">Morocco +212</option>

                                                        <option value="258">Mozambique +258</option>

                                                        <option value="95">Myanmar +95</option>

                                                        <option value="264">Namibia +264</option>

                                                        <option value="674">Nauru +674</option>

                                                        <option value="977">Nepal +977</option>

                                                        <option value="31">Netherlands +31</option>

                                                        <option value="599">Netherlands Antilles +599</option>

                                                        <option value="687">New Caledonia +687</option>

                                                        <option value="64">New Zealand +64</option>

                                                        <option value="505">Nicaragua +505</option>

                                                        <option value="227">Niger +227</option>

                                                        <option value="234">Nigeria +234</option>

                                                        <option value="683">Niue +683</option>

                                                        <option value="672">Norfolk Island +672</option>

                                                        <option value="1670">Northern Mariana Islands +1670</option>

                                                        <option value="47">Norway +47</option>

                                                        <option value="968">Oman +968</option>

                                                        <option value="92">Pakistan +92</option>

                                                        <option value="680">Palau +680</option>

                                                        <option value="970">Palestinian Territory, Occupied +970
                                                        </option>

                                                        <option value="507">Panama +507</option>

                                                        <option value="675">Papua New Guinea +675</option>

                                                        <option value="595">Paraguay +595</option>

                                                        <option value="51">Peru +51</option>

                                                        <option value="63">Philippines +63</option>

                                                        <option value="64">Pitcairn +64</option>

                                                        <option value="48">Poland +48</option>

                                                        <option value="351">Portugal +351</option>

                                                        <option value="1787">Puerto Rico +1787</option>

                                                        <option value="974">Qatar +974</option>

                                                        <option value="262">Reunion +262</option>

                                                        <option value="40">Romania +40</option>

                                                        <option value="7">Russian Federation +7</option>

                                                        <option value="250">Rwanda +250</option>

                                                        <option value="590">Saint Barthelemy +590</option>

                                                        <option value="290">Saint Helena +290</option>

                                                        <option value="1869">Saint Kitts and Nevis +1869</option>

                                                        <option value="1758">Saint Lucia +1758</option>

                                                        <option value="590">Saint Martin +590</option>

                                                        <option value="508">Saint Pierre and Miquelon +508</option>

                                                        <option value="1784">Saint Vincent and the Grenadines +1784
                                                        </option>

                                                        <option value="684">Samoa +684</option>

                                                        <option value="378">San Marino +378</option>

                                                        <option value="239">Sao Tome and Principe +239</option>

                                                        <option value="966">Saudi Arabia +966</option>

                                                        <option value="221">Senegal +221</option>

                                                        <option value="381">Serbia +381</option>

                                                        <option value="381">Serbia and Montenegro +381</option>

                                                        <option value="248">Seychelles +248</option>

                                                        <option value="232">Sierra Leone +232</option>

                                                        <option value="65">Singapore +65</option>

                                                        <option value="721">Sint Maarten +721</option>

                                                        <option value="421">Slovakia +421</option>

                                                        <option value="386">Slovenia +386</option>

                                                        <option value="677">Solomon Islands +677</option>

                                                        <option value="252">Somalia +252</option>

                                                        <option value="27">South Africa +27</option>

                                                        <option value="500">South Georgia and the South Sandwich Islands
                                                            +500</option>

                                                        <option value="211">South Sudan +211</option>

                                                        <option value="34">Spain +34</option>

                                                        <option value="94">Sri Lanka +94</option>

                                                        <option value="249">Sudan +249</option>

                                                        <option value="597">Suriname +597</option>

                                                        <option value="47">Svalbard and Jan Mayen +47</option>

                                                        <option value="268">Swaziland +268</option>

                                                        <option value="46">Sweden +46</option>

                                                        <option value="41">Switzerland +41</option>

                                                        <option value="963">Syrian Arab Republic +963</option>

                                                        <option value="886">Taiwan, Province of China +886</option>

                                                        <option value="992">Tajikistan +992</option>

                                                        <option value="255">Tanzania, United Republic of +255</option>

                                                        <option value="66">Thailand +66</option>

                                                        <option value="670">Timor-Leste +670</option>

                                                        <option value="228">Togo +228</option>

                                                        <option value="690">Tokelau +690</option>

                                                        <option value="676">Tonga +676</option>

                                                        <option value="1868">Trinidad and Tobago +1868</option>

                                                        <option value="216">Tunisia +216</option>

                                                        <option value="90">Turkey +90</option>

                                                        <option value="7370">Turkmenistan +7370</option>

                                                        <option value="1649">Turks and Caicos Islands +1649</option>

                                                        <option value="688">Tuvalu +688</option>

                                                        <option value="256">Uganda +256</option>

                                                        <option value="380">Ukraine +380</option>

                                                        <option value="971">United Arab Emirates +971</option>

                                                        <option value="44">United Kingdom +44</option>

                                                        <option value="1">United States +1</option>

                                                        <option value="1">United States Minor Outlying Islands +1
                                                        </option>

                                                        <option value="598">Uruguay +598</option>

                                                        <option value="998">Uzbekistan +998</option>

                                                        <option value="678">Vanuatu +678</option>

                                                        <option value="58">Venezuela +58</option>

                                                        <option value="84">Viet Nam +84</option>

                                                        <option value="1284">Virgin Islands, British +1284</option>

                                                        <option value="1340">Virgin Islands, U.s. +1340</option>

                                                        <option value="681">Wallis and Futuna +681</option>

                                                        <option value="212">Western Sahara +212</option>

                                                        <option value="967">Yemen +967</option>

                                                        <option value="260">Zambia +260</option>

                                                        <option value="263">Zimbabwe +263</option>

                                                    </select>

                                                    <span class="message" id="msgmformate"></span>

                                                </div>

                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <input type="text" id="mob" name="mob" max="10"
                                                        class="form-control" placeholder="Phone Number"
                                                        required="required">

                                                    <span class="message" id="msgmobile"></span>

                                                </div>

                                            </div>

                                            <div class="row" style="margin-bottom:30px">



                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <input type="type" id="email" name="email" 
                                                        class="form-control" placeholder="Email ID" required="required">

                                                    <span class="message" id="msgemail"></span>

                                                </div>



                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <select name="how_did_you" id="how_did_you"
                                                        class="form-select form-select-sm form-control"
                                                        aria-label=".form-select-sm example">

                                                        <option value="">How did you hear about us?</option>

                                                        <option value="Google">Google</option>

                                                        <option value="Yahoo">Yahoo</option>

                                                        <option value="Airbnb">Airbnb</option>

                                                        <option value="Blog">Blog</option>

                                                        <option value="VRBO">VRBO</option>

                                                        <option value="Bookings.com">Bookings.com</option>

                                                        <option value="TripAdvisor">TripAdvisor</option>

                                                        <option value="Social media (Facebook, Twitter, Instagram etc)">
                                                            Social media (Facebook, Twitter, Instagram etc)</option>

                                                        <option value="Recommendation from another guest.">Recommendation
                                                            from another guest.</option>

                                                    </select>

                                                    <span class="message" id="msghow_did_you"></span>

                                                </div>

                                            </div>

                                            <div class="row" style="margin-bottom:30px">

                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <select name="business" id="business"
                                                        class="form-select form-select-sm form-control"
                                                        aria-label=".form-select-sm example">

                                                        <option value="">Purpose Of Visit</option>

                                                        <option value="Business">Business</option>

                                                        <option value="Leisure">Leisure</option>

                                                    </select>

                                                    <span class="message" id="msgbusiness"></span>

                                                </div>

                                                <div class="col-md-6">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <select name="myself" id="myself"
                                                        class="form-select form-select-sm form-control"
                                                        aria-label=".form-select-sm example">

                                                        <option value="">Booking For</option>

                                                        <option value="Myself">Myself</option>

                                                        <option value="Someone else">Someone else</option>

                                                    </select>

                                                    <span class="message" id="msgmyself"></span>

                                                </div>

                                            </div>



                                            <div class="row" style="margin-bottom:30px">

                                                <div class="col-md-12">

                                                    <sup class="pull-right text-danger">*</sup>

                                                    <textarea class="form-control" id="enq_comment" name="comment" placeholder="Message" required="required"></textarea>

                                                    <span class="message" id="msgcomment"></span>

                                                </div>

                                            </div>



                                        </div>

                                    </div>



                                </form>

                                <!--<button type="submit" name="submit" class="btn btn-warning btn-block">Pay Now</button>-->

                                <button type="button" id="enquiryClick" name="submit"
                                    class="btn btn-warning btn-block buy_now">Submit</button>

                            </div>



                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                            <div class="panel-box" style="border-top: 10px solid #f6f6f6000;">

                                <div class="panel-body br_add  review-form" style="padding: 9px;">

                                    <!--<img src="https://www.especialrentals.com/img/travelwithcon.png" title="Luxury Vacation Rentals, Serviced Apartments, Holiday Homes" class="img-responsive">-->

                                    <div class="secure col-md-12" style="padding:0px;">

                                        <h1 class="text-center" style="margin-bottom:0px;"><i
                                                class="fa fa-shield shields"></i></h1>

                                        <h3 class="text-center" style="margin-top:10px;">Travel with confidence</h3>

                                        <ul class="secure-point-ul" style="padding:8px;">

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span><span class="features"> We ensure the best
                                                    quality of properties &amp; services</span></li>

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span> <span class="features">Secure payment
                                                    gateway, your payment is under guarantee until you check-in</span></li>

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span> <span class="features">Easy refunds and
                                                    partial payment options for a hassle free booking experience.</span>
                                            </li>

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span> <span class="features">Comfort of home
                                                    coupled with luxury of a hotel.</span></li>

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span> <span class="features">Dedicated &amp;
                                                    experienced stay manager.</span></li>

                                            <li><span><img
                                                        src="https://www.especialrentals.com/public/frontend/images/tick_2.png"
                                                        width="20"></span> <span class="features">Verified
                                                    Properties</span></li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>









            </div>





        </div>

    </section>



    <style>
        .headerrelative.navbar.navbar-default {

            background: url({{ url('/') }}/public/frontend/images/header_bg.jpg);

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

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <?php $startdate = session()->get('startDate');
    
    $enddate = session()->get('endDate'); ?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#enquiryClick').click(function() {

                if (isValidateEnquiry()) {

                    var token = "{{ csrf_token() }}";

                    var url = "{{ url('') }}";

                    var pro_id = {{ $properties->id }};

                    var pro_name = '{{ $properties->propertyname }}';

                    var fname = $('#fname').val();

                    var lname = $('#lname').val();

                    var email = $('#email').val();

                    var mob = $('#mob').val();

                    var gen = $('#gen').val();

                    var how_did_you = $('#how_did_you').val();

                    var mformate = $('#mformate').val();

                    var business = $('#business').val();

                    var myself = $('#myself').val();

                    var comment = $('#enq_comment').val();

                    var checkin = '<?php echo date('d-M-Y ', strtotime($date)); ?>';

                    var checkout = '<?php echo date('d-M-Y ', strtotime($endDate)); ?>';

                    var guest = $('#guest').val();

                    var night = $('#night').val();



                    $.ajax({

                        url: url + '/property/enquiryformdata',

                        data: {
                            pro_id: pro_id,
                            pro_name: pro_name,
                            fname: fname,
                            lname: lname,
                            email: email,
                            mob: mob,
                            comment: comment,
                            gen: gen,
                            how_did_you: how_did_you,
                            mformate: mformate,
                            business: business,
                            myself: myself,
                            checkin: checkin,
                            checkout: checkout,
                            guest: guest,
                            night: night,
                            _token: token
                        },

                        method: "POST",

                        success: function(result) {

                            window.location.href =
                                '{{ url('/') }}/property/enquiry-thank-you';



                        }

                    });

                }



            });

        });



        function isValidateEnquiry() {

            var valid = true;

            var fname = $('input[name=fname]').val();

            var lname = $('input[name=lname]').val();

            var email = $('input[name=email]').val();

            var mob = $('input[name=mob]').val();

            var gen = $('#gen').val();

            var how_did_you = $('#how_did_you').val();

            var mformate = $('#mformate').val();

            var business = $('#business').val();

            var myself = $('#myself').val();

            var comment = $('textarea[name=comment]').val();



            $(".message").html("&nbsp;");

            $(".message").css("color", "red");

            $(".message").css("font-size", "10px");

            $(".message").css("display", "block");

            $(".message").hide();

            if (gen.length == 0) {

                valid = false;

                $("#msggen").html("Select your gender");

                $("#msggen").show();

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



            if (mob.length == 0) {

                valid = false;

                $("#msgmobile").html("Enter mobile");

                $("#msgmobile").show();

            }

            if (how_did_you.length == 0) {

                valid = false;

                $("#msghow_did_you").html("Select How did you hear about us?");

                $("#msghow_did_you").show();

            }



            if (business.length == 0) {

                valid = false;

                $("#msgbusiness").html("Select business");

                $("#msgbusiness").show();

            }



            if (mformate.length == 0) {

                valid = false;

                $("#msgmformate").html("Select country code");

                $("#msgmformate").show();

            }



            if (myself.length == 0) {

                valid = false;

                $("#msgmyself").html("Select myself");

                $("#msgmyself").show();

            }



            if (comment.length == 0) {

                valid = false;

                $("#msgcomment").html("Enter comment");

                $("#msgcomment").show();

            }



            return valid;

        }
    </script>
@endsection
