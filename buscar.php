<?php
if(!(isset($_GET['buscar']) && !empty($_GET['buscar']))){
    header('location: index.php');
}
session_start();
require_once("./Model/BuscarLivro.php");
$buscarLivros = new BuscarLivro();
$buscar = addslashes($_GET['buscar']);
if(isset($_GET['buscar']) && !empty($_GET['buscar']) ){
    $_SESSION['textoBuscado'] = addslashes($_GET['buscar']);
}
$livros = $buscarLivros->buscar($_SESSION['textoBuscado']);

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
                if (empty($livros)) {
                    echo "<p class='msg-livro-achado'>Nenhum Livro Achado com o Palavra: <strong>$buscar</strong> </p>";
                } else {
                    echo "<p class='msg-livro-achado'>Livros Achados com o Palavra: <strong>$buscar</strong> </p>";
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
        <section class="paginacao">
            <?php
            $numPaginas =  $buscarLivros->numPaginas;
            $pagina = $buscarLivros->pagina;
            echo "<p> <a href='buscar.php?pagina=1'>Primeira</a> ";
            for ($i = 1; $i <= $numPaginas; $i++) {
                echo ($i == $pagina) ? "<span>$i</span>" : "<a href='buscar.php?pagina=$i'>$i</a>";
            }
            echo "<a href='buscar.php?pagina=$numPaginas'>Última</a></p>";
            ?>
        </section>
    </main>
    <?php require_once("templetes/footer.php"); ?>
</body>

</html>