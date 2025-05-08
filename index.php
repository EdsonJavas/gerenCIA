<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['servidor'], $_POST['usuario'], $_POST['senha'], $_POST['base'])) {
    $servidor = $_POST['servidor'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $base = $_POST['base'];

    $conn = new mysqli($servidor, $usuario, $senha);
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS `$base`";
    if ($conn->query($sql) === TRUE) {
        file_put_contents('config.php', "<?php\n\$host = '$servidor';\n\$user = '$usuario';\n\$pass = '$senha';\n\$dbname = '$base';\n");
        header('Location: cadastro_admin.php');
        exit;
    } else {
        echo "Erro ao criar o banco de dados: " . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Gerenciamento de Credenciais</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gradient bg-primary-subtle d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 1rem;">
  <h2 class="text-center text-primary mb-4">Gerenciar Credenciais</h2>
  <p class="text-center text-muted">Configure a conexão com o banco de dados do sistema Devisate.</p>
  <form method="POST">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="servidor" id="servidor" placeholder="localhost" required>
      <label for="servidor">Servidor</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="usuario" id="usuario" placeholder="root" required>
      <label for="usuario">Usuário</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="senha" id="senha" placeholder="senha" required>
      <label for="senha">Senha</label>
    </div>
    <div class="form-floating mb-4">
      <input type="text" class="form-control" name="base" id="base" placeholder="sistema" required>
      <label for="base">Base de Dados</label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg w-100">Criar Banco de Dados</button>
  </form>
</div>
</body>
</html>
