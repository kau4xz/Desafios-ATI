<?php 

// criando a conexão
include __DIR__ . '/../db/config.php';

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $connM->query("SELECT cidade AS municipio, count(*) AS total_municipio 
                        FROM tb_inscricoes_cnh_social
                        GROUP BY cidade
                        HAVING count(*) < 1000
                        ORDER BY total_municipio DESC");
//print_r($query1);


if ($query1->num_rows > 0) {
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>";
    echo "<tr>
            <th>Municipio</th>
            <th>Total de Inscritos</th>
          </tr>";

    
    while($row = $query1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["municipio"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["total_municipio"]) . "</td>";
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