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
    /*    
        // foreach ($dados as $value) {
        //     echo
        //     "<li>
        //         <a href='livro.php?id={$value['id_livro']}'>
        //             <img src='../arquivos/capas/{$value['url_capa_livro']}' alt='{$value['titulo_livro']}'>
        //         </a>    
        //         <h3><a href='livro.php?id={$value['id_livro']}  '>{$value['titulo_livro']}</a></h3>
        //         <p><a href='livro.php?id={$value['id_livro']}'>Baixar ou Ler Online</a></p>
        //     </li>";
        // }
        // echo "<hr><p> <a href='SelecionarLivros.php?pagina=1'>Primeira</a> ";
        // for ($i = 1; $i <= $numPaginas; $i++) {
        //     echo ($i == $pagina) ? "<span>$i</span>" : "<a href='SelecionarLivros.php?pagina=$i'>$i</a>";
        // }
        // echo "<a href='SelecionarLivros.php?pagina=$numPaginas'>Última</a> </p>";
    */

        
        return $dados;
    }
}
// $livros = new SelecionarLivros();
// $lista = $livros->listarLivros();

// echo "<pre>";
// var_dump($lista);
// echo "</pre>";
// echo $livros->numPaginas;