<?php
    session_start();
    include '../backEnd/Utente.php';
    include '../backEnd/Config.php';
    include '../backEnd/Movimento.php';
    $utente = new Utente();
    Movimento::creaTabella($connessione);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stileHome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <title>I tuoi movimenti</title>
</head>
<body>
    <div class="contenitoreSaldo">
        <h1 class="puoiSpendere">PUOI SPENDERE</h1>
        <h1 class="saldo"><?php echo $utente->getSaldo($connessione, $_SESSION['sessioneid'])?> €</h1>
    </div>
    <div>
        <h1 class="movimenti">Tutti i tuoi movimenti</h1>
    </div>
    <div class="contenitoreMovimentiInteri">
        <?php

            $array = Movimento::getMovimenti($connessione, $_SESSION['sessioneid']);

            foreach($array as $onearray) {
                echo "<div class='movimento1'>";
                if($onearray['verso'] === 'Uscita') {
                    echo "<h1>Hai effettuato un bonifico a</h1>";
                    echo "<h3>- ".$onearray['soldi']." €</h3>";
                }else {
                    echo "<h1>Hai ricevuto un bonifico da</h1>";
                    echo "<h3>+ ".$onearray['soldi']." €</h3>";
                }
                echo "<h2>".$onearray['nome']."</h2>
                </div>";
            }
        ?>
    </div>
    <div class="menu">
        <div class="icone">
            <a href="Bonifici.php"><ion-icon name="cash-outline"></ion-icon></a>
            <a href="movimenti.php"><ion-icon name="document-outline"></ion-icon></a>
            <a href="carta.php"><ion-icon name="card-outline"></ion-icon></a>
            <a href="Home.php"><ion-icon name="home-outline"></ion-icon></a>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>