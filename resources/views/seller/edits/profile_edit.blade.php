@extends('seller.seller-master')

@section('seller')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
        
                    <h1 class="card-title">EDIT PROFILE </h1>
        
                    <form method="post" action="{{ route('seller_store.profile') }}" enctype="multipart/form-data">
                        @csrf
        
                    <div class="row mb-3 mt-4">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{ $editData->name }}"  id="example-text-input">
                        </div>
                    </div>
                    <!-- end row -->
        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" type="enail" value="{{ $editData->email }}"  id="example-text-input">
                        </div>
                    </div>
                    <!-- end row -->
        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image </label>
                        <div class="col-sm-10">
            <input name="profile_image" class="form-control" type="file"  id="image">
                        </div>
                    </div>
                    <!-- end row -->
        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image)) ? url('upload/admin_images/'.$editData->profile_image) :url('upload/no_image.PNG') }}" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                    </form>
        
        
        
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    
    
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
        
                    <h1 class="card-title">CHANGE PASSWORD </h1>
        
                    <form method="post" action="{{ route('password.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
        
                    <div class="row mb-3 mt-4">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input id="current_password" name="current_password"class="form-control" type="password"  >
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input id="password" name="password" class="form-control" type="password"  >
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input id="password_confirmation" name="password_confirmation" class="form-control" type="password"  >
                        </div>
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                    <!-- end row -->
        
                    <div class="flex items-center gap-4">
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                        @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-success-600 text-bold"
                        >{{ __('Password successfully changed.') }}</p>
                    @endif
                    </div>
        

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    </div>
    </div>

    <script type="text/javascript">
    
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection 