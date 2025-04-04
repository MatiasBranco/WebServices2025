<?php
header('Content-Type: application/json');

// Configuração da base de dados
$host = 'sql308.alojamento-gratis.com';
$dbname = 'ljmn_38672788_DB_LPJ';
$username = 'ljmn_38672788';
$password = 'Matias#2024';

// Conexão à base de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Erro na conexão à base de dados: ' . $conn->connect_error]));
}

// Buscar contactos da base de dados
$result = $conn->query("SELECT * FROM Contactos");

if (!$result) {
    http_response_code(500);
    die(json_encode(['error' => 'Erro na consulta: ' . $conn->error]));
}

// Preparar array com os dados
$contactos = [];
while ($row = $result->fetch_assoc()) {
    $contactos[] = [
        'telefone' => $row['num_international'] . $row['telefone'], // Adiciona prefixo +351
        'nome' => $row['nome'],
        'mensagem' => "Olá {$row['nome']}, esta é uma mensagem personalizada"
    ];
}

// Fechar conexão
$conn->close();

// Retornar os dados em formato JSON
echo json_encode([
    'success' => true,
    'count' => count($contactos),
    'contactos' => $contactos
]);
exit;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Informativa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .navbar {
            background: linear-gradient(135deg, #6e48aa 0%, #9d50bb 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 2rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.2);
            cursor: default;
            transition: background-color 0.3s;
        }
        
        .nav-links li:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        h1 {
            color: #6e48aa;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }
        
        h2 {
            color: #9d50bb;
            margin: 1.5rem 0 1rem;
            font-size: 1.8rem;
        }
        
        p {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        
        .info-box {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #333;
            color: white;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">InfoSite</div>
        <ul class="nav-links">
            <li>Início</li>
            <li>Sobre</li>
            <li>Serviços</li>
            <li>Contato</li>
        </ul>
    </nav>
    
    <div class="container">
        <div class="info-box">
            <h1>Bem-vindo ao Nosso Site Informativo</h1>
            <p>Esta é uma página demonstrativa criada para mostrar um layout com navbar decorativa e conteúdo informativo. Os itens do menu são apenas decorativos e não possuem links funcionais.</p>
        </div>
        
        <div class="info-box">
            <h2>Sobre Nós</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
            <p>Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
        </div>
        
        <div class="info-box">
            <h2>Nossos Serviços</h2>
            <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
            <ul style="margin-left: 2rem; margin-bottom: 1rem;">
                <li>Serviço Demonstrativo 1</li>
                <li>Serviço Demonstrativo 2</li>
                <li>Serviço Demonstrativo 3</li>
            </ul>
            <p>Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor posuere.</p>
        </div>
    </div>
    
    <footer>
        <p>© 2023 Página Informativa. Todos os direitos reservados (demonstração).</p>
    </footer>
</body>
</html>
