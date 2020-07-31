<?php
function getTodos() {
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once './db.php';
  include_once './model/produtos.php';

  $database = new Database();
  $db = $database->getConnection();
  $produto = new Produto($db);

  $stmt = $produto->getTodos();
  $num = $stmt->rowCount();

  if( $num > 0 ) {
    $produtos_arr=array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $produto_item = array(
          "id" => $id,
          "titulo" => $titulo,
        );
        array_push($produtos_arr, $produto_item);
      }
      http_response_code(200);
      echo json_encode($produtos_arr);
  } else {
    echo json_encode([]);
  }
}