<?php 
/*


try {
    // 1. Cria a string de conexão (DSN - Data Source Name)
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    
    // 2. Instancia o objeto PDO
    $conn = new PDO($dsn, $username, $password);
    
    // 3. Configura o PDO para relatar erros disparando exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Sucesso! A conexão com o banco de dados via PDO foi estabelecida.";
    

    $sql=$conn->prepare("SELECT nome_completo, cpf, data_nascimento, categoria_desejada FROM tb_inscricoes_cnh_social WHERE cidade = 'São Luís' ORDER BY nome_completo ASC LIMIT 100" );
    $sql->execute();

    $dados = $sql-> fetchAll(PDO::FETCH_ASSOC);
    print_r($dados);
} catch(PDOException $e) {
    // 4. Captura e exibe a mensagem caso a conexão falhe
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

// Opcional: No PDO, para fechar a conexão, basta atribuir 'null' à variável
// $conn = null; */








// criando a conexão
include("config.php");
// verficando a conexão
if ($mysqli->connect_error){
    die("Falha na conexão: ".$mysqli->connect_error);
}

//echo "conexão realizada com sucesso";



// primeira query
$query1 = $mysqli->query("SELECT nome_completo, cpf, data_nascimento, categoria_desejada FROM tb_inscricoes_cnh_social WHERE cidade = 'São Luís' ORDER BY nome_completo ASC LIMIT 10");
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
$mysqli->close();
//$mysqli->close()
?>