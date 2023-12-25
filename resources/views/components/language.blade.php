<div class="form-group">
    <label class="font-weight-semibold">{{ $label }}</label>

    <select name="{{ $name }}" data-placeholder="{{ $placeholder }}" class="form-control select-icons" {{ $attrDisabled }} data-fouc>
        @forelse ($dataSelect as $item)
            <option value="{{ $item->locale }}" data-icon="{{ $item->flag }}" {{ ($slot == $item->locale) ? 'selected' : "" }}>{{ $item->name }}</option>
        @empty
            <option value="">{{ label('element.no_data') }}</option>
        @endforelse
    </select>
</div>
