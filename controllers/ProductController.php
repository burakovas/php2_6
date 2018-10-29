<?php
namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){
    $model = (new ProductRepository())->GetAll();
    echo $this->render("catalog", ['model' => $model]);
  }

  public function actionCard(){
    $id = (new Request())->get('id');
    $model = (new ProductRepository())->GetOne($id);
    echo $this->render("card", ['model' => $model]);
  }

}
