<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    

    function product()
    {
        return $this->belongsTo(product::class);
    }

}

