<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Blog;


class BlogController extends Controller
{

    public function index(){
        $blogs=Blog::latest()->paginate(10);
        return view('admin.blog.index',compact('blogs'));
    }
    public function  create(){
        $blog = new Blog();
        return view('admin.blog.create',compact('blog'));
    }
    public function store(Request $request){
        
        $allData=$request->all();
        if ($request->hasFile('feature_image')){
            $path=$request->file('feature_image')->store('images','public');
            $image = Image::make(Storage::get('public/'.$path))->fit(750, 293);
            $small_image = Image::make(Storage::get('public/'.$path))->fit(360, 360);
            Storage::put($path, $image);
            Storage::put('small/'.$path, $small_image);
            $allData['feature_image']=$path;

           
        }

        if ($request->hasFile('author_img')){
            $path=$request->file('author_img')->store('images','public');
            $image = Image::make(Storage::get('public/'.$path))->fit(100, 100)->encode();
            $small_image = Image::make(Storage::get('public/'.$path))->fit(100, 100)->encode();
            Storage::put($path, $image);
            Storage::put('small/'.$path, $small_image);
            $allData['author_img']=$path;
        }

        $allData['created_by']=Auth::guard('admin')->user()->id;
        $allData['slug'] = Str::slug($allData['title'],'-');
        $blog=Blog::create($allData);
        Session::flash('success','Blog post created successfully!!!!');

        return redirect()->route('blogs.index');
      
    }
    public function  edit($id){
        $blog = Blog::where('id',$id)->first();
        return view('admin.blog.edit',compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->source = $request->source;
        $blog->author_name = $request->author_name;
        $blog->author_note = $request->author_note;
        $blog->photo_credit = $request->photo_credit;
        $blog->details = $request->details;
        $blog->slug = make_slug($request->title);

        if ($request->hasFile('feature_image')){
            Storage::delete($blog->feature_image);
            Storage::delete('small/' .$blog->feature_image);
            $path=$request->file('feature_image')->store('images','public');

            $image = Image::make(Storage::get('public/'.$path))->fit(750, 293)->encode();
            $small_image = Image::make(Storage::get('public/'.$path))->fit(360, 360)->encode();

            Storage::put($path, $image);
            Storage::put('small/'.$path, $small_image);

            $blog->feature_image = $path;
        }

        if ($request->hasFile('author_img')){
            Storage::delete($blog->author_img);
            Storage::delete('small/'.$blog->author_img);
            $path=$request->file('author_img')->store('images','public');

            $image = Image::make(Storage::get($path))->fit(100, 100)->encode();
            $small_image = Image::make(Storage::get('small/'.$path))->fit(100, 100)->encode();

            Storage::put($path, $image);
            Storage::put('small/'.$path, $small_image);

            $blog->author_img = $path;
        }


        $blog->updated_by = Auth::guard('admin')->user()->id;
        $blog->save();
        Session::flash('success','Blog post updated successfully!!!!');
        return redirect()->route('blogs.index');
    }

    public function destroy($id)
    {
        $blog=Blog::find($id);
        if(isset($blog->feature_image)){
            Storage::delete($blog->feature_image);
            Storage::delete('small/' .$blog->feature_image);
        }
        if(isset($blog->author_img)){
            Storage::delete($blog->author_img);
            Storage::delete('small/'.$blog->author_img);

        }

        Blog::destroy($id);
        Session::flash('success','Blog post deleted successfully!!!!');
        return redirect()->back();
    }
}
 