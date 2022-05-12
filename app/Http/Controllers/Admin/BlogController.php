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
use App\Models\MetaInformation;

class BlogController extends Controller
{

    public function index(){
        $blogs = Blog::with('metaInformation')->latest()->paginate(10);
        return view('admin.admin_blog.index',compact('blogs'));
    }
    public function  create(){
        
        $blog = new Blog();
        return view('admin.admin_blog.create',compact('blog'));
    }
    public function store(Request $request){
        // dd($request->all());
        $allData = $request->except('_token', 'meta_title', 'meta_description','meta_image','meta_type');
        // if ($request->hasFile('feature_image')){
        //     $path=$request->file('feature_image')->store('images','public');
        //     $image = Image::make(public_path('storage/'.$path));
        //     $image->save(public_path('storage/'.$path));

        //     $path_small=$request->file('feature_image')->store('images/small/','public');
        //     $small_image = Image::make(public_path('storage/'.$path_small))->fit(360, 360);
        //     $small_image->save(public_path('storage/'.$path_small));
        //     $allData['feature_image']=$path;
           
        // }
        if ($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $s3 = \Storage::disk('s3');
            $uniqueString = generateUniqueString();
            $feature_image_file_name = uniqid().$uniqueString.'.'. $image->getClientOriginalExtension();
            $s3filePath = '/public/images/' . $feature_image_file_name;
            $s3->put($s3filePath, file_get_contents($image));
            $allData['feature_image']=$feature_image_file_name;
        }

        // if ($request->hasFile('author_img')){
        //     $path=$request->file('author_img')->store('images','public');
        //     $image = Image::make(public_path('storage/'.$path))->encode();
        //     $image->save(public_path('storage/'.$path));

        //     $path_small=$request->file('author_img')->store('images/small','public');
        //     $small_image = Image::make(public_path('storage/'.$path_small))->fit(100, 100)->encode();
        //     $small_image->save(public_path('storage/'.$path_small));
        //     $allData['author_img']=$path;
        // }
        if ($request->hasFile('author_img')){
            $image = $request->file('author_img');
            $s3 = \Storage::disk('s3');
            $uniqueString = generateUniqueString();
            $author_img_file_name = uniqid().$uniqueString.'.'. $image->getClientOriginalExtension();
            $s3filePath = '/public/images/' . $author_img_file_name;
            $s3->put($s3filePath, file_get_contents($image));
            $allData['author_img']=$author_img_file_name;
        }

        // if ($request->hasFile('meta_image')){
        //     $path=$request->file('meta_image')->store('images','public');
        //     $image = Image::make(public_path('storage/'.$path));
        //     $image->save(public_path('storage/'.$path));

        //     $path_small=$request->file('meta_image')->store('images/small/','public');
        //     $small_image = Image::make(public_path('storage/'.$path_small))->fit(360, 360);
        //     $small_image->save(public_path('storage/'.$path_small));
        //     $meta_image_path=$path;
           
        // }

        if ($request->hasFile('meta_image')){
            $image = $request->file('meta_image');
            $s3 = \Storage::disk('s3');
            $uniqueString = generateUniqueString();
            $meta_image_file_name = uniqid().$uniqueString.'.'. $image->getClientOriginalExtension();
            $s3filePath = '/public/images/' . $meta_image_file_name;
            $s3->put($s3filePath, file_get_contents($image));
        }

        $allData['created_by']=Auth::guard('admin')->user()->id;
        
        $lowercase = strtolower($allData['title']);
        $pattern = '/[^A-Za-z0-9\-]/';
        $preg_replace = preg_replace($pattern, '-', $lowercase);
        $single_hypen = preg_replace('/-+/', '-', $preg_replace);
        $alias = $single_hypen;

        //$allData['slug'] = Str::slug($allData['title'],'-');
        $allData['slug'] = $alias;

        $blog = Blog::create($allData);

        $metaInformation = new MetaInformation();
        $metaInformation->blog_id = $blog->id;
        $metaInformation->meta_title = $request->meta_title;
        $metaInformation->meta_description = $request->meta_description;
        $metaInformation->meta_type = $request->meta_type;
        $metaInformation->meta_image = $meta_image_file_name??NULL;
        $metaInformation->save();
        return redirect()->route('blogs.index');
      
    }
    public function  edit($id){
        Session::flash('success','Blog post created successfully!!!!');
        Session::put('backUrl',  url()->previous());
        
        $blog = Blog::with('metaInformation')->where('id',$id)->first();
        return view('admin.admin_blog.edit',compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::with('metaInformation')->find($id);
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
        if ($request->hasFile('author_img')){
            Storage::disk('s3')->delete($blog->author_img);
            Storage::delete('small/'.$blog->author_img);
            $image = $request->file('author_img');
            $s3 = \Storage::disk('s3');
            $author_img_file_name = uniqid() .'.'. $image->getClientOriginalExtension();
            $s3filePath = '/blog_images/' . $author_img_file_name;
            $s3->put($s3filePath, file_get_contents($image));
            $allData['author_img']=$author_img_file_name;
        }

        $blog->updated_by = Auth::guard('admin')->user()->id;
        $blog->save();
        
        $metaInformation = MetaInformation::where('blog_id',$id)->first();

        if(!$metaInformation) 
        {

            if ($request->hasFile('meta_image')){
                $path=$request->file('meta_image')->store('images','public');
                $image = Image::make(public_path('storage/'.$path));
                $image->save(public_path('storage/'.$path));
    
                $path_small=$request->file('meta_image')->store('images/small/','public');
                $small_image = Image::make(public_path('storage/'.$path_small))->fit(360, 360);
                $small_image->save(public_path('storage/'.$path_small));
                $meta_image_path=$path;
               
            }

            $metaInformation = new MetaInformation();
            $metaInformation->blog_id = $blog->id;
            $metaInformation->meta_title = $request->meta_title;
            $metaInformation->meta_description = $request->meta_description;
            $metaInformation->meta_type = $request->meta_type;
            $metaInformation->meta_image = $meta_image_path ?? NULL;
            $metaInformation->save();
        } 
        else
        {

            if ($request->hasFile('meta_image')){
                Storage::delete($blog->metaInformation->meta_image);
                Storage::delete('small/'.$blog->metaInformation->meta_image);
    
                $path = $request->file('meta_image')->store('images','public');
                $image = Image::make(public_path('storage/'.$path))->encode();
                $image->save(public_path('storage/'.$path));
    
                $path_small = $request->file('meta_image')->store('images/small','public');
                $small_image = Image::make(public_path('storage/'.$path_small))->fit(100, 100)->encode();
                $small_image->save(public_path('storage/'.$path_small));
                $meta_image_path = $path;
            }

            $metaInformation->blog_id = $blog->id;
            $metaInformation->meta_title = $request->meta_title;
            $metaInformation->meta_description = $request->meta_description;
            $metaInformation->meta_type = $request->meta_type;
            $metaInformation->meta_image = $meta_image_path ?? $metaInformation->meta_image;
            $metaInformation->save();
        }
        $url = Session::get('backUrl');
        Session::flash('success','Blog post updated successfully!!!!');
        return redirect($url);
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
 