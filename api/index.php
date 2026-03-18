<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Documentação da API</title>
    <style>
      body {
        font-family:
          Segoe UI,
          Roboto,
          Arial,
          sans-serif;
        margin: 0;
        background: #f4f7fb;
        color: #0b2545;
      }
      .wrap {
        max-width: 90%;
        margin: 2% auto;
        padding: 2%;
      }

      header {
        display: flex;
        align-items: baseline;
        gap: 1%;
      }

      header h1 {
        margin: 0;
        font-size: 24px;
      }

      header p {
        margin: 0.4% 0 0;
        color: #375176;
      }
      .grid {
        display: grid;
        grid-template-columns: 28% 72%;
        gap: 1.8%;
        margin-top: 1.8%;
      }
      nav {
        background: #ffffff;
        border-radius: 1%;
        padding: 1.4%;
        border: 1px solid #e1e8ef;
      }
      nav h3 {
        margin: 0 0 0.8%;
        font-size: 1rem;
      }
      nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      nav li {
        margin: 0.8% 0;
      }
      nav a {
        color: #0b2545;
        text-decoration: none;
      }
      main .card {
        background: #fff;
        border: 1px solid #e6eef6;
        border-radius: 1%;
        padding: 1.6%;
      }
      .endpoint {
        margin-bottom: 1.4%;
        padding-bottom: 1%;
        border-bottom: 1px dashed #e6eef6;
      }
      .endpoint h2 {
        margin: 0;
        font-size: 1.05rem;
      }
      .meta {
        color: #4b6b84;
        margin-top: 0.6%;
      }
      pre {
        background: #0b1220;
        color: #e6eef6;
        padding: 1.2%;
        border-radius: 0.6%;
        overflow: auto;
      }
      .label {
        display: inline-block;
        background: #eef6ff;
        color: #075985;
        padding: 0.4% 0.8%;
        border-radius: 0.6%;
        font-size: 0.85rem;
        margin-top: 0.8%;
      }
      .params {
        margin-top: 0.8%;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 0.8%;
      }
      th,
      td {
        border: 1px solid #eef6ff;
        padding: 0.8%;
        text-align: left;
        font-size: 0.95rem;
      }
      th {
        background: #f1f8ff;
      }
      footer {
        margin-top: 1.2%;
        color: #6b7f93;
        font-size: 0.9rem;
      }
      @media (max-width: 880px) {
        .grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <div class="wrap">
      <header>
        <div>
          <h1>Documentação da API</h1>
          <p>
            Descrição de cada arquivo, uso, parâmetros e exemplos de
            request/response.
          </p>
        </div>
      </header>

      <div class="grid">
        <nav>
          <h3>Arquivos</h3>
          <ul>
            <li><a href="alimentos.php">alimentos.php</a></li>
            <li><a href="detalhes.php">detalhes.php</a></li>
            <li><a href="cadastro.php">cadastro.php</a></li>
            <li><a href="login.php">login.php</a></li>
            <li><a href="consumo_alimento.php">consumo_alimento.php</a></li>
            <li><a href="consumo_dia.php">consumo_dia.php</a></li>
            <li><a href="consumo_listar_alimento.php">consumo_listar_alimento.php</a></li>
            <li><a href="perfil.php">perfil.php</a></li>
          </ul>
        </nav>

        <main>
          <div class="card">
            <section id="alimentos" class="endpoint">
              <h2>alimentos.php <span class="label">GET</span></h2>
              <div class="meta">
                Pesquisa por alimentos. Retorna lista com `id`,
                `descricao_do_alimento`, `energia_kcal` e outros campos
                nutricionais.
              </div>
              <div class="params">
                <strong>Parâmetros:</strong>
                <table>
                  <tr>
                    <th>nome</th>
                    <th>tipo</th>
                    <th>descrição</th>
                  </tr>
                  <tr>
                    <td>busca</td>
                    <td>string (opcional)</td>
                    <td>
                      Pesquisa por `descricao_do_alimento` ou `Categoria` (LIKE)
                    </td>
                  </tr>
                </table>
              </div>
              <div style="margin-top: 8px">
                <strong>Exemplo:</strong>
                <pre>
GET /api/alimentos.php?busca=arroz
Resposta: [ {"id":1,"descricao_do_alimento":"Arroz branco","energia_kcal":130}, ... ]</pre
                >
              </div>
            </section>

            <section id="detalhes" class="endpoint">
              <h2>detalhes.php <span class="label">GET</span></h2>
              <div class="meta">
                Retorna todos os campos de um alimento específico por `id`.
              </div>
              <div class="params">
                <strong>Parâmetros:</strong>
                <table>
                  <tr>
                    <th>nome</th>
                    <th>tipo</th>
                    <th>descrição</th>
                  </tr>
                  <tr>
                    <td>id</td>
                    <td>int (obrigatório)</td>
                    <td>ID do alimento</td>
                  </tr>
                </table>
              </div>
              <pre>
GET /api/detalhes.php?id=10
Resposta: {"id":10,"descricao_do_alimento":"Banana","Energia_kcal":89,...}</pre
              >
            </section>

            <section id="cadastro" class="endpoint">
              <h2>cadastro.php <span class="label">POST</span></h2>
              <div class="meta">
                Cria novo usuário. Recebe JSON no body e armazena senha com
                `password_hash`.
              </div>
              <div class="params">
                <strong>Payload JSON:</strong>
                <table>
                  <tr>
                    <th>campo</th>
                    <th>tipo</th>
                    <th>descrição</th>
                  </tr>
                  <tr>
                    <td>nome</td>
                    <td>string</td>
                    <td>Nome do usuário (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>email</td>
                    <td>string</td>
                    <td>E-mail (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>senha</td>
                    <td>string</td>
                    <td>Senha em texto (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>data_nascimento</td>
                    <td>YYYY-MM-DD</td>
                    <td>Data de nascimento (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>sexo</td>
                    <td>string</td>
                    <td>Sexo: 'Masculino', 'Feminino' ou 'Outro' (obrigatório)</td>
                  </tr>
                </table>
              </div>
              <pre>
POST /api/cadastro.php
Content-Type: application/json
{ "nome":"João", "email":"joao@ex.com", "senha":"senha123", "data_nascimento":"1990-01-01", "sexo":"Masculino" }
Resposta: {"success":true,"usuario":{"id":12,"nome":"João","email":"joao@ex.com","sexo":"Masculino"}}</pre
              >
            </section>

            <section id="login" class="endpoint">
              <h2>login.php <span class="label">POST</span></h2>
              <div class="meta">
                Autentica usuário usando `email` e `senha`. Verifica com
                `password_verify`.
              </div>
              <div class="params">
                <strong>Payload JSON:</strong>
                <table>
                  <tr>
                    <th>campo</th>
                    <th>tipo</th>
                  </tr>
                  <tr>
                    <td>email</td>
                    <td>string</td>
                  </tr>
                  <tr>
                    <td>senha</td>
                    <td>string</td>
                  </tr>
                </table>
              </div>
              <pre>
POST /api/login.php
{ "email":"joao@ex.com","senha":"senha123" }
Resposta (sucesso): {"sucesso":true,"usuario":{"id":12,"email":"joao@ex.com","nome":"João"}}</pre
              >
            </section>

            <section id="consumo_alimento" class="endpoint">
              <h2>consumo_alimento.php <span class="label">POST</span></h2>
              <div class="meta">
                Registra uma entrada em `consumo_diario` (quantidade em gramas).
              </div>
              <div class="params">
                <strong>Payload JSON:</strong>
                <table>
                  <tr>
                    <th>campo</th>
                    <th>tipo</th>
                    <th>descrição</th>
                  </tr>
                  <tr>
                    <td>usuario_id</td>
                    <td>int</td>
                    <td>ID do usuário (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>alimento_id</td>
                    <td>int</td>
                    <td>ID do alimento (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>data_consumo</td>
                    <td>YYYY-MM-DD</td>
                    <td>Data do consumo (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>quantidade_gramas</td>
                    <td>number</td>
                    <td>Quantidade consumida em gramas (obrigatório)</td>
                  </tr>
                  <tr>
                    <td>meta</td>
                    <td>number</td>
                    <td>Meta calórica diária (obrigatório)</td>
                  </tr>
                </table>
              </div>
              <pre>
POST /api/consumo_alimento.php
{ "usuario_id":1, "alimento_id":10, "data_consumo":"2026-02-24", "quantidade_gramas":100, "meta":2000 }
Resposta: {"sucesso":true,"mensagem":"Consumo registrado com sucesso"}</pre
              >
            </section>

            <section id="consumo_dia" class="endpoint">
              <h2>consumo_dia.php <span class="label">GET</span></h2>
              <div class="meta">
                Retorna totais agregados (calorias, proteínas, carboidratos,
                gorduras) para um dia.
              </div>
              <div class="params">
                <strong>Parâmetros:</strong>
                <table>
                  <tr>
                    <th>nome</th>
                    <th>tipo</th>
                    <th>descrição</th>
                  </tr>
                  <tr>
                    <td>usuario_id</td>
                    <td>int (obrigatório)</td>
                    <td>ID do usuário</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>YYYY-MM-DD (opcional)</td>
                    <td>Se ausente, padrão é hoje</td>
                  </tr>
                </table>
              </div>
              <pre>
GET /api/consumo_dia.php?usuario_id=1&data=2026-02-24
Resposta: {"data":"2026-02-24","calorias":450.5,"proteinas":30.2,"carboidratos":60.1,"gorduras":12.4}</pre
              >
            </section>

            <section id="consumo_listar" class="endpoint">
              <h2>
                consumo_listar_alimento.php <span class="label">GET</span>
              </h2>
              <div class="meta">
                Lista os itens consumidos em um dia (últimos registros) e
                fornece totais do dia.
              </div>
              <div class="params">
                <strong>Parâmetros:</strong>
                <table>
                  <tr>
                    <th>nome</th>
                    <th>tipo</th>
                  </tr>
                  <tr>
                    <td>usuario_id</td>
                    <td>int</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>YYYY-MM-DD</td>
                  </tr>
                </table>
              </div>
              <pre>
GET /api/consumo_listar_alimento.php?usuario_id=1&data=2026-02-24
Resposta: { "data":"2026-02-24","totais_do_dia":{...},"itens":[ ... ] }</pre
              >
            </section>

            <section id="perfil" class="endpoint">
              <h2>perfil.php <span class="label">GET</span></h2>
              <div class="meta">
                Retorna informações do perfil do usuário (email, nome,
                data_nascimento, sexo).
              </div>
              <div class="params">
                <strong>Parâmetros:</strong>
                <table>
                  <tr>
                    <th>nome</th>
                    <th>tipo</th>
                  </tr>
                  <tr>
                    <td>id</td>
                    <td>int</td>
                  </tr>
                </table>
              </div>
              <pre>
GET /api/perfil.php?id=1
Resposta: {"email":"joao@ex.com","nome":"João","data_nascimento":"1990-01-01","sexo":"Masculino"}</pre
              >
            </section>

            <section id="conexao" class="endpoint">
              <h2>config/conexao.php <span class="label">arquivo PHP</span></h2>
              <div class="meta">
                Cria o objeto PDO (`$pdo`) com configuração de conexão ao banco
                de dados "YourDiet". Usado por todos os endpoints via `require_once`.
              </div>
              <div class="params">
                <strong>Atenção:</strong> não incluir credenciais sensíveis em
                repositórios públicos. Exemplo mínimo:
                <pre>
$pdo = new PDO("mysql:host=HOST;dbname=YourDiet;charset=utf8mb4", USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);</pre
                >
              </div>
            </section>

            <footer>
              <div>
                Nota: esta página é documentação estática. Os endpoints reais
                estão nos arquivos listados e respondem JSON.
              </div>
            </footer>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
