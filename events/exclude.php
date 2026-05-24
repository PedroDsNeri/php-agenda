<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['events'])) {
        foreach($_POST['events'] as $index){
            unset($_SESSION['events'][$index]);
        }
        $_SESSION['events'] = array_values($_SESSION['events']);
    }
    header("Location: dashboard.php");
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
    <a href="dashboard.php" class="back-btn">
    Voltar
</a>
    <h2>Qual evento deseja excluir ?</h2>
    <?php
        if(!isset($_SESSION['events']) || empty($_SESSION['events'])) {
            echo 'Nenhum evento encontrado.';
        } else {
            echo "<form method='POST'>";

            foreach($_SESSION['events'] as $index => $event) {
                echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";

                echo "<input type='checkbox' name='events[]' value='$index'>";

                echo "<strong>" . $event['title'] . "</strong><br>";
                echo $event['description'] . "<br>";
                echo "Data: " . $event['event_date'] . "<br>";
                echo "Lembrete: " . $event['reminder_at'];

                echo "</div>";
            }

            echo "<input type='submit'>"; 
            echo "</form>";
        }
    ?>
</body>
</html>



