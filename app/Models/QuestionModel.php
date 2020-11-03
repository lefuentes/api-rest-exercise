<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
  protected $table      = 'questions';
  protected $primaryKey = 'question_id';

  protected $returnType     = '\App\Entities\Question';

  protected $allowedFields = ['product_id', 'question', 'response'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}
