<?php
session_start();
if(!(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])  && isset($_SESSION['email_usuario']) && !empty($_SESSION['email_usuario']))){
    header('Location: login.php');
}

require_once("./class/CadastrarLivro.php");
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

        $a = $cadastrar->cadastrarLivro($livro);
        if ($a) {
            echo "<script> alert('Cadastrado com SUCESSO!')</script>";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/cadastrar.css">
    <title>Cadastrar livros</title>
</head>

<body>
    <?php require_once("./templetes/header.php"); ?>
    <main>

        <section>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" id="titulo" placeholder="Titulo do livro">
                <textarea name="descricao" id="descricao" cols="64" rows="10" placeholder="Descrição do livro"></textarea>
                <input type="text" name="autor" id="autor" placeholder="Nome do Autor">
                <select name="categoria" id="categoria">
                    <option value="tecnologia">Tecnologia</option>
                    <option value="finanças">Finanças</option>
                    <option value="aventura">Aventura</option>
                    <option value="autoajuda">Auto ajuda</option>
                    <option value="filosofia">Filosofia</option>
                </select>
                <fieldset>
                    <legend><label for="livroPdf">Selecionar um Livro *Somente .PDF</label></legend>
                    <input type="file" name="livroPdf" id="livroPdf" placeholder="Selecione um Livro">
                </fieldset>
                <fieldset>
                    <legend><label for="livroCapa">Selecione uma Capa *Somente .JPG ou .PNG</label></legend>
                    <input type="file" name="livroCapa" id="livroCapa" placeholder="Selecione a capa do livro">
                </fieldset>
                <input type="submit" value="Cadastrar">
            </form> 
        </section>
    </main>
    <?php require_once("./templetes/footer.php"); ?>
</body>

</html>