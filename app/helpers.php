<?php

use App\Models\Offer_product_list;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//require_once __DIR__ . './countryList.php';

function getUploadPath()
{
    return public_path('storage');
}



function userCanAccess($access_id) {
    // Retrieve the authenticated admin
    $admin = Auth::guard('admin')->user();
    // Get the role associated with the admin
    $role = $admin->role;
    if($role){
        // Retrieve the access_role_list from the role
        $access_list = $role->access_role_list;
        // Explode the access_role_list into an array
        $accessListArray = explode(",", $access_list);
        // Check if the access_id is in the accessListArray
        return in_array($access_id, $accessListArray);
    } 
    // Return false if the role is not found
    return false;
}

function calculateDiscount($item)
{
    $product = Product::find($item['id']);
    $currentDate = strtotime(Carbon::now()->format('Y-m-d'));
    $discount = 0;
    
    if ($product->discount > 0) {
        if ($product->discount_type == 0) {
            $discount = $product->discount;
        }
        if ($product->discount_type == 1) {
            $discount = ($product->discount * $product->current_sale_price) / 100;
        }
    }
    /*ghjkl*/

    if ($item['offerId'] > 0) {
        $offerInfo = Offer_product_list::with('offerInfo')->where('product_id', $item['id'])->where('offer_id', $item['offerId'])->first();
        $startDate = strtotime($offerInfo['offerInfo']->start_date);
        $endDate = strtotime($offerInfo['offerInfo']->end_date);

        if ($startDate <= $currentDate && $endDate >= $currentDate) {
            if ($offerInfo->offer_type == 0) {
                $discount = $offerInfo->offer_amount;
            }
            if ($offerInfo->offer_type == 1) {
                $discount = ($offerInfo->offer_amount * $product->current_sale_price) / 100;
            }
        }
    }
    return $discount;
}

function calculateOrder($order_items){
    $total_payable=0;
    $discountTotal=0;
    foreach ($order_items as $item) {
        $product = Product::find($item['id']);
        $discount = calculateDiscount($item);
        $unitPrice = $product->current_sale_price - $discount;
        $quantity = $item['quantity'];
        $total_price = $quantity * $unitPrice;
        $total_payable += $total_price;
        $discountTotal+=$discount*$quantity;
    }
    return [$total_payable,$discountTotal];
}

if (!function_exists('countryList')) {
    function countryList(){
       return countryListData();
    }
}



