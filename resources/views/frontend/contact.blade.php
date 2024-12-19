@extends('frontend.frontend_masters')

@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Contact
@endsection


@section('main')

<main class="main">

    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background-color: ash;">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-sm-12 col-xl-12 col-lg-12">
                        <h3 class="text-center">Contact Us</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><i class="icon-home"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Contact Us
                </li>
            </ol>
        </div>
    </nav>

    {{-- <div id="map"></div> --}}

    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row">
                <div class="col-12">
                    <h2 class="ls-n-25 m-b-1">
                        {{ $contact->title }}
                    </h2>

                    <p>
                        {!! $contact->description !!}
                    </p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Address</h3>
                            <h5>{{ $getSystemSettingsApp->address }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Phone Number</h3>
                            <h5>
                                {{ $getSystemSettingsApp->phone1 }}
                                <br>
                                {{ $getSystemSettingsApp->phone2 }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-envelope"></i>
                        <div class="feature-box-content">
                            <h3>E-mail Address</h3>
                            <h5>
                                <a href="mailto:{{ $getSystemSettingsApp->email1 }}">{{ $getSystemSettingsApp->email1 }}</a>
                                <br>
                                <a href="mailto:{{ $getSystemSettingsApp->email2 }}">{{ $getSystemSettingsApp->email2 }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-calendar-alt"></i>
                        <div class="feature-box-content">
                            <h3>Working Days/Hours</h3>
                            <h5>
                                {{ $getSystemSettingsApp->working_hours }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2 class="mt-6 mb-2">Send Us a Message</h2>

                <form class="mb-0"  action="{{ route('store.message') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="contact-name">Your Name
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="contact-name" name="name"
                            required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="contact-email">Your E-mail
                            <span class="required">*</span></label>
                        <input type="email" class="form-control" id="contact-email" name="email"
                            required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="contact-message">Your Message
                            <span class="required">*</span></label>
                        <textarea cols="30" rows="1" id="contact-message" class="form-control"
                            name="message" required></textarea>
                    </div>

                    <div class="form-footer mb-0">
                        <button type="submit" class="btn btn-dark font-weight-normal">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

            {{-- <div class="col-lg-6">
                <h2 class="mt-6 mb-1">Frequently Asked Questions</h2>
                <div id="accordion">
                    <div class="card card-accordion">
                        <a class="card-header" href="#" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Curabitur eget leo at velit imperdiet viaculis
                            vitaes?
                        </a>

                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <p>Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Curabitur eget leo at velit
                                imperdiet varius. In eu ipsum vitae velit
                                congue iaculis vitae at risus. Nullam tortor
                                nunc, bibendum vitae semper a, volutpat eget
                                massa.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                            Curabitur eget leo at velit imperdiet vague
                            iaculis vitaes?
                        </a>

                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <p>Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Curabitur eget leo at velit
                                imperdiet varius. In eu ipsum vitae velit
                                congue iaculis vitae at risus. Nullam tortor
                                nunc, bibendum vitae semper a, volutpat eget
                                massa. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Integer
                                fringilla, orci sit amet posuere auctor,
                                orci eros pellentesque odio, nec
                                pellentesque erat ligula nec massa. Aenean
                                consequat lorem ut felis ullamcorper posuere
                                gravida tellus faucibus. Maecenas dolor
                                elit, pulvinar eu vehicula eu, consequat et
                                lacus. Duis et purus ipsum. In auctor mattis
                                ipsum id molestie. Donec risus nulla,
                                fringilla a rhoncus vitae, semper a massa.
                                Vivamus ullamcorper, enim sit amet consequat
                                laoreet, tortor tortor dictum urna, ut
                                egestas urna ipsum nec libero. Nulla justo
                                leo, molestie vel tempor nec, egestas at
                                massa. Aenean pulvinar, felis porttitor
                                iaculis pulvinar, odio orci sodales odio, ac
                                pulvinar felis quam sit.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Curabitur eget leo at velit imperdiet viaculis
                            vitaes?
                        </a>

                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <p>Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Curabitur eget leo at velit
                                imperdiet varius. In eu ipsum vitae velit
                                congue iaculis vitae at risus. Nullam tortor
                                nunc, bibendum vitae semper a, volutpat eget
                                massa.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
                            Curabitur eget leo at velit imperdiet vague
                            iaculis vitaes?
                        </a>

                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                            <p>Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Curabitur eget leo at velit
                                imperdiet varius. In eu ipsum vitae velit
                                congue iaculis vitae at risus. Nullam tortor
                                nunc, bibendum vitae semper a, volutpat eget
                                massa. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Integer
                                fringilla, orci sit amet posuere auctor,
                                orci eros pellentesque odio, nec
                                pellentesque erat ligula nec massa. Aenean
                                consequat lorem ut felis ullamcorper posuere
                                gravida tellus faucibus. Maecenas dolor
                                elit, pulvinar eu vehicula eu, consequat et
                                lacus. Duis et purus ipsum. In auctor mattis
                                ipsum id molestie. Donec risus nulla,
                                fringilla a rhoncus vitae, semper a massa.
                                Vivamus ullamcorper, enim sit amet consequat
                                laoreet, tortor tortor dictum urna, ut
                                egestas urna ipsum nec libero. Nulla justo
                                leo, molestie vel tempor nec, egestas at
                                massa. Aenean pulvinar, felis porttitor
                                iaculis pulvinar, odio orci sodales odio, ac
                                pulvinar felis quam sit.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseFive" aria-expanded="true" aria-controls="collapseThree">
                            Curabitur eget leo at velit imperdiet varius
                            iaculis vitaes?
                        </a>

                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                            <p>Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Curabitur eget leo at velit
                                imperdiet varius. In eu ipsum vitae velit
                                congue iaculis vitae at risus. Nullam tortor
                                nunc, bibendum vitae semper a, volutpat eget
                                massa. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Integer
                                fringilla, orci sit amet posuere auctor,
                                orci eros pellentesque odio, nec
                                pellentesque erat ligula nec massa. Aenean
                                consequat lorem ut felis ullamcorper posuere
                                gravida tellus faucibus. Maecenas dolor
                                elit, pulvinar eu vehicula eu, consequat et
                                lacus. Duis et purus ipsum. In auctor mattis
                                ipsum id molestie. Donec risus nulla,
                                fringilla a rhoncus vitae, semper a massa.
                                Vivamus ullamcorper, enim sit amet consequat
                                laoreet, tortor tortor dictum urna, ut
                                egestas urna ipsum nec libero. Nulla justo
                                leo, molestie vel tempor nec, egestas at
                                massa. Aenean pulvinar, felis porttitor
                                iaculis pulvinar, odio orci sodales odio, ac
                                pulvinar felis quam sit.</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="mb-8"></div>
</main>
@endsection


