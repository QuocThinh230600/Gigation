<div class="col-lg-12">
    <div class="card border-top-info rounded-0 animated fadeIn">
        <div class="card-body">
            <button type="submit" class="btn btn-info btn-labeled btn-labeled-left">
                <b><i class="icon-floppy-disk"></i></b> {{ behavior('button.save') }}
            </button>

            <button type="reset" class="btn btn-warning btn-labeled btn-labeled-left">
                <b><i class="icon-blocked"></i></b> {{ behavior('button.reset') }}
            </button>

            <button onClick="window.location.href='{{ $exit }}'" type="button" class="btn btn-danger btn-labeled btn-labeled-left">
                <b><i class="icon-enter3"></i></b> {{ behavior('button.close') }}
            </button>
        </div>
    </div>
</div>
