<?php

namespace App\Http\Controllers;

use App\Models\OrderModificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Blog;
use App\Models\BusinessProfile;
use App\Models\Manufacture\Product as ManufactureProduct;
use App\Models\CompanyFactoryTour;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Helper;
use DB;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //$products = Product::with('images')->where('is_featured', 1)->paginate(9);
        $readyStockProducts = Product::with('images')->whereIn('product_type', [2,3])->where('state',1)->where('sold',0)->inRandomOrder()->get();
        $buyDesignsProducts = Product::with('images')->where('product_type', 1)->where('state',1)->where('sold',0)->inRandomOrder()->get();
        //dd($buyDesignsProducts);
        return view('shoplanding', compact('readyStockProducts', 'buyDesignsProducts'));
    }

    public function productList()
    {
        $products = Product::with('images')->where('is_featured', 1)->where('state',1)->where('sold',0)->paginate(12);
        return view('products',compact('products'));
    }
    //start products by category sub category and subsub category
    public function productsByCategory($slug)
    {
        $category=ProductCategory::where('slug',$slug)->with('children')->first();
        //$cat_id=collect([$category->id]);
        $get_sel_cat_id=$category->id;
        $get_child_cat_id= $category->getAllChildren()->pluck('id');
        $total_cat_id=$get_child_cat_id->push($get_sel_cat_id)->toArray();
        // $products=Product::with('images')->whereIn('product_category_id', $total_cat_id)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(9);
        // return $products;
        // if($category->children()->exists()){
        //     foreach($category->children as $child){
        //         array_push($total_cat_id,$child->id);
        //         if($child->children()->exists()){
        //             foreach($child->children as $child2){
        //                 array_push($total_cat_id,$child2->id);
        //             }
        //         }
        //     }
        // }
        $products = $this->products($total_cat_id);
        return view('product.categories_product',compact('products','total_cat_id'));
    }

    public function productsBySubCategory($category,$subcategory)
    {
        $category=ProductCategory::where('slug',$subcategory)->first();
        $total_cat_id[]=$category->id;
        if($category->children()->exists()){
            foreach($category->children as $child){
                array_push($total_cat_id,$child->id);
            }
        }
        $products = $this->products($total_cat_id);
        return view('product.categories_product',compact('products','total_cat_id'));
    }

    public function productsBySubSubCategory($category,$subcategory,$subsubcategory)
    {
        $category=ProductCategory::where('slug',$subsubcategory)->first();
        $total_cat_id[]=$category->id;
        $products = $this->products($total_cat_id);
        return view('product.categories_product',compact('products','total_cat_id'));
    }

    public function products($id)
    {
      $products=Product::with('images')->whereIn('product_category_id', $id)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
      return $products;
    }
    //end products category
    //start readystock products
    public function readyStockProducts()
    {
        $products = Product::with('images')->whereIn('product_type', [2,3])->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.ready_stock_product',compact('products'));
    }

    public function readyStockProductsByCategory($slug)
    {
        $category=ProductCategory::where('slug',$slug)->first();
        $total_cat_id[]=$category->id;
        if($category->children()->exists()){
            foreach($category->children as $child){
                array_push($total_cat_id,$child->id);
                if($child->children()->exists()){
                    foreach($child->children as $child2){
                        array_push($total_cat_id,$child2->id);
                    }
                }
            }
        }
        $products = Product::with('images')->whereIn('product_category_id', $total_cat_id)->whereIn('product_type', [2,3])->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.ready_stock_product',compact('products', 'total_cat_id'));
    }


    public function  readyStockProductsBySubcategory($category,$subcategory){
        $category=ProductCategory::where('slug',$subcategory)->first();
        $total_cat_id[]=$category->id;
        if($category->children()->exists()){
            foreach($category->children as $child){
                array_push($total_cat_id,$child->id);
            }
        }
        $products = Product::with('images')->whereIn('product_category_id', $total_cat_id)->whereIn('product_type', [2,3])->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.ready_stock_product',compact('products','total_cat_id'));
    }

    public function  readyStockProductsBySubSubcategory($category,$subcategory,$subsubcategory){
        $category=ProductCategory::where('slug',$subsubcategory)->first();
        $products = Product::with('images')->where('product_category_id', $category->id)->whereIn('product_type', [2,3])->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        $total_cat_id[]=$category->id;
        return view('product.ready_stock_product',compact('products','total_cat_id'));
    }
    //end readystock products

    //customizable products
    public function customizable()
    {
        $products = Product::with('images')->where('customize', true)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.customizable',compact('products'));
    }

   //start buy design products
    public function buyDesignsProducts()
    {
        $products = Product::with('images')->where('product_type', 1)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.buy_design_product',compact('products'));
    }

    public function buyDesignProductsByCategory($slug)
    {
        $category=ProductCategory::where('slug',$slug)->first();
        $total_cat_id[]=$category->id;
        if($category->children()->exists()){
            foreach($category->children as $child){
                array_push($total_cat_id,$child->id);
                if($child->children()->exists()){
                    foreach($child->children as $child2){
                        array_push($total_cat_id,$child2->id);
                    }
                }
            }
        }
        $products = Product::with('images')->whereIn('product_category_id', $total_cat_id)->where('product_type', 1)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.buy_design_product',compact('products','total_cat_id'));
    }
    public function  buyDesignProductsBySubcategory($category,$subcategory){
        $category=ProductCategory::where('slug',$subcategory)->first();
        $total_cat_id[]=$category->id;
        if($category->children()->exists()){
            foreach($category->children as $child){
                array_push($total_cat_id,$child->id);
            }
        }
        $products = Product::with('images')->whereIn('product_category_id', $total_cat_id)->where('product_type', 1)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        return view('product.buy_design_product',compact('products','total_cat_id'));
    }
    public function  buyDesignProductsBySubSubcategory($category,$subcategory,$subsubcategory){
        $category=ProductCategory::where('slug',$subsubcategory)->first();
        $products = Product::with('images')->where('product_category_id', $category->id)->where('product_type', 1)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
        $total_cat_id[]=$category->id;
        return view('product.buy_design_product',compact('products','total_cat_id'));
    }
    //end buy design products
    public function vendorList()
    {
        $userIds=User::where('user_type','wholesaler')->pluck('id');
        $vendors = Vendor::with('user')->whereIn('user_id',$userIds)->paginate(12);
        return view('vendors',compact('vendors'));
    }

    public function productDetails($sku)
    {
        $category = ProductCategory::get();
        $product = Product::with('businessProfile')->where('sku',$sku)->first();

        $orderModificationRequest=OrderModificationRequest::where(['product_id' => $product->id, 'type' => 2, 'user_id' =>auth()->id() ])->get();
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

        $productReviewExistsOrNot = ProductReview::where('created_by',auth()->id())->where('product_id',$product->id)->first();
        $colors_sizes = json_decode($product->colors_sizes);
        $attr = json_decode($product->attribute);
        //recommandiation products
        $recommandProducts=Product::with('businessProfile')->where('state',1)
        ->where('id','!=',$product->id)
        ->whereHas('category', function($q) use ($product){
             $q->where('id',$product->product_category_id);

        })
        ->orWhere(function($query) use ($product){
            $query->where('product_type',$product->product_type)
                  ->where('id', '!=', $product->id);
        })
        ->with(['images'])
        ->get();
        return view('product.details',compact('category','product','colors_sizes','attr','productReviewExistsOrNot','averageRating','orderModificationRequest','recommandProducts'));
    }

    public function sorting($value, $slug=null, $cat_id=null)
    {

      //home category wise product
      if($cat_id != 'null' && ($slug != 'buy-designs' && $slug != 'ready-stock') ){
                $cat_ids= explode(",", $cat_id);
                if($value == 'name'){
                    $products=Product::whereIn('product_category_id',$cat_ids)->orderBy($value)->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
                }
                else{
                    $products=Product::whereIn('product_category_id',$cat_ids)->orderBy($value, 'desc')->where('state',1)->where('sold',0)->inRandomOrder()->paginate(12);
                }
        }
      //product type wise product
      if($cat_id == 'null' && ($slug == 'buy-designs' || $slug == 'ready-stock' ) ){
            $type= $slug == 'buy-designs' ? [1] : [2,3] ;
            if($value == 'name'){
                $products=Product::whereIn('product_type', $type)->orderBy($value)->where('state',1)->where('sold',0)->paginate(12);
            }
            else{
                $products=Product::whereIn('product_type', $type)->orderBy($value, 'desc')->where('state',1)->where('sold',0)->paginate(12);
            }

        }
      //product type plus category wise product
      if( $cat_id != 'null' && ($slug == 'buy-designs' || $slug == 'ready-stock') ){
            $type= $slug == 'buy-designs' ? [1] : [2,3];
            $cat_ids= explode(",", $cat_id);
            if($value == 'name'){
                $products=Product::whereIn('product_category_id',$cat_ids)->whereIn('product_type', $type)->orderBy($value)->where('state',1)->where('sold',0)->paginate(12);
            }
            else{
                $products=Product::whereIn('product_category_id',$cat_ids)->whereIn('product_type', $type)->orderBy($value, 'desc')->where('state',1)->where('sold',0)->paginate(12);
            }
        }

      $data=view('product._products_list',compact('products'))->render();
      return response()->json([
        'data' => $data,
      ],200);

    }
   //vendor sorting
   public function sortingVendor($value)
    {
        $userIds=User::where('user_type','wholesaler')->pluck('id');
        if($value == 'name'){
            $vendors = Vendor::with('user')->whereIn('user_id',$userIds)->orderBy('vendor_name')->paginate(12);
        }
        else{
            $vendors = Vendor::with('user')->whereIn('user_id',$userIds)->orderBy($value, 'desc')->paginate(12);
        }
        $data=view('include.partials._vendor_list',compact('vendors'))->render();

        return response()->json([
            'data' => $data,
        ],200);

    }

    public function liveSearchByProductOrVendor(Request $request){
        if(!empty($request->searchInput)) {
            if($request->selectedSearchOption=="product")
            {
                $results=Product::with('images')->where('name', 'like', '%'.$request->searchInput.'%')->get();
                $averageRatings=[];
                foreach($results as $result){
                    array_push($averageRatings, productRating($result->id));
                }


                $resultCount=count($results);
                return response()->json([
                    'data' => $results,
                    'resultCount'=>$resultCount,
                    'averageRatings'=>$averageRatings,
                    'error' => 0,
                    'searchType' =>$request->selectedSearchOption,
                  ],200);
            }
            elseif($request->selectedSearchOption=="vendor")
            {
                $results=Vendor::where('vendor_name', 'like', '%'.$request->searchInput.'%')->get();
                $resultCount=count($results);
                return response()->json([
                    'data' => $results,
                    'resultCount'=>$resultCount,
                    'error' => 0,
                    'searchType' =>$request->selectedSearchOption,
                    ],200);
            }
        }
        else
        {
            return response()->json([
                'data' => "No result found",
                'resultCount'=>0,
                'error' => 1,
                'searchType' =>$request->selectedSearchOption,
                ],200);
        }

    }

    public function searchByProductOrVendor(Request $request){
        //dd($request->all());
        $searchInputValue=$request->search_input;

        if(!empty($request->search_input)) {

            if($request->search_type=="product")
            {
                $products=Product::with('images')->where('name', 'like', '%'.$request->search_input.'%')->get();
                $searchType="product";
                return view('system_search_products',compact('products','searchType','searchInputValue'));

            }
            elseif($request->search_type=="vendor")
            {
                $vendors=Vendor::where('vendor_name', 'like', '%'.$request->search_input.'%')->get();
                $searchType="vendor";
                return view('system_search_vendors',compact('vendors','searchType','searchInputValue'));

            }
        }
        else
        {
            return redirect()->back();
        }

    }

   //filter search
   public function filterSearch(Request $request)
   {

      if($request->search_category_id){
          $home_page_cat_id= explode(",", $request->search_category_id);
          $products=Product::whereIn('product_category_id',$home_page_cat_id)->where('state',1)->where('sold',0)->get();
        }
      else{
          if($request->product_type== 1){
            $product_type=[1];
          }else{
            $product_type=[2,3];
          }

          if($request->product_type_category_id){
            $product_type_cat_id= explode(",", $request->product_type_category_id);
            $products=Product::whereIn('product_type',  $product_type)->whereIn('product_category_id',$product_type_cat_id)->where('state',1)->where('sold',0)->get();
          }
          else{
            $products=Product::whereIn('product_type', $product_type)->where('state',1)->where('sold',0)->get();
          }
      }

      $search_id=[];

      foreach($products as $product)
        {
          if(isset($product->colors_sizes))
            {
              foreach(json_decode($product->colors_sizes) as $color_attr)
                {
                    if(isset($request->color))
                    {
                        if(in_array($color_attr->color, $request->color)){
                            array_push($search_id, $product->id);
                        }
                    }
                    if (isset($request->size))
                    {
                        foreach($color_attr as $key=>$attr)
                        {
                            if(in_array($key, $request->size) && !empty($attr))
                            {
                               array_push($search_id,$product->id);
                            }
                        }
                    }

                }
            }

          if(isset($request->rating))
          {
             foreach($product->productReview as $review)
             {
                 if(in_array($review->average_rating, $request->rating))
                 {
                     array_push($search_id,$product->id);
                 }
             }
          }

          if(!empty($request->minimum_value) && !empty($request->maximum_value))
          {
            foreach(json_decode($product->attribute) as $price)
            {
              if (  $price[2] >= $request->minimum_value && $price[2] <= $request->maximum_value){
                  array_push($search_id,$product->id);
              }
            }
          }


        }

        $productList=Product::whereIn('id',array_unique($search_id))->paginate(12);
        $data=view('product._products_list',['products' => $productList])->with('products', $productList)->render();
        return response()->json([
               'success' => true,
               'data'    => $data,
        ],200);

    }

    public function blogs(){

        $blogs=Blog::latest()->paginate(10);
        return view('blog.index',compact('blogs'));

    }
    public function blogDetails($slug)
    {
        $blog = Blog::where('slug',$slug)->firstOrFail();
        $data = [];

        $blogs = $blog->source;
        foreach((array)$blogs as $blo)
        {
            if(!is_null($blo['name']) && $blo['name'] != "")
            {
               $data[] = ['name' => $blo['name'],'link' => $blo['link']];
            }
        }

        $blog['sourcedata'] = $data;

        return view('blog.show',compact('blog'));
    }

    //suppliers
    public function suppliers(Request $request)
    {
        $suppliers=BusinessProfile::with(['businessCategory'])->where(function($query) use ($request){
            if($request->business_type){
                $query->whereIn('business_type',$request->business_type)->get();
            }
            if($request->industry_type){
                $query->whereIn('industry_type',$request->industry_type)->get();
            }
            if(isset($request->business_name)){
                $query-> where('business_name', 'like', '%'.$request->business_name.'%')->get();
            }
        })
        ->paginate(10);
        return view('suppliers.index',compact('suppliers'));
    }
    //supplier profile
    public function supplerProfile($id)
    {
        $business_profile=BusinessProfile::findOrFail($id);
        //manufacture
        $flag=0;
        if( $business_profile->companyOverview->about_company == null){
            $flag=1;
        }
        elseif( $business_profile->companyOverview->address == null ){
            $flag=1;
        }
        elseif($business_profile->companyOverview->factory_address  == null ){
            $flag=1;
        }
        else{
            foreach (json_decode($business_profile->companyOverview->data) as $company_overview){
                if($company_overview->value == null)
                {
                    $flag=1;
                    break;
    
                }
              
            }

        }
        if($business_profile->business_type == 1 )
        {

            $business_profile=BusinessProfile::with(['companyOverview','manufactureProducts.product_images','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security'])->findOrFail($id);
            $userObj = User::where('id',$business_profile->user_id)->get();
            $companyFactoryTour=CompanyFactoryTour::with('companyFactoryTourImages','companyFactoryTourLargeImages')->where('business_profile_id',$id)->first();
            $mainProducts=ManufactureProduct::with('product_images')->where('business_profile_id',$id)->inRandomOrder()
            ->limit(4)
            ->get();
            return view('manufacture_profile_view_by_user.index',compact('business_profile','mainProducts','companyFactoryTour','userObj','flag'));
        }
        //wholesaler
        if($business_profile->business_type == 2 )
        {
            $business_profile=BusinessProfile::with(['companyOverview','wholesalerProducts.images','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security'])->findOrFail($id);
            $userObj = User::where('id',$business_profile->user_id)->get();
            $mainProducts=Product::with('images')->where('business_profile_id',$id)->inRandomOrder()
            ->limit(4)
            ->get();
            return view('wholesaler_profile_view_by_user.index',compact('business_profile','mainProducts','userObj','flag'));
        }
    }
    //low moq
    public function lowMoqData(Request $request)
    {
        $wholesaler_products=Product::with(['images','businessProfile'])->where('moq','!=', null)->where(['state' => 1, 'sold' => 0,])->where('business_profile_id', '!=', null)->get();
        $manufacture_products=ManufactureProduct::with(['product_images','businessProfile'])->where('moq','!=', null)->where('business_profile_id', '!=', null)->get();
        $merged = $wholesaler_products->merge($manufacture_products)->sortBy('moq');
        $sorted=$merged->sortBy('moq');
        $sorted_value= $sorted->values()->all();
        return $sorted_value;
        //return view('product.low_moq',['products' => $sorted_value]);
        // $page=isset($request->page) ? $request->page : 1;
        // $collection=  $sorted->forPage($page,3);
        // return $collection;
    }

    public function lowMoq()
    {
        return view('product.low_moq');
    }
    //low moq details
    public function mixProductDetails($flag, $id)
    {
        if($flag == 'mb'){
            $product = ManufactureProduct::with('category','product_images','businessProfile')->findOrFail($id);
            return view('product.manufactrue_product_details',compact('product'));
        }
        else if($flag == 'shop'){
            $category = ProductCategory::get();
            $product = Product::with('businessProfile')->where('id',$id)->first();

            $orderModificationRequest=OrderModificationRequest::where(['product_id' => $product->id, 'type' => 2, 'user_id' =>auth()->id() ])->get();
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

            $productReviewExistsOrNot = ProductReview::where('created_by',auth()->id())->where('product_id',$product->id)->first();
            $colors_sizes = json_decode($product->colors_sizes);
            $attr = json_decode($product->attribute);
            //recommandiation products
            $recommandProducts=Product::with('businessProfile')->where('state',1)
            ->where('id','!=',$product->id)
            ->whereHas('category', function($q) use ($product){
                 $q->where('id',$product->product_category_id);

            })
            ->orWhere(function($query) use ($product){
                $query->where('product_type',$product->product_type)
                      ->where('id', '!=', $product->id);
            })
            ->with(['images'])
            ->get();
            return view('product.details',compact('category','product','colors_sizes','attr','productReviewExistsOrNot','averageRating','orderModificationRequest','recommandProducts'));
        }
    }
    //shortest lead time
    public function shortestLeadTime()
    {
        $products=ManufactureProduct::with(['product_images','businessProfile'])->where('lead_time','!=', null)->where('business_profile_id', '!=', null)->orderBy('lead_time')->paginate(12);
        return view('product.shortest_lead_time',compact('products'));
    }

    public function studio3dPage(){
        return view('studio.index');
    }

    public function toolsLandingPage(){
        return view('tools.index');
    }



}
