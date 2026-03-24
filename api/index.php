<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação da API - YourDiet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .endpoint-list {
            margin-top: 20px;
        }
        .endpoint-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }
        .endpoint-item h3 {
            margin-top: 0;
            color: #2980b9;
        }
        .endpoint-item p {
            margin-bottom: 10px;
        }
        .method {
            font-weight: bold;
            color: #e74c3c;
        }
        .method.get {
            color: #27ae60;
        }
        .method.post {
            color: #e67e22;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .params {
            font-size: 0.9em;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Documentação da API - YourDiet</h1>
        <div class="endpoint-list">
            <div class="endpoint-item">
                <h3>alimentos.php</h3>
                <p>Busca alimentos por descrição ou categoria.</p>
                <p><span class="method get">GET</span> <a href="alimentos.php?busca=arroz">alimentos.php?busca={termo}</a></p>
                <p class="params">Parâmetro: busca (opcional) - termo de busca para descrição ou categoria.</p>
            </div>
            <div class="endpoint-item">
                <h3>cadastro.php</h3>
                <p>Cadastra um novo usuário.</p>
                <p><span class="method post">POST</span> cadastro.php</p>
                <p class="params">Corpo JSON: nome, email, senha, data_nascimento, sexo.</p>
            </div>
            <div class="endpoint-item">
                <h3>consumo_alimento.php</h3>
                <p>Registra o consumo de um alimento por um usuário.</p>
                <p><span class="method post">POST</span> consumo_alimento.php</p>
                <p class="params">Corpo JSON: usuario_id, alimento_id, data_consumo, quantidade_gramas.</p>
            </div>
            <div class="endpoint-item">
                <h3>consumo_dia.php</h3>
                <p>Retorna o consumo total de nutrientes do dia para um usuário.</p>
                <p><span class="method get">GET</span> <a href="consumo_dia.php?usuario_id=1">consumo_dia.php?usuario_id={id}&data={YYYY-MM-DD}</a></p>
                <p class="params">Parâmetros: usuario_id (obrigatório), data (opcional, padrão hoje).</p>
            </div>
            <div class="endpoint-item">
                <h3>consumo_listar_alimento.php</h3>
                <p>Lista os alimentos consumidos em um dia por um usuário.</p>
                <p><span class="method get">GET</span> <a href="consumo_listar_alimento.php?usuario_id=1">consumo_listar_alimento.php?usuario_id={id}&data={YYYY-MM-DD}</a></p>
                <p class="params">Parâmetros: usuario_id (obrigatório), data (opcional, padrão hoje).</p>
            </div>
            <div class="endpoint-item">
                <h3>detalhes.php</h3>
                <p>Retorna detalhes completos de um alimento por ID.</p>
                <p><span class="method get">GET</span> <a href="detalhes.php?id=1">detalhes.php?id={id}</a></p>
                <p class="params">Parâmetro: id (obrigatório) - ID do alimento.</p>
            </div>
            <div class="endpoint-item">
                <h3>login.php</h3>
                <p>Autentica um usuário.</p>
                <p><span class="method post">POST</span> login.php</p>
                <p class="params">Corpo JSON: email, senha.</p>
            </div>
            <div class="endpoint-item">
                <h3>meta.php</h3>
                <p>Atualiza a meta calórica de um usuário.</p>
                <p><span class="method post">POST</span> meta.php</p>
                <p class="params">Corpo JSON: usuario_id, meta.</p>
            </div>
            <div class="endpoint-item">
                <h3>perfil.php</h3>
                <p>Retorna o perfil de um usuário.</p>
                <p><span class="method get">GET</span> <a href="perfil.php?id=1">perfil.php?id={id}</a></p>
                <p class="params">Parâmetro: id (obrigatório) - ID do usuário.</p>
            </div>
        </div>
    </div>
    <script>
        // JavaScript opcional para funcionalidades futuras
        console.log('Documentação da API carregada.');
    </script>
</body>
</html>
</head>
<body>
    <div class="container">
        <h1>Documentação da API - YourDiet</h1>
        <p>Esta é uma API para gerenciamento de dieta e consumo alimentar. Abaixo, uma descrição da função de cada arquivo no diretório da API:</p>
        <div class="file-list">
            <div class="file-item">
                <h3>alimentos.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Busca alimentos no banco de dados por descrição ou categoria. Retorna uma lista de alimentos com ID, descrição e energia em kcal, em formato JSON.</p>
            </div>
          
            <div class="file-item">
                <h3>cadastro.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Cadastra um novo usuário no sistema. Recebe dados via POST (nome, email, senha, data de nascimento, sexo), valida e insere no banco. Retorna sucesso ou erro em JSON.</p>
            </div>
            <div class="file-item">
                <h3>consumo_alimento.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Registra o consumo de um alimento por um usuário. Recebe dados via POST (usuario_id, alimento_id, data, quantidade, meta) e insere na tabela consumo_diario.</p>
            </div>
            <div class="file-item">
                <h3>consumo_dia.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Calcula os totais nutricionais (calorias, proteínas, carboidratos, gorduras) consumidos por um usuário em uma data específica. Também retorna a meta calórica.</p>
            </div>
            <div class="file-item">
                <h3>consumo_listar_alimento.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Lista os alimentos consumidos por um usuário em uma data, com detalhes de cada item (quantidade, kcal consumidas, etc.) e totais do dia.</p>
            </div>
           
            <div class="file-item">
                <h3>detalhes.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Retorna os detalhes completos de um alimento específico, incluindo todos os valores nutricionais, pelo ID fornecido via GET.</p>
            </div>
           
            <div class="file-item">
                <h3>login.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Faz o login do usuário. Recebe email e senha via POST, verifica credenciais e retorna dados do usuário se válido.</p>
            </div>
            <div class="file-item">
                <h3>meta.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Atualiza a meta calórica de um usuário. Recebe usuario_id e meta via POST e atualiza a tabela usuarios.</p>
            </div>
            <div class="file-item">
                <h3>perfil.php</h3>
                <p class="file-type">PHP - Endpoint</p>
                <p>Retorna os dados do perfil de um usuário (email, nome, data de nascimento, sexo) pelo ID via GET.</p>
            </div>
        </div>
    </div>
</body>
</html>
