<?php
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ligação à base de dados
    $host = 'localhost';
    $db = 'deapc';      // substitui pelo nome da tua base de dados
    $user = 'root';     // ou outro utilizador MySQL
    $pass = '';         // palavra-passe (em localhost, normalmente está vazia)

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Erro na ligação: " . $conn->connect_error);
    }

    // Login
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM contas WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['username'] = $username;
            header("Location: funcionarios.php");
            exit();
        } else {
            $erro = "Palavra-passe incorreta.";
        }
    } else {
        $erro = "Utilizador não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <header>
      <a href="index.html">
        <img src="imagens/logo.png" alt="Logo SIT" class="logo" />
      </a>
      <h1>Login SIT</h1>
    </header>

    <div class="login-container">
      <h2>Login</h2>

      <?php if (!empty($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="text" name="username" placeholder="Usuário" required />
        <input type="password" name="password" placeholder="Senha" required />
        <button type="submit">Entrar</button>
      </form>
    </div>
  </body>
</html>
