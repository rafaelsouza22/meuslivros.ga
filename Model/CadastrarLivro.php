<?php
require_once("Conexao.php");

class CadastrarLivro extends Conexao
{

    public function cadastrar($livro)
    {
        $pdo = parent::connect();
        $erros = array();
        //$urlPdf = $urlCapa = '';
        if (!empty($livro['livroPdf']['name']) && !empty($livro['livroCapa']['name'])) {
            $nomeLivro = explode('.', $livro['livroPdf']['name']);
            $nomeCapa = explode('.', $livro['livroCapa']['name']);
            if (($nomeLivro[sizeof($nomeLivro) - 1] == 'pdf') && ($nomeCapa[sizeof($nomeCapa) - 1] == 'jpg')) {
                $urlPdf = md5($nomeLivro[0]) . rand(10000, 99999999) . '.' . $nomeLivro[sizeof($nomeLivro) - 1];
                move_uploaded_file($livro['livroPdf']['tmp_name'], "./arquivos/livros/$urlPdf");
                $urlCapa = md5($nomeCapa[0]) . rand(1000, 9999999) . '.' . $nomeCapa[sizeof($nomeCapa) - 1];
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
        try {
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
        } catch (PDOException $e) {
            echo "Erro no DB: {$e->getMessage()}";
        } catch (Exception $e) {
            echo "Erro: {$e->getMessage()}";
        }
        return true;
    }
}
