<div class="row mb-2 row-upload-multi" data-id="{{ $id }}" id="row-upload-multi-image-{{ $id }}">
    <div class="col-md-2">
        <div class="card-img-actions mx-1 mt-1">
            <img class="card-img img-fluid preview-image" id="image-upload-{{ $id }}" src="{{ $imageDefault }}" />
            <div class="card-img-actions-overlay card-img">
                <a href="{{ $imageDefault }}" id="image-upload-{{ $id }}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group-image">
                    <i class="icon-zoomin3"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-5 my-auto">
        <input type="text" class="form-control" placeholder="{{ placeholder('images.source') }}" name="multi_images[{{ $id }}][alt]">
        <input type="hidden" name="multi_images[{{ $id }}][image]" id="image-upload-{{ $id }}" />
    </div>
    <div class="col-md-3 my-auto">
        <input type="text" class="form-control position_multi_images" placeholder="{{ placeholder('images.source') }}" name="multi_images[{{ $id }}][position]" value="{{ $position }}">
    </div>
    <div class="col-md-2 my-auto text-right p-0">
        <button type="button" class="btn btn-success d-inline mr-2 upload-multi-image" data-id="image-upload-{{ $id }}"><i class="icon-upload"></i></button>
        <button type="button" class="btn btn-danger d-inline delete-row-upload" data-id="row-upload-multi-image-{{ $id }}"><i class="icon-trash"></i></button>
    </div>
</div>