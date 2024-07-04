<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewProduct extends Controller
{
    // public function index(){

    //     $review=Product_review::all();
    //     return view('/guest/pages/productdetail')->with('review',$review);
    // }

    public function index(){
        $review=Product_review::all();
        return view('adminPanel/Reviews/review')->with('review',$review);
    }

   


    
    public function addreview(Request $request){
        // dd($request);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please register to submit a review.');
        }    
        $review=new Product_review();
        $review->rate=$request->rate;
        $review->product_id=$request->product_id;
        $review->content=$request->content;
        $review->customer_id=Auth::user()->id;
        $review->save();
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }


    public function delete($id){
        $review = Product_review::find($id);
        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        }
        return redirect()->back()->with('error', 'Review not found.');
    }
}
