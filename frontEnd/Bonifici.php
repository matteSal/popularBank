<?php
    session_start();
    include '../backEnd/Utente.php';
    include '../backEnd/Config.php';
    include '../backEnd/Movimento.php';

    $utente = new Utente();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stileHome.css">
    <link rel="stylesheet" href="stileBonifici.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <title>Effettua un bonifico</title>
</head>
<body>
    <div class="contenitoreSaldo">
        <h1 class="puoiSpendere">PUOI INVIARE MASSIMO:</h1>
        <h1 class="saldo"><?php echo $utente->getSaldo($connessione, $_SESSION['sessioneid'])?> €</h1>
    </div>
    <div class="menu">
        <div class="icone">
            <a href="Bonifici.php"><ion-icon  name="cash-outline"></ion-icon></a>
            <a href="movimenti.php"><ion-icon name="document-outline"></ion-icon></a>
            <a href="carta.php"><ion-icon name="card-outline"></ion-icon></a>
            <a href="Home.php"><ion-icon name="home-outline"></ion-icon></a>
        </div>
    </div>
    <form action="" method="POST">
        <div class="contenitoreForm">
            <input class="iban" type="text" name="iban" placeHolder="Inserisci iban">
            <input class="soldiDaInviare" type="text" name="soldi" placeHolder="Inserisci i soldi da inviare">
            <input class="motivoTransazione" type="text" name="motivazione" placeHolder="Inserisci il motivo della transazione">
            <input class="bottone" type="submit" name="button" value="Invia soldi">
        </div>
    </form>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>

<?php

    if(isset($_POST['button'])) {

        $ibanEsiste = Utente::controlloIban($connessione, $_POST['iban']);
        $haSoldi = $utente->controlloSoldi($connessione, $_SESSION['sessioneid'], $_POST['soldi']);

        if($ibanEsiste) {
            if($haSoldi) {
                Utente::setSoldi($connessione, $_SESSION['sessioneid'], $utente->getSaldo($connessione, $_SESSION['sessioneid']) - (int) $_POST['soldi']);
                Utente::setSoldi($connessione, Utente::getID($connessione, $_POST['iban']), $utente->getSaldo($connessione, Utente::getID($connessione, $_POST['iban'])) + (int) $_POST['soldi']);
                Movimento::addMovimento($connessione, $_SESSION['sessioneid'], Utente::getNome($connessione, $_POST['iban']), 'Uscita', $_POST['soldi']);
                Movimento::addMovimento($connessione, Utente::getID($connessione, $_POST['iban']), Utente::getNome($connessione, Utente::getIban($connessione, $_SESSION['sessioneid'])), 'Entrata', $_POST['soldi']);
                header('Location: Home.php');
            }
        }

    }


?>