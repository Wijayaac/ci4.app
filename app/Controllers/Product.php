<?php

namespace App\Controllers;

use App\Models\ModelProduct;

class Product extends BaseController
{
    public function index()
    {
        $product = new ModelProduct;

        $data = [
            'showdata' => $product->findAll()
        ];
        return view('product/show', $data);
    }

    //--------------------------------------------------------------------

}
