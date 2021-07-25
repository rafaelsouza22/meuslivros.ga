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

        <section>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="msg-feedback"><?php echo isset($msg) ? $msg : ''; ?></div>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo do livro">
                <textarea name="descricao" id="descricao" cols="64" rows="10" placeholder="Descrição do livro"></textarea>
                <input type="text" name="autor" id="autor" placeholder="Nome do Autor">
                <select name="categoria" id="categoria">
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Autoajuda">Auto ajuda</option>
                    <option value="Filosofia">Filosofia</option>
                    <option value="Fisica">Fisica</option>
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