<div class="add-tab-content">
    <div class="add-tab-row push-padding-bottom">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="gallery">
                    <div class="form-group">
                        <label>Property Photo</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple="" onchange="preview_image(this);" value="">
                        <div class="img-responsive previewimg"></div>
                    </div> 
                    
                   
                    
                </div>
                
                 
                    
                    
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" class="btn  mleft_no reorder_link btn-default pull-right" id="save_reorder">reorder photos</a>
    <br>
    <div class="clearfix"></div><br>
    <div class="row">
        <ul class="reorder_ul reorder-photos-list">
        @if(isset($propGallery) && !empty($propGallery))
            @foreach ($propGallery as $gallery)
        <div class="col-lg-4 col-md-12" style="margin-bottom: 10px;">
            <li id="image_li_{{$gallery->id}}" class="ui-sortable-handle" style="list-style: none;"> 
                <a href="javascript:void(0);" style="float:none;" class="image_link">
                    <img src="{{url('public/uploads/property_image')}}/{{$gallery->propertyid}}/{{$gallery->photoname}}" alt="" style="width: 322px;height: 185px;">
                </a>
                <input type="text" class="form-control" placeholder="Enter caption" name="caption" id="editCaption{{$gallery->id}}" value="{{$gallery->phototitle}}">
                <button type="button" class="btn btn-sm btn-icons btn-rounded btn-danger pull-right editCaption"  data-id="{{$gallery->id}}" title="Update Caption" style="position: absolute;right: 0; margin: -33px 13px 0 0;"><i class="fa fa-paper-plane"></i></button>
                <button type="button" class="btn btn-sm btn-icons btn-rounded btn-danger btn-remove-image pull-right deleteImage"  data-id="{{$gallery->id}}" style="position: absolute;right: 12px;top: 0;"><i class="fa fa-trash-o"></i></button>
            </li>  
        </div>
            @endforeach
        @endif
        </ul>
                                </div>
                             

                        </div>
                        
                        
                    
                    