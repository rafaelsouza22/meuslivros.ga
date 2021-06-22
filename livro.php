<?php
session_start();
require_once("class/SelecionarLivroPorId.php");
$selecionar = new SelecionarLivroPorId();
$idLivro = addslashes($_GET['id']);
$livro = $selecionar->selecionarLivroPorId($idLivro);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/padrao.css">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/livro.css">

    <title>MeusLivros - <?php echo $livro['titulo_livro']; ?></title>
</head>

<body>
    <?php require_once("./templetes/header.php"); ?>
    <main>
        <section>
            <article>
                <img src="./arquivos/capas/<?php echo $livro['url_capa_livro'] ?>" alt="<?php echo $livro['titulo_livro']; ?>">
                <div id="descicao">
                    <h1> <?php echo $livro['titulo_livro']; ?></h1>
                    <p>Descrição: <?php echo $livro['descricao_livro']; ?> </p>
                    <p>Autor: <?php echo $livro['autor_livro']; ?></p>
                    <p>Categoria: <?php echo $livro['categoria_livro']; ?></p>
                    <p>Postado em <?php echo $livro['data_postagem_livro']; ?></p>
                    <p><a target="_blank" href="./arquivos/livros/<?php echo $livro['url_pdf_livro'] ?>">Baixar Livro</a></p>
                    <p></p>
                   
                </div>
                <?php // echo "<pre>"; var_dump($livro); echo "</pre>"; ?>

            </article>

            <object data="./arquivos/livros/<?php echo $livro['url_pdf_livro'] ?>" type="" width="500" height="600" title="ola mundo"></object>
        </section>
    </main>
    <?php require_once("./templetes/footer.php"); ?>
</body>

</html>