@extends('website.master')

@section('content')
    <main class="product-page">
        @include('website.modules.product.banner')

        @include('website.modules.product.product_intro')

        @include('website.modules.product.custom_price')

        @include('website.modules.product.client')

        @include('website.modules.product.pricing_table')

        @include('website.modules.product.cost')

        @include('website.modules.product.infrastructure')

        @include('website.modules.product.advantages')

        @include('website.modules.product.platform_support')

        @include('website.modules.product.story')

    </main>
@endsection
