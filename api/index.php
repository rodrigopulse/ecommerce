<?php
include 'route.php';
include 'config.php';

// Produtos
include './controller/produtos/getTodos.php';
include './controller/produtos/criarProduto.php';
include './controller/produtos/uploadImagem.php';
// Usuários
include './controller/usuarios/criarUsuario.php';
include './controller/usuarios/login.php';

// Home
Route::add('/',function(){ echo 'Olá :-)'; });

// Produtos
Route::add('/produtos',function(){ getTodos(); },'get');
Route::add('/produtos/criar',function(){ criarProduto(); },'post');
Route::add('/produtos/upload-imagem',function(){ uploadImagem(); },'post');

// Usuários
Route::add('/usuarios/criar',function(){ criarUsuario(); },'post');
Route::add('/usuarios/login',function(){ login(); },'post');

Route::run('/');