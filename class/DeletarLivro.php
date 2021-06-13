<?php
require_once("Conexao.php");
class DeletarLivro extends Conexao{
    public function deletar(int $id){
        $id = addslashes($id);
        $pdo = parent::conexao();
        $sql = "DELETE FROM livros WHERE id_livro = :id";
        $con = $pdo->prepare($sql);
        $con->bindParam(":id", $id);
        $con->execute();
        if($con->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}

// $deletar = new DeletarLivro();
// $res = $deletar->deletar('4');
// var_dump($res);