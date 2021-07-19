<?php

abstract class Conexao{
    protected $pdo;
    protected function connect()
    {
        try{
            $this->pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=meuslivros','root', '');
            return $this->pdo;
        }catch(PDOException $e){
            echo"Erro no DB: {$e->getMessage()}";
        }catch(Exception $e){
            echo"Erro: {$e->getMessage()}";
        }
    }
}


   