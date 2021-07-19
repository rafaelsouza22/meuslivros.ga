<?php

require_once("Conexao.php");
class BuscarLivro extends Conexao{

    public function buscar($texto){
        $textoLimpo = filter_var($texto , FILTER_SANITIZE_STRING);
        $busca = "%$textoLimpo%";
        $dados = array();
        $sql = "SELECT * FROM livros WHERE titulo_livro like :b ";
        $pdo = parent::connect();
        $con = $pdo->prepare($sql);
        $con->bindParam(":b", $busca);
        $con->execute();
       
        if($con->rowCount() > 0){
            $dados[] = $con->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }else {
            return $dados;
        }
    }

}
