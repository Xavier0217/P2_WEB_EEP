<?php
session_start();
require 'includes/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $stmt_check = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();
    
    if ($stmt_check->num_rows > 0) {
        $error = "E-mail já cadastrado!";
    } else {
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Erro ao cadastrar. Tente novamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles-loginCadastro.css">
</head>
<body>  
    <div class="login-container">
        <form method="POST" class="text-center">
            <h2 class="mb-4">Cadastre-se</h2>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success">
                    Cadastro feito com sucesso. <a href="login.php" class="text-orange">Faça Login</a>
                </div>
            <?php endif; ?>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Cadastrar</button>
            <div class="text-center">
                <a href="login.php" class="text-orange">Já tem conta? Faça login</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>