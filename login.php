<?php
    session_start();

    if(isset($_POST["enviar"])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $Lemail = "aluno@fatec.edu.br";
        $Lsenha = "alunoweb2";

        if ($email == $Lemail && $senha == $Lsenha){
            setcookie("email",$email,time() + 86400 * 7);
            setcookie("senha",$senha,time() + 86400 * 7);
            $_SESSION['email'] = $email;
            $_SESSION['online'] = True;
            header("location: main.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; justify-content:center; align-items: center; height: 100vh;">
    <div class="container border rounded shadow p-5 w-50">
        <form id="login" action="" method="POST">
            <h2>Log-in</h2>
            <div class="mb-3 d-grid gap-2 col-7 mx-auto">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control w-100" id="email" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3 d-grid gap-2 col-7 mx-auto">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control w-100" id="senha" aria-describedby="emailHelp" name="senha">
            </div>
            <button type="submit" class="btn btn-primary d-grid gap-2 col-4 mx-auto" name="enviar">log-in</button>

        </form>
    </div>
</body>
</html>