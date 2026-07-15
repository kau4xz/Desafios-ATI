
<?php
// vamos "importar" a config do bd e as querys


include __DIR__ . '/../db/config.php';
include __DIR__ . '/../querys/querys.php';

// descobre qual query vai ser apresentada
$id_atual = $_GET['id'] ?? 1;
$relatorio = $querys[$id_atual];

// manda a query para o bd
$resultado = $connM->query($relatorio['sql']);
?>
<?php

// 3. Descobre qual query o usuário quer ver. 
// O "??" significa: se não tiver 'id' na URL, use o 1.
$id_atual = $_GET['id'] ?? 1;
$relatorio = $querys[$id_atual];

// 4. Manda a query pro banco de dados
$resultado = $connM->query($relatorio['sql']);
?>

<!DOCTYPE html>
<html>
<body>

    <div style="margin-bottom: 20px;">
        <form method="GET" action="">
            <label for="seletor_query"><strong>Selecione o Relatório: </strong></label>
            
            <select name="id" id="seletor_query" onchange="this.form.submit()" style="padding: 5px; font-size: 16px;">
                <?php foreach ($querys as $id => $dados): ?>
                    
                    <?php $selecionado = ($id == $id_atual) ? 'selected' : ''; ?>
                    
                    <option value="<?= $id ?>" <?= $selecionado ?>>
                        <?= htmlspecialchars($dados['titulo']) ?>
                    </option>
                    
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <h3><?= $relatorio['titulo'] ?></h3>

    <table border="1", display: flex, align-itens: center,  justify-content: center; style="border-collapse: collapse; width: 90%; text-align: center; margin: 0 auto;">
        <?php 
        $cabecalho_feito = false; // "Interruptor" para saber se já fizemos o cabeçalho
        
        while ($linha = $resultado->fetch_assoc()) {
            
            // Desenha os <th> (títulos) apenas na primeira vez que o loop rodar
            if ($cabecalho_feito == false) {
                echo "<tr>";
                foreach (array_keys($linha) as $coluna) {
                    echo "<th>$coluna</th>";
                }
                echo "</tr>";
                
                $cabecalho_feito = true; // Desliga o interruptor para não repetir os títulos
            }
            
            // Desenha os <td> (dados) para todas as linhas
            echo "<tr>";
            foreach ($linha as $dado) {
                echo "<td>$dado</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>