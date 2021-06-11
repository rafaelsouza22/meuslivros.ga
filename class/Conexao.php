<?php

abstract class Conexao{
    
    private const HOST = "127.0.0.1:3306";
    private const DBNAME = "meuslivros";
    private const USER = "root";
    private const PASS = "";
    protected $pdo;
    protected function conexao()
    {
        try{
            $this->pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME ,self::USER, self::PASS);
            return $this->pdo;
            

        }catch(PDOException $e){
            echo"Erro no DB: {$e->getMessage()}";
        }catch(Exception $e){
            echo"Erro: {$e->getMessage()}";
        }
    }
}

        
class Teste extends Conexao {
    $pdo = parent::conexao();
    $res = $pdo->query("SELECT url_pdf_livro , url_capa_livro WHERE id_livro = $id");
    $res->fetchObject();
}
$t = new Teste();
     
      