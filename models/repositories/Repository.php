<?php
namespace app\models\repositories;

use app\models\DataEntity;
use app\services\Db;

abstract class Repository implements IRepository{
  private $db;

  public function __construct(){
      $this->db = static::getDb();
  }

  public function getOne($id){
      $table = $this->getTableName();
      $sql = "SELECT * FROM {$table} WHERE id = :id";
      return static::getDb()->queryObject($sql, [':id' => $id], $this->getEntityClass());
  }

  public function getAll(){
      $table = $this->getTableName();
      $sql = "SELECT * FROM {$table}";
      return static::getDb()->queryAll($sql);
  }

  public function delete(DataEntity $entity){
      $table = $this->getTableName();
      $sql = "DELETE FROM {$table} WHERE id = :id";
      return static::getDb()->execute($sql, [':id' => $entity->id]);
  }

  public function save(DataEntity $entity){
      if (is_null($entity->id)) {
          $this->insert($entity);
      } else {
          $this->update($entity);
      }
  }

  public function insert(DataEntity $entity){
      $columns = [];
      $params = [];
      $table = $this->getTableName();
      foreach($entity as $key => $value){
          if($key == 'db'){
              continue;
          }
          $params[":{$key}"] = $value;
          $columns[] = "`{$key}`";
      }
      $columns = implode(", ", $columns);
      $placeholders = implode(", ", array_keys($params));
      $sql = "INSERT INTO  `{$table}` ({$columns}) VALUES ({$placeholders})";
      $this->db->execute($sql,$params);
      $entity->id = static::getDb()->lastInsertId();
  }

  public function update(DataEntity $entity){
      $columns = [];
      $params = [];
      $table = $this->getTableName();
      foreach($entity as $key => $value){
          if($key == 'db'){
              continue;
          }
          $params["{$key} = :{$key}"] = $value;
          $columns[":{$key}"] = $value;
      }
      $placeholders = implode(", ", array_keys($params));
      $sql = "UPDATE {$table} SET {$placeholders} WHERE (id = {$entity->id});";
      $this->db->execute($sql, $columns);

  }

  static function GetDb(){
    return Db::getInstance();
}

}
