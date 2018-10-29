<?php
namespace app\models\repositories;

use app\models\Product;

class ProductRepository extends Repository{

  public function getTableName(){
    return 'catalog';
  }

  public function getEntityClass(){
    return Product::class;
  }

}
