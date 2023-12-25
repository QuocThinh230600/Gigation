<div class="form-group">

    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <div class="input-group">
        <select name="{{ $name }}" class="form-control multiselect-toggle-selection" multiple="multiple" {{ $attrDisabled }} data-fouc>
            @forelse ($dataSelect as $item)
                @php $id = $attrId($item) @endphp
                <option value="{{ $id }}" {{ (in_array($id,explode(",", $slot))) ? 'selected' : "" }}>{{ $item->name }}</option>
            @empty
                <option value="">{{ label('element.no_data') }}</option>
            @endforelse
        </select>

        <div class="input-group-append">
            <button type="button" class="btn btn-light {{ $attrActiveButton }}" name="{{ $name }}">{{ label('element.select_all') }}</button>
        </div>
    </div>
</div>
