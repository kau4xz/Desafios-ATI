<?php 

// criando a conexão
include("config.php");

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $conn->query("SELECT nome_completo, cpf, data_nascimento, categoria_desejada FROM tb_inscricoes_cnh_social WHERE cidade = 'São Luís' ORDER BY nome_completo ASC LIMIT 10");
//print_r($query1);


if ($query1->num_rows > 0) {
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>";
    echo "<tr>
            <th>Nome Completo</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Categoria Desejada</th>
          </tr>";

    
    while($row = $query1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["nome_completo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cpf"]) . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row["data_nascimento"])) . "</td>"; 
        echo "<td>" . htmlspecialchars($row["categoria_desejada"]) . "</td>";
        echo "</tr>";
    }
    
    
    echo "</table>";

} else {
    echo "Nenhum registro encontrado";
}

// Fechando a conexão
$conn->close();
//$conn->close()
?>