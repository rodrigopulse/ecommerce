<?php
function uploadImagem() {
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

  $id = $_GET['id'];

  $imagem1 = $_FILES['imagem1'];
  $imagem2 = $_FILES['imagem2'];
  $imagem3 = $_FILES['imagem3'];
  $imagem4 = $_FILES['imagem4'];

  $uploaddir = './uploads/produtos/';

  $uploadfile1 = $uploaddir . basename($id . '-imagem1.jpg');
  $uploadfile2 = $uploaddir . basename($id . '-imagem2.jpg');
  $uploadfile3 = $uploaddir . basename($id . '-imagem3.jpg');
  $uploadfile4 = $uploaddir . basename($id . '-imagem4.jpg');

  move_uploaded_file($_FILES['imagem1']['tmp_name'], $uploadfile1);
  move_uploaded_file($_FILES['imagem2']['tmp_name'], $uploadfile2);
  move_uploaded_file($_FILES['imagem3']['tmp_name'], $uploadfile3);
  move_uploaded_file($_FILES['imagem4']['tmp_name'], $uploadfile4);

  $produto->id = $id;

  $imagem1 != NULL ? $produto->imagem1 = $id . '-imagem1.jpg' : $produto->imagem1 = NULL;
  $imagem2 != NULL ? $produto->imagem2 = $id . '-imagem2.jpg' : $produto->imagem2 = NULL;
  $imagem3 != NULL ? $produto->imagem3 = $id . '-imagem3.jpg' : $produto->imagem3 = NULL;
  $imagem4 != NULL ? $produto->imagem4 = $id . '-imagem4.jpg' : $produto->imagem4 = NULL;

  if( $resposta = $produto->imagemProduto() ) {
    http_response_code(201);
    echo json_encode(array("mensagem" => "Upload da imagem feito com sucesso"));
  } else {
    http_response_code(201);
    echo json_encode(array("mensagem" => "Ocorreu um erro"));
  }

}