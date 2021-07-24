<?php
require_once('./Controller/ControllerAtualizar.php');
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


                <textarea name="descricao" id="descricao" cols="64" rows="4" placeholder="Descrição do livro"><?php if (isset($livroSelecionado)) {
                                                                                                                    echo $livroSelecionado['descricao_livro'];
                                                                                                                } ?></textarea>
                <input type="text" name="autor" id="autor" placeholder="Nome do Autor" value="<?php if (isset($livroSelecionado)) {
                                                                                                    echo $livroSelecionado['autor_livro'];
                                                                                                } ?>">
                <select name="categoria" id="categoria">
                    <?php if (isset($livroSelecionado)) {
                        echo "<option value='{$livroSelecionado['categoria_livro']}' > {$livroSelecionado['categoria_livro']} </option> ";
                    } ?>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Autoajuda">Auto ajuda</option>
                    <option value="Filosofia">Filosofia</option>
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
                <?php 
                    if (isset($livroSelecionado['id_livro'])) {
                        echo "<button class='btn-apagar' type='submit' name='btn-apagar' value='deletar'>Apagar Livro</button>";
                    } 
                ?>
                <!-- <button class="btn-apagar" type="submit" name="btn-apagar" value="deletar">Apagar Livro</button> -->
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
        <section class="paginacao">
            <?php
            $numPaginas =  $buscarLivros->numPaginas ? $buscarLivros->numPaginas : 1;
            $pagina = $buscarLivros->pagina;
            echo "<p> <a href='atualizar.php?pagina=1&buscar={$_SESSION['textoBuscado']}'>Primeira</a>";
            for($i = 1; $i <= $numPaginas; $i++) {
                echo ($i == $pagina) ? "<span>$i</span>" : "<a href='atualizar.php?pagina=$i&buscar={$_SESSION['textoBuscado']}'>$i</a>";
            }
            echo "<a href='atualizar.php?pagina=$numPaginas&buscar={$_SESSION['textoBuscado']}'>Última</a></p>";
            ?>
        </section>


    </main>
    <?php require_once("./templetes/footer.php"); ?>
</body>

</html>