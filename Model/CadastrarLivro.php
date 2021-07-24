<?php
require_once("Conexao.php");

class CadastrarLivro extends Conexao
{

    public function cadastrar($livro)
    {
        try {
            $pdo = parent::connect();
            $sql = "SELECT id_livro FROM livros WHERE titulo_livro = :titulo";
            $cmd = $pdo->prepare($sql);
            $cmd->bindValue(":titulo", $livro['titulo']);
            $cmd->execute();
            if ($cmd->rowCount() < 1) {
                // movendo capa e livro
                if (!empty($livro['livroPdf']['name']) && !empty($livro['livroCapa']['name'])) {
                    $nomeLivro = explode('.', $livro['livroPdf']['name']);
                    $nomeCapa = explode('.', $livro['livroCapa']['name']);
                    if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf') && ($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                        $urlPdf = md5($nomeLivro[0]) . rand(10000, 9999999999) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                        move_uploaded_file($livro['livroPdf']['tmp_name'], "./arquivos/livros/$urlPdf");
                        $urlCapa = md5($nomeCapa[0]) . rand(10000, 9999999999) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
                        move_uploaded_file($livro['livroCapa']['tmp_name'], "./arquivos/capas/$urlCapa");
                    } else {
                        return 3;
                    }
                } else {
                    return 5;
                }
                date_default_timezone_set('America/Sao_Paulo');
                $dataPostagem = date('Y-m-d H:i:s');
                $sql = "INSERT INTO livros(titulo_livro, descricao_livro, autor_livro, categoria_livro, url_pdf_livro, url_capa_livro, data_postagem_livro)
                values(:titulo, :descricao, :autor, :categoria, :url_pdf, :url_capa, :data_postagem ) ";
                $cmd = $pdo->prepare($sql);
                $cmd->bindValue(":titulo", $livro['titulo']);
                $cmd->bindValue(":descricao", $livro['descricao']);
                $cmd->bindValue(":autor", $livro['autor']);
                $cmd->bindValue(":categoria", $livro['categoria']);
                $cmd->bindValue(":url_pdf", $urlPdf);
                $cmd->bindValue(":url_capa", $urlCapa);
                $cmd->bindValue(":data_postagem", $dataPostagem);
                $cmd->execute();
                if ($cmd->rowCount() > 0) {
                    return 2;
                }
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            echo "Erro no DB: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro: {$e->getMessage()}";
        }
       
    }
}
