<?php
namespace app\controllers;

use app\models\repositories\CartRepository;
use app\services\Request;

class CartController extends Controller{

  protected $action;
  protected $defaultAction = "index";
  protected $layout = "main";
  protected $useLayout = true;

  public function actionIndex(){
    $data = (new CartRepository())->GetAll();
    echo $this->render("cart", ['data' => $data]);
  }

  public function actionAdd(){
    $id = (new Request())->get('id');
    $model = new \app\models\Cart();
    $model->tovid = $id;
    $model->tovkol = 1;
    (new CartRepository())->save($model);
    $this->actionIndex();
  }

  public function actionDel(){
    $model = new \app\models\Cart();
    $model->id =  (new Request())->get('id');
    (new CartRepository())->delete($model);
    $this->actionIndex();
  }
}
