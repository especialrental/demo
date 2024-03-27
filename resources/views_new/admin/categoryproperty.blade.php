<!----Propetry category-->

    <section class="content">

        <div class="row">

            <div class="col-md-12"  style="padding:0px;">

                <div class="box box-info">

                    <div class="box-header">

                        <h3 class="box-title">Property Category

                        </h3>

                    </div>

                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <div class="row">

                            @php $selectedCategory = array();

                             if(isset($propertyCat) && !empty($propertyCat)) {

                             foreach( $propertyCat as $propertyCat ) {

                             $selectedCategory = explode(',',$propertyCat->ids);

                             }}

                            @endphp

                            @foreach($productCategory as $categoryData)

                                <div class="col-sm-3">

                                    <div class="checkbox">

                                       @php $checked = ((in_array($categoryData->id, $selectedCategory))?'checked':'')@endphp 

                                        <label>

                                            <input type="checkbox" 

                                             name="category[]" value="{{$categoryData->id}}" {{$checked}}>

                                              {{$categoryData->name}}

                                        </label>

                                    </div>

                                </div>

                            @endforeach 
                         

                        </div>

                    </div>

                </div>

            </div>

            <!-- /.col-->

        </div>

        <!-- ./row -->

    </section>

    <!-- Property Video link -->
    
    <section class="content" style="margin-bottom: -85px;">

        <div class="row">

            <div class="col-md-12"  style="padding:0px;">

                <div class="box box-info">

                    <div class="box-header">

                        <h3 class="box-title">Front-Page Feature Property Status

                        </h3>

                        

                    </div>

                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <div class="col-lg-6 col-md-12"  style="padding-left:0px;">

                          <div class="form-group">

                              <label></label>
                               @php 
                                $selected = (isset($property->feature_properties)) ? (($property->feature_properties == 1)?'selected':''):'';
                                 $sselected = (isset($property->feature_properties)) ? (($property->feature_properties == 0)?'selected':''):'';
                               @endphp
                              <select class="form-control" name="feature_properties" >
                              
                                <option value="">-- Select --</option>

                                <option value="1" {{$selected}}>Yes </option> 

                                <option value="0"{{$sselected}}>No</option> 

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

    <section class="content" style="margin-bottom: -85px;">

        <div class="row">

            <div class="col-md-12"  style="padding:0px;">

                <div class="box box-info">

                    <div class="box-header">

                        <h3 class="box-title">Property Videos Link

                        </h3>

                        

                    </div>

                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">

                                <label>Insert Videos Link ( Like - YouTube, Vimeo, etc )  </label>
                                @php $propVlink = isset($property->vlink) ? $property->vlink : ''; @endphp  
                                <input type="text" name="videos" class="form-control" placeholder="Enter Embedded Videos Link -https://www.youtube.com/embed/UtiOtUHCn_c" value="{{$propVlink}}">

                            </div>

                        </div>



                    </div>

                </div>

            </div>

            <!-- /.col-->

        </div>

        <!-- ./row -->

    </section>