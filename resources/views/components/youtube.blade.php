<div class="form-group">
    <label class="cursor-move font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <div class="input-group">
        <input type="text" class="form-control border-right-0" name="{{ $name }}" placeholder="{{ $placeholder }}" id="link-youtube" value="{{ $slot }}" {{ $attrDisabled }}>
        <span class="input-group-append">
            <button class="btn bg-teal" type="button" id="show-youtube"><i class="icon-eye"></i></button>
            <button class="btn bg-danger" type="button" id="clear-youtube"><i class="icon-trash-alt"></i></button>
        </span>
    </div>
</div>

<div class="video-youtube"></div>

<input type="hidden" name="youtube_image" value="{{ old('youtube_image') }}" />
