<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\brandController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\colorController;
use App\Http\Controllers\Admin\discountController;
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\pageController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\shippingChargeController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Frontend\contactController;
use App\Http\Controllers\Frontend\frontendController;


use App\Http\Controllers\Frontend\paymentController;
use App\Http\Controllers\Frontend\wishListController;



use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\sellerController;
use App\Http\Controllers\Users\userController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('frontend.index');
// });



require __DIR__.'/auth.php';


/* ========= Admin Starts ========= */
Route::middleware('admin')->prefix('admin')->group(function () {

    Route::controller(AdminController::class)->group(function() {
        Route::get('/dashboard', 'Dashboard')->name('admin_dashboard');
        Route::get('/profile', 'adminProfile')->name('admin.profile');
        Route::get('/edit/profile', 'editProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/view/users', 'viewAllUsers')->name('customerView');
        Route::get('/logout', 'Logout')->name('admin_logout');
        Route::get('/delete/user/{id}', 'deleteCustomer')->name('delete_customer');
        
    });

    // CATEGORY CONTROLLER
    Route::controller(categoryController::class)->group(function() {
        Route::get('/add/category', 'addCategory')->name('add_category');
        Route::post('/store/category', 'storeCategory')->name('store_category');
        Route::post('/update/category', 'updateCategory')->name('update_category');
        Route::get('/view/category', 'viewCategories')->name('view_categories');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete_category');
        Route::get('/restore/category/{id}', 'restoreCategory')->name('restore_category');
        Route::get('/recently-deleted/categories', 'deletedCategories')->name('deleted_categories');
        Route::post('/delete-selected-categories', 'deleteSelectedCategories');
        Route::post('/update-selected-categories-status', 'updateSelectedCategoriesStatus');
    });

    // SUB CATEGORY CONTROLLER
    Route::controller(subCategoryController::class)->group(function() {
        Route::get('/add/sub-category', 'add_Subcategory')->name('add_Subcategory');
        Route::post('/store/sub-category', 'storeSubCategory')->name('store_Subcategory');
        Route::post('/update/sub-category', 'updateSubCategory')->name('update_subcategory');
        Route::get('/view/sub-category', 'viewSubCategories')->name('view_subcategories');
        Route::get('/delete/sub-category/{id}', 'deleteSubCategory')->name('delete_subcategory');
        Route::post('/delete-selected-sub-categories', 'deleteSelectedSubCategories');
        Route::get('/recently-deleted/sub-categories', 'deletedSubCategories')->name('deleted_subcategories');
        Route::post('/update-selected-sub-categories-status', 'updateSelectedSubCategoriesStatus');
        Route::get('/restore/sub-category/{id}', 'restoreSubCategory')->name('restore_subcategory');
    });

    // BRAND CONTROLLER
    Route::controller(brandController::class)->group(function() {
        Route::get('/add/brand', 'addBrand')->name('add_brand');
        Route::post('/store/brand', 'storeBrand')->name('store_brand');
        Route::post('/update/brand', 'updateBrand')->name('update_brand');
        Route::get('/view/brand', 'viewBrands')->name('view_brands');
        Route::get('/delete/brand/{id}', 'deleteBrand')->name('delete_brand');
        Route::get('/restore/brand/{id}', 'restoreBrand')->name('restore_brand');
        Route::get('/recently-deleted/brands', 'deletedBrands')->name('deleted_brands');
        Route::post('/delete-selected-brands', 'deleteSelectedBrands');
        Route::post('/update-selected-brands-status', 'updateSelectedBrandsStatus');
    });

    // COLOR CONTROLLER
    Route::controller(colorController::class)->group(function() {
        Route::get('/add/color', 'addColor')->name('add_color');
        Route::post('/store/color', 'storeColor')->name('store_color');
        Route::post('/update/color', 'updateColor')->name('update_color');
        Route::get('/view/color', 'viewColor')->name('view_colors');
        Route::get('/delete/color/{id}', 'deleteColor')->name('delete_color');
        Route::post('/delete-selected-colors', 'deleteSelectedColors');
        Route::post('/update-selected-colors-status', 'updateSelectedColorStatus');
        Route::get('/recently-deleted/colors', 'deletedColors')->name('deleted_colors');
        Route::get('/restore/color/{id}', 'restoreColor')->name('restore_color');
    });

    // PRODUCT CONTROLLER
    Route::controller(productController::class)->group(function() {
        Route::get('/add/product', 'addProducts')->name('add_products');
        Route::post('/store/product', 'storeProduct')->name('store_product');
        Route::get('/view/products', 'viewProducts')->name('view_products');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit_product');
        Route::post('/get_SubCategory', 'getSubCategory'); 
        Route::post('/update/product', 'updateProduct')->name('update_product'); 
        Route::get('/delete/product/image/{id}', 'imageDelete')->name('image_delete');
        Route::get('/delete/product/{id}', 'deleteProduct')->name('delete_product');
        Route::post('/product_image_sort', 'productImageSort'); 
        Route::post('/product-feature', 'productFeature');
    });


    // COUPON CONTROLLER
    Route::controller(discountController::class)->group(function() {
        Route::get('/add/discount', 'adddiscount')->name('add_discount');
        Route::post('/store/discount', 'storediscount')->name('store_discount');
        Route::post('/update/discount', 'updatediscount')->name('update_discount');
        Route::get('/view/discount', 'viewdiscount')->name('view_discount');
        Route::get('/delete/discount/{id}', 'deletediscount')->name('delete_discount');
    });

    // SHIPPING CHARGE CONTROLLER
    Route::controller(shippingChargeController::class)->group(function() {
        Route::get('/add/shipping-charge', 'addshippingcharge')->name('add_shipping_charge');
        Route::post('/store/shipping-charge', 'storeshippingcharge')->name('store_shipping_charge');
        Route::post('/update/shipping-charge', 'updateshippingcharge')->name('update_shipping_charge');
        Route::get('/delete/shipping-charge/{id}', 'deleteshippingcharge')->name('delete_shipping_charge');
        Route::get('/view/shipping-charge', 'viewShippingCharge')->name('shipping_charge');
    });


    // ORDERS CONTROLLER
    Route::controller(orderController::class)->group(function() {
        Route::get('/add/orders', 'addorders')->name('add_orders');
        Route::post('/store/orders', 'storeorders')->name('store_orders');
        Route::post('/update/orders', 'updateorders')->name('update_orders');
        Route::get('/view/orders', 'vieworders')->name('view_orders');
        Route::get('/delete/orders/{id}', 'deleteorders')->name('delete_orders');
        Route::get('/details/orders/{id}', 'detailsorders')->name('details_orders');
        Route::post('/order_status', 'orderStatus');
    });


    // PAGE CONTROLLER
    Route::controller(pageController::class)->group(function() {
        Route::get('/page/list', 'pageList')->name('page_list');
        Route::get('/page/edit/{id}', 'pageEdit')->name('page_edit');
        Route::post('/page/update', 'pageUpdate')->name('page_update');

        Route::get('/system-settings', 'systemSettings')->name('systemSettings');
        Route::post('/system-settings', 'updateSettings')->name('update_system_settings');

        Route::get('/payment-settings', 'paymentSettings')->name('paymentSettings');
        Route::post('/payment-settings', 'updatePaymentSettings')->name('update_payment_settings');

        Route::get('/slider-settings', 'sliderSettings')->name('sliderSettings');
        Route::get('/slider-settings/edit/{id}', 'sliderEdit')->name('slider_edit');
        Route::post('/slider-settings/update', 'sliderUpdate')->name('slider_update');

        Route::get('/supported-brands', 'supportedBrands')->name('supportedBrands');
        Route::get('/supported-brands/edit/{id}', 'supportBRandsEdit')->name('supportBRands_edit');
        Route::post('/supported-brands/update', 'supportBrandUpdate')->name('supportBrand_update');

        Route::get('/notification', 'notification')->name('notification');
        
        

    });


});


