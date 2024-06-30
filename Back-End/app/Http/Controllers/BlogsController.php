<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function index(){
        $Blogs=Blogs::all();
        return view('adminPanel/Blogs/blogs')->with(compact('blogs'));

    }

    public function store(Request $request){
        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string',
            'blogowner' => 'required|string',
            'Shorttitle' => 'required|string',
            // 'slug' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $blogs=new Blogs();
        $blogs->content=$request->content;
        $blogs->blogowner=$request->blogowner;
        $blogs->title=$request->title;
        $blogs->Shorttitle=$request->Shorttitle;
        // $blogs->slug=$request->slug;
        $blogs->slug=uniqid();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $fillename=time() . '.' .$extension;
            $file->move('uploads_blogs/blogs', $fillename);
            $blogs->img=$fillename;
        }else{
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
            'blogowner' => 'required|string',
            'Shorttitle' => 'required|string',
            // 'slug' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    


        $blogs->content = $request->content;
        $blogs->blogowner=$request->blogowner;
        $blogs->title = $request->title;
        $blogs->Shorttitle=$request->Shorttitle;
        // $blogs->slug = $request->slug;
    
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
        $CompanyInfo=CompanyInfo::get();
        $CartCount = 0;
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandes = Commande::where('users_id', Auth::id())->get();

    // Loop through each Commande and count the total number of items
    foreach ($commandes as $commande) {
        $CartCount += $commande->lignecommande->count();
    }

        return view('guest.pages.blogdetails', compact('productSubcategory', 'category','blogs','blogget','Blogs','CompanyInfo','CartCount','wishlistCount'));
    }

    public function blogall(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $Blogall=Blogs::all();
        $CompanyInfo=CompanyInfo::get();
        $CartCount = 0;
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandes = Commande::where('users_id', Auth::id())->get();
    // Loop through each Commande and count the total number of items
        foreach ($commandes as $commande) {
            $CartCount += $commande->lignecommande->count();
        }

        return view('guest.pages.blogall', compact('productSubcategory', 'category','Blogall','CompanyInfo','CartCount','wishlistCount'));
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
