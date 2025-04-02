<?php
session_start();

if (!isset($_SESSION['online']) || !$_SESSION['online']) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['sair'])) {
    session_destroy();
    setcookie('email', '', time() - 3600, '/'); 
    header('Location: login.php');
    exit;
}

function carregarProdutos()
{
    $url = 'https://fakestoreapi.com/products';
    $dados = file_get_contents($url);
    if ($dados === false) {
        echo "Erro ao carregar os produtos.";
        return [];
    }
    return json_decode($dados, true);
}

$produtos = carregarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="lojastyle.css">
</head>

<body>
<header>
        <nav class="navbar bg-dark border-bottom border-body mb-3">
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

                    if ($_SESSION['online'] == True){
                        echo "<span id='Hemail' class='navbar-brand text-light me-3'>" . $_SESSION['email'] . "</span>";
                    } else {
                        session_destroy();
                        header("location: login.php");
                    }
                    ?>
                    <form action="#" method="POST" class="d-flex w-50 justify-content-between">
                        <input class="btn btn-secondary me-3" type="submit" name="btnLoja" value="visite nossa loja">
                        <input class="btn btn-secondary" type="submit" name="sair" value="sair">
                    </form>
                </div>
            </div>
        </nav>
        
    </header>

    <div class="container border rounded shadow mb-5">
        <h1 class="text-center mt-3">Loja Online</h1>
        <div class="produtos">
            <?php foreach ($produtos as $produto): ?>
                <div class="produto">
                    <img src="<?php echo htmlspecialchars($produto['image']); ?>" alt="<?php echo htmlspecialchars($produto['title']); ?>">
                    <h2><?php echo htmlspecialchars($produto['title']); ?></h2>
                    <p><?php echo htmlspecialchars(substr($produto['description'], 0, 100)) . '...'; ?></p>
                    <p>R$ <?php echo number_format($produto['price'], 2, ',', '.'); ?></p>
                    <form method="POST" action="checkout.php">
                        <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto['title']); ?>">
                        <button type="submit">Comprar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
