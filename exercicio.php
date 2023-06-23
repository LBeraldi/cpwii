<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="campoNome">Nome:</label>
        <input name="campoNome">
        <input type="submit" value="Salvar"/>
    </form>

    <?php
        $endereco_sgbd = 'localhost';
        $usuario = 'root';
        $senha = '';
        $nome_bd = 'cpwii';

        $conn = new mysqli($endereco_sgbd,$usuario,$senha,$nome_bd);
        $nome = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'Metodo HTTP POST executado';

            if(!isset($_POST['remover'])) {
                // inserir
                $nome = $_POST['campoNome'];
                $sql = "INSERT INTO cliente (nome) VALUES ('$nome')";

                if ($conn->query($sql)){
                    echo '<p>Cliente inserido.</p>';
                } else {
                    echo'<p>Falha ao salvar cliente no BD.</p>';
                }
            } else {
                //remover
                $remover = $_POST['remover'];
                $sql = "DELETE FROM cliente WHERE id = $remover";
                
                if ($conn->query($sql)){
                    echo '<p>Cliente removido.</p>';
                } else {
                    echo'<p>Falha ao remover cliente do BD.</p>';  
                }
            }

        } else {
            echo'Metodo HTTP GET executado.';
        }

        $sql = 'SELECT * FROM cliente';
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                $id = $linha['id'];
                $nome = $linha['nome'];

                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='remover' value='$id' />";
                echo "<p>$id - $nome <input type='submit' value='remover' /></p>";
                echo "</form >";
            }
        } else {
            echo "<p>Nenhum resultado encontrado!</p>";
        }
    ?>
</body>

</html>