<!-- Main content -->

 

 <div class="row">

    <!-- right column -->

   <div class="col-md-12">

    <span style="color:red;"></span>

     <section class="content">

      <div class="row">

              <!-- right column -->

        <div class="col-md-12">

          <!-- Horizontal Form -->

          <span style="color:red;"></span>

                   

            <section class="content" style="min-height:150px; ">

              <div class="row">

                <div class="col-md-12">

                  <div class="box box-info">

                    <div class="box-header">

                      <h3 class="box-title"> Rates

                      </h3>

                    </div>

            

                    <div class="box-body pad">

                    <div class="add-tab-row push-padding-bottom">

                      <div class="row" style="padding: 0px 19px 1px;">  
                      <div id="add_words"> 
                       <!-- <input type="hidden" name="season[]" class="Seasons" value="">
                       
                       <input type="hidden" name="from_date[]" class="From_Dates" value="">
                       
                       <input type="hidden" name="to_date[]" class="To_dates" value="">
                        
                       <input type="hidden" name="nightly_Rate[]" class="Nightly_Rates" value="">
                        
                       <input type="hidden" name="weekend_rate[]" class="weekend_rates" value="">
                       
                       <input type="hidden" name="weekly_rate[]" class="Weekly_Rates" value="">
                       
                       <input type="hidden" name="monthly_rate[]" class="Monthly_Rates" value="">
                       
                       <input type="hidden" name="minimum_stay[]" class="minimum_stays" value="">
                       
                       <input type="hidden" name="extra_person[]" class="Extra_Persons" value="">

                       <input type="hidden" name="other_fees[]" class="Other_Feess" value=""> -->

                       </div>

                       <!-- <input type="hidden" name="dealseason" class="dealseason" value="">

                       <input type="hidden" name="specialType" class="specialType" value="">

                       <input type="hidden" name="ofrom_date" class="OFrom_Date" value="">

                       <input type="hidden" name="oto_date" class="OTo_Date" value="">

                       <input type="hidden" name="onightly_Rate" class="ONightly_Rate" value="">

                       <input type="hidden" name="oweekly_rate" class="OWeekly_Rate" value="">

                       <input type="hidden" name="omonthly_rate" class="OMonthly_Rate" value=""> -->



                       <button type="button" class="btn btn-info btn-lg" id="new_rate" data-toggle="modal" data-target="#addmorerates">Add More Rates</button>

                          <!-- Modal -->

                          <div id="addmorerates" class="modal fade" role="dialog">

                            <div class="modal-dialog">                                     

                              <!-- Modal content-->

                              <div class="modal-content">

                                <div class="modal-header">

                                  <button type="button" class="close" data-dismiss="modal">×</button>

                                  <h4 class="modal-title">Add rates</h4>

                                </div>

                                <div class="modal-body">
                                        
                                      @php $propertyRatesId = (isset($propRates->id))? $propRates->id :0
                                           
                                       @endphp
                                      <input type="hidden" name="propertyRates" value="{{$propertyRatesId}}">
                                      <input type="hidden" id="rateId" name="rateId" value="@if(isset($propertyId)){{ $propertyId }}@endif">
                                      <table class="popup_rates" width="100%" cellpadding="0" cellspacing="0" border="0">

                                          <tbody >

                                          <tr>
                                              
                                              <td><strong>Season<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="season" id="Season" value=""></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>From Date<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control hasDatepicker" type="date" name="from_date" id="From_Date" value="">

                                              </td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>To Date<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control hasDatepicker" type="date" name="to_date" id="To_Date" value="">

                                              </td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>Nightly Rate<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="nightly_rate" id="Nightly_Rate" value=""></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>Weekend Rate<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="weekend_rate" id="weekend_rate" value=""></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>Weekly Rate<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="weekly_rate" id="Weekly_Rate" value=""></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr>

                                              <td><strong>Monthly Rate<span class="text-danger">*</span></strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="monthly_rate" id="Monthly_Rate" value=""></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

