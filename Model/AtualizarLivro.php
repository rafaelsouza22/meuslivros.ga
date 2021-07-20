<?php
require_once("Conexao.php");

class AtualizarLivro extends Conexao
{
    public function atualizar($livro)
    {
        try {
            $pdo = parent::connect();
            // SETANDO DADOS RECEBIDOS DO LIVRO    
            $id = addslashes($livro['id_livro']);
            $titulo = addslashes($livro['titulo']);
            $descricao = addslashes($livro['descricao']);
            $categoria = addslashes($livro['categoria']);
            $autor = addslashes($livro['autor']);
            $livroPdf = $livro['livro_pdf'];
            $livroCapa = $livro['livro_capa'];

            // MOVENDO O LIVRO e CAPA
            if (!empty($livroPdf['name']) || !empty($livroCapa['name'])) {
                // MOVER LIVRO
                if (!empty($livroPdf['name'])) {
                    $nomeLivro = explode('.', $livroPdf['name']);
                    if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf')) {
                        $urlPdf = md5($nomeLivro[0]) . rand(10000, 99999999999) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                        move_uploaded_file($livroPdf['tmp_name'], "./arquivos/livros/$urlPdf");
                        // APAGANDO O LIVRO 
                        if (!empty($id)) {
                            $sql = "SELECT url_pdf_livro FROM livros WHERE id_livro =  '$id' ";
                            $res = $pdo->query($sql);
                            $dados = $res->fetchObject();
                            if ($res->rowCount() == 1) {
                                @$res = unlink("./arquivos/livros/{$dados->url_pdf_livro}");
                            }
                        }
                    } else {
                        return 1;
                    }
                }
                // MOVER CAPA
                if (!empty($livroCapa['name'])) {
                    $nomeCapa = explode('.', $livroCapa['name']);
                    if (($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                        $urlCapa = md5($nomeCapa[0]) . rand(10000, 99999999999) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
                        move_uploaded_file($livroCapa['tmp_name'], "./arquivos/capas/$urlCapa");
                        // APAGANDO O CAPA 
                        if (!empty($id)) {
                            $sql = "SELECT url_capa_livro FROM livros WHERE id_livro =  '$id' ";
                            $res = $pdo->query($sql);
                            $dados = $res->fetchObject();
                            if ($res->rowCount() == 1) {
                                @$res = unlink("./arquivos/capas/{$dados->url_capa_livro}");
                            }
                        }
                    } else {
                        return 1;
                    }
                }
            }

            // setando data e hora
            date_default_timezone_set('America/Sao_Paulo');
            $dataPostagem = date('Y-m-d H:i:s');

            // ATUALIZANDO DADOS DO LIVRO NO DB/**/
            if (!empty($id)) {
                $sql = "UPDATE livros SET titulo_livro = :titulo, descricao_livro = :descricao,autor_livro = :autor,
                    categoria_livro = :categoria, data_postagem_livro = :data_postagem  WHERE id_livro = :id ";
                $con = $pdo->prepare($sql);
                $con->bindValue(':id',  $id);
                $con->bindValue(':titulo', $titulo);
                $con->bindValue(':descricao', $descricao);
                $con->bindValue(':autor', $autor);
                $con->bindValue(':categoria', $categoria);
                $con->bindValue(":data_postagem", $dataPostagem);
                $con->execute();

                //atualizando livro
                if (!empty($livroPdf['name']) || !empty($livroCapa['name'])) {
                    if (!empty($id) && (!empty($urlPdf))) {
                        $sql = "UPDATE livros SET url_pdf_livro = :url_pdf WHERE id_livro = :id ";
                        $con = $pdo->prepare($sql);
                        $con->bindValue(":url_pdf", $urlPdf);
                        $con->bindValue(':id', $id);
                        $con->execute();
                    } 
                    // atualizando capa
                    if (!empty($id) && (!empty($urlCapa))) {
                        $sql = "UPDATE livros SET url_capa_livro = :url_capa WHERE id_livro = :id ";
                        $con = $pdo->prepare($sql);
                        $con->bindValue(":url_capa", $urlCapa);
                        $con->bindValue(':id', $id);
                        $con->execute();
                    }
                }
            } else {
                return 5;
            }
            return 2;
        } catch (PDOException $e) {
            echo "Erro no DB: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro: {$e->getMessage()}";
        }
    }
}
