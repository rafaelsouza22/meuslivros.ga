<?php

require_once("Conexao.php");
class BuscarLivro extends Conexao
{
    public $numPaginas;
    public $pagina;

    public function buscar($texto)
    {
        $textoLimpo = filter_var($texto, FILTER_SANITIZE_STRING);
        $busca = "%$textoLimpo%";

        // pega o total de livros achados
        $pdo = parent::connect();

        $res = $pdo->prepare("SELECT id_livro FROM livros WHERE titulo_livro like :b");
        $res->bindParam(":b", $busca);
        $res->execute();
        $total = $res->rowCount();
        

        // retorna os livros achados paginados
        if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
            $this->pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
        } else {
            $this->pagina = 1;
        }

        $registros = 12;
        $this->numPaginas = intval(ceil($total / $registros)) ;
        $inicio = ($registros *  $this->pagina) - $registros;

        $sql = "SELECT * FROM livros WHERE titulo_livro like :b LIMIT $inicio, $registros";
        $con = $pdo->prepare($sql);
        $con->bindParam(":b", $busca);
        $con->execute();

        $dados = array();
        if ($con->rowCount() > 0) {
            $dados[] = $con->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        } else {
            return $dados;
        }
    }
}
// $buscar = 'a';
// $buscarLivros = new BuscarLivro();
// $livros = $buscarLivros->buscar($buscar);

// echo "<pre>";
// var_dump($livros);
// echo "</pre>";