<?php
require_once('db_link.php');
session_start();

if(!isset($_SESSION['login'])){
    header("Location: index.php");
}

$id = $_SESSION['id_usuario']; // Obtendo o ID do usuário da sessão

// Executando a consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$result = mysqli_query($conex, $sql);
$data = mysqli_fetch_array($result);
$nome = $data['nome'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
</head>
<body>
    <center>
        <h1>Seja bem-vindo, <?php echo $data['nome']; ?>!</h1> 
        <a href="logout.php">SAiR</a>
    </center>
</body>
</html>
