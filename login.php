<?php
session_start();
require_once("./Model/Login.php");
$res;
if (isset($_POST['email']) && isset($_POST['senha'])) {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        // limpando os campos
        $e = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $s = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $email = filter_var($e, FILTER_VALIDATE_EMAIL);
        $senha = filter_var($s, FILTER_SANITIZE_SPECIAL_CHARS);

        // chamando o metodo logar
        $usuario = array('email'=>$email , 'senha'=> $senha);
        $logar = new Login();
        $res = $logar->logar($usuario);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/padrao.css">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login - MeusLivros</title>
</head>

<body>
    <?php require_once("./templetes/header.php"); ?>
    <main>
        <section>
            <form action="./login.php" method="post">
                <h2>LOGAR</h2>
                <p class='msg'><?php echo (isset($res)) ? $res : '';  ?></p>
                <input type="email" name="email" id="email" required placeholder="Usuario">
                <input type="password" name="senha" id="senha" required placeholder="Senha">
                <input type="submit" value="ENTRAR">
            </form>
        </section>
    </main>

</body>

</html>