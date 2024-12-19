<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>User - Unsubscribe </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Forgot Paassword" name="description" />
        <meta content="Forgot Paassword" name="author" />
        @php
            $getSystemSettingsApp = App\Models\settings::getSingle();
        @endphp
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url($getSystemSettingsApp->favicon) }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('logs/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('logs/assets/css/icons.min.css') }}"
         rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href= "{{ asset('logs/assets/css/app.min.css') }}"
        id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>

    <body class="bg-light">
        {{-- <div class="bg-overlay"></div> --}}
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-3">
                            <div class="mb-2">
                                <a href="{{ url('/') }}" class="auth-logo">
                                    <img src="{{ url($getSystemSettingsApp->logo) }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ url($getSystemSettingsApp->logo) }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
    
                        <div class=" text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                            <!-- Session Status -->
                        <div class="p-3 pt-1">
                            <form method="POST" action="{{ route('password.email') }}" class="form-horizontal mt-3">
                                @csrf
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" id="email" name="email" required  value="Email address">
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-dark w-100 waves-effect waves-light" type="submit">Email Password Reset Link</button>
                                    </div>
                                </div>
    
                                <div class="form-group mb-0 row mt-2">
                                    <div class="col-sm-5 mt-3">
                                        <a href="{{ url('/login') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Back to login</a>
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
        <script src=" {{ asset('logs/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src=" {{ asset('logs/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src=" {{ asset('logs/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src=" {{ asset('logs/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src=" {{ asset('logs/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src=" {{ asset('logs/assets/js/app.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
         }
         @endif 
        </script>

    </body>
</html>


{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
