CREATE TABLE produtos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome_produto VARCHAR(255) NOT NULL,
 preco DECIMAL(10, 2) check(preco>0) NOT NULL,
 categoria VARCHAR(100),
 imagem_url VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS CARRINHO (
 -- "id_item_carrinho" é o nome da COLUNA que identifica cada linha
id_item_carrinho INT AUTO_INCREMENT PRIMARY KEY, 
                                                                                                                        
id_produto INT NOT NULL, 
nome VARCHAR(100) NOT NULL,
subtotal DECIMAL(10,2) NOT NULL,
desconto DECIMAL(10,2),
total DECIMAL(10,2) NOT NULL,
                                                                                                                                                
 CONSTRAINT fk_produto_carrinho FOREIGN KEY (id_produto) REFERENCES produtos(id)
);
