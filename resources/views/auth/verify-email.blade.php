<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>User | Verify email</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Verify email" name="description" />
        <meta content="Verify email" name="author" />
        @php
            $getSystemSettingsApp = App\Models\settings::getSingle();
        @endphp
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url($getSystemSettingsApp->favicon) }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}"
         rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href= "{{ asset('backend/assets/css/app.min.css') }}"
        id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        {{-- <div class="bg-overlay"></div> --}}
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="{{ url('/') }}" class="auth-logo">
                                    <img src="{{ url($getSystemSettingsApp->logo) }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ url($getSystemSettingsApp->logo) }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <div>
                            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="text-success">
                                A new verification link has been sent to the email address you provided during registration.
                            </div>
                        @endif

                        <div class="">
                            <form method="POST" action="{{ route('verification.send') }}" class="form-horizontal mt-3">
                                @csrf
    
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-dark d-block"> Resend Verification Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src=" {{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src=" {{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src=" {{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src=" {{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src=" {{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src=" {{ asset('backend/assets/js/app.js') }}"></script>

    </body>
</html>




{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
