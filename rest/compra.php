<?php
require_once(__DIR__ . "/../config/utils.php");
require_once(__DIR__ . "/../config/verbs.php");
require_once(__DIR__ . "/../config/header.php");
require_once(__DIR__ . "/../classes/Compra.php");

// GET
if (isMetodo("GET")) {
    try{
    if(count($_GET) == 1){
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $lista = Compra::get($_GET["id"]);
        if(count($lista) == 0){
            throw new Exception("ID inválido", 400);
        }else{
            output(200, $lista);
        }
    }elseif(count($_GET) == 0){
        $lista = Compra::list();
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
        if (!parametrosValidos($_POST, ["idCliente", "dataCompra"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $res = Compra::add($_POST["idCliente"], $_POST["dataCompra"]);
        if (!$res) {
            throw new Exception("Erro ao realizar o cadastro", 500);
        }
        output(201, ["msg" => "Compra cadastrada com sucesso!"]);
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
        if (!parametrosValidos($_PUT, ["idCliente", "dataCompra"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        if (!Compra::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Compra::edit($_GET["id"], $_PUT["idCliente"], $_PUT["dataCompra"]);
        if (!$res) {
            throw new Exception("Erro ao editar a compra", 500);
        }
        output(200, ["msg" => "Compra editada com sucesso!"]);
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
        if (!Compra::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Compra::delete($_GET["id"]);
        if (!$res) {
            throw new Exception("Erro ao excluir a compra", 500);
        }
        output(200, ["msg" => "Compra excluída com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}