<!--                                           <tr>

                                              <td><strong>Minimum Stay</strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="minimum_stay" id="minimum_stay" value=""></td>

                                                

                                          </tr> -->

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <!-- <tr style="display: none">

                                              <td><strong>Extra Person</strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="extra_person" id="Extra_Person" value="0"></td>

                                          </tr> -->

                                          <!-- <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr>

                                          <tr style="display: none">

                                              <td><strong>Other Fees</strong></td>

                                              <td width="5">&nbsp;</td>

                                              <td><input class="form-control" type="text" name="other_fees" id="Other_Fees" value="0"></td>

                                          </tr>

                                          <tr>

                                              <td height="10" colspan="3"></td>

                                          </tr> -->

                                          <tr>

                                              <td colspan="2">&nbsp;</td>
                                              
                                              <td><button type="button" data-dismiss="modal" id="pro_add_rates" class="btn btn-primary">Add Rate Details</button></br>
                                                <button type="button" title="Update More Rates" class="btn btn-sm btn-icons btn-rounded btn-danger pull-right updatesRatesBtn hide" data-toggle="modal" data-dismiss="modal" style="margin: -20px 0 0 0;"><i class="fa fa-paper-plane"></i></button>&nbsp;
                                                <button type="button" title="Update Rates" class="btn btn-sm btn-icons btn-rounded btn-danger pull-right updatesRates hide" data-toggle="modal" data-dismiss="modal" style="margin: -20px 0 0 0;"><i class="fa fa-paper-plane"></i></button>
                                              </td>
                                            
                                          </tr>

                                      </tbody>

                                      </table>         

                                      <div id="updatePropRates"></div> 

                                </div>

                               

                              </div>

                          

                            </div>

                          </div>

                       

                          <div class="table-responsive">
                                      
                              <table class="table" id="tablename">
                                <thead>
                                  <tr>
                                    <th>Season</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Nightly Rate</th>
                                     <th>Weekend Rate</th>
                                    <th>Weekly Rate</th>
                                    <th>Monthly Rate</th>
                                    <!-- <th>Extra Person</th> -->
                                    <!-- <th>Other Fees</th> -->
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                   @php if(isset($propRates) && !empty($propRates))  
                                    foreach($propRates as $rates){ @endphp
                                  <tr>
                                    <td >{{$rates->season}}</td>
                                    <td >{{date_format(date_create($rates->fromdate), 'd M Y')}}</td>
                                    <td >{{date_format(date_create($rates->todate), 'd M Y')}}</td>
                                    <td >{{$rates->nightrate}}</td>
                                    <td >{{$rates->weekend}}</td>
                                    <td >{{$rates->weekrate}}</td>
                                    <td >{{$rates->monthrate}}</td>
                                   
                                    <!-- <td>{{$rates->extraperson}}</td> -->
                                    <!-- <td>{{$rates->otherfees}}</td> -->
                                    <td><button type="button" class="editRates" data-id="{{$rates->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button><button type="button" class="deleteRates" data-id="{{$rates->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button></td> 
                                  </tr>
                                  @php }
                                 @endphp
                                </tbody>
                              </table>   
                          </div>    

                      </div>

                    </div>

                  </div>

                    </div>

                </div>

              </div>

            </section>
           

            <div class="account-block">

                <div class="add-title-tab">

                    <!--<h3>Rates Notes</h3>-->

                    <div class="add-expand"></div>

                </div>

                <div class="add-tab-content">

                    <div class="add-tab-row push-padding-bottom">

                        <div class="row">

                                    

                <hr style="border: solid 2px;">

                 

                <h2>Other Rates</h2>

                <div class="col-sm-12"><div class="col-sm-4"><h4>Per Person / Per Night Above</h4>



                <div class="form-group">
                  @php $extraId = (isset($extraRates->id))? $extraRates->id :0 @endphp
                  <input type="hidden" name="statusExtra" value="{{$extraId}}">
                 <input class="form-control" type="text" name="fee" id="fee" value="@if(isset($extraRates->extrafee)){{ $extraRates->extrafee }}@endif {{old('fee')}}">  

                </div> </div> 

                <div class="col-sm-4"><h4>Guest</h4>

                 <div class="form-group">

                  <select class="form-control" name="person" id="guest" >

                    <option>Select Guest</option>

                        @for($c=1; $c<=12; $c++)
                         @php $selected = (isset($extraRates->extraperson)) ? (($extraRates->extraperson == $c)?'selected':''):'';@endphp   
                          <option value="{{$c}}"{{$selected}}> {{$c}}</option>

                        @endfor 

                   </select> 



                </div> </div>



                <div class="col-sm-4"><h4>Currency</h4>



                <div class="form-group">
                   @php $rCurrency = App\Model\Currency::where(['status'=>'1'])->get();
                   @endphp
                   <select class="form-control" id="currency" data-live-search="false" title="Select" name="currency">
                    @foreach($rCurrency as $rc)
                      @php if(isset($extraRates->currency))
                        $uselected = ($extraRates->currency == $rc->short_code) ? 'selected' : '';
                        else
                        $uselected = ''
                      @endphp
                    <option value="{{$rc->short_code}}"{{$uselected}}>{{$rc->short_code}} ({{$rc->name}})</option>
                    @endforeach

                    
                   </select> 

                </div> </div> 

                </div>

                <div class="col-sm-12"><div class="col-sm-3"><h4>Cleaning Fee</h4>

                 <div class="form-group">

                       <input class="form-control" type="text" name="clean" id="clean" value="@if(isset($extraRates->clean)){{ $extraRates->clean }}@endif {{old('clean')}}">

                </div>  </div>

                <div class="col-sm-3"><h4>Refunadable Deposit</h4>

                 <div class="form-group">

                       <input class="form-control" type="text" name="refund" id="refund" value="@if(isset($extraRates->refund)){{ $extraRates->refund }}@endif {{old('refund')}}">

                </div>  </div>

                <div class="col-sm-3"><h4>Tax</h4>

                   <div class="form-group">

                         <input class="form-control" type="text" name="tax" id="tax" value="@if(isset($extraRates->tax)){{$extraRates->tax}}@endif {{old('tax')}}">

                </div>  </div>
                <div class="col-sm-3"><h4>Minimum Stay</h4>

                   <div class="form-group">

                         <input class="form-control" type="text" name="min_stay" id="min_stay" value="@if(isset($extraRates->min_stay)){{$extraRates->min_stay}}@endif {{old('min_stay')}}">

                </div>  </div> </div>

                     <div class="col-sm-12">

                <h4>Rates Notes</h4>                                         

                    <div class="form-group">

                       <textarea class="form-control" id="editor5" name="extrafeenotes" rows="7">@if(isset($extraRates->extraNotes)){!! $extraRates->extraNotes !!}@endif</textarea>

                       

                    </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>
                                

              </div>

          </div>

      </section>



             