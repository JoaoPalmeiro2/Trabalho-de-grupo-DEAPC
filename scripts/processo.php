<?php
// Configurações da base de dados
$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "deapc";        

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);



// Verifica se a requisição é do tipo POST (ou seja, se o formulário foi submetido)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém e sanitiza os dados do formulário
    $test_drive_date = $_POST['test_drive_date']; 
    $car_model = $_POST['car_model'];             
    $process_type = $_POST['process_type'];       
    // Prepara a query SQL para inserir os dados
    
    $sql = "INSERT INTO processo (tipo, data_test_drive) VALUES (?, ?)";

    // Prepara a declaração para prevenir SQL injection
    $stmt = $conn->prepare($sql);

   

    // Liga os parâmetros à declaração: 'ss' significa que são dois parâmetros string
    $stmt->bind_param("ss", $process_type, $test_drive_date);

    // Executa a declaração
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id; 
        echo "Test Drive para o modelo '" . htmlspecialchars($car_model) . "' agendado com sucesso para " . htmlspecialchars($test_drive_date) . ". ID do Processo: " . $last_id;
        echo "<br><br><a href='../catalogo.html'>Voltar ao Catálogo</a>"; // Adiciona um link para voltar
    } else {
        echo "Erro ao agendar Test Drive: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
} else {
    // Se a página for acedida diretamente sem dados POST
    echo "Método de requisição inválido. Por favor, utilize o formulário no catálogo.";
}

// Fecha a conexão com a base de dados
$conn->close();
?>