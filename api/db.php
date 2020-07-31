<?php
class Database{
  private $host = "db";
  private $db_name = "ecommerce";
  private $username = "root";
  private $password = "root";
  public $conn;
  public function getConnection(){
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    } catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
?>