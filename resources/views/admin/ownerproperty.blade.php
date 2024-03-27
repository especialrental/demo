<!-- Property Owner Details -->

    <section class="content">

        <div class="row">

            <div class="col-md-12"  style="padding:0px;">

                <div class="box box-info">

                    <div class="box-header">

                        <h3 class="box-title">Property Owner Information

                        </h3>

                        

                    </div>

                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">

                                <label>Owner Name</label>
                                @php $owName = isset($property->owner_name) ? $property->owner_name : old('owner'); @endphp
                                <input type="text" name="owner" class="form-control required" placeholder="Enter ..." value="{{ $owName }}" >

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control required" placeholder="Enter ..." value="@if(isset($property->owner_email)){{$property->owner_email}}@endif {{old('email')}}">

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">

                                <label>Address</label>

                                <input type="text" name="ownaddr" class="form-control" placeholder="Enter ..." value="@if(isset($property->owner_address)){{$property->owner_address}}@endif {{old('ownaddr')}}">

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <label>Mobile</label>

                            <div class="box-body">

                                <div class="row" style="margin-top: -5px;">

                                    <div class="col-xs-12">

                                        <input type="text" name="maddress1" class="form-control" placeholder="Number" value="@if(isset($property->numowner_mobile)){{$property->numowner_mobile}}@endif {{old('maddress1')}}" >

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <label>Phone</label>

                            <div class="box-body">

                                <div class="row" style="margin-top: -5px;">

                                    <div class="col-xs-12">

                                        <input type="text" name="paddress1" class="form-control" placeholder="Phone" value="@if(isset($property->numowner_alt_phone)){{$property->numowner_alt_phone}}@endif {{old('paddress1')}}">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">

                                <label>Fax</label>

                                <input type="text" name="fax" class="form-control" placeholder="Fax" value="@if(isset($property->owner_fax)){{$property->owner_fax}}@endif {{old('fax')}}">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /.col-->

        </div>

        <!-- ./row -->

    </section>