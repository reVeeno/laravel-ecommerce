<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $table = 'goods';
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
