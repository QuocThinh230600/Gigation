<div class="form-group">
    <label class="cursor-move font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <div class="input-group">
        <input type="text" name="{{ $name }}" class="form-control border-right-0" placeholder="{{ $placeholder }}" value="{{ $slot }}" {{ $attrDisabled }}>
        <span class="input-group-append">
            <button class="btn bg-teal upload-file" id="{{ $name }}" type="button">File</button>
        </span>
    </div>
</div>
