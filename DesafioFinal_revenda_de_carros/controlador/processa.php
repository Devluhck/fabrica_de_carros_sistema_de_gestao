<?php

session_start();
require_once '../modelo/Carro.php';
require_once '../modelo/Fabrica.php';
require_once '../includes/navbar.php';

// Inicializa a fábrica na sessão se não existir
if (!isset($_SESSION['fabrica'])) {
    $_SESSION['fabrica'] = serialize(new Fabrica());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    switch ($acao) {

        case 'fabricar':
            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Fabricar Carros | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <div class="container">
                    <div class="form-container">
                        <h2>⚙️ Fabricar Carros</h2>
                        <p>Quantos carros você deseja fabricar?</p>
                        
                        <form action="processa.php" method="POST">
                            <input type="hidden" name="acao" value="solicitar_dados_fabricacao">
                            <div class="form-group">
                                <label><strong>Quantidade de carros:</strong></label>
                                <input type="number" name="quantidade" min="1" required class="form-select">
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">Avançar</button>
                                <a href="../visualizacao/index.php" class="btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </body>
            </html>';
            break;

        case 'solicitar_dados_fabricacao':
            $quantidade = (int)($_POST['quantidade'] ?? 0);

            if ($quantidade <= 0) {
                echo '<!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Erro | Fábrica de Carros</title>
                    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
                </head>
                <body>
                    ' . renderNavbar() . '
                    <div class="container">
                        <div class="message-container">
                            <h2 class="error">❌ Quantidade inválida!</h2>
                            <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                        </div>
                    </div>
                </body>
                </html>';
                break;
            }

            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Dados dos Carros | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <div class="container">
                    <div class="form-container">
                        <h2>⚙️ Preencha os dados dos carros a serem fabricados</h2>
                        <form action="processa.php" method="POST">
                            <input type="hidden" name="acao" value="finalizar_fabricacao">
                            <input type="hidden" name="quantidade" value="' . $quantidade . '">';

            for ($i = 0; $i < $quantidade; $i++) {
                echo '<div class="carro-form">
                        <h3>Carro #' . ($i + 1) . '</h3>
                        
                        <div class="form-group">
                            <label><strong>Modelo *:</strong></label>
                            <input type="text" name="modelo_' . $i . '" required>
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Cor *:</strong></label>
                            <input type="text" name="cor_' . $i . '" required>
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Marca (opcional):</strong></label>
                            <input type="text" name="marca_' . $i . '">
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Ano (opcional):</strong></label>
                            <input type="text" name="ano_' . $i . '">
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Placa (opcional):</strong></label>
                            <input type="text" name="placa_' . $i . '">
                        </div>
                        
                        <div class="form-group">
                            <label><strong>Preço (opcional):</strong></label>
                            <input type="number" name="preco_' . $i . '" step="0.01" min="0">
                        </div>
                      </div>';
            }

            echo '          <div class="form-actions">
                                <button type="submit" class="btn-primary">Fabricar Carros</button>
                                <a href="../visualizacao/index.php" class="btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </body>
            </html>';
            break;

        case 'finalizar_fabricacao':
            $quantidade = (int)($_POST['quantidade'] ?? 0);
            $fabrica = unserialize($_SESSION['fabrica']);

            $fabrica->fabricarCarro($quantidade, $_POST);
            $_SESSION['fabrica'] = serialize($fabrica);

            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sucesso | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <div class="container">
                    <div class="message-container">
                        <h2 class="success">✅ Carros fabricados com sucesso!</h2>
                        <p>' . $quantidade . ' carro(s) adicionado(s) à fábrica.</p>
                        <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                    </div>
                </div>
            </body>
            </html>';
            break;

        case 'vender':
            $fabrica = unserialize($_SESSION['fabrica']);

            if (empty($fabrica->getCarros())) {
                echo '<!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Aviso | Fábrica de Carros</title>
                    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
                </head>
                <body>
                    ' . renderNavbar() . '
                    <div class="container">
                        <div class="message-container">
                            <h2 class="warning">⚠️ Nenhum carro disponível para venda!</h2>
                            <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                        </div>
                    </div>
                </body>
                </html>';
                break;
            }

            $modelos = $fabrica->getModelosDisponiveis();

            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Vender Carro | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <div class="container">
                    <div class="form-container">
                        <h2>💰 Vender Carro</h2>
                        <p>Selecione o modelo e a cor do carro que deseja vender:</p>

                        <form id="venderForm" action="processa.php" method="POST">
                            <input type="hidden" name="acao" value="confirmar_venda">
                            
                            <div class="form-group">
                                <label for="modelo"><strong>Modelo do carro:</strong></label>
                                <select id="modelo" name="modelo" class="form-select" required>
                                    <option value="">Selecione um modelo</option>';

            foreach ($modelos as $modelo) {
                echo '<option value="' . htmlspecialchars($modelo) . '">' . htmlspecialchars($modelo) . '</option>';
            }

            echo '                  </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="cor"><strong>Cor do carro:</strong></label>
                                <select id="cor" name="cor" class="form-select" required disabled>
                                    <option value="">Primeiro selecione um modelo</option>
                                </select>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">Vender Carro</button>
                                <a href="../visualizacao/index.php" class="btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <script>
                    const modeloSelect = document.getElementById("modelo");
                    const corSelect = document.getElementById("cor");
                    
                    modeloSelect.addEventListener("change", function() {
                        const modelo = this.value;
                        
                        if (modelo === "") {
                            corSelect.innerHTML = "<option value=\"\">Primeiro selecione um modelo</option>";
                            corSelect.disabled = true;
                            return;
                        }
                        
                        // Buscar cores via AJAX
                        fetch("processa.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: "acao=buscar_cores&modelo=" + encodeURIComponent(modelo)
                        })
                        .then(response => response.json())
                        .then(data => {
                            corSelect.innerHTML = "<option value=\"\">Selecione uma cor</option>";
                            
                            if (data.cores && data.cores.length > 0) {
                                data.cores.forEach(function(cor) {
                                    const option = document.createElement("option");
                                    option.value = cor;
                                    option.textContent = cor;
                                    corSelect.appendChild(option);
                                });
                                corSelect.disabled = false;
                            } else {
                                corSelect.innerHTML = "<option value=\"\">Nenhuma cor disponível</option>";
                                corSelect.disabled = true;
                            }
                        })
                        .catch(error => {
                            console.error("Erro ao buscar cores:", error);
                            corSelect.innerHTML = "<option value=\"\">Erro ao carregar cores</option>";
                            corSelect.disabled = true;
                        });
                    });
                </script>
            </body>
            </html>';
            break;

        case 'buscar_cores':
            header('Content-Type: application/json');
            $modelo = $_POST['modelo'] ?? '';
            $fabrica = unserialize($_SESSION['fabrica']);
            $cores = $fabrica->getCoresPorModelo($modelo);
            echo json_encode(['cores' => $cores]);
            exit;
            break;

        case 'confirmar_venda':
            $modelo = $_POST['modelo'] ?? '';
            $cor = $_POST['cor'] ?? '';

            if (empty($modelo) || empty($cor)) {
                echo '<!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Erro | Fábrica de Carros</title>
                    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
                </head>
                <body>
                    ' . renderNavbar() . '
                    <div class="container">
                        <div class="message-container">
                            <h2 class="error">❌ Modelo e cor são obrigatórios!</h2>
                            <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                        </div>
                    </div>
                </body>
                </html>';
                break;
            }

            $fabrica = unserialize($_SESSION['fabrica']);

            if ($fabrica->venderCarro($modelo, $cor)) {
                $_SESSION['fabrica'] = serialize($fabrica);
                echo '<!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Sucesso | Fábrica de Carros</title>
                    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
                </head>
                <body>
                    ' . renderNavbar() . '
                    <div class="container">
                        <div class="message-container">
                            <h2 class="success">✅ Carro vendido com sucesso!</h2>
                            <p><strong>Modelo:</strong> ' . htmlspecialchars($modelo) . '</p>
                            <p><strong>Cor:</strong> ' . htmlspecialchars($cor) . '</p>
                            <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                        </div>
                    </div>
                </body>
                </html>';
            } else {
                echo '<!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Erro | Fábrica de Carros</title>
                    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
                </head>
                <body>
                    ' . renderNavbar() . '
                    <div class="container">
                        <div class="message-container">
                            <h2 class="error">❌ Carro não encontrado!</h2>
                            <p>Não foi encontrado um carro com modelo "' . htmlspecialchars($modelo) . '" e cor "' . htmlspecialchars($cor) . '" na fábrica.</p>
                            <a href="../visualizacao/index.php" class="btn-primary">Voltar ao menu</a>
                        </div>
                    </div>
                </body>
                </html>';
            }
            break;

        case 'ver_info':
            $fabrica = unserialize($_SESSION['fabrica']);
            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Estoque | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <main class="main-content">
                    <div class="container" style="padding: 40px 20px;">
                        <div class="form-container">';
            echo $fabrica->listarCarros();
            echo '          </div>
                    </div>
                </main>
            </body>
            </html>';
            break;

        case 'finalizar_sessao':
            session_unset();
            session_destroy();
            echo '<!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sessão Finalizada | Fábrica de Carros</title>
                <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
            </head>
            <body>
                ' . renderNavbar() . '
                <div class="container">
                    <div class="message-container">
                        <h2>🗑️ Sessão finalizada!</h2>
                        <p>Todos os dados da fábrica foram apagados.</p>
                        <a href="../visualizacao/index.php" class="btn-primary">🏠 Voltar ao menu inicial</a>
                    </div>
                </div>
            </body>
            </html>';
            break;

        default:
            echo "<h2>❌ Ação inválida.</h2>";
            echo '<a href="../visualizacao/index.php">🔙 Voltar ao menu</a>';
            break;
    }
} else {
    echo "<h2>⚠️ Nenhuma ação recebida.</h2>";
    echo '<a href="../visualizacao/index.php">🔙 Voltar ao menu</a>';
}
