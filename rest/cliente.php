<?php
require_once(__DIR__ . "/../config/utils.php");
require_once(__DIR__ . "/../config/verbs.php");
require_once(__DIR__ . "/../config/header.php");
require_once(__DIR__ . "/../classes/Cliente.php");

// GET
if (isMetodo("GET")) {
    try{
    if(count($_GET) == 1){
        if (!parametrosValidos($_GET, ["id"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $lista = Cliente::get($_GET["id"]);
        if(count($lista) == 0){
            throw new Exception("ID inválido", 400);
        }else{
            output(200, $lista);
        }
    }elseif(count($_GET) == 0){
        $lista = Cliente::list();
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
        if (!parametrosValidos($_POST, ["nome", "nome_usuario", "estado", "cidade", "bairro", "rua", "nro_cartao", "nro_seguranca", "nome_cartao", "data_validade_cartao"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        $res = Cliente::add($_POST["nome"], $_POST["nome_usuario"], $_POST["estado"], $_POST["cidade"], $_POST["bairro"], $_POST["rua"], $_POST["nro_cartao"], $_POST["nro_seguranca"], $_POST["nome_cartao"], $_POST["data_validade_cartao"]);
        if (!$res) {
            throw new Exception("Erro ao realizar o cadastro", 500);
        }
        output(201, ["msg" => "Cliente cadastrado com sucesso!"]);
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
        if (!parametrosValidos($_PUT, ["nome", "nome_usuario", "estado", "cidade", "bairro", "rua", "nro_cartao", "nro_seguranca", "nome_cartao", "data_validade_cartao"])) {
            throw new Exception("Parâmetros incorretos", 400);
        }
        if (!Cliente::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Cliente::edit($_GET["id"], $_PUT["nome"], $_PUT["nome_usuario"], $_PUT["estado"], $_PUT["cidade"], $_PUT["bairro"], $_PUT["rua"], $_PUT["nro_cartao"], $_PUT["nro_seguranca"], $_PUT["nome_cartao"], $_PUT["data_validade_cartao"]);
        if (!$res) {
            throw new Exception("Erro ao editar o cliente", 500);
        }
        output(200, ["msg" => "Cliente editado com sucesso!"]);
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
        if (!Cliente::exists($_GET["id"])) {
            throw new Exception("ID inválido", 400);
        }
        $res = Cliente::delete($_GET["id"]);
        if (!$res) {
            throw new Exception("Erro ao excluir o cliente", 500);
        }
        output(200, ["msg" => "Cliente excluído com sucesso!"]);
    } catch (Exception $e) {
        output($e->getCode(), ["msg" => $e->getMessage()]);
    }
}