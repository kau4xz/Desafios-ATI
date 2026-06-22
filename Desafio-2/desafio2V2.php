<?php declare(strict_types=1);

$matriz = [
    1 => [1 => 1, 2 => 0, 3 => 1, 4 => 1, 5 => 0],
    2 => [1 => 0, 2 => 1, 3 => 0, 4 => 1, 5 => 0],
    3 => [1 => 0, 2 => 1, 3 => 1, 4 => 1, 5 => 0],
    4 => [1 => 1, 2 => 0, 3 => 0, 4 => 0, 5 => 1],
    5 => [1 => 0, 2 => 1, 3 => 0, 4 => 0, 5 => 1],
];

function consultarAssento( $matriz, $linha, $coluna){
    if (!isset($matriz[$linha][$coluna])) {
        return "Assento [$linha][$coluna] é inválido.<br>";
    }

    if ($matriz[$linha][$coluna] === 1) {
        return "Assento [$linha][$coluna] está Ocupado.<br>";
    }

    return "Assento [$linha][$coluna] está Livre.<br>";
}

function exibirSituacao($matriz,  $linha, $coluna){
    echo consultarAssento($matriz, $linha, $coluna);
}

exibirSituacao($matriz, 5, 5); 
