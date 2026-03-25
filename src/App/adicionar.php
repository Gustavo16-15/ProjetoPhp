 <?php
// 1. Configurações de Conexão
$host = "localhost:";
$dbname = "app_bd"; // O nome do seu banco de dados
$usuario_db = "root";
$senha_db = "";

try {
    // 2. Criar a conexão segura com PDO
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario_db, $senha_db);
    
    // Ativa o modo de erros para o PHP te avisar se algo quebrar
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Receber o ID que o JavaScript enviou (via POST)
    // No seu JS, o body deve ser: 'id_produto=' + productId
    $id_produto = $_POST["id_produto"] ?? '';

    if (!empty($id_produto)) {
        
        // 4. Preparar a Query (A ideia que você queria aproveitar)
        // Usamos o :id como um "espaço reservado" (placeholder)
        $sql = "INSERT INTO CARRINHO (id_produto, nome, subtotal, desconto, total)
                SELECT id, nome_produto, preco, 0, preco 
                FROM produtos 
                WHERE id = :id";

        $stmt = $conexao->prepare($sql);

        // 5. Vincular o valor com segurança (PARAM_INT garante que é um número)
        $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
        
        // 6. Executar a ação no Banco
        $stmt->execute();

        echo "Sucesso! O produto foi gravado no phpMyAdmin.";

    } else {
        echo "Aviso: Nenhum ID de produto foi enviado.";
    }

} catch(PDOException $e) {
    // Se o banco estiver desligado ou a tabela não existir, cairá aqui:
    echo "Erro no Banco de Dados: " . $e->getMessage();
}
?>