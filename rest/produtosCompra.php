<?php
require_once(__DIR__ . "/../config/utils.php");
require_once(__DIR__ . "/../config/verbs.php");
require_once(__DIR__ . "/../config/header.php");
require_once(__DIR__ . "/../classes/ProdutosCompra.php");

// GET
if (isMetodo("GET")) {
    try{
    if(count($_GET) == 1){
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $lista = ProdutosCompra::get($_GET["id"]);
        if(count($lista) == 0){
            throw new Exception("ID inválido", 400);
        }else{
            output(200, $lista);
        }
    }elseif(count($_GET) == 0){
        $lista = ProdutosCompra::list();
        output(200, $lista);
    }elseif(count($_GET) > 1){
        throw new Exception("Excesso de parâmetros", 400);
    }
    }catch(Exception $e){
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}

// POST
if (isMetodo("POST")) {
    try {
        if (!parametrosValidos($_POST, ["idCompra", "idProduto", "qtdProduto"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $res = ProdutosCompra::add($_POST["idCompra"], $_POST["idProduto"], $_POST["qtdProduto"]);
        if (!$res) {
            throw new Exception("Erro ao realizar o cadastro", 500);
        }
        output(201, ["msg" => "Produto de compra cadastrado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}

// PUT
if (isMetodo("PUT")) {
    try {
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("ID não foi enviado", 400);
        }
        if (!parametrosValidos($_PUT, ["idCompra", "idProduto", "qtdProduto"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        if (!ProdutosCompra::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = ProdutosCompra::edit($_GET["id"], $_PUT["idCompra"], $_PUT["idProduto"], $_PUT["qtdProduto"]);
        if (!$res) {
            throw new Exception("Erro ao editar o produto de compra", 500);
        }
        output(200, ["msg" => "Produto de compra editado com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}

// DELETE
if (isMetodo("DELETE")) {
    try {
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("ID não foi enviado", 400);
        }
        if (!ProdutosCompra::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = ProdutosCompra::delete($_GET["id"]);
        if (!$res) {
            throw new Exception("Erro ao excluir o produto de compra", 500);
        }
        output(200, ["msg" => "Produto de compra excluído com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}