

  <!-- Address Section -->

   <section class="content">

      <div class="row">

          <div class="col-md-12"  style="padding:0px;">

              <div class="box box-info">

                  <div class="box-header">

                      <h3 class="box-title">Property location

                      </h3>

                  </div>

                  <!-- /.box-header -->

                  <div class="box-body pad">

                      <div class="col-lg-6 col-md-12">

                          <div class="form-group">

                              <label>Address</label>

                              @php $propAddress = isset($property->address) ? $property->address : old('praddress'); @endphp

                              <input type="text" id="pAddress" name="praddress" class="form-control required" placeholder="Enter ..." value="{{ $propAddress }}">

                          </div>

                      </div>

                      <div class="col-lg-6 col-md-12">

                          <div class="form-group">

                              <label>Country</label>

                              <select class="form-control bindState" id="country" data-live-search="false" name="country" >

                                <option value="">Select Country</option>

                                @foreach($countryData as $country)

                                  @php $selected = (isset($property->country)) ? (($property->country == $country->id) ? 'selected' : '') : ''; @endphp

                                  <option value="{{ $country->id }} "{{$selected}}>{{ $country->country_name }}</option>

                                @endforeach

                                </select>

                          </div>

                      </div>

                      <div class="col-lg-4 col-md-12">

                          <div class="form-group ">

                              <label>State</label>

                              <select class="form-control bindCity" name="state" id="state">



                              @php

                                if(isset($property->country)){

                                $sub = \App\Model\State::where('country_id',$property->country)->get(); 

                                foreach($sub as $subData){

                                  $selected = ($subData->id == $property->state)? 'selected' : ''; @endphp

                                  <option value="{{$subData->id}}"{{$selected}}>{{$subData->state_name}}</option>

                                 @php }

                                } else { @endphp

                                <option value="" selected="" disabled="">Select State</option>

                              @php }

                                @endphp

                              </select>



                                

                                

                          </div>

                      </div>

                      <div class="col-lg-4 col-md-12">

                          <div class="form-group ">

                              <label>City</label>

                              <select class="form-control bindArea" name="city" id="city" >

                                

                                @php
                                       
                                if(isset($property->state)){

                                $sub = \App\Model\City::where('sid',$property->state)->get(); 

                                foreach($sub as $subData){

                                  $selected = ($subData->id == $property->city)? 'selected' : ''; @endphp

                                  <option value="{{$subData->id}}"{{$selected}}>{{$subData->city_name}}</option>

                                 @php }

                                } else { @endphp

                                <option value="" selected="" disabled="">Select City</option>

                              @php }

                                @endphp

                              </select>

                          </div>

                      </div>

                      <div class="col-lg-4 col-md-12">

                          <div class="form-group">

                              <label>Area</label>
                                
                              <select class="form-control" name="area" id="area">
                                @php
                                    
                                if(isset($property->city)){
                                      
                                $sub = \App\Model\Area::where('cid',$property->city)->get(); 

                                foreach($sub as $subData){

                                  $selected = ($subData->id == $property->town)? 'selected' : ''; @endphp

                                  <option value="{{$subData->id}}"{{$selected}}>{{$subData->area_name}}</option>

                                 @php }

                                } else { @endphp

                                <option value="" selected="" disabled="">Select Area</option>

                              @php }

                                @endphp

                             </select>

                          </div>

                      </div>



                      <div class="col-lg-3 col-md-12">

                          <div class="form-group">

                            @php $propZip = isset($property->zipcode) ? $property->zipcode : old('zip'); @endphp

                              <label>Zipcode</label>

                              <input type="text" name="zip" class="form-control required" placeholder="Enter ..." value="{{$propZip}}" autocomplete="off">

                          </div>

                      </div>

                      <div class="col-lg-3 col-md-12">

                          <div class="form-group">
                           @php $proplat = isset($latlan->id) ? $latlan->id : ''; @endphp 
                            <input type="hidden" name="propertyMap" id="propertyMap" value="{{$proplat}}">

                              <label>Google Maps latitude</label>
                              @php $proplat = isset($latlan->lat) ? $latlan->lat : ''; @endphp
                              <input type="text" name="lat" id="lati" class="form-control " placeholder="Enter ..." value="{{$proplat}}">

                          </div>

                      </div>

                      <div class="col-lg-3 col-md-12">

                          <div class="form-group">

                              <label>Google Maps longitude</label>
                              @php $proplan = isset($latlan->longt) ? $latlan->longt : ''; @endphp
                              <input type="text" name="long" id="longi" class="form-control " placeholder="Enter ..." value="{{$proplan}}">

                          </div>

                      </div>

                      <div class="col-lg-3 col-md-12">

                          <div class="form-group">

                              <label>Time Zone</label>

                              <select class="form-control" name="time">

                                <option value="">Select Time-Zone</option>
                               
                                 @foreach($zoneData as $zone){

                                  @php $selected = (isset($latlan->timezone)) ? (($latlan->timezone == $zone->id) ? 'selected' : '') : ''; @endphp
                                 
                                 <option value="{{ $zone->id }}" {{$selected}}>{{ $zone->timezone }}</option>
                                 
                                @endforeach
           
                                

                              </select>

                          </div>

                      </div>



                  </div>

              </div>

          </div>

          <!-- /.col-->

      </div>

      <!-- ./row -->

   </section>

    