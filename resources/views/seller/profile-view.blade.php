@extends('seller.seller-master')

@section('seller')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <div class="mx-auto">
                                <img class="rounded-circle avatar-xl" src="{{ (!empty($adminData->profile_image)) ? url('upload/admin_images/'.$adminData->profile_image) :url('upload/no_image.PNG') }}" alt="Card image cap">
                        </div>

                        <div class="card-body">
                                    <h4 class="card-title">Name : {{ $adminData->name }} </h4>
                                    <hr>
                                    <h4 class="card-title">User Email : {{ $adminData->email }} </h4>
                                    <hr>
                                    <a href="{{ route('seller_edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div>

@endsection 