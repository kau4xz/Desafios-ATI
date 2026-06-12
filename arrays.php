<?php declare(strict_types=1);

//Array com números de 1 a 31 de forma aleatória
$listaDeNumeros = [19, 26, 18, 1, 24, 2, 4, 25, 3, 5, 20, 28, 23, 9, 10, 27, 6, 15, 16, 7, 14, 30, 21, 13, 17,29, 12, 11, 22, 8, 31];


// function achar_numero 1
// Nesta Versão o tratamento de erros ainda não estava bem resolvido, pois ele se o número fosse desconhecido ele ainda percorria o array utilizando o foreach assim comparando o parametro passado com cada item do array, o que acabava retornando 31 "Números Desconhecidos"

function achar_numero($parametro, $listaDeNumeros){

    //Utilização do foreach para percorrer os valores do array
    foreach($listaDeNumeros as $indice => $valor){
        
        //verificação do parâmetro em relação ao valor no indice
        if ($parametro == $valor ){
                echo "O número $parametro está no índice $indice";

            //tentativa de tramento de erro, onde números maiores que 31 e menores 0 entrrariam como "números desconhecidos"
            } elseif ($parametro < 0 || $parametro > 31){
                echo "Número Desconhecido";
            } else {
                echo "";
        }
    };

}

//achar_numero(6, $listaDeNumeros);


//function achar_numero2
function achar_numero2($parametro, $listaDeNumeros){


    if($parametro < 1 || $parametro > 31){

        echo "O Número $parametro não está contido no array de 0 a 31";

    } else {
        foreach($listaDeNumeros as $indice => $valor){
            //Vou deixar o var_dump comentado para não atrapalhar a vizualização da saída 
            //var_dump($listaDeNumeros[$indice]);

            if ($parametro === $valor){
                echo "O número $parametro está no índice $indice";
                return;
            }
       
        }
    }
}

achar_numero2(5, $listaDeNumeros);


//early return