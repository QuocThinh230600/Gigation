<div class="row mb-2 row-upload-multi" data-id="{{ $id }}" id="row-upload-multi-attribute-{{ $id }}">
    <div class="col-md-5 my-auto">
        <select name="multi_attribute[{{ $id }}][attribute]" class="form-control">
            @php
                $attributes = DB::table('attributes')
                                ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
                                ->where('locale',config('app.locale'))
                                ->where('attributes.id','<>','1')
                                ->get();
            @endphp
            @php
                recursiveSelect($attributes,old('multi_attribute['.$id.']["attribute"]'))
            @endphp
        </select>
    </div>
    <div class="col-md-6 my-auto">
        <input type="text" class="form-control" placeholder="{{ placeholder('product.value') }}" name="multi_attribute[{{ $id }}][value]">
    </div>
    <div class="col-md-1 my-auto text-right p-0">
        <button type="button" class="btn btn-danger d-inline delete-row-upload" data-id="row-upload-multi-attribute-{{ $id }}"><i class="icon-trash"></i></button>
    </div>
</div>
