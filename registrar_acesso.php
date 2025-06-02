<?php
session_start();


$host = 'localhost';
$dbname = 'deapc';
$username = 'root'; 
$password = '';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $now = new DateTime();
    $dia = $now->format('d');
    $mes = $now->format('m');
    $ano = $now->format('Y');
    $hora = $now->format('H');
    $minuto = $now->format('i');

    
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    
    $url = $_SERVER['REQUEST_URI'];

   
    $sql = "INSERT INTO acesso (dia, mes, ano, hora, minuto, user, url) 
            VALUES (:dia, :mes, :ano, :hora, :minuto, :user, :url)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':dia' => $dia,
        ':mes' => $mes,
        ':ano' => $ano,
        ':hora' => $hora,
        ':minuto' => $minuto,
        ':user' => $user_id,
        ':url' => $url
    ]);

} catch (PDOException $e) {
    error_log("Erro de acesso: " . $e->getMessage());
}
?>