<?php
function criarProduto() {
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once './db.php';
  include_once './model/produtos.php';

  $database = new Database();
  $db = $database->getConnection();
  $produto = new Produto($db);

  $data = json_decode(file_get_contents("php://input"));

  $produto->titulo = $data->titulo;

  if( $resposta = $produto->criarProduto() ) {
    http_response_code(201);
    echo json_encode(array("mensagem" => "Produto Criado",'id' => $resposta));
  } else {
    http_response_code(400);
    echo json_encode(array("mensagem" => "Produto Não Criado"));
  }
}