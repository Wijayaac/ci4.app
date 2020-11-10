<?php

namespace App\Controllers;

use App\Models\ModelProduct;
use CodeIgniter\Model;

class Product extends BaseController
{
    public function index()
    {

        return view('product/showProduct');
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'showdata' => $this->product->findAll()
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



                $this->product->insert($saveData);

                $message = [
                    'success' => ' Yeay !, your product had been submited '
                ];
            }
            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }


    public function edit()
    {
        if ($this->request->isAJAX()) {
            $idProduct = $this->request->getVar('idProduct');


            $row = $this->product->find($idProduct);

            $data = [
                'idProduct' => $row['idProduct'],
                'nameProduct' => $row['nameProduct'],
                'sellerProduct' => $row['sellerProduct']
            ];

            $message = [
                'success' => view('product/editModal', $data)
            ];

            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $dataOld = $this->request->getVar('nameProductOld');
            $dataNew = $this->request->getVar('nameProduct');
            $idProduct = $this->request->getVar('idProduct');

            if ($dataOld !== $dataNew) {
                $rules = [
                    'rules' => 'required|is_unique[product.nameProduct]',
                    'errors' => [
                        'required' => 'name must inserted',
                        'is_unique' => 'name already available on store'
                    ]

                ];
            } else {
                $rules = [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'name must inserted'
                    ]

                ];
            }

            $valid = $this->validate([
                'nameProduct' => $rules
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


                $this->product->update($idProduct, $saveData);

                $message = [
                    'success' => ' Yeay !, your product had been updated '
                ];
            }
            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    public function remove()
    {
        if ($this->request->isAJAX()) {
            $idProduct = $this->request->getVar('idProduct');


            $this->product->delete($idProduct);

            $message = [
                'success' => ' Your product had been deleted '
            ];
            echo json_encode($message);
        } else {
            exit('Bip bop bip bip bop ?');
        }
    }

    //--------------------------------------------------------------------

}
