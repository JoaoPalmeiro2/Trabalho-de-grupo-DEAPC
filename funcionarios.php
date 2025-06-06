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
  <style>
  table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

  p {
    text-align: center;
    font-weight: bold;
  }

  .logout {
    padding: 6px 12px;
    background-color: #d9534f;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
  }

  .logout:hover {
    background-color: #c9302c;
  }

  </style>

  <meta charset="UTF-8" />
  <title>Área Funcionários - Inventário</title>
  <link rel="stylesheet" href="styles/style.css" />
  
</head>
<body>
  <header>
    <h1>Área Restrita Funcionários</h1>
    <a href="index.html">
      <button class="logout" onclick="logout()">Sair</button>
    </a>
  </header>

  <?php if (!empty($msg_atualizacao)) : ?>
    <p style="color:green;"><?= htmlspecialchars($msg_atualizacao) ?></p>
  <?php endif; ?>

  <h2>Inventário</h2>
  <table border="1" cellpadding="5" cellspacing="0">
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

  <h2>Test Drives Marcados</h2>

  <?php if ($result_test_drives->num_rows > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 80%; margin: 20px auto; border-collapse: collapse;">
      <tr style="background-color: #8B4513; color: white;">
        <th>ID</th>
        <th>Tipo de Processo</th>
        <th>Data do Test Drive</th>
      </tr>
      <?php while ($test_drive = $result_test_drives->fetch_assoc()): ?>
        <tr style="text-align: center; border-bottom: 1px solid #ddd;">
          <td><?= htmlspecialchars($test_drive['id']) ?></td>
          <td><?= htmlspecialchars($test_drive['tipo']) ?></td>
          <td><?= htmlspecialchars($test_drive['data_test_drive']) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p style="text-align: center;">Não existem test drives marcados.</p>
  <?php endif; ?>

  <?php $conn->close(); ?>
</body>
</html>
