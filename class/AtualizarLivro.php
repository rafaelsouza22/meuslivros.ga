<?php
require_once("Conexao.php");

class AtualizarLivro extends Conexao
{
    public function atualizarLivro($livro)
    {
        $id = addslashes($livro['id_livro']);
        $titulo = addslashes($livro['titulo']);
        $descricao = addslashes($livro['descricao']);
        $categoria = addslashes($livro['categoria']);
        $autor = addslashes($livro['autor']);
        $livroPdf = addslashes($livro['livroPdf']);
        $livroCapa = addslashes($livro['livroCapa']);
        try {
            $erros = array();
            //$urlPdf = $urlCapa = '';
            if (!empty($livro['livroPdf']['name']) && !empty($livro['livroCapa']['name'])) {
                $nomeLivro = explode('.', $livro['livroPdf']['name']);
                $nomeCapa = explode('.', $livro['livroCapa']['name']);
                if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf') && ($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                    $urlPdf = sha1($nomeLivro[0]) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                    move_uploaded_file($livro['livroPdf']['tmp_name'], "./arquivos/livros/$urlPdf");
                    $urlCapa = sha1($nomeCapa[0]) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
                    move_uploaded_file($livro['livroCapa']['tmp_name'], "./arquivos/capas/$urlCapa");
                } else {
                    $erros = 'Você não pode fazer upload deste tipo de arquivo';
                    return $erros;
                }
            } else {
                $erros = 'Escolha um LIVRO e UMA CAPA';
                return $erros;
            }

            date_default_timezone_set('America/Sao_Paulo');
            $dataPostagem = date('Y-m-d H:i:s');

            $pdo = parent::conexao();
            $sql = "UPDATE livros SET titulo_livro = :titulo, descricao_livro = :descricao,autor_livro = :autor, categoria_livro = :categoria   WHERE id_livro = :id ";
            $con = $pdo->prepare($sql);
            $con->bindValue(':id',  $id);
            $con->bindValue(':titulo', $titulo);
            $con->bindValue(':descricao', $descricao);
            $con->bindValue(':autor', $autor);
            $con->bindValue(':categoria', $categoria);
            $con->bindValue(":url_pdf", $livroPdf);
            $con->bindValue(":url_capa", $livroCapa);
            $con->bindValue(":data_postagem", $dataPostagem);
            $con->execute();

            if ($con->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro no DB: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro: {$e->getMessage()}";
        }










        echo "<pre>";
        var_dump($livro);
        echo "</pre>";




        /*------------------------------- */

        $erros = array();
        //$urlPdf = $urlCapa = '';
        if (!empty($livro['livroPdf']['name']) && !empty($livro['livroCapa']['name'])) {
            $nomeLivro = explode('.', $livro['livroPdf']['name']);
            $nomeCapa = explode('.', $livro['livroCapa']['name']);
            if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf') && ($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                $urlPdf = sha1($nomeLivro[0]) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                move_uploaded_file($livro['livroPdf']['tmp_name'], "./arquivos/livros/$urlPdf");
                $urlCapa = sha1($nomeCapa[0]) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
                move_uploaded_file($livro['livroCapa']['tmp_name'], "./arquivos/capas/$urlCapa");
            } else {
                $erros = 'Você não pode fazer upload deste tipo de arquivo';
                return $erros;
            }
        } else {
            $erros = 'Escolha um LIVRO e UMA CAPA';
            return $erros;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $dataPostagem = date('Y-m-d H:i:s');


        return true;
    }
}
