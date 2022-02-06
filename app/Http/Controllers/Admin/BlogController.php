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
        return view('admin.admin_blog.index',compact('blogs'));
    }
    public function  create(){
        $blog = new Blog();
        return view('admin.admin_blog.create',compact('blog'));
    }
    public function store(Request $request){
        
        $allData=$request->all();
        if ($request->hasFile('feature_image')){
            $path=$request->file('feature_image')->store('images','public');
            $image = Image::make(public_path('storage/'.$path));
            $image->save(public_path('storage/'.$path));

            $path_small=$request->file('feature_image')->store('images/small/','public');
            $small_image = Image::make(public_path('storage/'.$path_small))->fit(360, 360);
            $small_image->save(public_path('storage/'.$path_small));
            $allData['feature_image']=$path;
           
        }

        if ($request->hasFile('author_img')){
            $path=$request->file('author_img')->store('images','public');
            $image = Image::make(public_path('storage/'.$path))->encode();
            $image->save(public_path('storage/'.$path));

            $path_small=$request->file('author_img')->store('images/small','public');
            $small_image = Image::make(public_path('storage/'.$path_small))->fit(100, 100)->encode();
            $small_image->save(public_path('storage/'.$path_small));
            $allData['author_img']=$path;
        }

        $allData['created_by']=Auth::guard('admin')->user()->id;
        
        $lowercase = strtolower($allData['title']);
        $pattern = '/[^A-Za-z0-9\-]/';
        $preg_replace = preg_replace($pattern, '-', $lowercase);
        $single_hypen = preg_replace('/-+/', '-', $preg_replace);
        $alias = $single_hypen;

        //$allData['slug'] = Str::slug($allData['title'],'-');
        $allData['slug'] = $alias;

        $blog=Blog::create($allData);
        Session::flash('success','Blog post created successfully!!!!');

        return redirect()->route('blogs.index');
      
    }
    public function  edit($id){
        $blog = Blog::where('id',$id)->first();
        return view('admin.admin_blog.edit',compact('blog'));
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

        $lowercase = strtolower($request->title);
        $pattern = '/[^A-Za-z0-9\-]/';
        $preg_replace = preg_replace($pattern, '-', $lowercase);
        $single_hypen = preg_replace('/-+/', '-', $preg_replace);
        $alias = $single_hypen;        

        //$blog->slug = make_slug($request->title);
        $blog->slug = $alias;

        if ($request->hasFile('feature_image')){

            Storage::delete($blog->feature_image);
            Storage::delete('small/' .$blog->feature_image);

            $path=$request->file('feature_image')->store('images','public');
            $image = Image::make(public_path('storage/'.$path));
            $image->save(public_path('storage/'.$path));

            $path_small=$request->file('feature_image')->store('images/small/','public');
            $small_image = Image::make(public_path('storage/'.$path_small))->fit(360, 360);
            $small_image->save(public_path('storage/'.$path_small));

            $blog->feature_image = $path;
        }

        if ($request->hasFile('author_img')){
            Storage::delete($blog->author_img);
            Storage::delete('small/'.$blog->author_img);

            $path=$request->file('author_img')->store('images','public');
            $image = Image::make(public_path('storage/'.$path))->encode();
            $image->save(public_path('storage/'.$path));

            $path_small=$request->file('author_img')->store('images/small','public');
            $small_image = Image::make(public_path('storage/'.$path_small))->fit(100, 100)->encode();
            $small_image->save(public_path('storage/'.$path_small));
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
 