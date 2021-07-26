<?php
    require_once('./Controller/ControllerCadastrar.php');
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

        <section class='section'>
            <form class='form' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="msg-feedback"><?php echo isset($msg) ? $msg : ''; ?></div>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo do livro">
                <textarea name="descricao" id="descricao" cols="64" rows="4" placeholder="Descrição do livro"></textarea>
                <input type="text" name="autor" id="autor" placeholder="Nome do Autor">
                <select name="categoria" id="categoria">
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
                    <legend><label for="livroPdf">Selecionar um Livro *Somente .PDF</label></legend>
                    <input type="file" name="livroPdf" id="livroPdf" placeholder="Selecione um Livro">
                </fieldset>
                <fieldset>
                    <legend><label for="livroCapa">Selecione uma Capa *Somente .JPG</label></legend>
                    <input type="file" name="livroCapa" id="livroCapa" placeholder="Selecione a capa do livro">
                </fieldset>
                <input type="submit" value="Cadastrar">
            </form> 
        </section>
    </main>
    <?php require_once("./templetes/footer.php"); ?>
    <script>
        const elem = document.querySelector(".msg-feedback");
        if(elem){
           setTimeout(()=>{elem.innerHTML = ''},5000);   
        }
       
    </script>
</body>

</html>