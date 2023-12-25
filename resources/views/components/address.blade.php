<div class="form-group">
    <label class="font-weight-semibold">{{ label('address.province') }} <span class="text-danger">*</span></label>

    <select class="form-control filter-select" name="province_id">
        @if (!empty($province))
            <option value="">{{ label('address.please_choose_province') }}</option>
        @endif

        @forelse ($province as $item)
            <option value="{{ (string)$item->id }}" {{ ($province_selected == (string)$item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
        @empty
            <option value="">{{ label('element.no_data') }}</option>
        @endforelse
    </select>
</div>

<div class="form-group">
    <label class="font-weight-semibold">{{ label('address.district') }} <span class="text-danger">*</span></label>

    <select class="form-control filter-select" name="district_id" data-url="{{ route('admin.ajax.getDistrict') }}">
        @if ($province_selected == null && $district_selected == null)
            <option value="">{{ label('address.please_choose_district') }}</option>
        @else
            @foreach ($district as $item)
                <option value="{{ (string)$item->id }}" {{ ($district_selected == (string)$item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-group">
    <label class="font-weight-semibold">{{ label('address.ward') }} <span class="text-danger">*</span></label>

    <select class="form-control filter-select" name="ward_id" data-url="{{ route('admin.ajax.getWard') }}">
        @if ($district_selected == null)
            <option value="">{{ label('address.please_choose_ward') }}</option>
        @else
            @foreach ($ward as $item)
                <option value="{{ (string)$item->id }}" {{ ($ward_selected == (string)$item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-group">
    <label class="cursor-move font-weight-semibold">{{ label('address.address') }}
        <span class="text-danger">*</span>
    </label>

    <input type="text" class="form-control" name="address" placeholder="{{ placeholder('address.address') }}" value="{{ $slot }}" />
</div>