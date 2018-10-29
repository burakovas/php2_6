<?php
namespace app\models;

class Product extends DataEntity
{
    public $id;
    public $name;
    public $imageName;
    public $description;
    public $price;
    public $brandId;
}
