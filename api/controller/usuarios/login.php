<?php
function login() {
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once './db.php';
  include_once './model/usuarios.php';

  $database = new Database();
  $db = $database->getConnection();
  $usuario = new Usuario($db);

  $data = json_decode(file_get_contents("php://input"));

  $usuario->email = $data->email;
  $senha = $data->senha;

  $stmt = $usuario->login();
  $num = $stmt->rowCount();
  if( $num > 0 ) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (crypt($senha, $usuario['senha']) == $usuario['senha']) {
      $header = ['alg' => 'HS256', 'typ' => 'JWT'];
      $header = json_encode($header);
      $header = base64_encode($header);
      $payload = ['email' => $usuario['email']];
      $payload = json_encode($payload);
      $payload = base64_encode($payload);
      $signature = hash_hmac('sha256',"$header.$payload",'$ab45febebt#224R0',true);
      $signature = base64_encode($signature);
      $token = "$header.$payload.$signature";
      $usuario['senha'] = '';
      http_response_code(200);
      echo json_encode(array("usuario" => $usuario, "token" => $token));
    } else {
      http_response_code(401);
      echo json_encode(array("mensagem" => "Usuário e/ou senha incorretos"));
    }
  } else {
    http_response_code(401);
    echo json_encode(array("mensagem" => "Usuário e/ou senha incorretos"));
  }
}
