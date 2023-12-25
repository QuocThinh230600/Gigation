<div class="form-group">
    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <textarea
        rows="3"
        cols="3"
        name="{{ $name }}"
        maxlength="{{ $maxlength }}"
        class="form-control maxlength-options"
        placeholder="{{ $placeholder }}"
        {{ $attrDisabled }}>{{ $slot }}</textarea>
</div>
