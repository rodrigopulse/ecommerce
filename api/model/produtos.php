<?php
class Produto{
  private $conn;
  private $tabela = "produtos";

  public function __construct($db){
    $this->conn = $db;
  }
  function getTodos() {
    $query = "SELECT * from $this->tabela";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
  function criarProduto() {

    $query = "INSERT INTO $this->tabela SET titulo=:titulo";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":titulo", $this->titulo);

    if($stmt->execute()){
      return $this->conn->lastInsertId();
    }

    return false;
  }
  function imagemProduto() {

    $query = "UPDATE $this->tabela SET
    imagem1=:imagem1,
    imagem2=:imagem2,
    imagem3=:imagem3,
    imagem4=:imagem4
    WHERE id=:id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", intval($this->id));
    $stmt->bindParam(":imagem1", $this->imagem1);
    $stmt->bindParam(":imagem2", $this->imagem2);
    $stmt->bindParam(":imagem3", $this->imagem3);
    $stmt->bindParam(":imagem4", $this->imagem4);

    if($stmt->execute()){
      return true;
    }

    return false;
  }
}
?>