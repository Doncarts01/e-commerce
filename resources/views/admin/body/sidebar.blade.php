<div class="vertical-menu">

    <div data-simplebar class="h-100">
{{-- to get the id of the user  --}}
@php
$id = Auth::guard('admin')->user()->id;
$adminData = App\Models\Admin::find($id);
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
                    <a href="{{ url('admin/dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                    @php
                        use App\Models\orders;
                        use App\Models\contact;
                        use App\Models\subscribers;
                        $orders = orders::latest()->count();
                        $contact = contact::latest()->count();
                        $subscribers = subscribers::latest()->count();
                    @endphp
                <li>
                    <a href="{{ route('view_orders') }}" class="waves-effect">
                        <i class="ri-shopping-cart-fill"></i>
                        <span class="badge rounded-pill bg-danger float-end">{{ $orders }}</span>
                        <span>Orders</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contacts') }}" class="waves-effect">
                        <i class="ri-phone-line"></i>
                        <span class="badge rounded-pill bg-danger float-end">{{ $contact }}</span>
                        <span>Contacts</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('subscribers') }}" class="waves-effect">
                        <i class="ri-phone-line"></i>
                        <span class="badge rounded-pill bg-danger float-end">{{ $subscribers }}</span>
                        <span>Subscribers</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-list-fill"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add_category') }}">Add Category</a></li>
                        <li><a href="{{ route('view_categories') }}">View All Categories </a></li>
                        <li><a href="{{ route('deleted_categories') }}">Recently Deleted Categories </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bill-line"></i>
                        <span>Sub Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add_Subcategory') }}">Add SubCategory</a></li>
                        <li><a href="{{ route('view_subcategories') }}">View SubCategoies </a></li>
                        <li><a href="{{ route('deleted_subcategories') }}">Recently Deleted SubCategories </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-font-color"></i>
                        <span>Color</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add_color') }}">Add Color</a></li>
                        <li><a href="{{ route('view_colors') }}">View Colors </a></li>
                        <li><a href="{{ route('deleted_colors') }}">Recently Deleted Colors </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-logout-box-fill"></i>
                        <span>Brand</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add_brand') }}">Add a Brand</a></li>
                        <li><a href="{{ route('view_brands') }}">View All Brands </a></li>
                        <li><a href="{{ route('deleted_brands') }}">Recently Deleted Brands </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-product-hunt-line"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add_products') }}">Add Products</a></li>
                        <li><a href="{{ route('view_products') }}">View All Products </a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('admin/view/discount') }}" class="waves-effect">
                        <i class="ri-gift-line"> </i>
                        <span>Coupon Code</span>
                    </a>
                </li>

                <li>
                    @php
                        use App\Models\shippingCharge;
                        $shippingCount = shippingCharge::getRecord();
                    @endphp
                    <a href="{{ url('admin/view/shipping-charge') }}" class="waves-effect">
                        <i class="ri-sailboat-fill"></i><span class="badge rounded-pill bg-danger float-end">{{ $shippingCount->count() }}</span>
                        <span>Shipping Charges</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/page/list') }}" class="waves-effect">
                        <i class="ri-pages-line"></i>
                        <span>Pages</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/slider-settings') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Slider Settings</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/supported-brands') }}" class="waves-effect">
                        <i class="ri-logout-circle-r-fill"></i>
                        <span>Supported Brands</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/system-settings') }}" class="waves-effect">
                        <i class="ri-settings-3-line"></i>
                        <span>System Settings</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/payment-settings') }}" class="waves-effect">
                        <i class="ri-settings-3-line"></i>
                        <span>Payment Settings</span>
                    </a>
                </li>

                <li class="menu-title">Users</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route("customerView") }}">Customers List</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>