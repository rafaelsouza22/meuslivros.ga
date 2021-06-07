<?php
/**  manipulando arquivos e diretorios */ 
// fopen(arquivo, permição para escirta/leitura ); abre o arquivo
// fwrite(arquivo, conteudo); escreve no arquivo
// fclose(arquivo); fecha o arquivo
// rename(local, destino)
// feof(ARQUIVO) // checa se o ponteiro esta no fim do arquivo
// fgets(ARQUIVO); //  lendo cada linha do arquivo
// file_get_contents(ARQUIVO)

$dir = 'produtos/';
mkdir($dir , 0777);
rename("./2021-06-07-01-13-39.txt" , "$dir/produtos/monitor/2021-06-07-01-13-39.txt" );

// CRIANDO O ARQUIVO
// $dir = './produtos/mesa';
// if(!is_dir($dir)){
//     mkdir($dir , 0777);
// }

// // ESCREVENDO NO ARQUIVO CRIADO
// $nome_arquivo = date('Y-m-d-H-i-s').'.txt';
// $arquivo = fopen($nome_arquivo , 'w+');
// fwrite($arquivo, "RAFAEL linha 1".PHP_EOL);
// fwrite($arquivo,"minha string 1 \nminha string 2");
// fclose($arquivo);


// // MOVENDO O ARQUIVO
// $move_arquivo = "$dir/$nome_arquivo";
// rename($nome_arquivo, $move_arquivo);

// // LENDO O ARQUIVO

// if( file_exists($move_arquivo) && is_file($move_arquivo) ){
//     fopen($move_arquivo,'r');
//     echo file_get_contents($move_arquivo);
//     // $ler_arquivo = fopen($move_arquivo,'r');
//     // while(!feof($ler_arquivo)){
//     //     echo fgets($ler_arquivo);
//     // }
//     // fclose($ler_arquivo);
// }

// // 

   




