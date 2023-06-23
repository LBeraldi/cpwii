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
</body>

<?php
    $endereco_sgbd = 'localhost';
    $usuario = 'root';
    $senha = '';
    $nome_bd = 'cpwii';

    $conn = new mysqli($endereco_sgbd,$usuario,$senha,$nome_bd);
    $nome = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['campoNome'];
        echo 'Metodo HTTP POST executado';
        $sql = "INSERT INTO cliente (nome) VALUES ('$nome')";

        if ($conn->query($sql)){
            echo '<p>Cliente inserido.</p>';
        }else{
            echo'<p>Falha ao salvar cliente no BD.</p>';
        }

    }else{
        echo'Metodo HTTP GET executado.';
    }


    $sql = 'SELECT * FROM cliente';
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $id = $linha['id'];
            $nome = $linha['nome'];
            echo "<p>$id - $nome <input type='submit' value='remover'/></p>";
        }
    }

   /* if(isset($_POST['remover'])) {
        $remover = $_POST['remover'];
        $sqlremover = "DELETE FROM cliente WHERE id = $remover";
        
        if ($conn->query($sql)){
            echo '<p>Cliente removido.</p>';
        }else{
            echo'<p>Falha ao remover cliente do BD.</p>';  
        }
    }*/



?>

</html>