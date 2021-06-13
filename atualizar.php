<?php
session_start();
if (!(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])  && isset($_SESSION['email_usuario']) && !empty($_SESSION['email_usuario']))) {
    header('Location: login.php');
}
require_once("./class/BuscarLivro.php");
require_once("./class/AtualizarLivro.php");
require_once("./class/SelecionarLivroPorId.php");
require_once("./class/Conexao.php");
$atualizar = new atualizarLivro();
$buscar = new BuscarLivro();
$selecionar = new SelecionarLivroPorId();
$texto = '';
$livros = array();
$erros = '';
$_SESSION['buscar'] = '';

if ((isset($_GET['id_livro']) && !empty($_GET['id_livro']))) {
    $id_livro = addslashes($_GET['id_livro']);
    $livroSelecionado = $selecionar->selecionarLivroPorId($id_livro);
}


if ((isset($_GET['buscar']) && !empty($_GET['buscar']))) {
    $texto = addslashes($_GET['buscar']);
    $_SESSION['buscar'] = $texto;
    $livrosBuscados = $buscar->buscarLivro($texto);
}



// para atualizar o livro
if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
    if (
        isset($_POST['id_livro']) && !empty($_POST['id_livro']) &&
        isset($_POST['titulo']) && !empty($_POST['titulo']) &&
        isset($_POST['descricao']) && !empty($_POST['descricao']) &&
        isset($_POST['autor']) && !empty($_POST['autor']) &&
        isset($_POST['categoria']) && !empty($_POST['categoria']) &&
        isset($_FILES['livroPdf']['name']) && !empty($_FILES['livroPdf']['name']) &&
        isset($_FILES['livroCapa']['name']) && !empty($_FILES['livroCapa']['name'])
    ) {
        $id = addslashes($_POST['id_livro']);
        $titulo = addslashes($_POST['titulo']);
        $descricao = addslashes($_POST['descricao']);
        $autor = addslashes($_POST['autor']);
        $categoria = addslashes($_POST['categoria']);
        $livroPdf = $_FILES['livroPdf'];
        $livroCapa = $_FILES['livroCapa'];
        $livro = array('id_livro' => $id, 'titulo' => $titulo, 'descricao' => $descricao, 'autor' => $autor, 'categoria' => $categoria, 'livro_pdf' => $livroPdf, 'livro_capa' => $livroCapa);
        $a = $atualizar->atualizarLivro($livro);
        $id_livro = addslashes($id);
        $livroSelecionado = $selecionar->selecionarLivroPorId($id_livro);
        switch ($a) {
            case 1:
                $erros = "Você não pode fazer upload deste tipo de arquivo/livro";
                break;
            case 2:
                $erros = "Escolha um LIVRO e UMA CAPA";
                break;
            case 3:
                $erros = "Sucesso ao atualizar ";
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

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/atualizar.css">
    <title>Atualizar livros </title>
</head>

<body>
    <?php require_once("./templetes/header.php"); ?>
    <main>
        <section id="buscar">
            <form action="./atualizar.php" method="get">
                <input type="search" name="buscar" id="buscar" placeholder="Buscar Livro">
                <button type="submit"><img src="./img/lupa.png" alt=""></button>
            </form>
        </section>
        <section id="form-atualizar">
            <form action="atualizar.php" method="post" enctype="multipart/form-data">
                <p class="erros"><?php echo isset($erros) ? $erros : ''; ?></p>
                <input type="hidden" name="id_livro" id="id_livro" value="<?php if (isset($livroSelecionado)) {
                                                                                echo $livroSelecionado['id_livro'];
                                                                            } ?>">

                <input type="text" name="titulo" id="titulo" placeholder="Titulo do livro" value="<?php if (isset($livroSelecionado)) {
                                                                                                        echo $livroSelecionado['titulo_livro'];
                                                                                                    } ?>">


                <textarea name="descricao" id="descricao" cols="64" rows="10" placeholder="Descrição do livro"><?php if (isset($livroSelecionado)) {
                                                                                                                    echo $livroSelecionado['descricao_livro'];
                                                                                                                } ?>
                                                                                                                    
                                                                                                               </textarea>
                <input type="text" name="autor" id="autor" placeholder="Nome do Autor" value="<?php if (isset($livroSelecionado)) {
                                                                                                    echo $livroSelecionado['autor_livro'];
                                                                                                } ?>">
                <select name="categoria" id="categoria">
                    <?php if (isset($livroSelecionado)) {
                        echo "<option value='{$livroSelecionado['categoria_livro']}' > {$livroSelecionado['categoria_livro']} </option> ";
                    } ?>
                    <option value="tecnologia">Tecnologia</option>
                    <option value="finanças">Finanças</option>
                    <option value="aventura">Aventura</option>
                    <option value="autoajuda">Auto ajuda</option>
                    <option value="filosofia">Filosofia</option>
                </select>
                <fieldset>
                    <legend><label for="livroPdf">Selecionar um Livro *Somente .PDF</label></legend>
                    <input type="file" name="livroPdf" id="livroPdf" placeholder="Selecione um Livro" value="<?php if (isset($livroSelecionado)) {
                                                                                                                    echo $livroSelecionado['url_pdf_livro'];
                                                                                                                } ?>">
                </fieldset>
                <fieldset>
                    <legend><label for="livroCapa">Selecione uma Capa *Somente .JPG </label></legend>
                    <input type="file" name="livroCapa" id="livroCapa" placeholder="Selecione a capa do livro">
                </fieldset>
                <input type="submit" value="Atualizar">
            </form>
        </section>

        <section id="lista-livros">
            <ul>
                <?php
                echo (!empty($_SESSION['buscar'])) ? "<p>Livros Achados por: " . $_SESSION['buscar'] . "</p>" : '';
                if (!empty($livrosBuscados)) {
                    //echo "<p>Livros Achados por: $texto</p>";
                    for ($i = 0; $i < count($livrosBuscados); $i++) {
                        foreach ($livrosBuscados[$i] as $value) {
                            echo
                            "<li>
                                <a href='atualizar.php?id_livro={$value['id_livro']}'>
                                    <img src='./arquivos/capas/{$value['url_capa_livro']}' alt='{$value['titulo_livro']}'>
                                </a>    
                                <h3><a href='atualizar.php?id_livro={$value['id_livro']}'>{$value['titulo_livro']}</a></h3>
                                <p> <a href='atualizar.php?id_livro={$value['id_livro']}'>Editar ou Deletar</a></p>
                            </li>";
                        }
                    }
                } elseif (!empty($livroSelecionado)) {
                    //echo "<p>Livros Achados por: $texto</p>";
                    echo "<li>
                            <a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>
                                <img src='./arquivos/capas/{$livroSelecionado['url_capa_livro']}' alt='{$livroSelecionado['titulo_livro']}'>
                            </a>    
                            <h3><a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>{$livroSelecionado['titulo_livro']}</a></h3>
                            <p> <a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>Editar ou Deletar</a></p>
                        </li>";
                } else {
                    echo "Nenhum Livro Achado com o Nome: $texto ";
                }
                ?>
            </ul>
        </section>


    </main>
    <?php require_once("./templetes/footer.php"); ?>
</body>

</html>