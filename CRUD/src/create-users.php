<?php

//referenciando a conexão com banco de dados ("importando")
require_once __DIR__ . '/../db/connect-db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // captura os 10 campos
    $nome_completo = trim($_POST['nome_completo'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');;
    $email = trim($_POST['email'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');
    $estado = trim($_POST['estado'] ?? '');
    $cidade = trim($_POST['cidade'] ?? '');
    $bairro = trim($_POST['bairro'] ?? '');
    $complemento = trim($_POST['complemento'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
}

if(!empty($nome_completo) && !empty($email) && !empty($telefone) && !empty($cpf) && !empty($data_nascimento) &&  !empty($estado) && !empty($cidade) && !empty($senha)){
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $connM->prepare("INSERT INTO tb_users (nome_completo, cpf, telefone, email, data_nascimento, estado, cidade, bairro, complemento, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssss", $nome_completo, $cpf, $telefone, $email, $data_nascimento, $estado, $cidade, $bairro, $complemento, $senha_hash);

    if ($stmt->execute()) {
            // Sucesso! Redireciona de volta para o index com uma mensagem
            header("Location: /Desafios-ATI/CRUD/src/teste.php?msg=criado");
            exit;
        } else {
            $erro = "Erro ao cadastrar no banco de dados.";
        }
        $stmt->close();
    } else {
        $erro = "Por favor, preencha nome, e-mail e senha.";
}
?>


<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="/Desafios-ATI/CRUD/styles/styles-create.css">
    <link rel="icon" type="image/x-icon" href="/Desafios-ATI/CRUD/assets/favicon.ico">
    
</head>
<body>
    <div class="container">
        <h2>Criar Cadastro</h2>

        <?php if ($erro): ?>
            <div class="alert-error">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="/Desafios-ATI/CRUD/src/create-users.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nome Completo *</label>
                    <input type="text" name="nome_completo" required>
                </div>
                <div class="form-group">
                    <label>E-mail *</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" maxlength="11">
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone" maxlength="11">
                </div>
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input type="date" name="data_nascimento">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <input type="text" name="estado" maxlength="50">
                </div>
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="cidade" maxlength="50">
                </div>
                <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" name="bairro" maxlength="50">
                </div>
                <div class="form-group full-width">
                    <label>Complemento</label>
                    <input type="text" name="complemento" maxlength="50">
                </div>
                <div class="form-group full-width">
                    <label>Senha *</label>
                    <input type="password" name="senha" required>
                </div>
            </div>
            
            <div class="actions">
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>