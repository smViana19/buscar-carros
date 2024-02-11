<?php
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de busca</title>
</head>

<body>
    <section>
    <h1>Lista de carros</h1>
    <form action="">
        <input type="text" name="busca" 
        class="txtbusca"
        value="<?php if (isset($_GET['busca'])) echo $_GET['busca']; ?>" 
        placeholder="Digite sua pesquisa">
        <button type="submit">Pesquisar</button>

    </form>
    <br>
    <div class="tabela">
    <table  border="1">
        <tr>
            <th>Marca</th>
            <th>Veículo</th>
            <th>Modelo</th>
            <th>Fabricante</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
        ?>
            <tr>
                <td colspan="4">Digite alguma coisa para pesquisar</td>
            </tr>
            <?php
        } else {
            $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * FROM veiculos 
            WHERE marca LIKE '%$pesquisa%' 
            OR veiculo LIKE '%$pesquisa%' 
            OR modelo LIKE '%$pesquisa%'
            OR fabricante LIKE '%$pesquisa%'";

            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);


            if ($sql_query->num_rows == 0) {
            ?>
                <tr>
                    <td colspan="4">Nenhum resultado encontrado</td>
                </tr>
                <?php
            } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $dados['marca'] ?></td>
                        <td><?php echo $dados['veiculo'] ?></td>
                        <td><?php echo $dados['modelo'] ?></td>
                        <td><?php echo $dados['fabricante'] ?></td>
                    </tr>
            <?php

                }
            } ?>

        <?php
        }
        ?>
    </table>
    </div>
    
    </section>
    
</body>

</html>