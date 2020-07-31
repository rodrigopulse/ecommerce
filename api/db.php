<?php
class Database{
  private $db_name = "ecommerce";
  private $username = "root";
  private $password = "root";
  public $conn;
  public function getConnection(){
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $GLOBALS['DB_HOST'] . ";dbname=" . $GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASS']);
      $this->conn->exec("set names utf8");
    } catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
?>