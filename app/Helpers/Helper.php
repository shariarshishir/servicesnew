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

if (!function_exists('units')){

    function units(){
        return [
            'cm'=>'cm',
            'mm'=>'mm',
            'mtr'=>'mtr',
            'kg'=>'kg',
            'pcs'=>'pcs',
            'ft'=>'ft',
            'inch'=>'inch',
            'ton'=>'ton',
            'pound'=>'pound',
            'ounce'=>'ounce',
			'yarn'=>'yarn',
			'yard' => 'yard',
        ];
    }

}






