<?php

namespace App\Observers;

use App\Models\Products;
use App\Models\log;

class ProductsObserver
{
    /**
     * Handle the Products "created" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function created(Products $products)
    {
        Log::create([
            'module' => 'tambah products',
            'action' => 'tambah products '.$products->judul.' dengan id '. $products->id,
            'useraccess' => $products->user_email
        ]);
    }

    /**
     * Handle the Products "updated" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function updated(Products $products)
    {
        Log::create([
            'module' => 'update products',
            'action' => 'update products '.$products->judul.' dengan id '. $products->id,
            'useraccess' => $products->user_email
        ]);
    }

    /**
     * Handle the Products "deleted" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function deleted(Products $products)
    {
        Log::create([
            'module' => 'hapus products',
            'action' => 'hapus products '.$products->judul.' dengan id '. $products->id,
            'useraccess' => $products->user_email
        ]);
    }

    /**
     * Handle the Products "restored" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function restored(Products $products)
    {
        //
    }

    /**
     * Handle the Products "force deleted" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function forceDeleted(Products $products)
    {
        //
    }
}
