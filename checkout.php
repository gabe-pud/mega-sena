<?php
session_start();

if (!isset($_SESSION['online']) || !$_SESSION['online']) {
    header('Location: login.php');
    exit;
}

$produtoSelecionado = isset($_POST['produto']) ? $_POST['produto'] : "Produto desconhecido";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <header> 
    <header>
        <nav class="navbar bg-dark border-bottom border-body mb-5">
            <div class="container-fluid">
                <a href="main.php" class="navbar-brand text-light">Mega Sena</a>
                <div class="containe d-flex justify-content-between align-middle">
                    <?php

                    if(isset($_POST['sair'])){
                        session_destroy();
                        header("location: login.php");
                    }

                    if(isset($_POST['btnLoja'])){
                        header("location: loja.php");
                    }
                    if(isset($_POST['fcompra'])){
                        header("location: loja.php");
                    }

                    if ($_SESSION['online'] == True){
                        echo "<span id='Hemail' class='navbar-brand text-light me-3'>" . $_SESSION['email'] . "</span>";
                    } else {
                        session_destroy();
                        header("location: login.php");
                    }
                    ?>
                    <form action="#" method="POST" class="d-flex w-50 justify-content-between">
                        <input class="btn btn-secondary me-3" type="submit" name="btnLoja" value="retornar à loja">
                        <input class="btn btn-secondary" type="submit" name="sair" value="sair">
                    </form>
                </div>
            </div>
        </nav>
        
    </header>   
    </header>
    <div  class="container border rounded shadow p-5 w-50 mb-5">
        <h2>Produto Selecionado: <span class="produto-nome"><?php echo htmlspecialchars($produtoSelecionado); ?></span></h2>
        <form action="#" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="email" class="form-control" id="nome" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco">
        </div>
        <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep">
        </div>
        <label for="metodo-pagamento">Metodo de pagamento</label>
        <select class="form-select mb-5" aria-label="Default select example" id="metodo-pagamento">
            <option value="1">Cartão de crédito</option>
            <option value="2">Cartão de debto</option>
            <option value="3">Pix</option>
        </select>
        <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto" name="fcompra">finalizar compra</button>
        </form>
    </div>
    
</body>
</html>