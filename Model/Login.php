<?php

require_once("Conexao.php");
class Login extends Conexao
{

    public function logar($usuario)
    {
        $email = addslashes($usuario['email']);
        $senha = addslashes($usuario['senha']);
        // VERIFICANDO SE EXISTE O EMAIL NO BANCO DE DADOS
        $sql = "SELECT id_usuario, nome_usuario, email_usuario, senha_usuario FROM usuarios WHERE email_usuario = :email ";
        $pdo = parent::connect();
        $con = $pdo->prepare($sql);
        $con->bindValue(':email', $email);
        $con->execute();

        if($con->rowCount() == 1){
            // COMPARANDO EMAIL E SENHA
            $res = $con->fetch(PDO::FETCH_ASSOC);
            if( ($email == $res['email_usuario'] ) &&  (password_verify($senha , $res['senha_usuario'])) ){
                //session_start();
                $_SESSION['id_usuario'] = $res['id_usuario'];
                $_SESSION['email_usuario'] = $res['email_usuario'];
                header('Location: ./cadastrar.php');
                
            }else{
                return"Login ou Senha invalida";
            }
        }else{
            return "Email não tem cadastro!";
        }
    }
}

