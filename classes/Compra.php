<?php
require_once(__DIR__ . "/../config/Conexao.php");

class Compra
{
    public static function list()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM compra");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function get($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM compra WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function listComprasCliente($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM compra WHERE idCliente=?");
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function add($idCliente, $dataCompra)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO compra(idCliente, dataCompra) VALUES (?,?)");
            $stmt->execute([$idCliente, $dataCompra]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function edit($id, $idCliente, $dataCompra)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE compra SET idCliente=?, dataCompra=? WHERE id=?");
            $stmt->execute([$idCliente, $dataCompra, $id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function exists($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT('*') FROM compra WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function delete($id){
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE FROM produtos_compra WHERE idCompra=?");
                $stmt->execute([$id]);
                $stmt = $conexao->prepare("DELETE FROM compra WHERE id=?");
                $stmt->execute([$id]);
    
                return $stmt->rowCount();
            } catch (Exception $e) {
                return null;
            }
    }
}
?>