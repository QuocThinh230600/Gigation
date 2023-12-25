<div class="card">
    <div class="card-img-actions mx-1 mt-1">
        <img class="card-img img-fluid preview-image" id="{{ $name }}" src="{{ ($slot == '') ? $imageDefault : $slot }}" alt="">
        <div class="card-img-actions-overlay card-img">
            <a href="{{ ($slot == '') ? $imageDefault : $slot }}" id="preview-{{ $name }}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                <i class="icon-zoomin3"></i>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex align-items-start flex-nowrap">
            <div class="list-icons list-icons-extended ml-auto">
                <a href="#" class="list-icons-item upload-image" id="{{ $name }}"><i class="icon-upload top-0"></i></a>
                <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $slot }}" />
                <a href="#" class="list-icons-item remove-image"><i class="icon-bin top-0"></i></a>
            </div>
        </div>
    </div>
</div>
