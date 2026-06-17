<?php declare(strict_types=1);

$matriz = [
     1 => [1 => 0 , 2 => 1 , 3 => 0, 4 => 0, 5 => 1 ],
];


function consultarAssento( $linha, $coluna){
    
    $matriz = [
        1 => [1 => 0 , 2 => 1 , 3 => 1, 4 => 1, 5 => 1 ],
        2 => [1 => 1 , 2 => 0 , 3 => 1, 4 => 0, 5 => 1 ],
        3 => [1 => 1 , 2 => 0 , 3 => 0, 4 => 1, 5 => 0 ],
        4 => [1 => 0 , 2 => 0 , 3 => 1, 4 => 0, 5 => 1 ],
        5 => [1 => 1 , 2 => 1 , 3 => 0, 4 => 0, 5 => 0 ],
    ];

    if(!isset($matriz[$linha][$coluna])){

        return  "[$linha] [$coluna] POSIÇÃO INVÁLIDA";

    } 
    elseif ($matriz[$linha][$coluna] === 0){

        return "O assento [$linha] [$coluna] está LIVRE";

    } 
    else {

        return "O Assento [$linha] [$coluna] está OCUPADO";     
    };
}



function exibirSituacao($linha, $coluna){
    
    echo consultarAssento($linha, $coluna);

}

exibirSituacao(-1,1);