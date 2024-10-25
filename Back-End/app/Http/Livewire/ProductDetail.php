<?php

namespace App\Http\Livewire;

use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $productId; // Renamed from $id to $productId
    public $product_id; 
    public $productSubcategory;
    public $category;
    public $color;
    public $productdetail;
    public $CompanyInfo;
    public $productList;
    public $avgRating;
    public $quantity = 1; // Add a public property for quantity
    public $activeCategory = null; // Active category, default to null

    // The mount method is called when the component is initialized
    public function mount($productId)
    {
        $this->productId = $productId;

        // Fetch all the necessary data
        $this->color = ProductColor::get();
        $this->productdetail = Product::find($productId);
        $this->CompanyInfo = CompanyInfo::get();

        // Initialize product list and ratings
        $this->refreshProductList();
        $this->calculateProductRating();
    }

    // Function to refresh the product list based on categories
    public function refreshProductList()
    {
        // Load products and set active category if needed
        if ($this->activeCategory) {
            $this->productList = Product::where('category_id', $this->activeCategory)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }

        // Dispatch an event to update frontend content
        $this->dispatchBrowserEvent('contentChanged');
    }

    // Function to calculate product ratings
    public function calculateProductRating()
    {
        $this->avgRating = 0;

        if ($this->productdetail && $this->productdetail->reviews->isNotEmpty()) {
            $totalRating = 0;
            foreach ($this->productdetail->reviews as $review) {
                $totalRating += $review->rate;
            }
            $this->avgRating = $totalRating / $this->productdetail->reviews->count();
        }
    }

    // Add product to wishlist
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

        // Emit event to update wishlist count
        $this->emit('wishlistUpdated');
        $this->dispatchBrowserEvent('contentUpdated');

        // Refresh the product list
        $this->refreshProductList();

        return redirect()->back()->with('success', 'تم إضافة المنتج إلى قائمة الأمنيات.');
    }

    // Add product to cart
    public function addToCart($productId, $quantity)
    {
        $userId = Auth::id();

        // Validate the product and quantity
        if (!$userId || !$productId || !$quantity) {
            session()->flash('error', 'Invalid product or quantity.');
            return;
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

        // Emit event to refresh cart in frontend
        $this->emit('cartUpdated');
        $this->dispatchBrowserEvent('contentUpdated');

        // Refresh the product list
        $this->refreshProductList();
    }

    // The render method returns the view with the data
    public function render()
    {
        return view('livewire.product-detail', [
            'productId' => $this->productId,
            'color' => $this->color,
            'productdetail' => $this->productdetail,
            'productList' => $this->productList,
            'avgRating' => $this->avgRating
        ]);
    }
}

