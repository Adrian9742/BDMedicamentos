<?php
// Incluindo o arquivo de configuração do banco de dados
include("conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="Imagens/style.css">  
</head>

<body>
 
    <h1>Lista de Medicamentos</h1>

    <!-- Formulário de busca -->
    <form action="" method="GET">
        <input name="busca" placeholder="Digite os termos de pesquisa" type="text" required>
        <button type="submit">Pesquisar</button>
    </form>

    <br>

    <!-- Tabela para exibir resultados -->
    <table width="700" border="1">
        <tr>
            <th>ID</th>
            <th>Nome Comercial</th>
            <th>Nome Original</th>
            <th>Grupo Do Medicamento</th>
            <th>Efeito</th>
            <th>Composição</th>
        </tr>

        <?php
        // Verificando se a pesquisa foi enviada
        if (isset($_GET['busca']) && !empty($_GET['busca'])) {
            // Protegendo a entrada do usuário contra injeção de SQL
            $pesquisa = $conexao->real_escape_string($_GET['busca']);

            // Consulta SQL para buscar os medicamentos
            $sql_code = "SELECT * FROM cadastro 
                         WHERE ID LIKE '%$pesquisa%'
                         OR Nome_Comercial LIKE '%$pesquisa%'
                         OR Nome_Original LIKE '%$pesquisa%'
                         OR Grupos_de_Medicamentos LIKE '%$pesquisa%'
                         OR Efeito_do_Medicamento LIKE '%$pesquisa%'
                         OR Composição LIKE '%$pesquisa%'";

            // Executando a consulta
            $sql_query = $conexao->query($sql_code) or die("Erro ao consultar: " . $conexao->error);

            // Verificando se retornou algum resultado
            if ($sql_query->num_rows == 0) {
                echo '<tr><td colspan="6">Nenhum resultado encontrado.</td></tr>';
            } else {
                // Exibindo os resultados na tabela
                while ($dados = $sql_query->fetch_assoc()) {
                    echo "<tr>
                            <td>{$dados['ID']}</td>
                            <td>{$dados['Nome_Comercial']}</td>
                            <td>{$dados['Nome_Original']}</td>
                            <td>{$dados['Grupos_de_Medicamentos']}</td>
                            <td>{$dados['Efeito_do_Medicamento']}</td>
                            <td>{$dados['Composição']}</td>
                          </tr>";
                }
            }
        } else {
            // Caso a pesquisa esteja vazia
            echo '<tr><td colspan="6">Digite algo para pesquisar.</td></tr>';
        }
        ?>

    </table>
</body>

</html>
