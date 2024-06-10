<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;


    
 

    public function lignecommande()
    {
        return $this->hasMany(LigneCommande::class, 'commande_id', 'id');
    }


    public function users()
    {
        if (!empty($this->users_id)) {
            return $this->belongsTo(User::class);
        }
        return null;
    }

    public function getTotal(){
        $total=0;
        //list de lifne de dcommande
        foreach($this->lignecommande as $lc){
          $total+= $lc->product->current_sale_price * $lc->qte;
        }
        return $total;
    }
}
