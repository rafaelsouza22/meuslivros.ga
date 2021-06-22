<?php
session_start();
require_once("class/SelecionarLivros.php");
$lista = new SelecionarLivros();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Meus Livros</title>
</head>

<body>
    <?php require_once("templetes/header.php"); ?>
    <main>
        <section>
            <ul>
                <?php
                $livros = $lista->selecionarLivros();
                if (empty($livros)) {
                    echo "Ainda não há livros cadastrados";
                } else {
                    foreach ($livros as $value) {
                        echo
                        "<li>
                            <a href='livro.php?id={$value['id_livro']}'>
                                <img src='./arquivos/capas/{$value['url_capa_livro']}' alt='{$value['titulo_livro']}'>
                            </a>    
                            <h3><a href='livro.php?id={$value['id_livro']}  '>{$value['titulo_livro']}</a></h3>
                            <p><a href='livro.php?id={$value['id_livro']}'>Baixar ou Ler Online</a></p>
                        </li>";
                    }
                } ?>
            </ul>
        </section>
    </main>
    <?php require_once("templetes/footer.php"); ?>
</body>

</html> 