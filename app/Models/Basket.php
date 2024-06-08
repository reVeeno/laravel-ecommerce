<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Goods;

class Basket extends Model
{
    use HasFactory;

    protected $table = 'basket';
    protected $guarded = [];

    public function goods()
    {
        return $this->belongsTo(Goods::class, 'id_goods');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
