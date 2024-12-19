<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Adnin - Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Admin Login" name="description" />
        <meta content="Admin Login" name="author" />
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
    
                        <h4 class="text-muted text-center font-size-18"><b>Sign In Admin</b></h4>
    
                        <div class="p-3">
                            <form method="POST" action="{{ route('admin_login_submit') }}" class="form-horizontal mt-3">
                                @csrf
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" id="email" name="email" required  placeholder="Email address">
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
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                        </div>


                                    </div>
                                </div>
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
    
                                <div class="form-group mb-0 row mt-2">
                                    <div class="col-sm-7 mt-3">
                                        <a href="{{ route('admin_forgot_password') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                    {{-- <div class="col-sm-5 mt-3">
                                        <a href="{{ route('admin_register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                    </div> --}}
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
         @if (Session::has('message'))
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




