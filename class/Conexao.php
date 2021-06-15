<?php

 class Conexao{
    
    private const HOST = "127.0.0.1:3306";
    private const DBNAME = "meuslivros";
    private const USER = "root";
    private const PASS = "";
    protected $pdo;
    public function conexao()
    {
        try{
            $this->pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=meuslivros','root', '');
            //$this->pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME ,self::USER, self::PASS);
            // if($this->pdo){
            //     echo "ok";
            // }else{
            //     echo "ERRO";
            // }
            return $this->pdo;
            

        }catch(PDOException $e){
            echo"Erro no DB: {$e->getMessage()}";
        }catch(Exception $e){
            echo"Erro: {$e->getMessage()}";
        }
    }
}
// $con = new Conexao();
// var_dump($con->conexao());

   