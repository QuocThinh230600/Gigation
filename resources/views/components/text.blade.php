@if (isset($label))
    <div class="form-group {{ $hiddenCSS }}">
        <label class="cursor-move font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

        <input
            type="{{ $type }}"
            class="form-control {{ $attrSlugTitle }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attrId }}
            {{ $attrSlug }}
            {{ $attrTitle }}
            {{ $attrDisabled }}
            value="{{ $slot }}">
    </div>
@else
    <input
        type="{{ $type }}"
        class="form-control {{ $attrSlugTitle }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attrId }}
        {{ $attrSlug }}
        {{ $attrDisabled }}
        value="{{ $slot }}">
@endif
