<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BusinessProfileController as AdminBusinessProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ShipmentTypeController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\ShippingMethodController;
use App\Http\Controllers\Admin\UomContorller;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ProductionFlowAndManpowerController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\MainBuyerController;
use App\Http\Controllers\ExportDestinationController;
use App\Http\Controllers\AssociationMembershipController;
use App\Http\Controllers\PressHighlightController;
use App\Http\Controllers\BusinessTermController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\Manufacture\PoController;
use App\Http\Controllers\SamplingController;
use App\Http\Controllers\SpecialCustomizationController;
use App\Http\Controllers\SustainabilityCommitmentController;
use App\Http\Controllers\WalfareController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\MessageController;



use App\Http\Controllers\Manufacture\ProductController as ManufactureProductController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductReviewController;

use App\Http\Controllers\QueryController as UserQueryController;
use App\Http\Controllers\VendorReviewController;
use App\Http\Controllers\ProductWishlistController;
use App\Http\Controllers\SubscribedUserEmailController;
use App\Http\Controllers\OrderModificationRequestController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\TinyMcController;
use App\Http\Controllers\Wholesaler\OrderController as WholesalerOrderController;
use App\Http\Controllers\Wholesaler\ProductController as WholesalerProductController;
use App\Http\Controllers\Wholesaler\ProfileInfoController;
use App\Http\Controllers\RfqBidController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//excel,csv user import
Route::get('import',[ImportController::class, 'importView'])->name('import.view');
Route::post('import',[ImportController::class, 'import'])->name('import');

// Frontend API's endpoint start
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'productList'])->name('products');
Route::get('/ready-stock', [HomeController::class, 'readyStockProducts'])->name('readystockproducts');
Route::get('/buy-designs', [HomeController::class, 'buyDesignsProducts'])->name('buydesignsproducts');
Route::get('/customizable', [HomeController::class, 'customizable'])->name('customizable');
Route::get('/low-moq-data', [HomeController::class, 'lowMoqData'])->name('low.moq.data');
Route::get('/low-moq', [HomeController::class, 'lowMoq'])->name('low.moq');
Route::get('/shortest-lead-time', [HomeController::class, 'shortestLeadTime'])->name('shortest.lead.time');


Route::get('/suppliers', [HomeController::class, 'suppliers'])->name('suppliers');
Route::get('/supplier/profile/{id}',[HomeController::class, 'supplerProfile'])->name('supplier.profile');
// Route::get('/suppliers', [HomeController::class, 'vendorList'])->name('vendors');
Route::get('product/{value}/details',[HomeController::class, 'productDetails'])->name('productdetails');

//low moq details
Route::get('product/details/{flag}/{id}',[HomeController::class, 'mixProductDetails'])->name('mix.product.details');

Route::get('/products/{slug}', [HomeController::class, 'productsByCategory'])->name('categories.product');
Route::get('/products/{category}/{subcategory}', [HomeController::class, 'productsBySubCategory'])->name('subcategories.product');
Route::get('/products/{category}/{subcategory}/{subsubcategory}', [HomeController::class, 'productsBySubSubCategory'])->name('sub.subcategories.product');

Route::get('/ready-stock/products/{slug}', [HomeController::class, 'readyStockProductsByCategory'])->name('readystock.categories.product');
Route::get('/ready-stock/products/{category}/{subcategory}', [HomeController::class, 'readyStockProductsBySubcategory'])->name('readystock.subcategories.product');
Route::get('/ready-stock/products/{category}/{subcategory}/{subsubcategory}', [HomeController::class, 'readyStockProductsBySubSubcategory'])->name('readystock.sub.subcategories.product');

Route::get('/buy-designs/products/{slug}', [HomeController::class, 'buyDesignProductsByCategory'])->name('buydesign.categories.product');
Route::get('/buy-designs/products/{category}/{subcategory}', [HomeController::class, 'buyDesignProductsBySubcategory'])->name('buydesign.subcategories.product');
Route::get('/buy-designs/products/{category}/{subcategory}/{subsubcategory}', [HomeController::class, 'buyDesignProductsBySubSubcategory'])->name('buydesign.sub.subcategories.product');

