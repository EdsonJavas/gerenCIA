<?php
include 'config.php';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$conn->query("CREATE TABLE IF NOT EXISTS admin (id INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100), email VARCHAR(100), senha VARCHAR(255))");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        header('Location: sucesso.php');
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success-subtle d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border-radius: 1rem;">
  <h2 class="text-center text-success mb-3">Administrador</h2>
  <p class="text-center text-muted">Banco criado com sucesso! Cadastre seu usuário administrador.</p>
  <form method="POST">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>
      <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
      <label for="email">E-mail</label>
    </div>
    <div class="form-floating mb-4">
      <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
      <label for="senha">Senha</label>
    </div>
    <button type="submit" class="btn btn-success btn-lg w-100">Cadastrar Administrador</button>
  </form>
</div>
</body>
</html>
