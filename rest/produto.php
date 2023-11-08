<?php
require_once(__DIR__ . "/../config/utils.php");
require_once(__DIR__ . "/../config/verbs.php");
require_once(__DIR__ . "/../config/header.php");
require_once(__DIR__ . "/../classes/Produto.php");

// GET
if (isMetodo("GET")) {
    try{
    if(count($_GET) == 1){
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $lista = Produto::get($_GET["id"]);
        if(count($lista) == 0){
            throw new Exception("ID inválido", 400);
        }else{
            output(200, $lista);
        }
    }elseif(count($_GET) == 0){
        $lista = Produto::list();
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
        if (!parametrosValidos($_POST, ["nome", "qtdEstoque", "preco", "descricao"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $res = Produto::add($_POST["nome"], $_POST["qtdEstoque"], $_POST["preco"], $_POST["descricao"]);
        if (!$res) {
            throw new Exception("Erro ao realizar o cadastro", 500);
        }
        output(201, ["msg" => "Produto cadastrado com sucesso!"]);
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
        if (!parametrosValidos($_PUT, ["nome", "qtdEstoque", "preco", "descricao"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        if (!Produto::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Produto::edit($_GET["id"], $_PUT["nome"], $_PUT["qtdEstoque"], $_PUT["preco"], $_PUT["descricao"]);
        if (!$res) {
            throw new Exception("Erro ao editar o produto", 500);
        }
        output(200, ["msg" => "Produto editado com sucesso!"]);
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
        if (!Produto::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Produto::delete($_GET["id"]);
        if (!$res) {
            throw new Exception("Erro ao excluir o produto", 500);
        }
        output(200, ["msg" => "Produto excluído com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}