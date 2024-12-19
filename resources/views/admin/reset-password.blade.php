<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Adnin - Reset Password </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Admin Reset Password" name="description" />
        <meta content="Admin Reset Password" name="author" />
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
                            <h5 class="text-secondary text-center">Password Reset </h5>

                            <form method="POST" action="{{ route('admin_reset_password_submit') }}" class="form-horizontal mt-3">
                                @csrf
    
                                <input type="hidden" name="token" value="{{ $token }}">
                                {{-- <input type="hidden" name="email" value="{{ $email }}"> --}}
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="email" required id="email" name="email" value="{{ $email }}">
                                    </div>
                                   <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" required id="password" name="password" placeholder="New Password">
                                    </div>
                                   <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" required id="password" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>
    
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset Password</button>
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






{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <h2>Reset password</h2>

    <form action="{{ route('admin_reset_password_submit') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="password" name="password" id="password"><br>
        <input type="password" name="password_confirmation" id="password_confirmation"><br>
        <button type="submit">Submit</button>
    </form>

</body>
</html> --}}
