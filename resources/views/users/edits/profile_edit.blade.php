
@extends('users.user-master')

@section('user_title')
    <title>
        User | Edit Profile
    </title>    
@endsection

@section('users')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
        
                    <h1 class="card-title">EDIT PROFILE </h1>
        
                    <form method="post" action="{{ route('user_store_profile') }}" enctype="multipart/form-data">
                        @csrf
        
                        <div class="row mb-3 mt-4">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Firstname | Lastname</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input name="firstname" class="form-control" type="text" value="{{ $editData->firstname }}"  id="example-text-input" placeholder="firstname">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input name="lastname" class="form-control" type="text" value="{{ $editData->lastname }}"  id="example-text-input" placeholder="lastname">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control" type="text" value="{{ $editData->name }}"  id="example-text-input">
                        </div>
                    </div>
                    <!-- end row -->

        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Email Address</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" type="enail" value="{{ $editData->email }}"  id="example-text-input" {{ 'readonly' }}>
                        </div>
                    </div>

                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <input name="country" class="form-control" type="text" value="{{ $editData->country }}"  id="example-text-input">
                        </div>
                    </div>

                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Street Address</label>
                        <div class="col-sm-10">
                            <input name="address1" class="form-control" type="text" value="{{ $editData->address1 }}"  id="example-text-input" placeholder="House number and street name">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input name="address2" class="form-control" type="text" value="{{ $editData->address2 }}"  id="example-text-input" placeholder="Apartment, suites,units, etc (optional) ">
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">City | State</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input name="city" class="form-control" type="text" value="{{ $editData->city }}"  id="example-text-input" placeholder="Town / City">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input name="state" class="form-control" type="text" value="{{ $editData->state }}"  id="example-text-input" placeholder="State">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Postcode | Phone</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input name="postcode" class="form-control" type="text" value="{{ $editData->postcode }}"  id="example-text-input" placeholder="postcode">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input name="phone" class="form-control" type="text" value="{{ $editData->phone }}"  id="example-text-input" placeholder="phone no.">
                                </div>
                            </div>
                        </div>
                    </div>
        
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
                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image)) ? url('upload/user_images/'.$editData->profile_image) :url('upload/no_image.PNG') }}" alt="Card image cap">
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