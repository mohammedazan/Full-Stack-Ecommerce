<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
class BlogsController extends Controller
{
    public function index(){
        $Blogs=Blogs::all();
        return view("adminPanel/Blogs/blogs")->with("blogs",$Blogs);
    }
    public function store(Request $request){
        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string',
            'remarque' => 'required|string',
            'slug' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $blogs=new Blogs();
        $blogs->content=$request->content;
        $blogs->title=$request->title;
        $blogs->remarque=$request->remarque;
        $blogs->slug=$request->slug;
        $blogs->slug=uniqid();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $fillename=time() . '.' .$extension;
            $file->move('uploads_blogs/blogs', $fillename);
            $blogs->img=$fillename;
        }else {
            return $request;
            $blogs->img=" "; // or set a default image
        }
        $blogs->save();
        return redirect()->back()->with('success', 'blogs added successfully');
    }

    public function update(Request $request, $id) {
        $blogs = Blogs::find($id);
    
        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string',
            'remarque' => 'required|string',
            'slug' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $blogs->content = $request->content;
        $blogs->title = $request->title;
        $blogs->remarque = $request->remarque;
        $blogs->slug = $request->slug;
    
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads_blogs/blogs', $filename);
            $blogs->img = $filename;
        }
    
        $blogs->save();
    
        return redirect()->back()->with('success', 'Blog updated successfully');
    }
    
    
    public function removeBlogs($id ){
        $blogs = Blogs::find($id);
        if($blogs){
            $blogs->delete() ;
            return redirect()->back()->with('success', 'blogs added successfully');
        }
        else{
            echo 'you dont have the permission';
        }      
    }


    public function blogdetails($id){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $blogs=Blogs::find($id);
        $blogget=Blogs::where('id','!=',$id)->get();
        $Blogs=Blogs::all();
        return view('guest.pages.blogdetails', compact('productSubcategory', 'category','blogs','blogget','Blogs'));
    }
    

















    // public function getAllBlogs()
    // {
    //     $blogs = Blogs::all();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $blogs,
    //         'message' => 'Blogs retrieved successfully',
    //     ]);
    // }

    // public function Blog($slug)
    // {
    //     $blogs = Blogs::where('slug',$slug)->first();

    //     return $this->success($blogs);
    // }
}
