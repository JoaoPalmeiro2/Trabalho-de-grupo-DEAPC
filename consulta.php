<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deapc";

$conn = new mysqli($servername, $username, $password, $dbname);

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = trim($_POST["id"]);

    $sql = "SELECT tipo, data_test_drive FROM processo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $dados = $result->fetch_assoc();
        $mensagem = "
            <h3>Detalhes do Test Drive #$id</h3>
            <p><strong>Tipo de Processo:</strong> {$dados['tipo']}</p>
            <p><strong>Data Marcada:</strong> {$dados['data_test_drive']}</p>
        ";
    } else {
        $mensagem = "<p style='color:red;'>ID não encontrado.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>Consulta Test Drive - SIT</title>
  <link rel="stylesheet" href="styles/style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@400..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
  <header class="header">
    <a href="index.php">
      <img src="imagens/logo.png" alt="Logo SIT" class="logo" />
    </a>
    <h1>Consulta de Test Drive</h1>
  </header>

  <main class="consulta-section">
    <form method="post">
      <label for="id">ID do Test Drive:</label>
      <input type="number" name="id" id="id" required />
      <button type="submit">Consultar</button>
    </form>

    <?php if ($mensagem): ?>
      <div class="mensagem">
        <?= $mensagem ?>
      </div>
    <?php endif; ?>
  </main>
</body>
</html>