<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['user'])) {

        echo 'Usuário não cadastrado.';

        echo "
            <a href='login.php'>
                <input type='button' value='Back'/>
            </a>
        ";

        exit();
    }

    $emailCorrect = $_POST['email'] == $_SESSION['user']['email'];

    $passwordCorrect = password_verify(
        $_POST['password'],
        $_SESSION['user']['password']
    );

    if ($emailCorrect && $passwordCorrect) {

        $_SESSION['logged'] = true;

        header("Location: ../events/dashboard.php");
        exit();

    } else {

        echo 'EMAIL/SENHA inválidos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <a href="../index.php" class="back-btn">
    Voltar
</a>

    <h2>Login</h2>

    <form method="POST">

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>

    </form>
</body>
</html>