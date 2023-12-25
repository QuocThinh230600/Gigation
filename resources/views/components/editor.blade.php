<div class="form-group">

    <label class="font-weight-semibold">{{ $label }} {!! $attrRequired !!}</label>

    <button type="button" class="btn btn-info btn-labeled d-block mb-2 remove-editor" name="{{ $name }}" visible-ckeditor="show">{{ trans('form.element.editor_button') }}</button>

    <textarea name="{{ $name }}" class="form-control" id="{{ $name }}" rows="4" cols="4" {{ $attrDisabled }}>{{ $slot }}</textarea>

    @if ($editor)
        <script type="text/javascript">
            CKEDITOR.replace("{{ $name }}", {
                height: "{{ $height ?? '200'}}"
            });
        </script>
    @endif
</div>
