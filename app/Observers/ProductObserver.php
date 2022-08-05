<?php

namespace App\Observers;

use App\Mail\ProductCreated;
use App\Mail\ProductUpdated;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        Mail::to(env('MAIL_TO'))
            ->send(new ProductCreated($product));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        Mail::to(env('MAIL_TO'))
            ->send(new ProductUpdated($product));
    }
}
