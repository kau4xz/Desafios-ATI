<?php declare(strict_types=1);

//Array com números de 1 a 31 de forma aleatória
$listaDeNumeros = [19, 26, 18, 1, 24, 2, 4, 25, 3, 5, 20, 28, 23, 9, 10, 27, 6, 15, 16, 7, 14, 30, 21, 13, 17,29, 12, 11, 22, 8, 31];


//function achar_numero2
function achar_numero2($parametro, $listaDeNumeros){


    if($parametro < 1 || $parametro > 31){

        echo "O Número $parametro não está contido no array de 0 a 31";

    } else {
        foreach($listaDeNumeros as $indice => $valor){
            //Vou deixar o var_dump comentado para não atrapalhar a vizualização da saída 
            var_dump($listaDeNumeros[$indice]);

            if ($parametro === $valor){
                echo "O número $parametro está no índice $indice";
               return;
            }
       
        }
    }
}

achar_numero2(5, $listaDeNumeros);


//early return