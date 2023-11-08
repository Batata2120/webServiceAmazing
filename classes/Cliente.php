<?php
require_once(__DIR__ . "/../config/Conexao.php");
require_once("Compra.php");

class Cliente
{
    public static function list()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM cliente");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function get($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM cliente WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function add($nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO cliente(nome, nome_usuario, estado, cidade, bairro, rua, nro_cartao, nro_seguranca, nome_cartao, data_validade_cartao) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function edit($id, $nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE cliente SET nome=?, nome_usuario=?, estado=?, cidade=?, bairro=?, rua=?, nro_cartao=?, nro_seguranca=?, nome_cartao=?, data_validade_cartao=? WHERE id=?");
            $stmt->execute([$nome, $nome_usuario, $estado, $cidade, $bairro, $rua, $nro_cartao, $nro_seguranca, $nome_cartao, $data_validade_cartao, $id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function exists($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT('*') FROM cliente WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function delete($id){
        try {
            $conexao = Conexao::getConexao();
            $listaCompras = Compra::listComprasCliente($id);
            foreach($listaCompras as $compra){
                Compra::delete($compra["id"]);
            }
            $stmt = $conexao->prepare("DELETE FROM cliente WHERE id=?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
}
}
?>
