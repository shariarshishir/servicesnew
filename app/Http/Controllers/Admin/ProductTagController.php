<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProductTagController extends Controller
{
    public function index()
    {
        $product_tag = ProductTag::select('id', 'name')->get();
        return view('admin.product_tag.index',compact('product_tag'));
    }

    /**
     * Show the form for creating a new reproductCategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_tag = new ProductTag();
        return view('admin.product_tag.create',compact('product_tag'));

    }

    /**
     * Store a newly created reproductCategories in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_tags,name',
        ]);

        $product_tag=new ProductTag();
        $product_tag->name=$request->name;
        $product_tag->save();
        Session::flash('success','Added successfully!!!!');

        return redirect()->route('admin.product-tag.index');

    }

    /**
     * Show the form for editing the specified reproductCategories.
     *
     * @param  \App\Models\ProductTag  $ProductTag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_tag = ProductTag::find($id);
        return view('admin.product_tag.edit',compact('product_tag'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:product_tags,name,'.$id,
        ]);
        $product_tag = ProductTag::find($id);
        $product_tag->name=$request->name;
        $product_tag->save();
        Session::flash('success','Updated successfully!!!!');
        return redirect()->route('admin.product-tag.index');
    }


    public function destroy($id)
    {
        $productTypeMapping=ProductTag::find($id);
        $productTypeMapping->delete();
        Session::flash('success','ProductTag deleted successfully!!!!');
        return redirect()->route('admin.product-tag.index');

    }


}
