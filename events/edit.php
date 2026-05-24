<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != True) {
    header("Location: ../index.php");
    exit();
}



if (isset($_POST['update'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $reminder_at = $_POST['reminder_at'];

    $index = $_POST['index'];

    if (empty($title)) {
        $_SESSION['error'] = "O título não pode estar vazio.";
    } 
    elseif (empty($event_date)) {
        $_SESSION['error'] = "A data do evento é obrigatória";
    } 
    elseif (!empty($reminder_at) && $reminder_at > $event_date) {
        $_SESSION['error'] = "O lembrete não pode ser depois da data do evento.";
    } 
    else {
        $_SESSION['events'][$index] = [
            'title' => $title,
            'description' => $description,
            'event_date' => $event_date,
            'reminder_at' => $reminder_at
        ];

        $_SESSION['success'] = "Evento atualizado com sucesso!";

        header("Location: dashboard.php");
        exit();
    }

    $event = [
        'title' => $title,
        'description' => $description,
        'event_date' => $event_date,
        'reminder_at' => $reminder_at
    ];
    
} elseif (isset($_POST['event_index'])) {
    $index = $_POST['event_index'];
    $event = $_SESSION['events'][$index];
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
    <a href="dashboard.php" class="back-btn">Voltar</a>

    <?php if(isset($event)): ?>

    <h2>Editar Evento</h2>

    <form method='POST'>
        <input type="hidden" name="index" value="<?php echo $index; ?>">

        <label>Título</label><br>
        <input type="text" name="title" value="<?php echo $event['title']; ?>"><br><br>

        <label>Descrição</label><br>
        <textarea name="description"><?php echo $event['description']; ?></textarea><br><br>

        <label>Data</label><br>
        <input type="datetime-local" name="event_date" value="<?php echo $event['event_date']; ?>"><br><br>

        <label>Lembrete</label><br>
        <input type="datetime-local" name="reminder_at" value="<?php echo $event['reminder_at']; ?>"><br><br>

        <a href="dashboard.php"><input type="button" value="Cancelar"></a>
        <button type="submit" name="update">Atualizar</button>
    </form>


    <?php endif; ?>


    <?php
        if (!isset($event)) {
            echo "<h1>Qual evento você deseja editar ?</h1>";
            if(!isset($_SESSION['events']) || empty($_SESSION['events'])) {
                echo 'Nenhum evento encontrado.';
            } else {
                echo "<form method='POST'>";

                foreach($_SESSION['events'] as $index => $event) {
                    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";

                    echo "<input type='radio' name='event_index' value='$index'>";

                    echo "<strong>" . $event['title'] . "</strong><br>";
                    echo $event['description'] . "<br>";
                    echo "Data: " . $event['event_date'] . "<br>";
                    echo "Lembrete: " . $event['reminder_at'];

                    echo "</div>";
                }

                echo "<input type='submit'>"; 
                echo "</form>";
            }
        }
        ?>

    <?php if(isset($_SESSION['error'])): ?>

        <script>
            const toast = document.createElement("div");
            toast.innerText = "<?= $_SESSION['error']; ?> ";

            toast.style.position = "fixed";
            toast.style.top = "10px";
            toast.style.right = "10px";

            toast.style.padding = "20px";
            toast.style.fontSize = "18px";
            toast.style.minWidth = "250px";
            toast.style.textAlign = "center";

            toast.style.background = "#c0392b";
            toast.style.color = "#fff";

            document.body.appendChild(toast);
            setTimeout(() => {
               toast.remove();
            }, 3000);

        </script>

        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>


</body>
</html>
