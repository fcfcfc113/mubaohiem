@extends('layouts.app')

@section('title','Mũ Bảo Hiểm Trẻ Em | Single Product')
@section('meta_description','Mũ bảo hiểm cho bé 2–6 tuổi — ABS nguyên sinh, lót EPS thoáng khí...')

@section('content')

    <div class="row g-4 align-items-start">
    <div class="col-lg-6">
        @include('products.sections._gallery')
    </div>
    <div class="col-lg-6">
        @include('products.sections._details')
    </div>
    </div>
    @include('products.sections._features')
    @include('products.sections._promotion')
    @include('products.sections._reviews')
    @include('products.sections._modals')

@endsection

@push('scripts')
    <script src="{{ asset('public/js/product.js') }}"></script>
@endpush
