<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Ads;
use App\Models\BankAccount;
use App\Models\Blogs;
use App\Models\Brand;
use App\Models\Commande;
use App\Models\Faq;
use App\Models\FeaturedLink;
use App\Models\Newsletter;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Product_review;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Role;
use App\Models\Sell;
use App\Models\Sell_details;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){
         $startdate = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'); // 30 May 2022
         $enddate=Carbon::now()->format('Y-m-d H:i:s');

        $totalOrder=Sell::where('sell_type',2)->whereNot('order_status',3)->whereBetween('date', [$startdate,$enddate])->count();
        $sell = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
            ->whereBetween('sell_details.created_at',[$startdate,$enddate])
            ->select(
            DB::raw("SUM(sell_details.sale_quantity) as total_sell"),
            DB::raw("SUM(sell_details.unit_product_cost) as total_cost"),
            DB::raw("SUM(sell_details.unit_sell_price) as total_sell_price"),
        )
            ->get()[0];

        $sellProductList = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
            ->select('products.*', DB::raw("SUM(sell_details.sale_quantity) as total_sell"))
            ->groupBy('sell_details.product_id')
            ->orderBy('total_sell', 'DESC')
            ->get()->take(7);
        $productItem=Product::count();

           $lastOrder=Sell_details::orderBy('id', 'DESC')->whereHas('sellInfo',function($q){return $q->where('sell_type',2);})->get()->take(5);

        $customer=User::count();
        $ProductCategory=ProductCategory::count();
        $ProductSubCategory=ProductSubCategory::count();
        $ListRole=Role::count();
        $Commande=Commande::count();
        $Admin=Admin::count();
        $Supplier=Supplier::count();
        $Ads=Ads::count();
        $Blogs=Blogs::count();
        $Brand=Brand::count();
        $Faq=Faq::count();
        $FeaturedLink=FeaturedLink::count();
        
        // $Newsletter=Newsletter::count();
        $Offer=Offer::count();
        $Bank=BankAccount::count();
        $review=Product_review::count();
        

        return view('adminPanel.index')
        ->with(compact('totalOrder','sell','customer','sellProductList','lastOrder','productItem','ProductCategory','ProductSubCategory','ListRole','Commande','Admin','Ads','Blogs','Brand','Faq','FeaturedLink','Offer','Bank','Supplier','review'));
    }
}
