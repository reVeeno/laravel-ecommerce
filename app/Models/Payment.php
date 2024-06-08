<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Basket;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $guarded = [];

    public function basket()
    {
        return $this->belongsTo(Basket::class, 'id_basket');
    }
}
