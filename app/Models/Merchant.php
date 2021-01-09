<?php

namespace App\Models;

use App\Models\Pivot\MerchantProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /** Relationship */
    public function products()
    {
        return $this->belongsToMany(Product::class)
        ->with('categories')
        ->withPivot('price');
    }
}
