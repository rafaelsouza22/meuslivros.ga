<?php
require_once("Conexao.php");

class SelecionarLivros extends Conexao{

    public function selecionarLivros()
    {   
        $pdo = parent::conexao();
        $sql = "SELECT * FROM livros limit 12";
        $res = $pdo->prepare($sql);
        $res->execute();
        if($res->rowCount() > 0){
            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados = array();
        }
        return $dados;
    }
}
