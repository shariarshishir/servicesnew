<?php

use App\Models\BusinessProfile;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\RelatedProduct;

if (!function_exists('vendorInformation')) {

    function vendorInformation($vendor_id)
    {
        $vendor=Vendor::where('id', $vendor_id)->first();
        return $vendor;
    }
}

if (!function_exists('singleProductInformation')) {

    function singleProductInformation($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        return $product;
    }
}

if (!function_exists('singleProductReviewInformation')) {

    function singleProductReviewInformation($product_id)
    {
        //$productReview = ProductReview::where('product_id', $product_id)->->get();
        $productReviews = DB::table('product_reviews')
                            ->join('users', 'product_reviews.created_by', '=', 'users.id')
                            ->where('product_id', $product_id)
                            ->get(['vendor_id', 'overall_rating', 'communication_rating', 'ontime_delivery_rating', 'sample_support_rating', 'product_quality_rating', 'experience', 'name','state', 'image']);

        return $productReviews;
    }
}
if (!function_exists('relatedProductInformation')) {

    function relatedProductInformation($product_id)
    {
        $relatedProductId = RelatedProduct::where('product_id', $product_id)->where('related_product_id', '!=', $product_id)->pluck('related_product_id');
        $productList=Product::whereIn('id',$relatedProductId)->where('state',1)->get();
        return $productList;
    }
}

if (!function_exists('productRating')) {
    function productRating($productId)
    {
        $product = Product::where('id',$productId)->first();
                $productReviews = ProductReview::where('product_id',$product->id)->get();
                $overallRating = 0;
                $communicationRating = 0;
                $ontimeDeliveryRating = 0;
                $sampleSupportRating = 0;
                $productQualityRating = 0;

                foreach($productReviews as $productReview){
                    $overallRating = $productReview->overall_rating+$overallRating;
                    $communicationRating = $productReview->communication_rating+$communicationRating;
                    $ontimeDeliveryRating = $productReview->ontime_delivery_rating+$ontimeDeliveryRating;
                    $sampleSupportRating = $productReview->sample_support_rating+$sampleSupportRating;
                    $productQualityRating = $productReview->product_quality_rating+$productQualityRating;

                }
                $ratingSum = $overallRating+$communicationRating+$ontimeDeliveryRating+$sampleSupportRating+$productQualityRating;
                if(count($productReviews)==0){
                    $averageRating=0;
                }
                else{
                    $averageRating = $ratingSum / count($productReviews) ;
                }

                $averageRating = $averageRating/5;
                return $averageRating;
    }

    if (!function_exists('make_slug')){
        function make_slug($string) {
            return preg_replace('/\s+/u', '-', strtolower(trim($string)));
        }
    }
}

if (!function_exists('businessProfileInfo')) {

    function businessProfileInfo($business_profile_id)
    {
        $business_profile=BusinessProfile::where('id',$business_profile_id)->first();
        return $business_profile;
    }
}

if (!function_exists('getlocalprice')){
    function getlocalprice($price)
    {
        $ip = request()->ip();
        $ipinfo = ipInfo($ip);
        $ipcode = $ipinfo->iso_code ?? "BD";
        if($ipcode != "BD")
        {
            return ($price == "")?sprintf("%.2f", '0'):sprintf("%.2f", $price);
        }
        else
        {
            if($price != "")
            {
                //$data = json_decode(file_get_contents('https://www.freeforexapi.com/api/live?pairs=USDBDT'), true);

                //return 1;


                return sprintf("%.2f", (int)$price * 1);
            }
            else
            {
                return sprintf("%.2f", '0');
            }
        }
    }
}

if (!function_exists('getlocalpriceunit')){
    function getlocalpriceunit()
    {
        $ip = request()->ip();
        $ipinfo = ipInfo($ip);
        $ipcode = $ipinfo->iso_code ?? "BD";
        if($ipcode != "BD")
        {
            return 'USD';
        }
        else
        {
            return 'USD';

        }
    }
}

if (!function_exists('ipInfo')){
    function ipInfo($ip=null) {
        $ip = $ip ?? request()->ip();

        $ipdata = GeoIP::getLocation($ip);
        //$ipdata = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
        //$ipdata = @json_decode(file_get_contents("http://www.netip.de/search?query={$ip}"));
        //$ipdata = @json_encode(file_get_contents("http://api.wipmania.com/{$ip}"));
        //$ipdata = @json_decode(file_get_contents("http://ip-api.com/php/{$ip}"));
        //$ipdata = @json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        return  $ipdata;
    }
}
