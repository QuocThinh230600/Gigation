<div class="container module-upload-multi-attribute">
    @if (!empty($dataAttr))
        @foreach($dataAttr as $item)
            <div class="row mb-2 row-upload-multi" data-id="{{ $loop->iteration }}" id="row-upload-multi-attribute-{{ $loop->iteration }}">
                <div class="col-md-5 my-auto">
                    <select name="multi_attribute[{{ $loop->iteration }}][attribute]" class="form-control">
                    @php
                        $attributes = DB::table('attributes')
                                ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
                                ->where('locale',config('app.locale'))
                                ->get();
                    @endphp

                    @php
                        recursiveSelect($attributes,old('multi_attribute['.$item->id.']["attribute"]', $item->attribute))
                    @endphp
                    </select>
                </div>
                <div class="col-md-5 my-auto">
                    <input type="text" class="form-control" placeholder="{{ placeholder('product.value') }}" name="multi_attribute[{{ $loop->iteration }}][value]" value="{{ $item->value }}">
                </div>
                <div class="col-md-2 my-auto text-right p-0">
                    {{-- <button type="button" class="btn btn-success d-inline mr-2 upload-multi-attribute" data-id="attribute-upload-{{ $loop->iteration }}"><i class="icon-upload"></i></button> --}}
                    <button type="button" class="btn btn-danger d-inline delete-row-upload" data-id="row-upload-multi-attribute-{{ $loop->iteration }}"><i class="icon-trash"></i></button>
                </div>
            </div>
        @endforeach
    @endif
    <div id="load-row-upload-attribute"></div>

    <div class="row mb-2">
        <div class="ml-auto my-auto">
            <button type="button" id="add-row-upload-attribute" class="btn btn-primary" data-url="{{ route('admin.ajax.addRowUploadAttribute') }}"><i class="icon-plus-circle2"></i></button>
        </div>
    </div>
</div>
