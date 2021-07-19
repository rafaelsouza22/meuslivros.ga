<?php
session_start();
if(!(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])  && isset($_SESSION['email_usuario']) && !empty($_SESSION['email_usuario']))){
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

        $a = $cadastrar->cadastrar($livro);
        if ($a) {
            echo "<script> alert('Cadastrado com SUCESSO!')</script>";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

?>