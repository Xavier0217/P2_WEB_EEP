<?php

require 'includes/config.php';

$query = "SELECT * FROM eventos ORDER BY data_evento ASC";
$resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademicLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles-index.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">AcademicLink</a>
            <div class="navbar-nav">
                <a class="nav-link dashboard" href="dashboard.php">Dashboard</a>
            </div>
        </div>
    </nav>
    <header class="container-fluid">
        <div class="container py-5">
            <h1>Eventos Incríveis</h1>
            <p class="subtitle">Descubra os melhores eventos da sua região e participe das experiências mais marcantes</p>
        </div>
    </header>

    <main class="container-fluid py-4">
        <div class="container">
            <h2 class="text-center mb-5">Próximos Eventos</h2>
            
            <?php if ($resultado->num_rows > 0): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php while ($evento = $resultado->fetch_assoc()): ?>
                        <div class="col">
                            <div class="card h-100">
                                <?php if (!empty($evento['imagem'])): ?>
                                    <img src="<?php echo htmlspecialchars($evento['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($evento['titulo']); ?>">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x200?text=Evento" class="card-img-top" alt="Imagem do Evento">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($evento['titulo']); ?></h5>
                                    <p class="card-text">
                                        <?php echo nl2br(htmlspecialchars($evento['descricao'])); ?>
                                    </p>
                                    <p class="card-text"><strong>Categoria:</strong> <?php echo htmlspecialchars($evento['categoria']); ?></p>
                                    <div class="text-center mt-3">
                                        <a href="evento.php?id=<?php echo $evento['id']; ?>" class="btn btn">Saiba mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="no-events">
                    <h3>Nenhum evento disponível no momento</h3>
                    <p>Parece que não há eventos cadastrados ainda. Que tal ser o primeiro a criar um evento incrível?</p>
                    <a href="login.php" class="btn btn">Acesse sua conta</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="container-fluid">
        <div class="container">
            <p>©2025 AcademicLink. Todos os direitos reservados.</p>
            <p class="small">Desenvolvido com ❤️ para amantes de eventos memoráveis</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>