<section class="content">

    <div class="row">

      <div class="col-md-12" style="padding:0px">

        @foreach($amenityData as $ameData)

        <div class="box box-info">

          <div class="box-header">

            <h3 class="box-title">{{$ameData->amen_value}}</h3>

          </div>

          <div class="box-body pad">

            <div class="row">

              
               
              @php
                
                $sub = \App\Model\SubAmenity::where('aid',$ameData->id)->orderBy('amenity','asc')->get(); 
                $saveSubAR = [];
                if(isset($propertyId) ){

                $saveSub = \App\Model\PropertyAmenities::where(['propertyid'=>$propertyId, 'category'=>$ameData->id])->get();
                
                
                if($saveSub->count()){
                  $saveSubAR = explode(',',$saveSub->first()->subcategory);

                }
              }
                @endphp

                @foreach($sub as $subData)

                <div class="col-sm-3">

                  <div class="checkbox">

                      <label>

                               
                         @php
                            $checked = (in_array($subData->id,$saveSubAR)) ? 'checked' : '';
                         @endphp 
                        <input type="checkbox" name="subAmenity[{{$ameData->id}}][]" value="{{$subData->id}} " {{$checked}}>{{$subData->amenity}} 

                        

                      </label>

                  </div>

                </div>  

                @endforeach                                                    

            </div>                             
 
          </div>

        </div>

        @endforeach

      </div>

                        

    </div>

                 

</section>