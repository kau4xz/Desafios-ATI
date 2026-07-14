<?php 

// criando a conexão
include __DIR__ . '/../db/config.php';

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $connM->query("SELECT 
	date(created_at), count(*) AS total_inscricoes,
	round(count(*) * 100 / sum(count(*)) OVER (), 2) AS percentual
FROM tb_inscricoes_cnh_social
GROUP BY date(created_at)
ORDER BY total_inscricoes DESC
LIMIT 30");
//print_r($query1);


if ($query1->num_rows > 0) {
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>";
    echo "<tr>
            <th>Data de </th>
            <th>Total de Inscritos</th>
            <th>Percentual</th>
          </tr>";

    
    while($row = $query1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["date(created_at)"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["total_inscricoes"]) . "</td>";
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