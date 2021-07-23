<?php
session_start();
require_once("./Model/SelecionarLivroPorId.php");
$selecionar = new SelecionarLivroPorId();
$idLivro = addslashes($_GET['id']);
$livro = $selecionar->selecionarLivro($idLivro);

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
        <section class="livro">
            <article>
                <figure>
                    <img src="./arquivos/capas/<?php echo $livro['url_capa_livro'] ?>" alt="<?php echo $livro['titulo_livro']; ?>">
                </figure>

                <div id="descicao" >
                    <h1><?php echo $livro['titulo_livro']; ?></h1>
                    <p><strong>Descrição:</strong>  <?php echo $livro['descricao_livro']; ?> </p>
                    <p><strong>Autor:</strong> <?php echo $livro['autor_livro']; ?></p>
                    <p><strong>Categoria:</strong> <?php echo $livro['categoria_livro']; ?></p>
                    <p class="postegem">Postado em <?php echo $livro['data_postagem_livro']; ?></p>

                </div>
            </article>
            <div class="botoes clear">
                <p>
                    <a target="_new" href="./arquivos/livros/<?php echo $livro['url_pdf_livro'] ?>">Ler Livro</a>
                    <a target="new " href="./arquivos/livros/<?php echo $livro['url_pdf_livro'] ?>">Baixar Livro</a>
                </p>
            </div>
            
            
        </section>
    </main>
    <?php require_once("./templetes/footer.php"); ?>
</body>
<!-- <object data="./arquivos/livros/<?php //echo $livro['url_pdf_livro'] 
                                                    ?>" type="" width="500" height="600" title="ola mundo"></object> -->
</html>