Route::controller(AdminController::class)->prefix('admin')->group(function() {
    Route::get('/login', 'Login')->name('admin_login');
    Route::get('/register', 'adminRegister')->name('admin_register');
    Route::post('/login-submit', 'Login_submit')->name('admin_login_submit');
    Route::get('/forgot-password', 'ForgetPassword')->name('admin_forgot_password');
    Route::post('/forgot-password-submit', 'ForgetPasswordSubmit')->name('admin_forgot_password_submit');
    Route::get('/reset-password/{token}/{email}', 'resetPassword')->name('admin_reset_password');
    Route::post('/reset-password-submit', 'resetPasswordSubmit')->name('admin_reset_password_submit');
});
/* ========= Admin Ends ========= */


//
//
//
//
//
//
//
//
//

/* ========= Seller Starts ========= */
Route::middleware('seller')->prefix('seller')->group(function () {
    Route::controller(sellerController::class)->group(function() {
        Route::get('/dashboard', 'Dashboard')->name('seller_dashboard');
        Route::get('/profile', 'adminProfile')->name('seller.profile');
        Route::get('/edit/profile', 'editProfile')->name('seller_edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('seller_store.profile');
        Route::get('/logout', 'Logout')->name('seller_logout');
    });
});



Route::controller(sellerController::class)->prefix('seller')->group(function() {
    Route::get('/login', 'Login')->name('seller_login');
    Route::get('/register', 'adminRegister')->name('seller_register');
    Route::post('/login-submit', 'Login_submit')->name('seller_login_submit');
    Route::get('/forgot-password', 'ForgetPassword')->name('seller_forgot_password');
    Route::post('/forgot-password-submit', 'ForgetPasswordSubmit')->name('seller_forgot_password_submit');
    Route::get('/reset-password/{token}/{email}', 'resetPassword')->name('seller_reset_password');
    Route::post('/reset-password-submit', 'resetPasswordSubmit')->name('seller_reset_password_submit');
});


/* ========= Seller ends ========= */

//
//
//
//
//
//
//

/* ========= User Starts========= */
Route::middleware('auth')->prefix('user')->group(function () {
    Route::controller(userController::class)->group(function() {
        Route::get('/profile', 'userProfile')->name('user_Profile');
        Route::get('/profile', 'userProfile')->name('user_Profile');
        Route::get('/edit/profile', 'userEditProfile')->name('user_Edit_Profile');
        Route::post('/store/profile', 'userStoreProfile')->name('user_store_profile');
        Route::get('/logout', 'userLogout')->name('user_logout');


        Route::get('/orders', 'user_order_list')->name('user_order_list');
        Route::get('/orders/details{id}', 'user_order_details')->name('user_order_details');
        Route::post('/add_to_wishlist', 'add_to_wishlist')->name('add_to_wishlist');
        Route::get('/delete-wishlist/{id}','deleteWishlist')->name('delete_wishlist');

        Route::post('/add-review', 'submitReview')->name('submit_review');
        Route::get('/notification', 'Usernotification')->name('user_notification');

    });

});
    // User Dashboard
    Route::get('/dashboard', [userController::class, 'userDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/decline-wishList', [userController::class, 'declineWishList'])->name('decline_wishlist');

/* ========= User Ends ========= */








/* ========= Frontend ========= */
Route::controller(frontendController::class)->group(function() {
    Route::get('/{cat_id}/{cat_name}', 'frontCategories')->name('front_categories');
    Route::get('/{cat_id}/{cat_name}/{sub_id}/{sub_name}', 'frontCategories')->name('front_sub_categories');
    Route::post('/get_filter_product_ajax', 'getFilterProductAjax');
    Route::get('/{cat_id}/{cat_name}/{sub_id}/{sub_name}/{id}/{title}', 'singleProductCat')->name('productDetailsSubCat');
    Route::get('/search', 'searchProduct')->name('search_product');
    Route::get('/my-wishlist', 'myWishlist')->name('my_wishlist');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/about', 'about')->name('about');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/payment-method', 'paymentMethod')->name('payment-method');
    Route::get('/money-back-guarantee', 'moneyBackGuarantee')->name('money-back-guarantee');
    Route::get('/shipping', 'shipping')->name('shipping');
    Route::get('/returns', 'returns')->name('returns');
    Route::get('/terms-conditions', 'termsConditions')->name('terms-conditions');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/', 'FrontendIndex')->name('frontend_index');
    Route::post('/subscribe', 'subscribe')->name('subscribe');
    // Route::get('unsubscribe/{token}', 'unsubscribePage')->name('unsubscribe_page');
    // // Route::get('/unsubscribe/{token}', 'unsubscribe')->name('unsubscribe');


});

Route::controller(paymentController::class)->group(function() {
    Route::post('/product/add-to-cart', 'productAddToCart')->name('product_addToCart');
    Route::get('/cart', 'ProductCarts')->name('productCarts');
    Route::post('/cart/update', 'updateCart')->name('update_cart');
    Route::get('/cart/delete/{id}', 'cartDelete')->name('cart_delete');
    Route::get('/checkout', 'checkOutProducts')->name('checkoutProducts');
    Route::post('/checkout/apply-coupon', 'applyCoupon');
    Route::post('/checkout/place-order', 'placeOrder');
    Route::get('/checkout/payment/{id}', 'checkoutPayment')->name('checkout_payment');
    // PAYPAL
    Route::get('/success-payment','paypalSuccessPayment')->name('success');
    Route::get('/cancel-payment','paypalCancelPayment')->name('cancel');
    // STRIPE
    Route::get('success', 'stripeSuccess')->name('stripe_success');
    Route::get('cancel', 'stripeCancel')->name('stripe_cancel');

    // PAYSTACK
    Route::get('callback', 'handleGatewayCallback')->name('handleGatewayCallback');

});

Route::controller(contactController::class)->group(function() {
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::post('/contact/message', 'storeMessage')->name('store.message');
    Route::get('admin/contact/message/delete/{id}', 'deleteMessage')->name('delete.contact')->middleware('admin');    
    Route::get('/subscribers', 'subscribers')->name('subscribers')->middleware('admin');

});





