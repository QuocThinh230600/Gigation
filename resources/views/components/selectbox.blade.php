<div class="form-group">
    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <select class="form-control filter-select" name="{{ $name }}" {{ $attrDisabled }}>
        @forelse ($dataSelect as $item)
            @php $id = $attrId($item) @endphp
            <option value="{{ $id }}" {{ ($slot == $id) ? 'selected' : "" }}>{{ $item->name }}</option>
        @empty
            <option value="">{{ label('element.no_data') }}</option>
        @endforelse
    </select>
</div>
