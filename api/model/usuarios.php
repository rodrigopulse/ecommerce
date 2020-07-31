<?php
class Usuario{
  private $conn;
  private $tabela = "usuarios";

  public function __construct($db){
    $this->conn = $db;
  }
  function criarUsuario() {
    $query = "INSERT INTO $this->tabela SET
      nome=:nome,
      email=:email,
      permissao=:permissao,
      senha=:senha";

    $stmt = $this->conn->prepare($query);

    $this->senha=crypt($this->senha);

    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":senha", $this->senha);
    $stmt->bindParam(":permissao", $this->permissao);

    if($stmt->execute()){
      return true;
    }

    return false;
  }
  function login(){
    $query = "SELECT * from $this->tabela WHERE email='$this->email'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
?>