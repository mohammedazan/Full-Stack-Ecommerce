<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $color , $productdetail , $productList , $avgRating ,$CompanyInfo ,$product_id ,  $qte = 1; 

    public function mount($id){
        $this->ProductDetail($id);

    }

    public function ProductDetail($id){
        $this->productdetail = Product::find($id);
        $this->CompanyInfo=CompanyInfo::get();
        $this->color = ProductColor::get();
        $this->productList = Product::where('deleted', 0)->get();
        $this->avgRating = 0;
                // Calculate average rating if there are reviews
                if ($this->productdetail && $this->productdetail->reviews->isNotEmpty()) {
                    $totalRating = 0;
                    foreach ($this->productdetail->reviews as $review) {
                        $totalRating += $review->rate;
                    }
                    $this->avgRating = $totalRating / $this->productdetail->reviews->count();
                }


    }
    
    public function addToCart($productId, $quantity)
    {
        $userId = Auth::id();

        if (!$userId || !$productId || !$quantity) {
            session()->flash('error', 'Invalid product or quantity.');
            return;
        }

        $commande = Commande::where('users_id', $userId)->where('etat', 'en cours')->first();
    
        if ($commande) {
            $exists = false;

            foreach ($commande->lignecommande as $lignec) {
                if ($lignec->product_id == $productId) {
                    $exists = true;
                    $lignec->qte += $quantity;
                    $lignec->save();
                    break;
                }
            }

            if (!$exists) {
                $Lc = new LigneCommande();
                $Lc->qte = $quantity;
                $Lc->product_id = $productId;
                $Lc->commande_id = $commande->id;
                $Lc->save();
            }

            session()->flash('success', 'Product added to order successfully.');
        } else {
            $commande = new Commande();
            $commande->users_id = $userId;
            $commande->etat = 'en cours';

            if ($commande->save()) {
                $Lc = new LigneCommande();
                $Lc->qte = $quantity;
                $Lc->product_id = $productId;
                $Lc->commande_id = $commande->id;
                $Lc->save();

                session()->flash('success', 'Order created and product added successfully.');
            } else {
                session()->flash('error', "Unable to create order.");
            }
        }

        $this->emit('cartUpdated'); // Refresh the cart in the UI
    }

    public function addWishlist($id_Wishlist)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please log in to add products to your wishlist.');
        }

        $this->product_id = $id_Wishlist;

        $this->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product_id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Product already exists in wishlist.');
            return;
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product_id,
        ]);

        $this->emit('wishlistUpdated'); // Refresh wishlist count in the header
        session()->flash('success', 'Product added to wishlist successfully.');
    }

    public function render()
    {
        return view('livewire.product-detail',[
            'color'=>$this->color,
            'productdetail'=>$this->productdetail,
            'productList'=>$this->productList,
            'avgRating'=>$this->avgRating,
            'CompanyInfo'=>$this->CompanyInfo
        ]);
    }
}