Route::get('/sorting/{value}/{slug?}/{cat_id?}', [HomeController::class, 'sorting'])->name('sorting');
Route::get('/vendor/sorting/{value}', [HomeController::class, 'sortingVendor'])->name('sorting.vendor');
Route::get('/filter/search', [HomeController::class, 'filterSearch'])->name('filter.search');
Route::post('/subscribe-for-newsletter', [SubscribedUserEmailController::class, 'subscribeForNewsletter'])->name('newsletter.subscribe');

Route::post('/products/{sku}/review',[ProductReviewController::class,'storeProductReview'])->name('product.review.store');
Route::get('/store-review',[VendorReviewController::class,'index'])->name('vendor.review.index');
Route::get('/store-review/order/{orderNumber}/store/{vendorUid}',[VendorReviewController::class,'showReviewForm'])->name('vendor.review_form');
Route::Post('/store-review/order/{orderNumber}/store/{vendorUid}',[VendorReviewController::class,'createVendorReview'])->name('vendor.review.create');
Route::get('/liveSearch',[HomeController::class,'liveSearchByProductOrVendor'])->name("live.search");
Route::get('/search',[HomeController::class,'searchByProductOrVendor'])->name("onsubmit.search");


Route::get('/industry-blogs',[HomeController::class,'blogs'])->name('industry.blogs');
Route::get('/press-room/details/{slug}',[HomeController::class,'blogDetails'])->name('blogs.details');

//user API's endpoint start
Route::get('/add-to-cart',[ProductCartController::class,'addToCart'])->name('add.cart');
Route::get('/wishlist',[ProductWishlistController::class,'index'])->name('wishlist.index')->middleware('auth','sso.verified');
Route::get('/delete-wishlist-item',[ProductWishlistController::class,'wishListItemDelete'])->name('wishlist.item.delete')->middleware('auth','sso.verified');
Route::get('/add-to-wishlist',[ProductWishlistController::class,'addToWishlist'])->name('add.wishlist');
Route::get('/copyright-price',[ProductCartController::class,'copyRightPrice'])->name('copyright.price');
Route::get('user/profile/vendor/{vendor}/order/{order}/notification/{notification}',[OrderController::class, 'showVendorOrderNotifactionFromFrontEnd'])->name('user.order.notification.show');

