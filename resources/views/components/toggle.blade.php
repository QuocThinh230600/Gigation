@if ($label)
    <div class="form-group">
        <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

        <div class="row">
            <div class="col-sm-6">
                <input
                    type="checkbox"
                    data-on-color="success"
                    data-off-color="danger"
                    name="{{ $name }}"
                    data-on-text="{{ $on }}"
                    data-off-text="{{ $off }}"
                    class="form-check-input-switch"
                    {{ ($slot == 'on') ? 'checked' : '' }}
                    {{ $attrDisabled }}/>
            </div>
        </div>
    </div>
@else
    <input
        type="checkbox"
        data-on-color="success"
        data-off-color="danger"
        name="{{ $name }}"
        data-on-text="{{ $on }}"
        data-off-text="{{ $off }}"
        data-size="small"
        data-uuid="{{ $uuid ?? 'uuid' }}"
        data-id="{{ $id }}"
        data-column="{{ $column }}"
        data-table="{{ $table }}"
        class="form-check-input-switch"
        {{ ($slot == 'on') ? 'checked' : '' }} />
@endif
