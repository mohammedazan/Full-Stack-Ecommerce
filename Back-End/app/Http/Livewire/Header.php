<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
    public $wishlistCount;

    // الاستماع لحدث 'wishlistUpdated'
    protected $listeners = ['wishlistUpdated' => 'updateWishlistCount'];

    public function mount()
    {
        $this->updateWishlistCount();
    }

    public function updateWishlistCount()
    {
        if (Auth::check()) {
            $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $this->wishlistCount = 0; // تعيين العدد إلى صفر إذا لم يكن المستخدم مسجل الدخول
        }
    }

    public function render()
    {
        return view('livewire.header');
    }
}
