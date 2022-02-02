<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;
use App\Models\ProductWishlist;
use App\Models\CartItem;
use Auth;
use App\Models\Config;
use App\Models\Manufacture\ProductCategory as ManufactureProductCategory;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $categories = Cache::remember('categories', 60, function ()
            {
                $source = ProductCategory::select('id', 'name', 'slug', 'status', 'parent_id')->where('status',1)->get()->toArray();
                $inArray = array();
                foreach($source as $key => $value)
                {
                    $inArray[$key] = $value;
                }

                $categories = array();
                $this->makeParentChildRelations($inArray, $categories);
                //dd($outArray);
                //return ProductCategory::where('parent_id',NULL)->get();
                if(!empty($categories)){
                    return $categories;
                } else {
                    return false;
                }
            });


            if(Auth()->check()){
                $cartItems=CartItem::where('user_id',auth()->user()->id)->get();
            }
            else{
                $cartItems=[];
            }




            $view->with(['cartItems'=>count($cartItems),'categories'=>$categories ]);
        });


        view()->composer('include.admin._header', function($view) {
            if(auth()->guard('admin')->check()){
                $notifications =auth()->guard('admin')->user()->unreadNotifications->where('read_at',NULL);
                $view->with(['notifications'=>$notifications]);
            }

        });

        view()->composer('include._header', function($view) {
            if(auth()->check())
            {
                $userNotifications =auth()->user()->unreadNotifications;
                $view->with(['userNotifications'=>$userNotifications]);
            }

        });

        //config
        view()->composer(['user.cart.checkout', 'order_success'], function($view){
            if(auth()->check())
            {
                $config=Config::first();
                if(isset($config)){
                    $configArray=[];
                    foreach( json_decode($config->config_data) as $key=>$data){
                        $configArray[$key]=$data;
                    }
                    $view->with(['configArray'=>$configArray]);
                }

            }
        });

        //For Manufacture Product Category
        view()->composer('*', function($view) {
            $categories=ManufactureProductCategory::with('subcategories')->get();
            $view->with([
                'manufacture_product_categories'=>$categories,
                'manufacture_product_categories_type'=>[
                    'apparel'   => ManufactureProductCategory::where(['industry'=>'apparel'])->get(),
                    'non-apparel'=> ManufactureProductCategory::where(['industry'=>'non-apparel'])->get()
                ],
            ]);
        });

        //wishlist data
        view()->composer(['product.*','manufacture_profile_view_by_user.index','wholesaler_profile_view_by_user.index'], function($view) {
            if(Auth()->check()){
                $wishListShopProductsIds=ProductWishlist::where('user_id' , auth()->user()->id)->where('product_id', '!=', null)->pluck('product_id')->toArray();
                $wishListMfProductsIds=ProductWishlist::where('user_id' , auth()->user()->id)->where('manufacture_product_id', '!=', null)->pluck('product_id')->toArray();
            }
            else{
                $wishListShopProductsIds=[];
                $wishListMfProductsIds=[];
            }
            $view->with(['wishListShopProductsIds' => $wishListShopProductsIds, 'wishListMfProductsIds' => $wishListMfProductsIds]);

        });
    }



    public function makeParentChildRelations(&$inArray, &$outArray, $currentParentId = 0) {
        if(!is_array($inArray)) {
            return;
        }

        if(!is_array($outArray)) {
            return;
        }

        foreach($inArray as $key => $tuple) {
            if($tuple['parent_id'] == $currentParentId) {
                $tuple['children'] = array();
                $this->makeParentChildRelations($inArray, $tuple['children'], $tuple['id']);
                $outArray[] = $tuple;
            }
        }
    }
}
