<?php require_once '../includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FÁBRICA DE CARROS | Sistema de Gestão Profissional</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <?php echo renderNavbar(); ?>

    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section-static">
            <div class="hero-overlay"></div>
            <div class="hero-content-static">
                <h1 class="hero-title-static">Sistema de Gestão de Fábrica</h1>
                <p class="hero-subtitle-static">Gerencie sua fábrica de carros de forma moderna, eficiente e profissional</p>
            </div>
        </section>

        <!-- Seção de Cards -->
        <section class="cards-sections">
            <div class="container">
                <!-- New Arrivals -->
                <div class="card-section">
                    <h2 class="section-title">Novos Modelos</h2>
                    <div class="cards-grid">
                        <div class="car-card">
                            <div class="car-card-image">
                                <img src="../assets/img/7Zh6H7mrO7I9.webp" alt="Novo Modelo 1">
                            </div>
                            <div class="car-card-content">
                                <h3>Modelo Premium</h3>
                                <p>Novo lançamento da fábrica</p>
                            </div>
                        </div>
                        <div class="car-card">
                            <div class="car-card-image">
                                <img src="../assets/img/9xr7QA5A8qYM.jpg" alt="Novo Modelo 2">
                            </div>
                            <div class="car-card-content">
                                <h3>Modelo Esportivo</h3>
                                <p>Alta performance e design</p>
                            </div>
                        </div>
                        <div class="car-card">
                            <div class="car-card-image">
                                <img src="../assets/img/1wdI2rxj5OIz.jpg" alt="Novo Modelo 3">
                            </div>
                            <div class="car-card-content">
                                <h3>Modelo Executivo</h3>
                                <p>Conforto e elegância</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
