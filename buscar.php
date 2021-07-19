<?php
if(!(isset($_GET['buscar']) && !empty($_GET['buscar']))){
    // header('location: index.php');
}
session_start();
require_once("./Model/BuscarLivro.php");
$res = new BuscarLivro();

$buscar = addslashes($_GET['buscar']);
$livros = $res->buscar($buscar);

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
                if (empty($livros)) {
                    echo "Nenhum Livro Achado com o Nome: $buscar ";
                } else {
                    for ($i=0; $i < count($livros) ; $i++) { 
                           foreach ($livros[$i] as $value) {
                            echo
                            "<li>
                                <a href='livro.php?id={$value['id_livro']}'>
                                    <img src='./arquivos/capas/{$value['url_capa_livro']}' alt='{$value['titulo_livro']}'>
                                </a>    
                                <h3><a href='livro.php?id={$value['id_livro']}  '>{$value['titulo_livro']}</a></h3>
                                <p><a href='livro.php?id={$value['id_livro']}'>Baixar ou Ler Online</a></p>
                            </li>";
                        }
                    }    
                } ?>
            </ul>
        </section>
    </main>
    <?php require_once("templetes/footer.php"); ?>
</body>

</html>