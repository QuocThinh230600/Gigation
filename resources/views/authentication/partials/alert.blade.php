<div class="alert bg-danger alert-styled-left alert-dismissible print-error-msg" style="display: none">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">Oh snap!</span>
    <ul class="m-0"></ul>
</div>

<div class="alert bg-success alert-styled-left alert-dismissible print-success-msg" style="display: none">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">Well done!</span> <span class="message-success"></span>
</div>

<div class="alert bg-warning alert-styled-left alert-dismissible print-warning-msg" style="display: none">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold">Warning!</span> <span class="message-warning"></span>
</div>

@if (session('success'))
    <div class="alert bg-success alert-styled-left alert-dismissible animated bounceInLeft">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">Well done!</span> {{ __(session('success')) }}
    </div>
@endif

@if (session('warning'))
    <div class="alert bg-warning alert-styled-left alert-dismissible animated bounceInLeft">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">Warning!</span> {{ __(session('warning')) }}
    </div>
@endif

@if (session('error'))
    <div class="alert bg-danger alert-styled-left alert-dismissible animated bounceInLeft">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">Error!</span> {{ __(session('error')) }}
    </div>
@endif
