<?php declare(strict_types=1);



$matriz = [
        '1' => [1, 0, 1, 1, 0],
        '2' => [0, 1, 0, 1, 0],
        '3' => [0, 1, 1, 1, 0],
        '4' => [1, 0, 0, 0, 1],
        '5' => [0, 1, 0, 0, 1],
    ];  
function consultarAssento($matriz, $linha, $coluna){
  
    if ($matriz[$linha][$coluna] == 0) {
          
        return "<a>Assento [$linha] [$coluna] está Livre </br> </a>";

    } elseif ($matriz[$linha][$coluna] == 1){
       
        return "<a>Assento [$linha] [$coluna] está Ocupado </br> </a>";
    
    }  else {

        return "Assento Inválido";
    }
        
}

// consultarAssento($matriz, 1, 1);

function exibirSituacao($matriz, $linha, $coluna){
    
    echo consultarAssento($matriz, $linha, $coluna);

}

exibirSituacao($matriz, 9, 1);