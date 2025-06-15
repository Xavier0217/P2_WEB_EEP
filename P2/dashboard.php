<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    require 'includes/config.php';

    $stmt = $conexao->prepare("SELECT * FROM eventos WHERE usuario_id=?");
    $stmt->bind_param("i",$_SESSION['user_id']);
    $stmt->execute( );
    $resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles-dashboard.css">
</head>
<body>
    <header class="container-fluid">
        <div class="container py-3">
            <h2>Bem-Vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2>
            <div class="header-buttons">
                <a class="btn" href="criar_evento.php">Criar Evento</a>
                <a class="btn" href="index.php">Acessar Mural Público</a>
                <a class="btn" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main class="container-fluid py-4">
        <div class="container">
            <h3>Seus eventos cadastrados:</h3>
            
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($evento = $resultado->fetch_assoc()): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($evento['titulo']); ?></h3>
                            <p class="card-text"><?php echo htmlspecialchars($evento['descricao']); ?></p>
                            <div class="btn-action-group">
                                <a class="btn" href="edit.php?id=<?php echo $evento['id']?>">Editar</a>
                                <div class="btn2">
                                    <a class="btn" href="delete.php?id=<?php echo $evento['id']?>" onclick="return confirm('Tem certeza que deseja excluir este evento?');">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-events">
                    <p>Você ainda não cadastrou nenhum evento.</p>
                    <a href="criar_evento.php" class="btn btn-primary">Criar Primeiro Evento</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>