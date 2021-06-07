<?php
// Verifica se existe o diretorio/pasta
//is_dir(DIRETORIO);

// criando um diretorio/pasta
// mkdir(DIRETORIO,  ACESSO, RECURSIVO);

// le todos os diretorios da aplicação
// scandir();


// rmdir();


// criando um diretorio

// $dir = 'produtos/mouse/usados';
$dir = './teclado';
// Verificando se o diretorio não existe
// if(!is_dir($dir)){
//     // criando um diretorio
//     mkdir($dir, 0777, true);  
// }

// listando os diretorios e removendo os pontos da lista
$lista = array_diff(scandir($dir) , ['.','..','diretorios.php']);
// percorrendo todos os diretorios da lista
foreach($lista as $diretorio ){
    echo"{$diretorio}<br>";
}

// deletando diretorios/pasta que estão vazios
rmdir($dir);