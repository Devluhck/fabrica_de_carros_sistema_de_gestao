<?php
/**
 * Navbar Component - Componente reutilizável de navegação
 * Garante consistência visual e funcional em todas as páginas
 */
function renderNavbar() {
    // Detecta o caminho base baseado na localização do arquivo atual
    $scriptPath = $_SERVER['PHP_SELF'];
    $basePath = '';
    
    // Conta quantos níveis de diretório precisamos subir
    $pathParts = explode('/', trim($scriptPath, '/'));
    
    // Remove o nome do arquivo
    array_pop($pathParts);
    
    // Se estiver em controlador/ ou visualizacao/, precisa subir um nível
    if (in_array('controlador', $pathParts) || in_array('visualizacao', $pathParts)) {
        $basePath = '../';
    }
    // Se estiver na raiz do projeto, não precisa subir
    else {
        $basePath = '';
    }
    
    // Caminhos absolutos usando basePath
    $processaPath = $basePath . 'controlador/processa.php';
    $homePath = $basePath . 'visualizacao/index.php';
    
    // Garantir que os caminhos não tenham barras duplas
    $processaPath = str_replace('//', '/', $processaPath);
    $homePath = str_replace('//', '/', $homePath);
    
    return '
    <header class="navbar-professional">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="' . htmlspecialchars($homePath) . '" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 15px;">
                    <div class="logo-icon"><img src="../assets/img/logo_inovadora.png" alt="Logo Inovadora" style="height: 40px;"></div>
                    <div class="logo-text">
                        <span class="logo-main">FÁBRICA DE CARROS</span>
                        <span class="logo-subtitle">Sistema de Gestão</span>
                    </div>
                </a>
            </div>
            <nav class="navbar-nav">
                <ul class="nav-menu-list">
                    <li class="nav-item">
                        <a href="' . htmlspecialchars($homePath) . '" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-home"></i></span>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="' . htmlspecialchars($processaPath) . '" method="POST" class="nav-form">
                            <input type="hidden" name="acao" value="fabricar">
                            <button type="submit" class="nav-link nav-button">
                                <span class="nav-icon"><i class="fas fa-tools"></i></span>
                                <span class="nav-text">Fabricar</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="' . htmlspecialchars($processaPath) . '" method="POST" class="nav-form">
                            <input type="hidden" name="acao" value="vender">
                            <button type="submit" class="nav-link nav-button">
                                <span class="nav-icon"><i class="fas fa-handshake"></i></span>
                                <span class="nav-text">Vender</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="' . htmlspecialchars($processaPath) . '" method="POST" class="nav-form">
                            <input type="hidden" name="acao" value="ver_info">
                            <button type="submit" class="nav-link nav-button">
                                <span class="nav-icon"><i class="fas fa-warehouse"></i></span>
                                <span class="nav-text">Estoque</span>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="' . htmlspecialchars($processaPath) . '" method="POST" class="nav-form">
                            <input type="hidden" name="acao" value="finalizar_sessao">
                            <button type="submit" class="nav-link nav-button nav-danger">
                                <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                                <span class="nav-text">Finalizar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>';
}
?>
