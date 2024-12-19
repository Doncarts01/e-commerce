<div class="vertical-menu">

    <div data-simplebar class="h-100">
{{-- to get the id of the user  --}}
@php
$id = Auth::user()->id;
$userData = App\Models\User::find($id);
@endphp
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty($userData->profile_image)) ? url('upload/user_images/'.$userData->profile_image) :url('upload/no_image.PNG') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ $userData->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ url('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user_order_list') }}" class="waves-effect">
                        <i class="ri-shopping-cart-fill"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <li class="menu-title">Profile</li>

                <li>
                    <a href="{{ route('user_Edit_Profile') }}" class="waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>