<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\BusinessProfileController;
use App\Http\Controllers\Api\User\CompanyOverviewController;
use App\Http\Controllers\Api\User\CapacityAndMachineriesController;
use App\Http\Controllers\Api\User\ProductionFlowAndManpowerController;
use App\Http\Controllers\Api\User\CertificationController;
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
use App\Http\Controllers\Api\User\MainBuyerController;
use App\Http\Controllers\Api\User\AssociationMembershipController;
use App\Http\Controllers\Api\User\ExportDestinationController;
use App\Http\Controllers\Api\User\PressHighlightController;
use App\Http\Controllers\Api\User\BusinessTermController;
use App\Http\Controllers\Api\User\SamplingController;
use App\Http\Controllers\Api\User\SpecialCustomizationController;
use App\Http\Controllers\Api\User\SustainabilityCommitmentController;
use App\Http\Controllers\Api\User\WalfareController;
use App\Http\Controllers\Api\User\SecurityController;
use App\Http\Controllers\Api\User\RFQController;
use App\Http\Controllers\Api\User\RfqBidController;
use App\Http\Controllers\Api\User\ManufactureProductController;
use App\Http\Controllers\Api\User\BlogController;
use App\Http\Controllers\Api\User\FactoryTourController;
use App\Http\Controllers\Api\User\MessageController;

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


//user profile update from sso
Route::post('/profile/update', [UserController::class, 'profileUpdate']);

//email verification api
Route::get('user/{userId}/verify/{token}', [UserController::class, 'verifyAccount']);
Route::post('/verify-user-from-manufacture',[UserController::class, 'verifyUserFromManufacture']);
Route::get('/email/verify',[UserController::class, 'emailVerify']);
//api with authentication

Route::post('/omd-rfqs', [RFQController::class, 'storeRfqFromOMD']);

//blogs
Route::get('/blogs',[BlogController::class,'blogs']);
Route::get('/blogs/{id}',[BlogController::class,'blogDetails']);

