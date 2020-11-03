<?php

namespace App\Controllers;

use App\Entities\Question;
use App\Models\QuestionModel;
use App\Models\VariantModel;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class ProductController extends ResourceController
{
  protected $modelName = 'App\Models\ProductModel';
  protected $format    = 'json';

  public function index()
  {
    $page = 1;
    $pageSize = 5;

    if ($this->validate('validatePaginate')) {
      $page = (int) $this->request->getGet('page');
      $pageSize = (int) $this->request->getGet('pageSize');
    }

    $offset = ($page * $pageSize) - $pageSize;
    $limit = $pageSize;

    return $this->respond($this->model->findAll($limit, $offset));
  }

  public function show($id = null)
  {
    $product = $this->model->find($id);

    if (empty($product)) {
      return $this->respond(null, 404, lang('Product.notFound'));
    }

    return $this->respond($product);
  }

  /**
   * El string del slug tiene que ser de formato:
   * {id}-NOMBRE-DEL-PRODCUTO
   */
  public function showWithSlug($slug = null)
  {
    $this->validator = Services::validation();
    if (!$this->validator->run(['slug' => $slug], 'showSlug')) {
      return $this->respond($this->validator->getErrors(), 400, lang('Product.errorSearch'));
    }

    $array = explode('-', $slug);
    if (count($array) < 2) {
      return $this->respond($this->validator->getErrors(), 400, lang('Product.errorSearch'));
    }

    $idProduct = $array[0];
    array_shift($array);
    $name = implode(' ', $array);

    $product = $this->model->where(['product_id' => $idProduct])->where(['name' => $name])->first();

    return $this->respond($product);;
  }

  public function showWithVariant($id = null)
  {
    $product = $this->model->find($id);

    if (empty($product)) {
      return $this->respond(null, 404, lang('Product.notFound'));
    }

    $variantsModel = model(VariantModel::class);
    $variants = $variantsModel->where(['product_id' => $id])->findAll();

    $product->variants = $variants;

    return $this->respond($product);
  }

  public function search()
  {
    if (!$this->validate('searchProduct')) {
      return $this->respond($this->validator->getErrors(), 400, lang('Product.errorSearch'));
    }

    $query = $this->request->getGet('query');


    return $this->respond(
      $this->model->like('name', $query, 'both')->orLike('description', $query, 'both')->findAll()
    );
  }

  public function create()
  {

    if (!$this->validate('createProduct')) {
      return $this->respond($this->validator->getErrors(), 400, lang('Product.errorCreate'));
    }

    $idProduct = $this->model->insert($this->request->getPost());

    if (empty($idProduct)) {
      return $this->respond(null, 400, lang('Product.errorCreate'));
    }

    return $this->respond($this->model->find($idProduct));
  }

  public function createQuestion($id = null)
  {
    if (!$this->validate('createQuestion')) {
      return $this->respond($this->validator->getErrors(), 400, lang('Product.errorCreate'));
    }

    $product = $this->model->find($id);

    if (empty($product)) {
      return $this->respond(null, 404, lang('Product.notFound'));
    }

    $questionModel = model(QuestionModel::class);
    $question = new Question($this->request->getPost());
    $question->product_id = $id;
    if (empty($questionModel->insert($question))) {
      return $this->respond(null, 400, lang('Product.errorCreateQuestion'));
    }

    return $this->respond(null, 200, lang('Product.questionCreated'));
  }
}
