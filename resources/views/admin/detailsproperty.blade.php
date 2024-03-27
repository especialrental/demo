<!-- Property Details -->

<section class="content">

    <div class="row">

        <div class="col-md-12" style="padding:0px;">

            <div class="box box-info">

                <div class="box-header">

                    <h3 class="box-title">Property Details

                    </h3>



                </div>

                <!-- /.box-header -->

                <div class="box-body pad">

                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">



                            <label>Property Name</label>
                            @php $propName = isset($property->propertyname) ? $property->propertyname : old('propertyname'); @endphp
                            <input type="text" name="propertyname" id="propertyname" class="form-control required"
                                placeholder="Enter ..." value="{{ $propName }}">

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">



                            <label>Property Url</label>
                            @php $propUrl = isset($property->url) ? $property->url : old('url'); @endphp
                            <input type="text" name="url" id="url" class="form-control required"
                                placeholder="Enter ..." value="{{ $propUrl }}">

                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">



                            <label>Property Meta Tag</label>
                            @php $meta_tag = isset($property->meta_tag) ? $property->meta_tag : old('meta_tag'); @endphp
                            <input type="text" name="meta_tag" id="meta_tag" class="form-control required"
                                placeholder="Enter ..." value="{{ $meta_tag }}">

                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">



                            <label>Property Meta Description</label>
                            @php $meta_description = isset($property->meta_description) ? $property->meta_description : old('meta_description'); @endphp
                            <input type="text" name="meta_description" id="meta_description"
                                class="form-control required" placeholder="Enter ..." value="{{ $meta_description }}">

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12" style="padding-right:0px;">

                        <div class="form-group">

                            <label>Property Type</label>

                            <select class="form-control" id="propertytype" name="propertytype">



                                <option value="">Select Property Type</option>

                                @foreach ($propertyTypeData as $ptypeData)
                                    @php $selected = (isset($property->propertytype)) ? (($property->propertytype == $ptypeData->id)?'selected':''):''; @endphp



                                    <option value="{{ $ptypeData->id }}" {{ $selected }}>
                                        {{ $ptypeData->categoryname }}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">

                            <label>Bedroom</label>

                            <select class="form-control " id="bedrooms" name="bedrooms">

                                <option selected="" disabled="">Select Bedroom</option>
                                @php $selected = (isset($property->bedrooms)) ? (($property->bedrooms == 'studio')?'selected':''):'';@endphp
                                <option value="studio"{{ $selected }}>Studio</option>
                                @for ($a = 1; $a <= 16; $a++)
                                    @php $selected = (isset($property->bedrooms)) ? (($property->bedrooms == $a)?'selected':''):'';@endphp
                                    <option value="{{ $a }}"{{ $selected }}>{{ $a }}</option>
                                @endfor

                            </select>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12" style="padding-right:0px;">

                        <div class="form-group">

                            <label>Bathroom</label>

                            <select class="form-control " id="baths" name="baths">

                                <option value="">Select Bathroom</option>

                                @for ($b = 1; $b <= 16; $b++)
                                    @php $selected = (isset($property->baths)) ? (($property->baths == $b)?'selected':''):'';@endphp

                                    <option value="{{ $b }}"{{ $selected }}> {{ $b }}
                                    </option>
                                @endfor

                            </select>

                        </div>

                    </div>



                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">

                            <label>Number of Sleeps</label>

                            <select class="form-control" id="sleepsno" name="sleepsno">

                                <option value="">Select Number of Sleeps</option>

                                @for ($c = 1; $c <= 25; $c++)
                                    @php $selected = (isset($property->sleepsno)) ? (($property->sleepsno == $c)?'selected':''):'';@endphp

                                    <option value="{{ $c }}"{{ $selected }}> {{ $c }}
                                    </option>
                                @endfor

                            </select>

                        </div>

                    </div>



                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">

                        <div class="form-group">

                            <label>Instant Booking</label>
                            @php
                                $selected = isset($property->booking_status) ? ($property->booking_status == 1 ? 'selected' : '') : '';
                                $sselected = isset($property->booking_status) ? ($property->booking_status == 0 ? 'selected' : '') : '';
                            @endphp
                            <select class="form-control" name="instantbooking">

                                <option value="">-- Select --</option>

                                <option value="1" {{ $selected }}>Yes </option>

                                <option value="0"{{ $sselected }}>No</option>

                            </select>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">
                        <div class="form-group">
                            <label>Bed Type</label>
                            @php $bedType = isset($property->bed_type) ? $property->bed_type : old('bed_type'); @endphp
                            <input type="text" name="bed_type" class="form-control required" placeholder="Enter ..."
                                value="{{ $bedType }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">
                        <div class="form-group">
                            <label>Check In</label>
                            @php $checkIn = isset($property->check_in) ? $property->check_in : old('check_in'); @endphp
                            <input type="text" name="check_in" class="form-control required" placeholder="Enter ..."
                                value="{{ $checkIn }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">
                        <div class="form-group">
                            <label>Check Out</label>
                            @php $checkOut = isset($property->check_out) ? $property->check_out : old('check_out'); @endphp
                            <input type="text" name="check_out" class="form-control required"
                                placeholder="Enter ..." value="{{ $checkOut }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" style="padding-left:0px;">
                        <div class="form-group">
                            <label>Room Type</label>
                            @php $roomType = isset($property->room_type) ? $property->room_type : old('room_type'); @endphp
                            <input type="text" name="room_type" class="form-control required"
                                placeholder="Enter ..." value="{{ $roomType }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12" style="padding:0px;">

                        <div class="form-group">

                            <label>Short Description</label>

                            <textarea id="editor1" name="sdescription" class="form-control" rows="5" cols="30">@php echo(isset($property->short_description) ? $property->short_description : ''); @endphp</textarea>





                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12" style="padding:0px;">

                        <div class="form-group">

                            <label>Description</label>

                            <textarea id="editor2" name="description" class="form-control" rows="10" cols="80">@php echo(isset($property->description) ? $property->description : ''); @endphp</textarea>



                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12" style="padding:0px;">

                        <div class="form-group">

                            <label>Area Info</label>

                            <textarea id="editor3" name="area_info" class="form-control" rows="10" cols="80">@php echo(isset($property->area_info) ? $property->area_info : ''); @endphp</textarea>



                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12" style="padding:0px;">

                        <div class="form-group">

                            <label>Transportation</label>

                            <textarea id="editor4" name="transportation" class="form-control" rows="10" cols="80">@php echo(isset($property->transportation) ? $property->transportation : ''); @endphp</textarea>



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    $("#propertyname").bind("keyup", changed).bind("change", changed);

    function changed() {
        $("#url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(
            /%/g, '').toLowerCase());
    }
</script>
