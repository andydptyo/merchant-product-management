<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MerchantProduct extends Pivot
{
    public $incrementing = true;

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
