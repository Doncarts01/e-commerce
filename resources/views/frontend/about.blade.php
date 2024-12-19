@extends('frontend.frontend_masters')


@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | About
@endsection

@section('main')


<main class="main about">
    <div class="page-header page-header-bg text-left"
        style="background: 50%/cover #D4E1EA url({{ $about->image_name }});">
        <div class="container">
            <h1><span>ABOUT US</span>
                OUR COMPANY</h1>
            <a href="{{ url('contact') }}" class="btn btn-dark">Contact</a>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">{{ $about->title }}</h2>

            {!! $about->description !!}

        </div><!-- End .container -->
    </div><!-- End .about-section -->

</main><!-- End .main -->


@endsection


