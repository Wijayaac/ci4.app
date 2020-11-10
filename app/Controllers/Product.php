<?php

namespace App\Controllers;

use App\Models\ModelProduct;

class Product extends BaseController
{
    public function index()
    {

        return view('product/showProduct');
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $product = new ModelProduct;

            $data = [
                'showdata' => $product->findAll()
            ];

            $message = [
                'data' => view('product/dataProduct', $data)
            ];

            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    public function add()
    {
        if ($this->request->isAJAX()) {
            $message = [
                'data' => view('product/addModal')
            ];

            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nameProduct' => [
                    'rules' => 'required|is_unique[product.nameProduct]',
                    'errors' => [
                        'required' => 'name must inserted',
                        'is_unique' => 'name already available on store'
                    ]
                ]
            ]);

            if (!$valid) {
                $message = [
                    'error' => [
                        'nameProduct' => $validation->getError('nameProduct')
                    ]
                ];
            } else {
                $saveData = [
                    'nameProduct' => $this->request->getVar('nameProduct'),
                    'sellerProduct' => $this->request->getVar('sellerProduct')
                ];

                $product = new ModelProduct;

                $product->insert($saveData);

                $message = [
                    'success' => ' Yeay !, your product had been submited '
                ];
            }
            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    //--------------------------------------------------------------------

}
