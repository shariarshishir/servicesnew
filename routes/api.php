<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\VendorController;
use App\Http\Controllers\Api\User\ProductController;
use App\Http\Controllers\Api\User\ProductCategoryController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ReviewController;
use App\Http\Controllers\Api\User\WishlistController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\User\OrderQueryController;
use App\Http\Controllers\Api\User\OrderModificationRequestController;
use App\Http\Controllers\Api\User\OrderModificationCommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// sso user registation
Route::post('user/signup',[UserController::class, 'signUp']);


//Auth api
//sso registration from app
Route::post('/register', [UserController::class, 'store']);
Route::post('/register-from-merchantbay/{userType}', [UserController::class, 'storeUserFromMerchantBay']);
Route::post('/login', [UserController::class, 'login']);

//email verification api
Route::get('user/{userId}/verify/{token}', [UserController::class, 'verifyAccount']);
Route::post('/verify-user-from-manufacture',[UserController::class, 'verifyUserFromManufacture']);
//api with authentication


Route::group(['middleware'=>['auth:sanctum']],function () {
    //user api
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/user/{userId}', [UserController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/profile-image-upload', [UserController::class, 'updateImage']);

    //store api
    Route::put('/store/{vendorUId}',[VendorController::class,'update']);
    Route::post('/store/{storeId}/products', [ProductController::class, 'store']);
    Route::post('/store/{storeId}/products/{productId}', [ProductController::class, 'update']);
    Route::delete('/store/{storeId}/products/{productId}', [ProductController::class, 'destroy']);
    Route::get('/store/{storeId}/orders', [OrderController::class, 'orderByVendorId']);
    Route::get('/store/{storeId}/orders/{orderId}', [OrderController::class, 'vendorOrderByOrderId']);
    Route::get('/related-products', [ProductController::class, 'relatedProducts']);
    Route::post('/product/reviews',[ReviewController::class,'createProductReview']);
    Route::post('/store/reviews',[ReviewController::class,'createVendorReview']);


    //wishlist api
    Route::post('/add-to-wishlist',[WishlistController::class,'addToWishlist']);
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::post('/delete-wishlist-item',[WishlistController::class,'wishListItemDelete']);

    //cart api
    Route::post('/add-to-cart',[CartController::class,'addToCart']);
    Route::get('/cart',[CartController::class,'index']);
    Route::get('/number-of-cart-items',[CartController::class,'noOfCartItems']);
    Route::post('/cart-item-update',[CartController::class,'cartItemUpdate']);
    Route::get('/cart-all-item-delete',[CartController::class,'cartAllItemDelete']);
    Route::get('/cart-item-delete/{cartId}',[CartController::class,'cartItemDelete']);


    //order api
    Route::post('/orders',[OrderController::class,'orderCreate']);
    Route::get('/orders/{orderId}',[OrderController::class,'orderDetails']);
    Route::get('/orders-by-authenticated-user',[OrderController::class,'orderByAuthenticatedUser']);

    //order query
    Route::post('/order-queries', [OrderQueryController::class, 'store']);
    Route::get('/order-queries',[OrderQueryController::class, 'index']);
    Route::get('/order-queries/{orderModificationRequestId}',[OrderQueryController::class, 'show']);
    Route::get('/order-queries-modification/{orderModificationId}',[OrderQueryController::class, 'showOrderQueryWithModification']);

    //order modification request
    Route::post('/order-modification-request',[OrderModificationRequestController::class, 'store']);
    Route::post('/order-modification-comment',[OrderModificationCommentController::class, 'store']);


    //notification
    Route::post('/notification-mark-as-read',[UserController::class,'notificationMarkAsRead']);
});


//country list api
Route::get('/countries', [OrderController::class, 'countries']);

//category api
Route::get('/product-categories', [ProductCategoryController::class, 'index']);
Route::get('/product-by-category/{categoryId}', [ProductController::class, 'showProductByCategoryId']);
Route::get('/product-category-list', [ProductCategoryController::class, 'categoryList']);
Route::get('/product-categories/{id}', [ProductCategoryController::class, 'subCategoryList']);


//products api
Route::get('/ready-stock-products', [ProductController::class, 'readyStockProducts']);
Route::get('/buy-design-products', [ProductController::class, 'buyDesignProducts']);
Route::get('/non-clothing-products', [ProductController::class, 'nonClothingProducts']);
Route::get('/recommanded-products/{productId}', [ProductController::class, 'recommandedProducts']);
Route::get('/store/{storeId}/products', [ProductController::class, 'index']);
Route::get('/store/{storeId}/productlist', [ProductController::class, 'productList']);
Route::get('/store/{storeId}/products/{productId}', [ProductController::class, 'show']);
Route::post('/search-product-by-name', [ProductController::class, 'searchByProductName']);
Route::get('/products/{productId}', [ProductController::class, 'productById']);
//store api
Route::get('/stores',[VendorController::class,'index']);
Route::get('/store/{vendorUId}',[VendorController::class,'show']);
Route::post('/search-store-by-name', [VendorController::class, 'searchByVendorName']);

//user details
Route::get('/user/{userId}', [UserController::class, 'show']);


//reviews
Route::get('/product/{productId}/reviews',[ReviewController::class,'productReviews']);
Route::get('/store/{vendorId}/reviews',[ReviewController::class,'vendorReviews']);


