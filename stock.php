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

// Atualizar stock se o formulário for enviado
if (isset($_POST["id"]) && isset($_POST["novo_stock"])) {
    $id = intval($_POST["id"]);
    $novo_stock = intval($_POST["novo_stock"]);

    $stmt = $conn->prepare("UPDATE inventario SET stock = ? WHERE id = ?");
    $stmt->bind_param("ii", $novo_stock, $id);
    $stmt->execute();
    $stmt->close();

    echo "<p>Stock atualizado com sucesso.</p>";
}

// Buscar dados atuais
$result = $conn->query("SELECT * FROM inventario");
?>

<h2>Inventário</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Item</th>
        <th>Stock Atual (unidades)</th>
        <th>Alterar Stock</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row["nome_item"]) ?></td>
        <td><?= $row["stock"] ?></td>
        <td>
            <form method="post" style="margin:0;">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <input type="number" name="novo_stock" min="0" value="<?= $row[
                    "stock"
                ] ?>" required>
                <input type="submit" value="Atualizar">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php $conn->close();
?>
