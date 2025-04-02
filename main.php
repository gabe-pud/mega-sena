<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega Sena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-body mb-3">
            <div class="container-fluid">
                <a href="main.php" class="navbar-brand text-light">Mega Sena</a>
                <div class="containe d-flex justify-content-between align-middle">
                    <?php
                    session_start();

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
    <div class="container border rounded shadow p-5 w-50 mb-5">
        <div id="form">
            <img class="w-100" src="image.png" alt="" id="img">
            <p>Escolha 6 números entre 1 e 60 e tente acertar os números sorteados</p>
            <hr>
            <h2>Faça sua aposta:</h2>
            <form action="#" method="POST">
                <div class="container d-flex justify-content-between"id="input">
                    <input type="number" class="form-control p-1 me-2" name="n1" min=1 max=60>
                    <input type="number" class="form-control p-1 ms-2 me-2" name="n2" min=1 max=60>
                    <input type="number" class="form-control p-1 ms-2 me-2" name="n3" min=1 max=60>
                    <input type="number" class="form-control p-1 ms-2 me-2" name="n4" min=1 max=60>
                    <input type="number" class="form-control p-1 ms-2 me-2" name="n5" min=1 max=60>
                    <input type="number" class="form-control p-1 ms-2" name="n6" min=1 max=60>
                </div>
                <br><input class="btn btn-secondary" id="button" type="submit" value="apostar" name="apostar">
            </form>
        </div>
        <hr>
        <div id="resultado">
            <?php
            
            $acertos = 0;
            $numeros = array(); 
            $tentativas = array();

            while (count($numeros) < 6){
                $numero = random_int(1,60);
                if (!in_array($numero,$numeros)){
                    $numeros[] = $numero;
                    // echo $numero."<br>";
                }
            }

            sort($numeros);

            for ($i = 0; $i < 6; $i++){
                if (isset($_POST["n".($i+1)])){
                    for ($i = 0; $i < 6; $i++){
                        $tentativas[$i] = $_POST["n".($i+1)];

                        if ($tentativas[$i] == $numeros[$i]){
                            $acertos += 1;
                        }
                    }

                    echo "<h2>resultado da sua aposta:</h2>";
                    echo "<p>sua aposta: ";
                    for ($i = 0; $i < 6; $i++){
                        if ($_POST["n".($i+1)]){
                            echo $tentativas[$i];
                            if ($i < 5){
                                echo ",";
                            }
                        }
                    }
                    echo "</p><br>";
                }
            }

            echo "<p>Você acertou ".$acertos." número(s)</p>";
            echo "<br>";

            $resultado;
            echo "<div id=\"resultado-final\">";
            if ($acertos == 4) {
                $resultado = "Legal, você fez uma Quadra!"; 
            } elseif ($acertos == 5) {
                $resultado = "Quase lá, você acertou na Quina!";
            } elseif ($acertos == 6) {
                $resultado = "Parabéns, você ganhou na Mega Sena!";
            } else{
                $resultado = "Não foi dessa vez, tente novamente!";
            }
            echo "<h2>" . $resultado . "</h2>";
            echo "</div>";
            // Se o usuário acertar 6 números: "Parabéns, você ganhou na Mega Sena!"
            // Se o usuário acertar 5 números: "Quase lá, você acertou na Quina!"
            // Se o usuário acertar 4 números: "Legal, você fez uma Quadra!"
            // Se o usuário acertar 3 números ou menos: "Não foi dessa vez, tente novamente!"
            ?>
        </div>
        <hr>
        <div>
            
            <?php
            echo '<h2>Apostas Realizadas:</h2>';

            if (isset($_POST['apostar'])) {

                $nmarquivo = date("m-d-Y_H-i-s");
                $nome = "./apostas/" . $nmarquivo . ".txt";
                
                $arquivo = fopen($nome,"w");
                
                $textol1 = "Data: " . date("m-d-Y H:i:s") . "\n";
                $textol2 = "Aposta: ";
                $textol3 = "Acertos: ". $acertos . "\n";
                $textol4 = "Resultado: " . $resultado . "\n";

                for ($i = 0; $i < 6; $i++){
                    if (isset($_POST["n".($i+1)])){
                        $textol2 = $textol2 . $tentativas[$i];
                        if ($i < 5){
                            $textol2 = $textol2 . ",";
                        }
                    }
                }
                $textol2 = $textol2 . "\n";

                if($arquivo){
                    fwrite($arquivo, $textol1 . $textol2 . $textol3 . $textol4);
                    fclose($arquivo);
                }
            }

            $files = array_diff(scandir("./apostas/"), array('.', '..'));
            $fnum = 0;
            foreach ($files as $f){
                $arquivo = fopen("./apostas/".$f,"r");
                $nome = "./apostas/" . $f;
                $conteudo = fread($arquivo, filesize($nome));
                echo nl2br($conteudo);
                
                echo ' <form method="post" >
                    <button class="delbtn" type="submit" name="deletar" value="' . $f . '">Deletar</button>
                </form><br><br>';

                fclose($arquivo);
                $fnum ++;
            }

            if (isset($_POST['deletar'])) {
                $arquivoParaDeletar = "./apostas/". $_POST['deletar'];
            
                // Verifica se o arquivo existe e deleta
                if (file_exists($arquivoParaDeletar)) {
                    if (unlink($arquivoParaDeletar)) {
                        echo 'Arquivo "' . $_POST['deletar'] . '" deletado com sucesso!';
                    } else {
                        echo 'Erro ao deletar o arquivo "' . $_POST['deletar'] . '".';
                    }
                } else {
                    echo 'Arquivo não encontrado.';
                }
                header("Refresh: 0");
            }
            ?>
        </div>
</body>

</html>