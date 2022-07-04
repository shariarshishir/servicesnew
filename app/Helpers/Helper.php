<?php

use App\Models\BusinessProfile;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\RelatedProduct;
use App\Models\ProductTypeMapping;

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
        $business_profile=BusinessProfile::withTrashed()->where('id',$business_profile_id)->first();
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



if (!function_exists('getLeadTime')){
    function getLeadTime($collection)
    {

        $count= count(json_decode($collection->attribute));
        $count_previous_last = $count-2;
        foreach (json_decode($collection->attribute) as $k => $v){
            if($k == 0 && $v[2] == 'Negotiable'){
                return $v[3]. ' days';
            }
            if($k == $count-1 && $v[2] != 'Negotiable'){
                return $v[3]. ' days';
            }
            if($k == $count-1 && $v[2] == 'Negotiable'){
                foreach (json_decode($collection->attribute) as $k => $v){
                        if($k == $count_previous_last){
                            return $v[3]. ' days';
                        }

                }
            }
        }
    }
}


if (!function_exists('productTypeMapping')){

    function productTypeMapping($parent_id){
        $product_type_mapping=ProductTypeMapping::where('parent_id',$parent_id)->pluck('title','id');
        return $product_type_mapping;
    }

}

if (!function_exists('generateUniqueString')){
    function generateUniqueString(){
        $str=rand();
        $uniqueString = md5($str);
        return $uniqueString;
    }
}

if (!function_exists('generateHashPassword')){
    function generateHashPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
