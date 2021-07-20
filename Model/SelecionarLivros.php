<?php
require_once("Conexao.php");

class SelecionarLivros extends Conexao{

    public function listarLivros()
    {   
        $pdo = parent::connect();
        $sql = "SELECT * FROM livros";
        $res = $pdo->prepare($sql);
        $total = $res->rowCount();
        $res->execute();
        if($res->rowCount() > 0){
            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados = array();
        }
        return $dados;
    }
}