Route::group(['middleware'=>['sso.verified','auth']],function (){
    Route::get('/cart',[ProductCartController::class,'index'])->name('cart.index');
    Route::get('/cart-item-delete/{rowId}',[ProductCartController::class,'cartItemDelete'])->name('cart.delete');
    Route::post('/cart-item-update',[ProductCartController::class,'cartItemUpdate'])->name('cart.update');
    Route::get('/cart-item-update/modal/{cart_id}',[ProductCartController::class,'cartItemUpdateModal'])->name('cart.update.modal');
    Route::get('/cart-all-item-delete',[ProductCartController::class,'cartAllItemDelete'])->name('cart.destroy');
    Route::get('/checkout',[ProductCartController::class,'checkout'])->name('cart.checkout');
    Route::post('/order/paynow',[ProductCartController::class,'order'])->name('cart.order');
    Route::get('/order-success',[ProductCartController::class,'orderSuccess'])->name('cart.order.success');

    Route::get('/notification-mark-as-read',[UserController::class,'notificationMarkAsRead']);
    //store
    Route::get('store/{vendorId}', [UserController::class, 'myShop'])->name('users.myshop');
    Route::get('store/{vendorUid}/productgrouplist/{slug}', [UserController::class, 'myShopProductsByCategory'])->name('users.categories_products');
    Route::get('store/{vendorUid}/productgrouplist/{category}/{subcategory}', [UserController::class, 'myShopProductsBySubCategory'])->name('users.subcategories_products');
    Route::get('store/{vendorUid}/productgrouplist/{category}/{subcategory}/{subsubcategory}', [UserController::class, 'myShopProductsBySubSubCategory'])->name('users.sub.subcategories_products');
    Route::get('store/{vendorId}/profile', [UserController::class, 'myShopProfile'])->name('users.myShopProfile');
    Route::get('store/{vendorId}/contact', [UserController::class, 'myShopContact'])->name('users.myShopContact');
    Route::get('store/{vendorId}/reviews', [UserController::class, 'myShopReviews'])->name('users.myShopReviews');
    //endstore
    //seller product
    Route::get('/delete-single-image', [SellerProductController::class,'deleteSingleImage']);
    Route::post('/upload', [SellerProductController::class,'uploadSubmit']);
    Route::put('/upload-edit', [SellerProductController::class,'uploadSubmit']);
    Route::post('seller-store-update',[SellerProductController::class,'storeUpdate'])->name('seller.store.update');
    Route::post('update-profile-image', [UserController::class,'updateImage' ])->name('image.update');
    Route::post('update-banner-image', [UserController::class,'updateBanner' ])->name('banner.update');
    Route::get('seller-product/publish-unpublish/{sku}',[SellerProductController::class, 'publishUnpublish'])->name('seller.product.publish.unpublish');
    Route::resource('seller-product', SellerProductController::class);
    //end seller product
    //order query
    Route::get('order/queries/',[UserQueryController::class, 'index'])->name('user.order.query.index');
    Route::get('order/queries/show/{ord_mod_id}',[UserQueryController::class, 'show'])->name('user.order.query.show');
    Route::post('order/queries/store',[UserQueryController::class, 'store'])->name('user.order.query.store');
    Route::get('order/queries/message/show/{order_query_request_id}',[UserQueryController::class, 'showMessage'])->name('user.order.query.show.message');
    Route::post('order/queries/message/store',[UserQueryController::class, 'storeMessage'])->name('user.order.query.message.store');
    //end order query
    //order
    Route::get('order',[UserOrderController::class, 'index'])->name('order.index')->middleware(['auth','sso.verified']);
    Route::get('order-delivered/{orderNumber}',[UserOrderController::class, 'orderDelivered'])->middleware(['auth','sso.verified']);
    Route::get('order-type-filter', [UserOrderController::class, 'orderTypeFilter'])->name('order.type.filter');
    //end order
    //business profile
    Route::get('/business/profile', [BusinessProfileController::class, 'index'])->name('business.profile');
    Route::get('/business/profile/create', [BusinessProfileController::class, 'create'])->name('business.profile.create');
    Route::post('/business/profile/store', [BusinessProfileController::class, 'store'])->name('business.profile.store');
    Route::get('/business/profile/show/{id}', [BusinessProfileController::class, 'show'])->name('business.profile.show');
    Route::post('/company/overview/update/{id}', [BusinessProfileController::class, 'companyOverviewUpdate'])->name('company.overview.update');

    Route::post('/capacity-and-machineries-create-or-update', [BusinessProfileController::class, 'capacityAndMachineriesCreateOrUpdate']);

    Route::post('/production-flow-and-manpower-create-or-update', [ProductionFlowAndManpowerController::class, 'productionFlowAndManpowerCreateOrUpdate'])->name('production-flow-and-manpower.create-or-update');

    Route::post('/business-term-create-or-update', [BusinessTermController::class, 'businessTermsCreateOrUpdate'])->name('business-terms.create-or-update');
    Route::post('/sampling-create-or-update', [SamplingController::class, 'samplingCreateOrUpdate'])->name('sampling.create-or-update');
    Route::post('/special-customization-create-or-update', [SpecialCustomizationController::class, 'specialCustomizationCreateOrUpdate'])->name('specialcustomizations.create-or-update');
    Route::post('/sustainability-commitment-create-or-update', [SustainabilityCommitmentController::class, 'sustainabilityCommitmentCreateOrUpdate'])->name('sustainabilitycommitments.create-or-update');
    Route::post('/worker-walfare-form-create-or-update', [WalfareController::class, 'walfareCreateOrUpdate'])->name('walfare.create-or-update');
    Route::post('/securtiy-create-or-update', [SecurityController::class, 'securityCreateOrUpdate'])->name('security.create-or-update');

    Route::post('/certification-details-upload', [CertificationController::class, 'certificationDetailsUpload'])->name('certification.upload');
    Route::get('/certification-details-delete', [CertificationController::class, 'deleteCertificate'])->name('certification.delete');

    Route::post('/factory-details-upload', [CertificationController::class, 'factoryDetailsUpload'])->name('factoryinfo.upload');
    Route::get('/factory-details-delete', [CertificationController::class, 'factoryDetailsDelete'])->name('factoryinfo.delete');

    Route::post('/main-buyers-details-upload', [MainBuyerController::class, 'mainBuyerDetailsUpload'])->name('mainbuyers.upload');
    Route::get('/main-buyers-details-delete', [MainBuyerController::class, 'deleteMainBuyer'])->name('mainbuyers.delete');

    Route::post('/export-destination-details-upload', [ExportDestinationController::class, 'exportDestinationDetailsUpload'])->name('exportdestinations.upload');
    Route::get('/export-destination-details-delete', [ExportDestinationController::class, 'deleteExportDestination'])->name('exportdestinations.delete');


    Route::post('/association-membership-details-upload', [AssociationMembershipController::class, 'associationMembershipDetailsUpload'])->name('associationmemberships.upload');
    Route::get('/association-membership-details-delete', [AssociationMembershipController::class, 'deleteAssociationMembership'])->name('associationmemberships.delete');

    Route::post('/press-highlight-details-upload', [PressHighlightController::class, 'pressHighLightDetailsUpload'])->name('presshighlights.upload');
    Route::get('/press-highlight-details-delete', [PressHighlightController::class, 'deletePressHighlight'])->name('presshighlights.delete');


    //wholesaler  profile
    Route::group(['prefix'=>'/wholesaler'],function (){
        //product
        Route::get('/profile/show/{id}', [ProfileInfoController::class, 'show'])->name('wholesaler.profile.show');
        Route::get('/product/{business_profile_id}', [WholesalerProductController::class, 'index'])->name('wholesaler.product.index');
        Route::post('/product/store', [WholesalerProductController::class, 'store'])->name('wholesaler.product.store');
        Route::get('/product/edit/{sku}', [WholesalerProductController::class, 'edit'])->name('wholesaler.product.edit');
        Route::put('/product/update/{sku}', [WholesalerProductController::class, 'update'])->name('wholesaler.product.update');
        Route::get('/product/publish-unpublish/{sku}',[WholesalerProductController::class, 'publishUnpublish'])->name('wholesaler.product.publish.unpublish');
        //order
        Route::get('order/{business_profile_id}',[WholesalerOrderController::class, 'index'])->name('wholesaler.order.index');
        Route::get('order-delivered/{orderNumber}',[WholesalerOrderController::class, 'orderDelivered']);
        Route::get('order-type-filter', [WholesalerOrderController::class, 'orderTypeFilter'])->name('wholesaler.order.type.filter');
        //profile info
        Route::get('profile-details/{business_profile_id}',[ProfileInfoController::class,'index'])->name('wholesaler.profile.info');

    });
    //tinymc
    Route::post('tiny-mc-file-uplaod', [TinyMcController::class, 'tinyMcFileUpload'])->name('tinymc.file.upload');
    Route::get('tinymc-untracked-file-delete/{business_profile_id}',[TinyMcController::class, 'tinyMcUntrackedFileDelete'])->name('tinymc.untracked.file.delete');
    //endtinymc

    //my order
    Route::get('my-order',[MyOrderController::class, 'index'])->name('myorder');
    //rfq
    Route::get('rfq',[RfqController::class, 'index'])->name('rfq.index');
    Route::post('rfq/store',[RfqController::class, 'store'])->name('rfq.store');
    //message center

    Route::get('/message-center',[MessageController::class,'message_center']);
    Route::get('/message-center?uid={id}',[MessageController::class,'message_center_selected_supplier'])->name('sentBidReply');
    Route::post('/message-center/getchatdata',[MessageController::class,'getchatdata'])->name('message.center.getchatdata');
    Route::post('/message-center/updateuserlastactivity',[MessageController::class,'updateuserlastactivity'])->name('message.center.update.user.last.activity');
    Route::post('/message-center/notificationforuser',[MessageController::class,'notificationforuser'])->name('message.center.notification.user');
    Route::get('/merchant-message',[MessageController::class,'merchant_message']);
    Route::get('rfq-merchant-message',[MessageController::class,'rfq_merchant_message']);
    Route::get('/supplier-message',[MessageController::class,'supplier_message']);
    Route::get('/message-center/getUsers',[MessageController::class,'getUsers']);
    Route::get('/message-center/getMerchants',[MessageController::class,'getMerchants']);
    Route::get('/message-center/getSuppliers',[MessageController::class,'getSupplier']);
    Route::post('/message-center/getMessages',[MessageController::class,'getMessages']);
    Route::post('/message-center/send-message',[MessageController::class,'sendMessage']);
    Route::post('/message-center/contactwithsupplierfromprofile',[MessageController::class,'contactWithSupplierFromProfile']);
    Route::post('/message-center/contactsupplierfromproduct',[MessageController::class,'contactSupplierFromProduct'])->name('message.center.contact.supplier.from.product');
    Route::get('/message-center/get-rfq-merchants',[MessageController::class,'getRFQMerchants']);
    Route::get('my-rfq',[RfqController::class, 'myRfq'])->name('rfq.my');
    //bid rfq
    Route::get('rfq/bid/create/{rfq_id}',[RfqBidController::class, 'create'])->name('rfq.bid.create');
    Route::post('rfq/bid/store',[RfqBidController::class, 'store'])->name('rfq.bid.store');
    //poforma
    Route::get('/po/add/toid={id}', [PoController::class, 'add'])->name('po.add');
    Route::post('/po/store', [PoController::class,'store'])->name('po.store');
    Route::get('/po',[PoController::class,'index'])->name('po.index');
    Route::get('/getsupplierbycat/{id}', [PoController::class, 'getsupplierbycat']);




});

