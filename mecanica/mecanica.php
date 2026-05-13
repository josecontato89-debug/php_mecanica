<?php
    session_start();
    if (!isset($_SESSION['nome'])) {
        header('Location: index.php?status=erro&msg=Acesso negado');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="imagens/logo_aba.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Mecanica</title>
        <style>
            body {
                background-color: #DCDCDC;
            }
            .header {
                float: right;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <img src="imagens/banner.png" width="50%" heigth="50%">
            <?php
                echo "<div class='header'>";
                if (isset($_SESSION['nome'])) {
                    $nome = $_SESSION['nome'];
                    echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'>
                        <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/>
                        <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1'/>
                        </svg>&nbsp;<b>".$nome."</b> | <a href='sair.php' style='color: black; text-decoration: none; font-weight: bold;'>SAIR</a>";
                }
                echo "</div>";
            ?>
        </div>
        <br/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <nav>
            <?php
                include 'menu.php';
            ?>
        </nav>
    </body>
</html>