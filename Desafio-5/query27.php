<?php 

// criando a conexão
include("config.php");

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $connM->query("	SELECT 
    CASE
        when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
	  	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
	    ELSE '60 ou mais'
        END AS faixa_etaria,
    COUNT(*) AS inscritos_faixa_etaria,
    ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
FROM tb_inscricoes_cnh_social
GROUP BY faixa_etaria
ORDER BY percentual_faixa_etaria desc");
//print_r($query1);


if ($query1->num_rows > 0) {
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>";
    echo "<tr>
            <th>Faixa Etária</th>
            <th>Inscritos</th>
            <th>Percentual</th>
          </tr>";

    
    while($row = $query1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["faixa_etaria"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["inscritos_faixa_etaria"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["percentual_faixa_etaria"]) . "</td>";
        echo "</tr>";
    }
    
    
    echo "</table>";

} else {
    echo "Nenhum registro encontrado";
}

// Fechando a conexão
$connM->close();
//$conn->close()
?>