<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ url($getSystemSettingsApp->logo) }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url($getSystemSettingsApp->logo) }}" alt="logo-dark" height="30">
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ url($getSystemSettingsApp->logo) }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url($getSystemSettingsApp->logo) }}" alt="logo-light" height="40">
                    </span>
                </a>
            </div>
{{-- to get the id of the user  --}}
@php
$id = Auth::user()->id;
$userData = App\Models\User::find($id);
@endphp
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                @php
                $getUnreadUserNotification = App\Models\notification::getUnreadUserNotification($userData->id)
            @endphp
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                      data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @if (!empty($getUnreadUserNotification->count()))
                        <span class="noti-dot"></span>
                    @endif
                </button>


                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">{{ $getUnreadUserNotification->count() }} Notification(s) </h6>
                            </div>
                            <div class="col-auto">
                                {{-- <a href="#!" class="small"> View All</a> --}}
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach ($getUnreadUserNotification as $notification)
                        <a href="{{ $notification->url }}?notification_id={{ $notification->id }} " class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">{{ $notification->message }}</h6>
                                    <div class="font-size-12 text-muted">
                                        {{-- <p class="mb-1">If several languages coalesce the grammar</p> --}}
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ url('user/notification') }}">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View All
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (!empty($userData->profile_image)) ? url('upload/user_images/'.$userData->profile_image) :url('upload/no_image.PNG') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $userData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route("user_Profile") }}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ url('/') }}"><i class="mdi mdi-home"></i> Back to Home</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route("user_logout") }}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>