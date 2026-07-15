<?php 

// criando a conexão
include __DIR__ . '/../db/config.php';

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $connM->query("SELECT
	cidade AS municipio,
	count(*) AS total_inscritos,
	round(count(*) * 100 / sum(count(*)) OVER(), 2) AS percentual
FROM tb_inscricoes_cnh_social
GROUP BY cidade
ORDER BY total_inscritos DESC");
//print_r($query1);


if ($query1->num_rows > 0) {
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>";
    echo "<tr>
            <th>Municipio</th>
            <th>Total de Inscritos</th>
            <th>Percentual</th>
          </tr>";

    
    while($row = $query1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["municipio"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["total_inscritos"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["percentual"]) . "</td>";
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