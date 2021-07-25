<?php
require_once("Conexao.php");

class SelecionarLivros extends Conexao
{
    public $numPaginas;
    public $pagina;

    public function listarLivros()
    {
        $pdo = parent::connect();
        $res = $pdo->query("SELECT id_livro FROM livros");
        $total = $res->rowCount();
        // $res->execute();
        

        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $this->pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
        } else {
            $this->pagina = 1;
        }

        $registros = 12;
        $this->numPaginas = intval(ceil($total / $registros)) ;
        $inicio = ($registros *  $this->pagina) - $registros;
        
        $cmd = "SELECT * FROM livros LIMIT $inicio, $registros";
        $req = $pdo->query($cmd);
        $total = $req->rowCount();        

        if ($req->rowCount() > 0) {
            $dados = $req->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $dados = array();
        }        
        return $dados;
    }
}
