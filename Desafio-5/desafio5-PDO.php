<?php 


include("config.php");

try {
    
    
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
// $conn = null; 

?>