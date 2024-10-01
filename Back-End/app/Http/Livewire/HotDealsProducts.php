<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Wishlist;

class HotDealsProducts extends Component
{
    public $category ,$product_id;
    public $productList;
    public $activeCategory = null; // Default to null for "All"
    public function mount()
    {
        // Fetch categories with related products count and sort them consistently
        $this->category = ProductCategory::where('status', 1)
            ->where('deleted', 0)
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->orderBy('name', 'asc')
            ->take(4)
            ->get();

        // Load all products
        $this->productList = Product::where('deleted', 0)->get();

        // Calculate ratings for each product
        foreach ($this->productList as $product) {
            $reviews = $product->reviews;
            if ($reviews->count() > 0) {
                $totalRating = $reviews->sum('rate');
                $product->avgRating = $totalRating / $reviews->count();
                $product->reviewsCount = $reviews->count();
            } else {
                $product->avgRating = 0;
                $product->reviewsCount = 0;
            }
        }
    }
    
    
    public function CategoryFilter($id = null)
    {
        $this->activeCategory = $id; // Set the active category

        if ($id) {
            $this->productList = Product::where('category_id', $id)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }

        $this->dispatchBrowserEvent('contentChanged');

        if ($this->productList->isEmpty()) {
            session()->flash('message', 'No products found for this category.');
            return;
        }
    }

    public function addWishlist($id_Wishlist)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('success', 'تم إضافة المنتج إلى قائمة الأمنيات.');
        }

        $this->product_id = $id_Wishlist;

        $this->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'المنتج موجود بالفعل في قائمة الأمنيات.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product_id,
        ]);

        // Emit an event to update the wishlist count in the header
        $this->emit('wishlistUpdated');
        
        // Refresh the product list
        $this->refreshProductList();

        // Optionally, you could flash a message indicating success
        session()->flash('success', 'تم إضافة المنتج إلى قائمة الأمنيات.');
    }
    public function refreshProductList()
    {
        if ($this->activeCategory) {
            $this->productList = Product::where('category_id', $this->activeCategory)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }

        $this->dispatchBrowserEvent('contentChanged');
    }

    public function addToCart($productId, $quantity)
    {
        $userId = Auth::id();

        // Validate the product and quantity
        if (!$userId || !$productId || !$quantity) {
            return redirect()->back()->with('error', 'Invalid product or quantity.');
        }

        // Check if an active order exists for the user
        $commande = Commande::where('users_id', $userId)->where('etat', 'en cours')->first();
    
        if ($commande) {
            $existe = false;

            // Check if the product already exists in the order
            foreach ($commande->lignecommande as $lignec) {
                if ($lignec->product_id == $productId) {
                    $existe = true;
                    $lignec->qte += $quantity;
                    $lignec->save(); // Save the updated quantity
                    break;
                }
            }

            // If the product doesn't exist in the order, create a new line item
            if (!$existe) {
                $Lc = new LigneCommande();
                $Lc->qte = $quantity;
                $Lc->product_id = $productId;
                $Lc->commande_id = $commande->id;
                $Lc->save();
            }

            // Redirect to the cart with a success message
            session()->flash('success', 'Product added to order successfully.');
        } else {
            // Create a new order if none exists
            $commande = new Commande();
            $commande->users_id = $userId;
            $commande->etat = 'en cours';

            if ($commande->save()) {
                // Add the product to the new order
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

        // Dispatch event to refresh the cart in the frontend, if necessary
        $this->emit('cartUpdated');
        // Refresh the product list
        $this->refreshProductList();
    }


    public function render()
    {
        return view('livewire.hot-deals-products', [
            'category' => $this->category,
            'productList' => $this->productList,
        ]);
    }
}




