<?php
include('route.php');

// Produtos
include('./controller/produtos/getTodos.php');
// Usuários
include('./controller/usuarios/criarUsuario.php');
include('./controller/usuarios/login.php');

// Home
Route::add('/',function(){ echo 'Olá :-)'; });

// Produtos
Route::add('/produtos',function(){ getTodos(); },'get');

// Usuários
Route::add('/usuarios/criar',function(){ criarUsuario(); },'post');
Route::add('/usuarios/login',function(){ login(); },'post');

Route::run('/');