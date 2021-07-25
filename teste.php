<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function modal() {
            alert("MODAL");
        }
        
    </script>
</head>

<body>
    <?php
    @$texto = $_POST['nome'];
    if (isset($_POST['btn-cadastrar'])) {
        echo "Cadastrar: {$_POST['nome']}";
    } 

    if (isset($_POST['btn-atualizar'])) {
        echo "Atualizar: {$_POST['nome']}";
    }
    if (isset($_POST['btn-apagar'])) {
        echo "Apagar: {$_POST['nome']}";
    } 



    ?>
    <form action="teste.php" method="post">
        <p><input type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo (!empty($texto)? $texto:'')  ?>"></p>
        <?php    
        if(empty($_POST['nome'])){
            echo "<button name='btn-cadastrar' type='submit'>cadastrar</button>";
        }else{
            echo "<button name='btn-atualizar' type='submit'>Atualizar</button>";
        }
        ?>
        <button name="btn-apagar" type="submit">Apagar</button>
    </form>



</body>

</html>