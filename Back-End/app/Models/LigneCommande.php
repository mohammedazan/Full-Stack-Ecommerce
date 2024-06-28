<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }

      // Define the relationship to the Product model
      public function product()
      {
          return $this->belongsTo(Product::class, 'product_id', 'id');
      }
    
      
}
