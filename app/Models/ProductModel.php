<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
  protected $table      = 'products';
  protected $primaryKey = 'product_id';

  protected $returnType     = '\App\Entities\Product';

  protected $allowedFields = ['name', 'question', 'response'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}
