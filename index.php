<?php
    require_once 'db_link.php';
    session_start();

    if(isset($_POST['enviar-login'])){
        $erros = [];
        
        $login = mysqli_real_escape_string($conex, $_POST['login']);
        $senha = mysqli_real_escape_string($conex, md5($_POST['senha']));

        if(empty($login) or empty($senha)){
            $erros[] = "<li>ta chapando, Zé?</li>";
        } else {
            $sql = "SELECT login FROM usuarios WHERE login = '$login'";
            $result = mysqli_query($conex, $sql);

            if(mysqli_num_rows($result) > 0){
                $sql = "SELECT * FROM usuarios WHERE login = '$login' and senha = '$senha'";
                $result = mysqli_query($conex, $sql);

                if(mysqli_num_rows($result) == 1){
                    $data = mysqli_fetch_array($result);
                    mysqli_close($conex);
                    $_SESSION['login'] = $data['login'];
                    $_SESSION['id_usuario'] = $data['id']; // Usando 'id_usuario' aqui

                    header('Location: main.php');
                } else {
                    $erros[] = "<li>Senha e usuário não batem</li>";
                }
            } else {
                $erros[] = "<li>Quem é esse maluco? kkk</li>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <center>
            <h1>Login</h1>
            <?php
                if(!empty($erros)){
                    foreach($erros as $erro){
                        echo "Ta errado aqui: $erro";
                    }
                }
            ?>
            <p>Login: <input type="text" name="login"></p>
            <p>Senha: <input type="password" name="senha"></p>
            <button type="submit" name="enviar-login">Entrar</button>
        </center>
    </form>
</body>
</html>
