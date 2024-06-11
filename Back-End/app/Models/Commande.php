<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'etat', 'users_id', 'first_name', 'last_name', 'country', 'street_address', 'town_city', 'state_county', 'postcode', 'phone', 'email', 'company_name'
    ];


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
