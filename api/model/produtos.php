<?php
class Produto{
  private $conn;
  private $tabela = "produtos";

  public function __construct($db){
    $this->conn = $db;
  }
  function getTodos(){
    $query = "SELECT * from $this->tabela";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
?>