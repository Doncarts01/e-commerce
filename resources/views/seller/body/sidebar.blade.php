<div class="vertical-menu">

    <div data-simplebar class="h-100">
{{-- to get the id of the user  --}}
@php
$id = Auth::guard('seller')->user()->id;
$adminData = App\Models\Seller::find($id);
@endphp
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty($adminData->profile_image)) ? url('upload/admin_images/'.$adminData->profile_image) :url('upload/no_image.PNG') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ $adminData->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ url('seller/dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-add-box-line"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route("add.blogCat") }}">Add Blog Category</a></li>
                        <li><a href="{{ route("add.blog") }}">Add Blog </a></li>
                        <li><a href="{{ route("view.blogCat") }}">View Blog Categories </a></li>
                        <li><a href="{{ route("view.blogs") }}">View All Blogs </a></li> --}}
                    </ul>
                </li>

                <li class="menu-title">Users</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Users View</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route("admin.all") }}">Users</a></li> --}}
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>