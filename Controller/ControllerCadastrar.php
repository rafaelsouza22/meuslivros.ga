<?php
session_start();
if (!(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])  && isset($_SESSION['email_usuario']) && !empty($_SESSION['email_usuario']))) {
    header('Location: login.php');
}

require_once("./Model/CadastrarLivro.php");
$cadastrar = new CadastrarLivro();
if (isset($_POST['titulo'])) {
    if (
        isset($_POST['titulo']) && !empty($_POST['titulo']) &&
        isset($_POST['descricao']) && !empty($_POST['descricao']) &&
        isset($_POST['autor']) && !empty($_POST['autor']) &&
        isset($_POST['categoria']) && !empty($_POST['categoria']) &&
        isset($_FILES['livroPdf']['name']) && !empty($_FILES['livroPdf']['name']) &&
        isset($_FILES['livroCapa']['name']) && !empty($_FILES['livroCapa']['name'])
    ) {
        $titulo = addslashes($_POST['titulo']);
        $descricao = addslashes($_POST['descricao']);
        $autor = addslashes($_POST['autor']);
        $categoria = addslashes($_POST['categoria']);
        $livroPdf = $_FILES['livroPdf'];
        $livroCapa = $_FILES['livroCapa'];

        $livro = array('titulo' => $titulo, 'descricao' => $descricao, 'autor' => $autor, 'categoria' => $categoria, 'livroPdf' => $livroPdf, 'livroCapa' => $livroCapa);

        $res = $cadastrar->cadastrar($livro);
        $msg = array();
        switch ($res) {
            case 1:
                $msg = "<p class='feedback-warning'>Livro Já possui Cadastro.</p>";
                break;
            case 2:
                $msg = "<p class='feedback-ok'>Livro Cadastro com Sucesso!</p>";
                break;
            case 3:
                $msg = "<p class='feedback-erro'>Você não pode fazer upload deste tipo de arquivo.</p>";
                break;    
            case 4:
                $msg = "<p class='feedback-erro'>Erro no Cadastro.</p>";
                break;
            case 5:
                $msg = "<p class='feedback-erro'>Escolha um LIVRO e UMA CAPA.</p>";
                break;    
            default:
                $msg = "<p class=''>$res</p>";
                
        }
    } else {
        $msg = "<p class='feedback-campos'>Preencha todos os campos</p>";
    }
}
/**
 * 1 = Livro Já possui Cadastro DB
 * 2 = cadastro ok
 * 3 = Você não pode fazer upload deste tipo de arquivo
 * 4 = erro no cadastro 
 * 5 = Escolha um LIVRO e UMA CAPA
 */
