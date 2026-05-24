<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    header("Location: ../index.php");
    exit();
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $reminder_at = $_POST['reminder_at'];

    
    if (empty($title)) {
        $_SESSION['error'] = "O título não pode estar vazio.";
    }

    
    elseif (empty($event_date)) {
        $_SESSION['error'] = "A data do evento é obrigatória";
    }

    
    elseif (!empty($reminder_at) && $reminder_at > $event_date) {

        $_SESSION['error'] = "O lembrete não pode ser depois da data do evento.";

    } else {
        $_SESSION['events'][] = [
        'title' => htmlspecialchars($title),
        'description' => htmlspecialchars($description),
        'event_date' => $event_date,
        'reminder_at' => $reminder_at
        ];

    
        header("Location: dashboard.php");
        exit();

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

<a href="dashboard.php" class="back-btn">
    Voltar
</a>

<br><br>

<h2>Criar Evento</h2>

<form method="POST">

    <label>Título</label><br>

    <input 
        type="text" 
        name="title"
        value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>"
    >

    <br><br>

    <label>Descrição</label><br>

    <textarea name="description"><?php
        echo isset($_POST['description']) 
            ? htmlspecialchars($_POST['description']) 
            : '';
    ?></textarea>

    <br><br>

    <label>Data do evento</label><br>

    <input 
        type="datetime-local"
        name="event_date"
        value="<?php echo isset($_POST['event_date']) ? $_POST['event_date'] : ''; ?>"
    >

    <br><br>

    <label>Lembrete</label><br>

    <input 
        type="datetime-local"
        name="reminder_at"
        value="<?php echo isset($_POST['reminder_at']) ? $_POST['reminder_at'] : ''; ?>"
    >

    <br><br>

    <button type="submit">Salvar Evento</button>

</form>

<?php if(isset($_SESSION['error'])): ?>
    <script>
        const toast = document.createElement("div");
        toast.innerText = "<?php echo $_SESSION['error']; ?>";

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