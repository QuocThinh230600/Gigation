<div class="container module-upload-multi-image">
    @if (!empty($dataImg))
        @foreach($dataImg as $item)
            <div class="row mb-2 row-upload-multi" data-id="{{ $loop->iteration }}" id="row-upload-multi-image-{{ $loop->iteration }}">
                <div class="col-md-2">
                    <div class="card-img-actions mx-1 mt-1">
                        <img class="card-img img-fluid preview-image" id="image-upload-{{ $loop->iteration }}" src="{{ $item->image }}" />
                        <div class="card-img-actions-overlay card-img">
                            <a href="{{ $item->image }}" id="image-upload-{{ $loop->iteration }}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group-image">
                                <i class="icon-zoomin3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 my-auto">
                    <input type="text" class="form-control" placeholder="{{ placeholder('images.source') }}" name="multi_images[{{ $loop->iteration }}][alt]" value="{{ $item->alt }}">
                    <input type="hidden" name="multi_images[{{ $loop->iteration }}][image]" id="image-upload-{{ $loop->iteration }}" value="{{ $item->image }}" />
                </div>
                <div class="col-md-3 my-auto">
                    <input type="text" class="form-control position_multi_images" placeholder="{{ placeholder('images.source') }}" name="multi_images[{{ $loop->iteration }}][position]" value="{{ $item->position }}">
                </div>
                <div class="col-md-2 my-auto text-right p-0">
                    <button type="button" class="btn btn-success d-inline mr-2 upload-multi-image" data-id="image-upload-{{ $loop->iteration }}"><i class="icon-upload"></i></button>
                    <button type="button" class="btn btn-danger d-inline delete-row-upload" data-id="row-upload-multi-image-{{ $loop->iteration }}"><i class="icon-trash"></i></button>
                </div>
            </div>
        @endforeach
    @endif
    <div id="load-row-upload-image"></div>

    <div class="row mb-2">
        <div class="ml-auto my-auto">
            <button type="button" id="add-row-upload" class="btn btn-primary" data-url="{{ route('admin.ajax.addRowUploadImage') }}"><i class="icon-plus-circle2"></i></button>
        </div>
    </div>
</div>
