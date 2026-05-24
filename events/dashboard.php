<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    header('Location: ../index.php');
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

    <form action="dashboard.php" method="POST" class="logout-form">
        <button type="submit" name="logout" class="logout-btn">
            Logout
        </button>
    </form>

    <div class="dashboard-wrapper">

        <h1 class="dashboard-title">Meus Eventos</h1>

        <?php
            if (!isset($_SESSION['events']) || empty($_SESSION['events'])) {
                echo "<div class='empty-message'>Nenhum evento encontrado.</div>";
            } else {

                echo "<div class='event-list'>";

                foreach($_SESSION['events'] as $event) {

                    echo "<div class='event-card'>";

                    echo "<h2 class='event-title'>" . htmlspecialchars($event['title']) . "</h2>";

                    echo "<p class='event-description'>" . htmlspecialchars($event['description']) . "</p>";

                    echo "<p class='event-date'><strong>Data:</strong> " . $event['event_date'] . "</p>";

                    echo "<p class='event-reminder'><strong>Lembrete:</strong> " . $event['reminder_at'] . "</p>";

                    echo "</div>";
                }

                echo "</div>";
            }
        ?>

        <div class="dashboard-actions">

            <a href="create.php">
                <button>Criar novo evento</button>
            </a>

            <a href="edit.php">
                <button class="secondary-btn">Editar evento</button>
            </a>

            <a href="exclude.php">
                <button class="logout-btn">Excluir evento</button>
            </a>

        </div>

    </div>

    <?php if(isset($_SESSION['success'])): ?>

        <script>
            const toast = document.createElement("div");
            toast.innerText = "<?= $_SESSION['success']; ?>";

            toast.style.position = "fixed";
            toast.style.top = "10px";
            toast.style.right = "10px";

            toast.style.padding = "20px";
            toast.style.fontSize = "18px";
            toast.style.minWidth = "250px";
            toast.style.textAlign = "center";

            toast.style.background = "#2ecc71";
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
