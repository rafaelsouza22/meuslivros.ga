<?php
session_start();
require_once('./Model/SelecionarLivros.php');
$livros = new SelecionarLivros();

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
        <section class="livros-listados">
            <ul>
                <?php
                $lista = $livros->listarLivros();
                if (empty($lista)) {
                    echo "Ainda não há livros cadastrados";
                } else {
                    foreach ($lista as $value) {
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
        <section class="paginacao">
            <?php
            $numPaginas =  $livros->numPaginas;
            if($numPaginas != 1){    
                $pagina = $livros->pagina;
                echo "<p><a href='index.php?pagina=1'>Primeira</a> ";
                for ($i = 1; $i <= $numPaginas; $i++) {
                    echo ($i == $pagina) ? "<span>$i</span>" : "<a href='index.php?pagina=$i'>$i</a>";
                }
                echo "<a href='index.php?pagina=$numPaginas'>Última</a></p>";
            }    
            ?>
        </section>
    </main>
    <?php require_once("templetes/footer.php"); ?>
</body>

</html>