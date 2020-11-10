<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelProduct extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'idProduct';
    protected $allowedFields = ['nameProduct', 'sellerProduct'];
    protected $useTimestamps = true;
}
