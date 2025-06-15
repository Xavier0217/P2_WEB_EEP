<?php
    session_start();
    require 'includes/config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt -> bind_param("s",$email);
        $stmt -> execute();

        $resultado = $stmt->get_result();
        if ($resultado->num_rows === 1){
            $usuario = $resultado->fetch_assoc();
            if($senha === $usuario['senha']){
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];  
                header("Location: dashboard.php");
                exit();
            }
            else {
                $error = "Senha incorreta!";
            }
        } 
        else {
            $error = "Usuario não encontrado";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles-loginCadastro.css">
</head>
<body>
    <div class="login-container">
        <form method="post" class="text-center">
            <h2 class="mb-4">Faça seu login!</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
            <div class="d-flex justify-content-between">
                <a href="registre.php" class="text-orange">Novo aqui? Cadastre-se</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>