<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantModel extends Model
{
  protected $table      = 'variants';
  protected $primaryKey = 'variant_id';

  protected $returnType     = '\App\Entities\Variant';

  protected $allowedFields = ['name', 'description', 'product_id'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}
