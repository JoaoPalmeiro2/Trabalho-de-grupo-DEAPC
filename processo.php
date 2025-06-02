<?php

session_start();

$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "deapc";        

$conn = new mysqli($servername, $username, $password, $dbname);

$resultado = "";
$erro = "";

// Se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test_drive_date = $_POST['test_drive_date']; 
    $car_model = $_POST['car_model'];             
    $process_type = $_POST['process_type'];       

    $sql = "INSERT INTO processo (tipo, data_test_drive) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $process_type, $test_drive_date);

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        $resultado = "✅ Test Drive para o modelo <strong>" . htmlspecialchars($car_model) . "</strong> agendado com sucesso para <strong>" . htmlspecialchars($test_drive_date) . "</strong>.<br>ID do Processo: <strong>$last_id</strong>";
    } else {
        $erro = "Erro ao agendar Test Drive: " . $stmt->error;
    }

    $stmt->close();
} else {
    $erro = "Método de requisição inválido. Por favor, utilize o formulário no catálogo.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <title>Test Drive - SIT</title>
    <link rel="stylesheet" href="styles/style.css" />
    <style>
      .mensagem {
        margin: 2rem auto;
        padding: 1.5rem;
        max-width: 600px;
        background-color: #f5f5f5;
        border-left: 5px solid #4CAF50;
        font-family: Arial, sans-serif;
        font-size: 1rem;
        color: #333;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 6px;
      }

      .erro {
        border-left-color: #f44336;
        background-color: #ffe6e6;
      }

      .mensagem a {
        display: inline-block;
        margin-top: 1rem;
        color: #2196F3;
        text-decoration: none;
      }

      .mensagem a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <header>
      <a href="index.html">
        <img src="imagens/logo.png" alt="Logo SIT" class="logo" />
      </a>
      <h1>Marcação Test Drive</h1>
    </header>

    <?php if ($resultado): ?>
      <div class="mensagem">
        <?= $resultado ?>
        <br>
      </div>
    <?php elseif ($erro): ?>
      <div class="mensagem erro">
        <?= $erro ?>
        <br>
      </div>
    <?php endif; ?>
  </body>
</html>
