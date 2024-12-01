<?php

$host = 'localhost';
$dbname = 'forum';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['conteudo'])) {
    $conteudo = $conn->real_escape_string($_POST['conteudo']);

 
    $sql = "INSERT INTO mensagens (conteudo) VALUES ('$conteudo')";
    if ($conn->query($sql) === TRUE) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar mensagem: " . $conn->error;
    }
}


$sql = "SELECT * FROM mensagens ORDER BY data_envio DESC";
$result = $conn->query($sql);

$mensagens = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mensagens[] = $row;
    }
}

echo json_encode($mensagens);


$conn->close();
?>
