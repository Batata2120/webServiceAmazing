<?php
require_once(__DIR__ . "/../config/Conexao.php");

class Produto
{
    public static function list()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produto");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function get($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM produto WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function add($nome, $qtdEstoque, $preco, $descricao)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES (?,?,?,?)");
            $stmt->execute([$nome, $qtdEstoque, $preco, $descricao]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function edit($id, $nome, $qtdEstoque, $preco, $descricao)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE produto SET nome=?, qtdEstoque=?, preco=?, descricao=? WHERE id=?");
            $stmt->execute([$nome, $qtdEstoque, $preco, $descricao, $id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function exists($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT('*') FROM produto WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function delete($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM produtos_compra WHERE idProduto=?");
            $stmt->execute([$id]);
            $stmt = $conexao->prepare("DELETE FROM produto WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            return null;
        }
    }
}
?>