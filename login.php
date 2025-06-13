<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$erro = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db = 'deapc';      
    $user = 'root';    
    $pass = '';         

    
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Erro na ligação: " . $conn->connect_error);
    }

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM contas WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
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

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css" />
    <script src="scripts/password.js" defer></script>
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
    <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
  <?php endif; ?>

  <form id="loginForm" method="POST" action="login.php">
    <input
      type="text"
      id="username"
      name="username"
      placeholder="Usuário"
      required
    />
    <div style="position: relative;">
      <input
        type="password"
        id="password"
        name="password"
        placeholder="Senha"
        required
        style="padding-right: 40px;"
      />
      <button
        type="button"
        id="togglePassword"
        style="position: absolute; right: 7px; top: 50%; transform: translateY(-50%);"
        aria-label="Mostrar/Ocultar senha"
      >
        👁️
      </button>
    </div>
    <button type="submit" style="margin-top: 10px;">Entrar</button>
  </form>
</div>
</body>
</html>
