@extends('frontend.frontend_masters')


@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Categories
@endsection


@section('main')


<style>
    /* Ensure that the loader container takes up the full viewport */
#loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center;    /* Center vertically */
    background-color: rgba(0, 0, 0, 0.5); /* Optional: semi-transparent background */
    z-index: 9999; /* Ensure the loader is on top of other elements */
    display: none; 
}

/* Style the loader (a simple spinner in this case) */
#loader {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 9999; /* Ensure the loader is on top of other elements */
    border: 8px solid #f3f3f3; /* Light grey background */
    border-top: 8px solid #3498db; /* Blue spinner color */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

/* Keyframes for spinning animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>
<div id="loader-container">
    <div id="loader"></div>
</div>








    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase" {{-- style="background: no-repeat 60%/cover url('{{ asset('frontend/assets/images/banners/banner-top.jpg') }}');"> --}} style="background-color: ash;">
                <div class="container position-relative">
                    <div class="row">
                        {{-- <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1"> --}}
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                            @if (!empty($subCategory))
                                <h3 class="text-center">{{ $subCategory->name }}</h3>
                            @elseif (!empty($categories))
                                <h3 class="text-center">{{ $categories->name }}</h3>
                            @else
                                <h3 class="text-center">Search results for {{ $search }}</h3>
                            @endif
                            {{-- <a href="category.html" class="btn btn-dark">Get Yours!</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Shop</a></li>
                    @if (!empty($subCategory))
                        <li class="breadcrumb-item"> <a
                                href="{{ route('front_categories', [$categories->id, Str::slug($categories->name)]) }}">{{ $categories->name }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subCategory->name }}</li>
                    @elseif (!empty($categories))
                        <li class="breadcrumb-item active" aria-current="page">{{ $categories->name }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page"> Results found for {{ $search }}</li>
                    @endif
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle">
                                <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>

                            <!--<div class="toolbox-item toolbox-sort">-->
                            <!--    <label>Show:</label>-->

                            <!--    <div class="select-custom">-->
                            <!--        <select name="count" class="form-control">-->
                            <!--            <option value="12">12</option>-->
                            <!--            <option value="24">24</option>-->
                            <!--            <option value="36">36</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                                <!-- End .select-custom -->


                            <!--</div>-->
                            <!-- End .toolbox-item -->
                        </div>
                        <!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>Sort By:</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control changeSortBy" id="sortBy">
                                        <option value="">Select</option>
                                        <option value="popularity">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->

                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

{{-- the dynamic Product with Ajax --}}

                    <div id="getTheProductAjax">
                        @include('frontend._category')
                    </div>

                    {{-- <div class="text-center">
                        @if(!empty($productPage))
                        <a href="javascript:void(0)" data-page = "{{ $productPage }}" class="btn btn-primary loadMore">Load More</a>
                        @endif
                    </div> --}}

{{-- the dynamic Product with Ajax --}}

                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>

                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">

                    <form action="" id="filterForm" method="POST">
                        @csrf
                        <input type="hidden" id="q" name="q" value="{{ !empty($search) ? $search : "" }}">
                        <input type="hidden" id="old_cat_id" name="old_cat_id" value="{{ !empty($categories) ? $categories->id : "" }}">
                        <input type="hidden" id="old_subcat_id" name="old_subcat_id" value="{{ !empty($subCategory) ? $subCategory->id : "" }}">
                        <input type="hidden" id="getSubCategoryId" name="subCategoryId">
                        <input type="hidden" id="getBrandId" name="brandId">
                        <input type="hidden" id="getColorId" name="colorId">
                        <input type="hidden" id="getSortBy" name="sortBy">
                        <input type="hidden" id="getStartPrice" name="start_price">
                        <input type="hidden" id="getEndPrice" name="end_price">
                    </form>


                    <div class="sidebar-wrapper">
                        @if(!empty($getSubCatFilter ))
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                   aria-controls="widget-body-2">Categories</a>
                            </h3>
                                <div class="collapse show" id="widget-body-2">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                            @foreach ($getSubCatFilter as $subCat_filter)                  
                                    <li>
                                        <label for="sub-{{ $subCat_filter->id }}" class="form-label text-muted"> 
                                            <input type="checkbox" id="sub-{{ $subCat_filter->id }}" value="{{ $subCat_filter->id }}" class="changeSubCategory"> {{ $subCat_filter->name }}
                                        </label>
                                        <span class="products-count">({{ $subCat_filter->totalProducts() }})</span>
                                    </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->                                
                        </div>
                        @endif


                        <div class="widget widget-color">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
                                    aria-controls="widget-body-4">Color</a>
                            </h3>

                            <div class="collapse show" id="widget-body-4">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        @foreach ($getColors as $colors)
                                        <li class="changeColor" id="{{ $colors->id }}">
                                            <a href="javascript:void(0)"  style="background-color: {{ $colors->code }};"></a>
                                        </li>                                            
                                        @endforeach 
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true"
                                   aria-controls="widget-body-2">Brand</a>
                            </h3>
                                <div class="collapse show" id="widget-body-5">
                                    <div class="widget-body">
                                        <ul class="cat-list">  
                                            @foreach ($getBrands as $brand)
                                            <li><label for="brand-{{ $brand->id }}" class="form-label text-muted"> <input type="checkbox" id="brand-{{ $brand->id }}" value="{{ $brand->id }}" class="changeBrand"> {{ $brand->name }}</label></li>                                                
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->                                
                        </div>
                        <!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-7" role="button" aria-expanded="true"
                                    aria-controls="widget-body-3">Price</a>
                            </h3>

                            <div class="collapse show" id="widget-body-7">
                                <div class="widget-body pb-0">
                                        <div class="price-slider-wrapper">
                                            <div id="price-slider"></div>
                                            <!-- End #price-slider -->
                                        </div>
                                        <!-- End .price-slider-wrapper -->

                                        <div
                                            class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="filter-price-text">
                                                Price:
                                                <span id="filter-price-range"></span>
                                            </div>
                                            <!-- End .filter-price-text -->

                                            {{-- <button type="submit" class="btn btn-primary">Filter</button> --}}
                                        </div>
                                        <!-- End .filter-price-action -->
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>

                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->


    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nouislider.min.js') }}"></script>
    <script>
        var i = 0;
        var xhr;
        $(document).ready(function() {

            $('.changeSortBy').change( function() {
                var id = $(this).val()
                $('#getSortBy').val(id);
                filterForm();
            });

            $('.changeSubCategory').change( function() {
                var ids = "";
                $('.changeSubCategory').each( function() {
                    if(this.checked){
                        var id = $(this).val()
                        ids += `${id} ,`;
                    }
                });

                $('#getSubCategoryId').val(ids);
                filterForm();
            });

            $('.changeBrand').change( function() {
                var ids = "";
                $('.changeBrand').each( function() {
                    if(this.checked){
                        var id = $(this).val()
                        ids += `${id} ,`;
                    }
                });

                $('#getBrandId').val(ids);
                filterForm();
            });

            $('.changeColor').click( function() {
                var ids = "";
                var id = $(this).attr('id')
                $(this).toggleClass('active');
                $('.changeColor').each( function() {
                    if($(this).hasClass('active')){
                        var id = $(this).attr('id')
                        ids += `${id} ,`;
                    }
                });

                $('#getColorId').val(ids);
                filterForm();
            });

            function filterForm(){

                if(xhr && xhr.readyState != 4){
                    xhr.abort();
                }

                // Show the loader
                $('#loader-container').show();

                xhr = $.ajax({
                    url: "{{ url('get_filter_product_ajax') }}",
                    type: 'POST',
                    data: $('#filterForm').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        $('#loader-container').hide();
                        $('#getTheProductAjax').html(data.success);
                    },
                    error: function(data) {
                        $('#loader-container').hide();
                    }
                });
            }
            
        });


        document.addEventListener("DOMContentLoaded", function () {
            if (typeof noUiSlider !== "undefined") {
                // filterSlider();
                var e = document.getElementById("price-slider");
                if (e !== null) {
                    noUiSlider.create(e, {
                        start: [0, 5000],
                        connect: true,
                        step: 1,
                        margin: 1,
                        range: { min: 0, max: 5000 },
                    });
                    e.noUiSlider.on("update", function (values, handle) {
                        var start_price = values[0];
                        var old_price = values[1];

                        $('#getStartPrice').val(start_price);
                        $('#getEndPrice').val(old_price);

                        var formattedValues = values.map(function (value) {
                            return "Є" + parseInt(value);
                        });
                        document.getElementById("filter-price-range").textContent = formattedValues.join(" - ");

                        if(i == 0 || i == 1 ){
                            i++;
                        }else{
                            if(xhr && xhr.readyState != 4){
                                xhr.abort();
                            }

                            // Show the loader
                            $('#loader-container').show();


                            xhr = $.ajax({
                                url: "{{ url('get_filter_product_ajax') }}",
                                type: 'POST',
                                data: $('#filterForm').serialize(),
                                dataType: 'json',
                                success: function(data) {
                                    $('#loader-container').hide();
                                    $('#getTheProductAjax').html(data.success);
                                },
                                error: function(data) {
                                    $('#loader-container').hide();
                                }
                            });
                        }
                    });
                }
            }

        });

    </script>
        
@endsection


