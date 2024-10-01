<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
    public $wishlistCount,$cartCount;

    // الاستماع لحدث 'wishlistUpdated'
    protected $listeners = ['wishlistUpdated' => 'updateWishlistCount','cartUpdated'=>'updateCartCount'];

    public function mount()
    {
        $this->updateWishlistCount();
        $this->updateCartCount();

    }

    public function updateWishlistCount()
    {
        if (Auth::check()) {
            $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $this->wishlistCount = 0; // تعيين العدد إلى صفر إذا لم يكن المستخدم مسجل الدخول
        }
    }

    public function updateCartCount()
    {
        if (Auth::check()) {
            // Get the user's orders that are 'en cours'
            $commandesEnCours = Commande::where('users_id', Auth::id())
                ->where('etat', 'en cours')
                ->get();

            // Initialize the cart count to zero
            $cartItemCount = 0;

            // Loop through each order and sum the quantities of products
            foreach ($commandesEnCours as $commande) {
                foreach ($commande->lignecommande as $ligne) {
                    $cartItemCount += $ligne->qte; // Sum the quantity for each product in the order
                }
            }

            // Assign the total count of items to the cartCount property
            $this->cartCount = $cartItemCount;
        } else {
            // Set the cart count to zero if the user is not logged in
            $this->cartCount = 0;
        }
    }
    public function render()
    {
        return view('livewire.header');
    }
}