//user API's endpoint start
Route::group(['prefix'=>'/user'],function (){
    Route::get('/register/{type}', [UserController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [UserController::class, 'create'])->name('users.create');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('users.showLoginForm');
    Route::get('/login-from-sso', [UserController::class, 'loginFromSso'])->name('user.login.from.sso');
    Route::get('/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');
    Route::get('/unverified', [UserController::class, 'unverifiedAccount'])->name('user.unverify');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile')->middleware(['auth', 'is_verify_email','sso.verified']);
    Route::get('/unverified', [UserController::class, 'unverifiedAccount'])->name('user.unverify');
    Route::post('/resend-verification-email', [UserController::class, 'resendVerificationEmail'])->name('resend.verification_email');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('/related/products', [UserController::class, 'relatedProducts'])->name('users.related.products');


});

//fresh order calcualte
Route::post('/fresh-order/calculate',[SellerProductController::class, 'freshOrderCalculate'])->name('fresh.order.calculate');
//product modification request
Route::get('order/modification/',[OrderModificationRequestController::class, 'index'])->name('ord.mod.req.index');
Route::get('order/modification/req/show/proposal/{id}',[OrderModificationRequestController::class, 'orderProposalShow'])->name('prod.mod.req.proposal.show');
Route::get('order/modification/req/comment/create/show/{id}',[OrderModificationRequestController::class, 'commentCreateShow'])->name('prod.mod.req.comment.create.show');
Route::post('order/modification/req',[OrderModificationRequestController::class, 'store'])->name('prod.mod.req.store');
Route::post('order/modification/replay/{id}',[OrderModificationRequestController::class, 'replay'])->name('order.mod.req.comment.replay');
Route::post('order/modification/create',[OrderModificationRequestController::class, 'createOrder'])->name('ord.mod.create.order');
Route::get('order/modification/create/{ord_mod_req_id}',[OrderModificationRequestController::class, 'ordModProposalCreateForm'])->name('order.mod.proposal.create.form');


// SSLCOMMERZ Start
Route::get('/payment/{order_no}', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('payment.page')->middleware('auth','sso.verified');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

// sso
Route::post('login-from-merchantbay',[UserController::class, 'loginFromMerchantbay']);
// end sso

//manufacture
Route::group(['prefix'=>'/manufacture'],function (){
    //product
    Route::post('product/store',[ManufactureProductController::class, 'store'])->name('manufacture.product.store');
    Route::get('product/edit/{product_id}',[ManufactureProductController::class, 'edit'])->name('manufacture.product.edit');
    Route::post('product/update/{product_id}',[ManufactureProductController::class, 'update'])->name('manufacture.product.update');
    Route::get('product/delete/{product_id}/{business_profile_id}',[ManufactureProductController::class, 'delete'])->name('manufacture.product.delete');

});




//SSLCOMMERZ END
// Frontend API's endpoint end
Route::group(['prefix'=>'/admin'],function (){
    // Admin API's endpoint start
    Route::get('/config', [ConfigController::class,'configDashboard'])->name('admin.configdashboard');
    Route::post('/config', [ConfigController::class,'storeConfigurationInformation'])->name('store.configuration');
    Route::get('/config/{configId}', [ConfigController::class,'editConfigurationInformation'])->name('edit.configuration');
    Route::patch('/config/{configId}', [ConfigController::class,'updateConfigurationInformation'])->name('update.configuration');
    Route::get('/', [AdminController::class,'showLoginForm'])->name('admin.showLoginForm');
    Route::post('/login', [AdminController::class,'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class,'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    //vendors API's endpoint start
    Route::group(['middleware'=> 'is.admin'],function () {
        Route::get('/vendors', [VendorController::class,'index'])->name('vendor.index');
        Route::get('/vendor/{vendor}', [VendorController::class,'show'])->name('vendor.show');
        Route::delete('/vendor/{vendor}', [VendorController::class,'destroy'])->name('vendor.destroy');
        Route::get('/vendors/inactive', [VendorController::class,'inactive'])->name('vendor.inactive.index');
        Route::get('/vendors/restore/{vendor}', [VendorController::class,'restore'])->name('vendor.restore');
        //prduct category resource API start
        Route::resource('product-categories',  ProductCategoryController::class);
        Route::get('findProductCategoryDropdownList',  [ProductCategoryController::class, 'productCategoryDropdownList']);
        //prduct API start
        Route::post('/upload', [ProductController::class,'uploadSubmit']);
        Route::get('/delete-single-image', [ProductController::class,'deleteSingleImage']);
        Route::get('/vendor/{vendor}/products', [ProductController::class,'index'])->name('product.index');
        Route::get('/vendor/{vendor}/product/create', [ProductController::class,'create'])->name('product.create');
        Route::post('/vendor/{vendor}/product', [ProductController::class,'store'])->name('product.store');
        Route::get('/vendor/{vendor}/product/{product}/edit', [ProductController::class,'edit'])->name('product.edit');
        Route::post('/vendor/{vendor}/product/{product}', [ProductController::class,'update'])->name('product.update');
        Route::delete('/vendor/{vendor}/product/{product}', [ProductController::class,'destroy'])->name('product.destroy');
        Route::get('/related/products', [ProductController::class, 'relatedProducts'])->name('admin.users.related.products');
        //vendor order
        Route::get('/vendor/{vendor}/orders',[OrderController::class, 'index'])->name('vendor.order.index');
        Route::get('/vendor/{vendor}/order/create',[OrderController::class, 'create'])->name('vendor.order.create');
        Route::post('/vendor/{vendor}/order',[OrderController::class, 'store'])->name('vendor.order.store');
        Route::get('/vendor/{vendor}/order/{order}',[OrderController::class, 'show'])->name('vendor.order.show');
        Route::get('/vendor/{vendor}/order/{order}/notification/{notification}',[OrderController::class, 'showFromNotifaction'])->name('vendor.order.show.notification');
        Route::get('/vendor/{vendor}/order/{order}/edit',[OrderController::class, 'edit'])->name('vendor.order.edit');
        Route::post('/vendor/{vendor}/order/{order}', [OrderController::class,'update'])->name('vendor.order.update');
        Route::delete('/vendor/{vendor}/order/{order}', [OrderController::class,'destroy'])->name('vendor.order.destroy');
        Route::get('/order/update/{id}', [OrderController::class, 'OrderUpdateByAdmin'])->name('order.updateby.admin');
        Route::get('/order/update/status/delivered/{id}', [OrderController::class, 'statusToDelivered'])->name('order.status.change.delivered');
        Route::get('/order/ask/payment/{order_no}', [OrderController::class, 'OrderAskPayment'])->name('order.ask.payment');
        //order queries
        Route::get('query/request/{type}',[QueryController::class, 'index'])->name('query.request.index');
       // Route::get('query/request/edit/{type}',[QueryController::class, 'edit'])->name('query.request.edit');
        Route::post('query/request/store',[QueryController::class, 'store'])->name('query.request.store');
        Route::post('query/request/comment',[QueryController::class, 'comment'])->name('query.request.comment');
        Route::get('query/modification/request/edit/{type}',[QueryController::class, 'editModificationRequest'])->name('query.modification.request.edit');

        Route::get('query/edit/{id}',[QueryController::class, 'edit'])->name('query.edit');
        Route::get('query/show/{id}',[QueryController::class, 'show'])->name('query.show');
        // uom, shipping-method, shipment-type, shipping-charge controller
        Route::resource('uom', UomContorller::class);
        Route::resource('shipping-method', ShippingMethodController::class);
        Route::resource('shipment-type', ShipmentTypeController::class);
        Route::get('shipping-charge/change/status/{order_id}', [ShippingChargeController::class, 'changeStatus'])->name('shipping.charge.change.status');
        Route::resource('shipping-charge', ShippingChargeController::class);

        // Blogs api start
        Route::resource('blogs', BlogController::class);
        //users
        Route::get('users',[AdminUserController::class, 'index'])->name('users.index');
        Route::get('user/{id}',[AdminUserController::class, 'show'])->name('user.show');
        Route::get('user/business/profile/details/{profile_id}',[AdminUserController::class, 'businessProfileDetails'])->name('business.profile.details');
        Route::post('user/company/overview/varifie/{company_overview_id}',[AdminBusinessProfileController::class, 'companyOverviewVarifie'])->name('company.overview.varifie');
        Route::post('user/business/profile/capacity-machineries/verify',[AdminBusinessProfileController::class, 'capacityAndMachineriesInformationVerify'])->name('capacity.machineries.verify');
        Route::post('user/business/profile/capacity-terms/verify',[AdminBusinessProfileController::class, 'businessTermsInformationVerify'])->name('business.terms.verify');
        Route::post('user/business/profile/samplings/verify',[AdminBusinessProfileController::class, 'samplingsInformationVerify'])->name('samplings.verify');
        Route::post('user/business/profile/special-customization/verify',[AdminBusinessProfileController::class, 'specialCustomizationInformationVerify'])->name('special.customizations.verify');
        Route::post('user/business/profile/sustainability-commitments/verify',[AdminBusinessProfileController::class, 'sustainabilityCommitmentsInformationVerify'])->name('sustainability.commitments.verify');
        Route::post('user/business/profile/productionflow-manpower/verify',[AdminBusinessProfileController::class, 'productionflowAndManpowerInformationVerify'])->name('productionflow.manpower.verify');
        Route::post('user/business/profile/walfare/verify',[AdminBusinessProfileController::class, 'walfareInformationVerify'])->name('worker.walfare.verify');
        Route::post('user/business/profile/security/verify',[AdminBusinessProfileController::class, 'securityInformationVerify'])->name('worker.security.verify');





    });

});


