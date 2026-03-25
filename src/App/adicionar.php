 <?php
// Configurações de conexão
$host = "localhost";
$user = "root";
$pass = "";
$db   = "app_bd"; // O nome que acabamos de criar

$conn = new mysqli($host, $user, $pass, $db);

// Verificação de segurança
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pega o ID enviado pelo JavaScript
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // O SQL que você me mandou no início, agora automatizado
    $sql = "INSERT INTO CARRINHO (id_produto, nome, subtotal, desconto, total)
            SELECT id, nome_produto, preco, 0, preco 
            FROM produtos 
            WHERE id = $id";

    if ($conn->query($sql)) {
        echo "Sucesso";
    } else {
        http_response_code(500);
        echo "Erro ao inserir: " . $conn->error;
    }
}
?>