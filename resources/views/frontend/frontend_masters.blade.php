<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>

    @php
        $getSystemSettingsApp = App\Models\settings::getSingle();
    @endphp

    <meta name="description" content="Indulge in delicious gourmet foods and fresh ingredients at [Your Store Name]. From organic produce and artisanal cheeses to ready-to-eat meals and specialty snacks, we offer a wide variety of high-quality food products. Enjoy convenient online shopping, fast delivery, and exclusive deals. Discover unique flavors and elevate your culinary experience with [Your Store Name]. Shop now and taste the difference with every bite.">
    <meta name="keywords" content="gourmet foods, fresh ingredients, organic produce, artisanal cheeses, ready-to-eat meals, specialty snacks, food delivery, online grocery">
    <meta name="author" content="{{ $getSystemSettingsApp->name }}">
    <!-- Open Graph Meta Tags for Social Media and WhatsApp -->
    <meta property="og:title" content="{{ $getSystemSettingsApp->name }} - Gourmet Foods and Fresh Ingredients Delivered">
    <meta property="og:description" content="Explore a world of gourmet foods, fresh ingredients, and specialty items at {{ $getSystemSettingsApp->name }}. Enjoy premium quality, fast delivery, and exclusive offers. From artisanal cheeses to organic produce, find everything you need to enhance your culinary adventures.">
    <meta property="og:image" content="{{ $getSystemSettingsApp->getLogo() }}"> <!-- Replace with your image URL -->
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $getSystemSettingsApp->name }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $getSystemSettingsApp->name }}  - Gourmet Foods and Fresh Ingredients Delivered">
    <meta name="twitter:description" content="Discover premium gourmet foods, fresh ingredients, and specialty items at [Your Store Name]. Enjoy convenient online shopping, fast delivery, and exclusive offers.">
    <meta name="twitter:image" content="{{ $getSystemSettingsApp->getLogo() }}"> <!-- Replace with your image URL -->
    <meta name="twitter:site" content="@angeldennis00"> <!-- Replace with your Twitter handle -->

    <!-- Robots Meta Tag -->
    <meta name="robots" content="index, follow">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ $getSystemSettingsApp->getFavIcon() }}">
    <script>
        // WebFontConfig = {
        //     google: {
        //         families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400']
        //     }
        // };
        // (function(d) {
        //     var wf = d.createElement('script'),
        //         s = d.scripts[0];
        //     wf.src = '{{ asset("frontend/assets/js/webfont.js") }}';
        //     wf.async = true;
        //     s.parentNode.insertBefore(wf, s);
        // })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demo4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="page-wrapper">

        @include('frontend.inc.header')

        @yield('main')
        <!-- End .main -->

        @include('frontend.inc.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    @include('frontend.inc.nav')
   
    <!-- Plugins JS File -->
    <script data-cfasync="false" src="{{ asset('frontend/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.j') }}s"></script>
    <script src="{{ asset('frontend/assets/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nouislider.min.js') }}"></script>


    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.min.js') }}"></script>
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


<script>


    $('body').delegate('.add_to_wishlist', 'click', function() {
            var product_id = $(this).attr('id');

            $.ajax({
                url: "{{ route('add_to_wishlist') }}",
                type: 'POST',
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    if (data.isWishlist == 1) {
                        // toastr.success('Added to Wishlist');
                        $('#' + data.product_id).addClass('added-wishlist');
                    } else {
                        // toastr.error('Removed from Wishlist');
                        $('#' + data.product_id).removeClass('added-wishlist');
                    }
                }
            });

    });
</script>
</body>

</html>