Route::group(['middleware'=>['auth:sanctum']],function () {
    //user api
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/user/{userId}', [UserController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/profile-image-upload', [UserController::class, 'updateImage']);

    //business profile
    Route::get('/manufacture-product-categories', [BusinessProfileController::class, 'manufactureProductCategories']);
    Route::post('/manufacture-product-categories-by-industry-type', [BusinessProfileController::class, 'manufactureProductCategoriesByIndustryType']);
    Route::get('/business-profile-list',[BusinessProfileController::class,'businessProfileList']);
    Route::get('/business-profile/{id}',[BusinessProfileController::class,'show']);
    
    //active inactive business profile by user
    Route::post('/business-profile/publish-unpublish', [BusinessProfileController::class, 'profilePublishOrUnpublish']);
    Route::post('/business-profile',[BusinessProfileController::class,'store']);
    Route::put('/company-overview',[CompanyOverviewController::class,'companyOverviewUpdate']);
    Route::post('/capacity-and-machineries',[CapacityAndMachineriesController::class,'capacityAndMachineriesCreateOrUpdate']);
    Route::post('/production-flow-and-manpower', [ProductionFlowAndManpowerController::class, 'productionFlowAndManpowerCreateOrUpdate']);

    Route::get('/certifications-type', [CertificationController::class, 'certificationTypesList']);
    Route::post('/certifications', [CertificationController::class, 'certificationDetailsUpload']);
    Route::get('/certifications/{id}', [CertificationController::class, 'deleteCertificate']);

    Route::post('/main-buyers', [MainBuyerController::class, 'mainBuyerDetailsUpload']);
    Route::get('/main-buyers/{id}', [MainBuyerController::class, 'deleteMainBuyer']);

    Route::post('/association-memberships', [AssociationMembershipController::class, 'associationMembershipDetailsUpload']);
    Route::get('/association-memberships/{id}', [AssociationMembershipController::class, 'deleteAssociationMembership']);

    Route::post('/export-destinations', [ExportDestinationController::class, 'exportDestinationDetailsUpload']);
    Route::get('/export-destinations/{id}', [ExportDestinationController::class, 'deleteExportDestination']);

    Route::post('/press-highlights', [PressHighlightController::class, 'pressHighlightDetailsUpload']);
    Route::get('/press-highlights/{id}', [PressHighlightController::class, 'deletePressHighlight']);


    Route::post('/business-term-create-or-update', [BusinessTermController::class, 'businessTermsCreateOrUpdate']);
    Route::post('/sampling-create-or-update', [SamplingController::class, 'samplingCreateOrUpdate']);
    Route::post('/special-customization-create-or-update', [SpecialCustomizationController::class, 'specialCustomizationCreateOrUpdate']);
    Route::post('/sustainability-commitment-create-or-update', [SustainabilityCommitmentController::class, 'sustainabilityCommitmentCreateOrUpdate']);
    Route::post('/worker-walfare-create-or-update', [WalfareController::class, 'walfareCreateOrUpdate']);
    Route::post('/securtiy-create-or-update', [SecurityController::class, 'securityCreateOrUpdate']);

    Route::post('/factory-tour',[FactoryTourController::class,'createFactoryTour']);
    Route::post('/factory-tour-edit',[FactoryTourController::class,'updateFactoryTour']);
    Route::get('/factory-tour/business-profile/{id}',[FactoryTourController::class,'factoryTourDetails']);
    //wholeslaer api
    Route::put('/store/{vendorUId}',[VendorController::class,'update']);
    Route::post('/wholesaler-products', [ProductController::class, 'store']);
    Route::post('/wholesaler-products-edit/{productId}', [ProductController::class, 'update']);
    Route::delete('/products/{productId}', [ProductController::class, 'publishOrUnpublishProduct']);
    Route::get('/store/{businessProfileId}/orders', [OrderController::class, 'orderByBusinessProfileId']);
    Route::get('/store/{businessProfileId}/orders/{orderId}', [OrderController::class, 'vendorOrderByOrderId']);
    Route::get('/business-profile/{businessProfileId}/related-products', [ProductController::class, 'relatedProducts']);
    Route::post('/product/reviews',[ReviewController::class,'createProductReview']);
    Route::post('/store/reviews',[ReviewController::class,'createVendorReview']);


    //wishlist api
    Route::post('/add-to-wishlist',[WishlistController::class,'addToWishlist']);
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::get('/wishlist-products-id',[WishlistController::class,'wishListedProductsId']);

    Route::post('/delete-wishlist-item',[WishlistController::class,'wishListItemDelete']);


    //rfq api
    Route::post('/rfqs', [RFQController::class, 'store']);
    Route::post('/rfq-bids', [RfqBidController::class, 'store']);

    Route::get('/rfqs', [RFQController::class, 'index']);
    Route::get('/my-rfq-list', [RFQController::class, 'myRfqList']);
    Route::get('/rfq/{id}/bids', [RfqBidController::class, 'rfqBidsByRfqId']);


    //manufacture product api
    Route::post('/manufacture-products', [ManufactureProductController::class, 'store']);
    Route::post('/manufacture-products/{productId}', [ManufactureProductController::class, 'update']);
    Route::get('/business-profile/{businessProfileID}/manufacture-products/{productId}', [ManufactureProductController::class, 'delete']);


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
    Route::get('/order-modification-request',[OrderModificationRequestController::class, 'index']);
    Route::get('/order-modification-request/{orderModificationRequestId}',[OrderModificationRequestController::class, 'show']);


    //notification
    Route::post('/notification-mark-as-read',[UserController::class,'notificationMarkAsRead']);
    //message center
    Route::post('/getchatdata',[MessageController::class,'getchatdata']);
    Route::get('/message-center',[MessageController::class,'message_center']);
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
Route::get('/wholesaler-low-moq-products', [BusinessProfileController::class, 'wholesalerLowMOQProducts']);
Route::get('/manufacture-low-moq-products', [BusinessProfileController::class, 'manufactureLowMOQProducts']);
Route::get('/customizable-products', [ProductController::class, 'customizableProducts']);
Route::get('/products-with-shortest-lead-time', [BusinessProfileController::class, 'productsWithShortestLeadTime']);
Route::get('/buy-design-products', [ProductController::class, 'buyDesignProducts']);
Route::get('/non-clothing-products', [ProductController::class, 'nonClothingProducts']);
Route::get('/recommanded-products/{productId}', [ProductController::class, 'recommandedProducts']);

Route::get('/store/{storeId}/productlist', [ProductController::class, 'productList']);
Route::get('/store/{storeId}/products/{productId}', [ProductController::class, 'show']);
Route::post('/search-product-by-name', [ProductController::class, 'searchByProductName']);
//products show or manufacture or wholesaler
Route::get('business-profile/{businessProfileID}/wholesaler-products', [ProductController::class, 'index']);
Route::get('/wholesaler-products/{productId}', [ProductController::class, 'productById']);
Route::get('/manufacture-products/{productId}', [ManufactureProductController::class,'show']);
Route::get('/business-profile/{businessProfileID}/manufacture-products', [ManufactureProductController::class, 'index']);


//business profile
Route::get('/all-business-profiles',[BusinessProfileController::class,'allBusinessProfile']);
Route::post('/search-suppliers-by-business-name', [BusinessProfileController::class, 'searchSuppliersByBusinessName']);

//store api
Route::get('/stores',[VendorController::class,'index']);
Route::get('/store/{vendorUId}',[VendorController::class,'show']);

//user details
Route::get('/user/{userId}', [UserController::class, 'show']);


//reviews
Route::get('/product/{productId}/reviews',[ReviewController::class,'productReviews']);
Route::get('/store/{vendorId}/reviews',[ReviewController::class,'vendorReviews']);


