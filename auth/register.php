<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $_SESSION['user'] = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $hashedPassword
    ];

    $_SESSION['success'] = "Registrado com sucesso!";
    
    header("Location: ../index.php");
    exit();
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

    <br><br>

    <form method="POST">

        <input type="text" name="name" placeholder="Nome" required><br><br>

        <input type="email" name="email" placeholder="E-mail" required><br><br>

        <input type="password" name="password" placeholder="Senha" required><br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>