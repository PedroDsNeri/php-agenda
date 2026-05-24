<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Virtual</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">

        <h1 class="main-title">
            Sistema de Agenda Online
        </h1>

        <p class="subtitle">
            Organize seus eventos e receba lembretes importantes.
        </p>

        <div class="home-card">

            <div class="buttons">

                <a href="auth/login.php">
                    <button>Fazer Login</button>
                </a>

                <a href="auth/register.php">
                    <button class="register-btn">Registrar</button>
                </a>

            </div>

        </div>

    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            const toast = document.createElement("div");
            toast.innerText = "<?php echo $_SESSION['success']; ?>";

            toast.style.position = "fixed";
            toast.style.top = "10px";
            toast.style.right = "10px";

            toast.style.padding = "20px";
            toast.style.fontSize = "18px";
            toast.style.minWidth = "250px";
            toast.style.textAlign = "center";

            toast.style.background = "#333";
            toast.style.color = "#fff";

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        </script>

        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

</body>
</html>