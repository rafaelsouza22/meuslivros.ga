<?php
require_once("Conexao.php");

class AtualizarLivro extends Conexao
{
    public function atualizarLivro($livro)
    {
        try {
            $pdo = parent::conexao();
            // SETANDO DADOS RECEBIDOS DO LIVRO    
            $id = addslashes($livro['id_livro']);
            $titulo = addslashes($livro['titulo']);
            $descricao = addslashes($livro['descricao']);
            $categoria = addslashes($livro['categoria']);
            $autor = addslashes($livro['autor']);
            $livroPdf = $livro['livro_pdf'];
            $livroCapa = $livro['livro_capa'];
            $erros = array();

            // MOVENDO O LIVRO NOVO
            if (!empty($livroPdf['name']) && !empty($livroCapa['name'])) {
                $nomeLivro = explode('.', $livroPdf['name']);
                $nomeCapa = explode('.', $livroCapa['name']);
                if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf') && ($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                    $urlPdf = sha1($nomeLivro[0]) . rand(1000, 99999999) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                    move_uploaded_file($livroPdf['tmp_name'], "./arquivos/livros/$urlPdf");
                    $urlCapa = sha1($nomeCapa[0]) . rand(1000, 99999999) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
                    move_uploaded_file($livroCapa['tmp_name'], "./arquivos/capas/$urlCapa");
                    // APAGANDO O LIVRO E CAPA
                    if (!empty($id)) {
                        $sql = "SELECT url_pdf_livro, url_capa_livro FROM livros WHERE id_livro =  '$id' ";
                        $res = $pdo->query($sql);
                        $dados = $res->fetchObject();
                        if ($res->rowCount() == 1) {
                            @$res = unlink("./arquivos/capas/{$dados->url_capa_livro}");
                            @$res = unlink("./arquivos/livros/{$dados->url_pdf_livro}");
                        }
                    }
                } else {
                    $erros = 'Você não pode fazer upload deste tipo de arquivo';
                    return 1;
                }
            } else {
                $erros = 'Escolha um LIVRO e UMA CAPA';
                return 2;
            }


            // ATUALIZANDO DADOS DO LIVRO/**/
            if (!empty($id)) {
                $sql = "UPDATE livros SET titulo_livro = :titulo, descricao_livro = :descricao,autor_livro = :autor,
                    categoria_livro = :categoria , url_pdf_livro = :url_pdf , url_capa_livro = :url_capa WHERE id_livro = :id ";
                $con = $pdo->prepare($sql);
                $con->bindValue(':id',  $id);
                $con->bindValue(':titulo', $titulo);
                $con->bindValue(':descricao', $descricao);
                $con->bindValue(':autor', $autor);
                $con->bindValue(':categoria', $categoria);
                $con->bindValue(":url_pdf", $urlPdf);
                $con->bindValue(":url_capa", $urlCapa);
                //$con->bindValue(":data_postagem", $dataPostagem);
                $con->execute();
                if ($con->rowCount() == 1) {
                    return 3;
                } else {
                    return 4;
                }
            }else{
                return 5;
            }
        } catch (PDOException $e) {
            echo "Erro no DB: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro: {$e->getMessage()}";
        }
    }
}
