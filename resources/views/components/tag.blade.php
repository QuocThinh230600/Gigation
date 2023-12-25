<div class="form-group">
    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <input
        type="text"
        class="form-control tokenfield"
        name="{{ $name }}"
        value="{{ $slot }}"
        placeholder="{{ $placeholder }}"
        data-fouc />
</div>
