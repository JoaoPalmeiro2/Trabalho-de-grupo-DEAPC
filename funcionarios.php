<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "deapc";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Ligação falhou: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    echo "Utilizador não autenticado.";
    exit;
}

$username = $_SESSION['username'];
$data_acesso = date('Y-m-d H:i:s');
$stmt = $conn->prepare("INSERT INTO acessos (username, data_acesso) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $data_acesso);
$stmt->execute();
$stmt->close();

if (isset($_POST['id']) && isset($_POST['novo_stock'])) {
    $id = intval($_POST['id']);
    $novo_stock = intval($_POST['novo_stock']);

    $stmt = $conn->prepare("UPDATE inventario SET stock = ? WHERE id = ?");
    $stmt->bind_param("ii", $novo_stock, $id);
    $stmt->execute();
    $stmt->close();

    $msg_atualizacao = "Stock atualizado com sucesso.";
}

$result = $conn->query("SELECT * FROM inventario");

$sql_test_drives = "SELECT id, tipo, data_test_drive FROM processo ORDER BY data_test_drive DESC";
$result_test_drives = $conn->query($sql_test_drives);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>Área Funcionários - Inventário</title>
  <link rel="stylesheet" href="styles/style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:wght@400..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css" />
  <style>
    body {
      font-family: 'Rethink Sans', Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .headerfuncionarios {
      background-color: #F4A300;
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .headerfuncionarios h1 {
      margin: 0;
      font-size: 1.8rem;
    }

    .logout {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .logout:hover {
      background-color: #c62828;
    }

    .mensagem {
      text-align: center;
      color: green;
      font-weight: bold;
      margin: 10px 0;
    }

    .tabelas-container {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
      padding: 20px;
    }

    .tabela-wrapper {
      flex: 1;
      min-width: 400px;
      max-width: 45%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #8B4513;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    input[type="number"] {
      width: 80px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
      text-align: center;
    }

    input[type="submit"] {
      padding: 6px 12px;
      background-color: #28a745;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
      margin-left: 5px;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }

    h2 {
      text-align: center;
      margin-top: 20px;
    }

    .scroll-processos {
      max-height: 400px;
      overflow-y: auto;
    }
  </style>
</head>
<body>

  <header class="headerfuncionarios">
    <h1>Área Restrita Funcionários</h1>
    <a href="index.php">
      <button class="logout">Sair</button>
    </a>
  </header>

  <?php if (!empty($msg_atualizacao)) : ?>
    <p class="mensagem"><?= htmlspecialchars($msg_atualizacao) ?></p>
  <?php endif; ?>

  <div class="tabelas-container">
    <!-- TABELA INVENTÁRIO -->
    <div class="tabela-wrapper">
      <h2>Inventário</h2>
      <table>
        <tr>
          <th>Item</th>
          <th>Stock Atual (unidades)</th>
          <th>Alterar Stock</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nome_item']) ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
              <form method="post" style="margin:0;">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="number" name="novo_stock" min="0" value="<?= $row['stock'] ?>" required>
                <input type="submit" value="Atualizar">
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <!-- TABELA TEST DRIVES -->
    <div class="tabela-wrapper">
      <h2>Test Drives Marcados</h2>
      <?php if ($result_test_drives->num_rows > 0): ?>
        <div class="scroll-processos">
          <table>
            <tr>
              <th>ID</th>
              <th>Tipo de Processo</th>
              <th>Data do Test Drive</th>
            </tr>
            <?php while ($test_drive = $result_test_drives->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($test_drive['id']) ?></td>
                <td><?= htmlspecialchars($test_drive['tipo']) ?></td>
                <td><?= htmlspecialchars($test_drive['data_test_drive']) ?></td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
      <?php else: ?>
        <p style="text-align: center;">Não existem test drives marcados.</p>
      <?php endif; ?>
    </div>
  </div>

  <?php $conn->close(); ?>
</body>
</html>
