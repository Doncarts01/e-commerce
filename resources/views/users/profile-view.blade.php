@extends('users.user-master')

@section('user_title')
    <title>
        User | Profile
    </title>    
@endsection

@section('users')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <div class="mx-auto">
                                <img class="rounded-circle avatar-xl" src="{{ (!empty($userData->profile_image)) ? url('upload/user_images/'.$userData->profile_image) :url('upload/no_image.PNG') }}" alt="Card image cap">
                        </div>

                        <div class="card-body">
                                    <h4 class="card-title">FirstName : {{ $userData->firstname }} </h4>
                                    <hr>
                                    <h4 class="card-title">LastName : {{ $userData->lastname }} </h4>
                                    <hr>
                                    <h4 class="card-title">Display name : {{ $userData->name }} </h4>
                                    <hr>
                                    <h4 class="card-title">Email : {{ $userData->email }} </h4>

                        </div>
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                                    <h4 class="card--header">Other Details</h4>
                                    <hr>
                                    <h4 class="card-title">Country : {{ $userData->country }} </h4>
                                    <hr>
                                    <h4 class="card-title">State : {{ $userData->state }} </h4>
                                    <hr>
                                    <h4 class="card-title">City : {{ $userData->city }} </h4>
                                    <hr>
                                    <h4 class="card-title">Address : {{ $userData->address1 }} </h4>
                                    @if(!empty($userData->address2))
                                    <hr>
                                    <h4 class="card-title">Address 2 : {{ $userData->address2 }} </h4>
                                    @endif
                                    <hr>
                                    <h4 class="card-title">Phone : {{ $userData->phone }} </h4>
                                    <hr>
                                    <a href="{{ route('user_Edit_Profile') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                        </div>
                    </div>
                </div> 

            </div> 
        </div>
    </div>

@endsection 