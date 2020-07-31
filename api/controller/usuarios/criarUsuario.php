<?php
function criarUsuario() {
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once './db.php';
  include_once './model/usuarios.php';

  $database = new Database();
  $db = $database->getConnection();
  $usuario = new Usuario($db);

  $data = json_decode(file_get_contents("php://input"));

  $usuario->nome = $data->nome;
  $usuario->email = $data->email;
  $usuario->senha = $data->senha;
  $usuario->permissao = $data->permissao;

  if($usuario->criarUsuario()){
    http_response_code(201);
    echo json_encode(array("mensagem" => "Usuário Criado"));
  } else {
    http_response_code(400);
    echo json_encode(array("mensagem" => "Usuário Não Criado"));
  }
}