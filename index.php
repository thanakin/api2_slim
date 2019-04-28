<?php

//require '../Slim/Slim/Slim.php';
require 'vendor/autoload.php';
//$request = \Slim\Slim::registerAutoloader();
//$app = new \Slim\Slim();
$app = new \Slim\App();
//$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/', function () {
    echo "SlimProdutos ";
    });

$app->get('/categorias','getCategorias');
//$app->post('/produto','addProduto');
//$app->get('/produto/:id','getProduto');
//$app->get('/produtos/:id/','getProduto');
$app->get('/produtos/','getProdutos');
$app->run();

function getConn() {
    return new PDO('mysql:host=localhost;dbname=api;port=3306','root','',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    }


function getCategorias() {
    $stmt = getConn()->query("SELECT * FROM Categorias");
    $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "{categorias:".json_encode($categorias)."}";
    }


function addProduto(){
    $request = \Slim\Slim::getInstance()->request();
    $produto = json_decode($request->getBody());
    $sql = "INSERT INTO produtos (nome,preco,dataInclusao,idCategoria) values (:nome,:preco,:dataInclusao,:idCategoria) ";
    $conn = getConn();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("nome",$produto->nome);
    $stmt->bindParam("preco",$produto->preco);
    $stmt->bindParam("dataInclusao",$produto->dataInclusao);
    $stmt->bindParam("idCategoria",$produto->idCategoria);
    $stmt->execute();
    $produto->id = $conn->lastInsertId();
    echo json_encode($produto);
    }

function getProduto($id){
    $conn = getConn();
    $sql = "SELECT * FROM produtos WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("id",$id);
    $stmt->execute();
    $produto = $stmt->fetchObject();
/*
    //categoria
    $sql = "SELECT * FROM categorias WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("id",$produto->idCategoria);
    $stmt->execute();
    $produto->categoria = $stmt->fetchObject();
    */
    echo json_encode($produto);
    }

function saveProduto($id){
    $request = \Slim\Slim::getInstance()->request();
    $produto = json_decode($request->getBody());
    $sql = "UPDATE produtos SET nome=:nome,preco=:preco,dataInclusao=:dataInclusao,idCategoria=:idCategoria WHERE   id=:id";
    $conn = getConn();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("nome",$produto->nome);
    $stmt->bindParam("preco",$produto->preco);
    $stmt->bindParam("dataInclusao",$produto->dataInclusao);
    $stmt->bindParam("idCategoria",$produto->idCategoria);
    $stmt->bindParam("id",$id);
    $stmt->execute();
    
    echo json_encode($produto);
    }

function deleteProduto($id){
    $sql = "DELETE FROM produtos WHERE id=:id";
    $conn = getConn();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("id",$id);
    $stmt->execute();
    echo "{'message':'Produto apagado'}";
    }

function getProdutos(){
    $sql = "SELECT *,Categorias.nome as nomeCategoria FROM Produtos,Categorias WHERE Categorias.id=Produtos.idCategoria";
    $stmt = getConn()->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "{\"produtos\":".json_encode($produtos)."}";
    }