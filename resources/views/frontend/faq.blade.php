@extends('frontend.frontend_masters')

@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | FAQ
@endsection


@section('main')

<main class="main about">

    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background-color: ash;">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-sm-12 col-xl-12 col-lg-12">
                        <h3 class="text-center">FAQ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">{{ $faq->title }}</h2>
            <p>
                {!! $faq->description !!}
            </p>
        </div><!-- End .container -->
    </div><!-- End .about-section -->

</main><!-- End .main -->


@endsection


