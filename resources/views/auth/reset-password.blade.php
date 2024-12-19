<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>User - Reset Password </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="User Reset Password" name="description" />
        <meta content="User Reset Password" name="author" />
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
    
                        <div class="p-3">
                            <form method="POST" action="{{ route('password.store') }}" class="form-horizontal mt-3">
                                @csrf
    
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" required id="email" name="email" value="{{ $request->email }}">
                                    </div>
                                   <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" required id="password" name="password" placeholder="Password">
                                    </div>
                                   <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" required id="password" name="password_confirmation" placeholder="Password">
                                    </div>
                                   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>
    
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-dark w-100 waves-effect waves-light" type="submit">Reset Password</button>
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
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
