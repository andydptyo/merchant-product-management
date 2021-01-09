<?php

namespace App\Observers;

use App\Models\Merchant;
use Illuminate\Support\Str;

class MerchantObserver
{
    /**
     * Handle the Merchant "creating" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function creating(Merchant $merchant)
    {
        $merchant->slug = Str::slug($merchant->name);
    }

    /**
     * Handle the Merchant "created" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function created(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "updating" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function updating(Merchant $merchant)
    {
        $merchant->slug = Str::slug($merchant->name);
    }

    /**
     * Handle the Merchant "updated" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function updated(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "deleted" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function deleted(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "restored" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function restored(Merchant $merchant)
    {
        //
    }

    /**
     * Handle the Merchant "force deleted" event.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return void
     */
    public function forceDeleted(Merchant $merchant)
    {
        //
    }
}
