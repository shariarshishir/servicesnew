<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function  addToWishlist(Request $request){

        if (Auth::check()) {
            $product=Product::where('id',$request->product_id)->first();
            $result=ProductWishlist::where('user_id',auth()->user()->id)->where('product_id',$product->id)->first();
            if(!$result){
                $productWishlist=new ProductWishlist;
                $productWishlist->product_id=$product->id;
                $productWishlist->user_id=auth()->user()->id;
                $productWishlist->ip_address = $request->ip()??"127.0.01";
                $productWishlist->user_agent = $request->header('User-Agent')??"mozila";
                $productWishlist->save();
                if($productWishlist){
                    return response()->json(["message" => "Added to Wishlist ..","code"=>true,"productWishlist"=>$productWishlist,"productExistOrNot"=> $result],200);

                }
                else{
                    return response()->json(["message" => "Failed to add into wishlist !!","code"=>false,"productWishlist"=>$productWishlist,"productExistOrNot"=> $result],200);
                }

            }
            else{
                return response()->json(["message" => "Product already added in wishlist !!","code"=>false,"productExistOrNot"=> $result],200);
            }

        }
        else{
            return response()->json(["message" => "Please login first !!","code"=>false],200);
        }
    }


    public function  index(){
        $wishListItems=ProductWishlist::with('product.images')->where('user_id',auth()->user()->id)->get();
        if($wishListItems){
            return response()->json(['message' => 'Wishlist products found','code'=>true,'productWishlist'=>$wishListItems],200);

        }
        else{
            return response()->json(['message' => 'Wishlist products not found !!','code'=>false,'productWishlist'=>$wishListItems],204);
        }
    }

    public function wishListItemDelete(Request $request){
        $wishListItem=ProductWishlist::find($request->id);
        $wishListItem->forceDelete();
        if($wishListItem){
            return response()->json(['message' => 'Deleted From Wishlist ..','code'=>true],200);
        }
        else{
            return response()->json(['message'=>'Item not deleted from wishlist','code'=>false],200);
        }
    }
}
