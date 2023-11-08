<?php
require_once(__DIR__ . "/../config/Conexao.php");

class ProdutosCompra
{
    public static function list()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produtos_compra");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function get($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produtos_compra WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function add($idCompra, $idProduto, $qtdProduto)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO produtos_compra(idCompra, idProduto, qtdProduto) VALUES (?,?,?)");
            $stmt->execute([$idCompra, $idProduto, $qtdProduto]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function edit($id, $idCompra, $idProduto, $qtdProduto)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE produtos_compra SET idCompra=?, idProduto=?, qtdProduto=? WHERE id=?");
            $stmt->execute([$idCompra, $idProduto, $qtdProduto, $id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function exists($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT('*') FROM produtos_compra WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function delete($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM produtos_compra WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }
}
?>