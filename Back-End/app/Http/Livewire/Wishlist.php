<?php

namespace App\Http\Livewire;

use App\Models\CompanyInfo;
use App\Models\Wishlist as ModelsWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    
    public $wishlistItems ;
    public $CompanyInfo ;
    public function mount()  {
        $this->wishlistItems =  ModelsWishlist::where('user_id', Auth::id())->with('product')->get();
        $this->CompanyInfo = CompanyInfo::get();
        
    }
    public function remove($id)
    {
        // Find and delete the wishlist item
        $wishlistItem = ModelsWishlist::findOrFail($id);
        $wishlistItem->delete();
        // After deletion, reload the wishlist items to reflect the changes
        $this->wishlistItems = ModelsWishlist::where('user_id', Auth::id())->with('product')->get();
    }
    

    public function render()
    {
        return view('livewire.wishlist',[
            'wishlistItems' => $this->wishlistItems ,
            'CompanyInfo' => $this->CompanyInfo
        ]);
    }
}
