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
    <script>
        function abrirModal() {
            let modal = document.querySelector('.notice');
            modal.style.display = 'block';
            let overlay = document.querySelector('.overlay');
            overlay.style.display = 'block';
        }

        function fechar() {
            let modal = document.querySelector('.notice');
            modal.style.display = 'none';
            let overlay = document.querySelector('.overlay');
            overlay.style.display = 'none';
        }
    </script>
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
                <div class="erros" id="erros"><?php echo isset($erros) ? $erros : ''; ?></div>
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
                   <option value="Administração">Administração</option>
                    <option value="Artes">Artes</option>
                    <option value="Autoajuda">Autoajuda</option>
                    <option value="Apostilas">Apostilas</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Arquitetura de Software">Arquitetura de Software</option>
                    <option value="Biografias e Memórias">Biografias e Memórias</option>
                    <option value="Ciências">Ciências</option>
                    <option value="Concurso Público">Concurso Público</option>
                    <option value="Contos e Crônicas">Contos e Crônicas</option>
                    <option value="Dicionários e Manuais Convers">Dicionários e Manuais Convers</option>
                    <option value="Direito">Direito</option>
                    <option value="Diversos">Diversos</option>
                    <option value="Economia">Economia</option>
                    <option value="Ensaios">Ensaios</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Fisica">Fisica</option>
                    <option value="Ficção Cientifica">Ficção Cientifica</option>
                    <option value="Ficção Fantástica">Ficção Fantástica</option>
                    <option value="Ficção Supense">Ficção Supense</option>
                    <option value="Filosofia">Filosofia</option>
                    <option value="Geografia e Historia">Geografia e Historia</option>
                    <option value="Humor">Humor</option>
                    <option value="Infanto-Juvenil">Infanto-Juvenil</option>
                    <option value="Linguística">Linguística</option>
                    <option value="Medicina">Medicina</option>
                    <option value="Poesia">Poesia</option>
                    <option value="Policial">Policial</option>
                    <option value="Programação">Programação</option>
                    <option value="Psicologia">Psicologia</option>
                    <option value="Regimes">Regimes</option>
                    <option value="Religião">Religião</option>
                    <option value="Romance">Romance</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Teoria e Crítica">Teoria e Crítica</option>
                    <option value="Terror e Suspense">Terror e Suspense</option>
                    <option value="Turismo">Turismo</option>
                </select>
                <fieldset>
                    <legend><label for="livroPdf">Selecionar um Livro *.pdf</label></legend>
                    <input type="file" name="livroPdf" id="livroPdf" placeholder="Selecione um Livro" value="<?php if (isset($livroSelecionado)) {
                                                                                                                    echo $livroSelecionado['url_pdf_livro'];
                                                                                                                } ?>">
                </fieldset>
                <fieldset>
                    <legend><label for="livroCapa">Selecione uma Capa *.jpg</label></legend>
                    <input type="file" name="livroCapa" id="livroCapa" placeholder="Selecione a capa do livro">
                </fieldset>
                <input type="submit" value="Atualizar">
                <?php
                if (isset($livroSelecionado['id_livro'])) {
                    echo "<button class='btn-apagar' type='button' onclick='abrirModal()'>Apagar Livro</button>";
                }
                ?>

                <!-- MODAL -->
                <div class="notice">
                    <h3>Opa!</h3>
                    <p> Tem certeza que deseja excluir esse livro? </p> 
                    <p class='modal-titulo-livro'><?php if (isset($livroSelecionado['titulo_livro'])) echo ucfirst($livroSelecionado['titulo_livro']); ?></p>
                    
                    <p class='modal-botoes'>
                        <button class="btn-modal-apagar" type="submit" name='btn-apagar'>SIM, QUERO DELETAR!</button>
                        <button class="btn-modal-cancelar" type="button" onclick="fechar()">Cancelar</button>
                    </p>
                </div>
                <div class="overlay" onclick="fechar()"></div>
                <!-- Fim MODAL -->

            </form>
        </section>

        <section id="lista-livros">
            <ul>
                <?php
                // echo (!empty($_SESSION['buscar'])) ? "<p>Livros Achados por: " . $_SESSION['buscar'] . "</p>" : '';
                if (!empty($livrosBuscados)) {
                    echo "<p class='msg-resutados'>Livros Achados por: <span>{$_GET['buscar']}</span></p>";
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
                    echo "<li>
                            <a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>
                                <img src='./arquivos/capas/{$livroSelecionado['url_capa_livro']}' alt='{$livroSelecionado['titulo_livro']}'>
                            </a>    
                            <h3><a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>{$livroSelecionado['titulo_livro']}</a></h3>
                            <p> <a href='atualizar.php?id_livro={$livroSelecionado['id_livro']}'>Editar ou Deletar</a></p>
                        </li>";
                }
                ?>
            </ul>
        </section>
        <section class="paginacao">
            <?php
            $numPaginas =  $buscarLivros->numPaginas ? $buscarLivros->numPaginas : 1;
            if ($numPaginas != 1) {

                $pagina = $buscarLivros->pagina;
                echo "<p> <a href='atualizar.php?pagina=1&buscar={$_SESSION['buscar']}'>Primeira</a>"; //
                for ($i = 1; $i <= $numPaginas; $i++) {
                    echo ($i == $pagina) ? "<span>$i</span>" : "<a href='atualizar.php?pagina=$i&buscar={$_SESSION['buscar']}'>$i</a>"; //
                }
                echo "<a href='atualizar.php?pagina=$numPaginas&buscar={$_SESSION['buscar']}'>Última</a></p>"; //
            }
            ?>
        </section>
    </main>
    <?php require_once("./templetes/footer.php"); ?>
    <script>
        const elem = document.querySelector(".erros > p");
        if (elem) {
            setTimeout(() => {
                elem.innerHTML = ''
            }, 5000);
        }
    </script>
</body>

</html>