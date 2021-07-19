<?php
require_once("Conexao.php");
class SelecionarLivroPorId extends Conexao{
    public function selecionarLivro($id)
    {   
        $pdo = parent::connect();
        $idLivro = addslashes($id);
        $sql = "SELECT * FROM livros WHERE id_livro = :id";
        $res = $pdo->prepare($sql);
        $res->bindValue(':id',$idLivro);
        $res->execute();
        if($res->rowCount() == 1){
            $dados = $res->fetch(PDO::FETCH_ASSOC);
        }else{
            $dados = array();
        }
        return $dados;  
    }
}