<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db = 'deapc';      
    $user = 'root';    
    $pass = '';         

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Erro na ligação: " . $conn->connect_error);
    }

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
            echo "<script>
                    alert('Palavra passe incorreta.');
                    window.location.href = 'login.html';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Utilizador não encontrado.');
                window.location.href = 'login.html';
              </script>";
    }
}
?>
