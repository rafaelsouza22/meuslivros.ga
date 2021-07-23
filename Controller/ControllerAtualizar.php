<?php
session_start();
if (!(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])  && isset($_SESSION['email_usuario']) && !empty($_SESSION['email_usuario']))) {
    header('Location: login.php');
}
require_once("./Model/BuscarLivro.php");
require_once("./Model/AtualizarLivro.php");
require_once("./Model/SelecionarLivroPorId.php");
require_once("./Model/DeletarLivro.php");

$atualizar = new atualizarLivro();
$buscarLivros = new BuscarLivro();
$selecionar = new SelecionarLivroPorId();
$deletar = new DeletarLivro();
$texto = '';
$livros = array();
$erros = '';
$_SESSION['buscar'] = '';

// SELECIONANDO O ID_LIVRO DA URL
if ((isset($_GET['id_livro']) && !empty($_GET['id_livro']))) {
    $id_livro = addslashes($_GET['id_livro']);
    $livroSelecionado = $selecionar->selecionarLivro($id_livro);
}


// BUSCAR LIVROS
if ((isset($_GET['buscar']) && !empty($_GET['buscar']))) {
    $_SESSION['textoBuscado'] = addslashes($_GET['buscar']);;
    $livrosBuscados = $buscarLivros->buscar($_SESSION['textoBuscado']);
}


// para atualizar o livro
if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
    if (
        isset($_POST['titulo']) && !empty($_POST['titulo']) &&
        isset($_POST['id_livro']) && !empty($_POST['id_livro']) &&
        isset($_POST['titulo']) && !empty($_POST['titulo']) &&
        isset($_POST['descricao']) && !empty($_POST['descricao']) &&
        isset($_POST['autor']) && !empty($_POST['autor']) &&
        isset($_POST['categoria']) && !empty($_POST['categoria'])
        
    ) {
        $id = addslashes($_POST['id_livro']);
        $titulo = addslashes($_POST['titulo']);
        $descricao = addslashes($_POST['descricao']);
        $autor = addslashes($_POST['autor']);
        $categoria = addslashes($_POST['categoria']);
        $livroPdf = $_FILES['livroPdf'];
        $livroCapa = $_FILES['livroCapa'];
        $livro = array('id_livro' => $id, 'titulo' => $titulo, 'descricao' => $descricao, 'autor' => $autor, 'categoria' => $categoria, 'livro_pdf' => $livroPdf, 'livro_capa' => $livroCapa);
        $res = $atualizar->atualizar($livro);
        $id_livro = addslashes($id);
        $livroSelecionado = $selecionar->selecionarLivro($id_livro);
        
        switch ($res) {
            case 1:
                $erros = "Você não pode fazer upload deste tipo de arquivo/livro";
                break;
            case 2:
                $erros = "Sucesso ao atualizar ";
                break;
            case 3:
                $erros = "Escolha um LIVRO e UMA CAPA";
                break;
            case 4:
                $erros = "ERRO ao atualizar ";
                break;
            case 5:
                $erros = "ID não idetificado ";
                break;
            case 6:
                $erros = "Erro na substituição do livro e capa";
                break;
            default:
                $erros = 'ERRO no switch!';
        }
    } else {
        $erros = "Preencha todos os campos!";
    }
} 

// APAGAR LIVRO
if (isset($_POST['btn-apagar']) && !empty($_POST['btn-apagar']) )
    if ( isset($_POST['id_livro']) && !empty($_POST['id_livro']) && isset($_POST['titulo']) && !empty($_POST['titulo']) ) {
        $id = addslashes($_POST['id_livro']);
        $titulo = addslashes($_POST['titulo']);
        $erros = "ID: $id , APAGADO"; 

        if($id){
            $res = $deletar->deletar($id);
            //$res = 1;
            if($res){
                $erros = "O Livro,( $titulo ),<br> FOI APAGADO. ";
            }
        }

    }
?>


