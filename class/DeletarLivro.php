<?php
require_once("Conexao.php");
class DeletarLivro extends Conexao{
    public function deletar(int $id){
        $id = addslashes($id);
        $pdo = parent::conexao();
         // APAGANDO O LIVRO E CAPA
         if (!empty($id)) {
            $sql = "SELECT url_pdf_livro, url_capa_livro FROM livros WHERE id_livro =  '$id' ";
            $res = $pdo->query($sql);
            $dados = $res->fetchObject();
            if ($res->rowCount() == 1) {
                $res = unlink("./arquivos/capas/{$dados->url_capa_livro}");
                $res = unlink("./arquivos/livros/{$dados->url_pdf_livro}");
            }
        } 
        $sql = "DELETE FROM livros WHERE id_livro = :id";
        $con = $pdo->prepare($sql);
        $con->bindParam(":id", $id);
        $con->execute();
        if($con->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }
}
