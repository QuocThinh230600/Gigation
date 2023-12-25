@extends('administrator.master')
@section('module', module('contact'))
@section('action', behavior('action.reply'))
@section('title', title_module('contact','reply'))

@canany(['contact_index', 'contact_destroy'])
    @section('index', route('admin.contact.index',['contact' => $contact->uuid]))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-pink-400 text-white text-center p-3" style="background-image: url({{ asset('administrator/global_assets/images/backgrounds/panel_bg.png') }}); background-size: contain;">
                <div>
                    <a href="#" class="btn btn-lg btn-icon mb-3 mt-1 btn-outline text-white border-white bg-white rounded-round border-2">
                        <i class="icon-quotes-right"></i>
                    </a>
                </div>

                <blockquote class="blockquote blockquote-bordered py-2 pl-3 mb-0 text-left">
                    <p class="mb-2 font-size-base">"{{ $contact->message }}"</p>
                    <footer class="blockquote-footer text-white">
                        <div>
                            {{ date('d/m/Y', strtotime($contact->created_at)) }}
                        </div>
                        <div>
                            {{ label('contact.full_name') }} : <cite title="Full Name">{{ $contact->full_name }}</cite>
                        </div>
                        <div>
                            {{ label('contact.phone') }} : <cite title="Phone">{{ $contact->phone }}</cite>
                        </div>
                        <div>
                            {{ label('contact.email') }} : <cite title="Email">{{ $contact->email }}</cite>
                        </div>
                        <div>
                            {{ label('contact.address') }} : <cite title="Address">{{ $contact->address }}</cite>
                        </div>
                    </footer>
                </blockquote>
            </div>

            <x-card title="action.info">
                <div class="list-feed">
                    <div class="list-feed-item border-danger-400">
                        <div class="text-muted font-size-sm mb-1">{{ date('d/m/Y - h:i:s', strtotime($contact->created_at)) }} ({{ \Carbon\Carbon::parse($contact->created_at)->diffForHumans() }})</div>
                        {{ label('contact.guest') }} <a href="#">{{ $contact->full_name }}</a> {{ label('contact.sent_1_contact') }}
                    </div>

                    @foreach ($replies as $reply)
                        @switch($reply->status)
                            @case (1)
                                @php
                                    $classBorder = 'border-danger-400'
                                @endphp
                                @break
                            @case (2)
                                @php
                                    $classBorder = 'border-warning-400'
                                @endphp
                                @break
                            @case (3)
                                @php
                                    $classBorder = 'border-info-400'
                                @endphp
                                @break
                            @case (4)
                                @php
                                    $classBorder = 'border-success-400'
                                @endphp
                                @break
                            @default
                                @php
                                    $classBorder = 'border-danger-400'
                                @endphp
                                @break
                        @endswitch


                    <div class="list-feed-item {{ $classBorder }}">
                        <div class="text-muted font-size-sm mb-1">{{ date('d/m/Y - h:i:s', strtotime($reply->created_at)) }} ({{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }})</div>
                        {{ label('contact.admin') }} <a href="#">{{ $reply->users->full_name }}</a> {{ label('contact.status_update') }}
                        @foreach (status_contact() as $status_code)
                            @if ($status_code->id == $reply->status)
                                <span class="text-info">{{ ($status_code->name) }}</span>
                            @endif
                        @endforeach

                        @if (!empty($reply->reply))
                            {{ label('contact.with_content') }} <p>{!!  $reply->reply !!}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </x-card>

            <form action="{{ route('admin.contact.send_reply',['contact' => $contact->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
                @csrf
                @method('POST')

                <div class="row">
                    @include('administrator.partials.button', ['exit' => route('admin.contact.index')])

                    <div class="col-lg-12">
                        <x-card title="action.info" id="forms-target-left">
                            <x-selectbox label="element.status" name="status" :dataSelect="status_contact()" required="required">
                                {{ old('status', $selected_status) }}
                            </x-selectbox>

                            <x-editor label="contact.reply" name="reply">
                                {{ old('reply') }}
                            </x-editor>
                        </x-card>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
