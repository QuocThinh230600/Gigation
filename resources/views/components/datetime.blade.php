<div class="form-group">
    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text"><i class="icon-calendar"></i></span>
        </span>

        <input
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control datepicker"
            value="{{ $slot }}"
            placeholder="{{ $placeholder }}"
            {{ $attrDisabled }}>
    </div>
</div>
