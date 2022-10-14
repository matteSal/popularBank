<?php
    session_start();

    include '../backEnd/Utente.php';
    include '../backEnd/Config.php';

    $utente = new Utente();
    Utente::creaTabella($connessione);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stileRegistrazione.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <title>Accedi alla tua banca online</title>
</head>
<body>
    <form action="" method="POST">
        <div class="contenitore">
            <h1 class="inserisciNome">Inserisci qui il tuo nome:</h1>
            <input class="nome" type="text" name="nome">
            <h1 class="inserisciCognome">Inserisci qui il tuo cognome:</h1>
            <input class="cognome" type="text" name="cognome">
            <ion-icon name="chevron-forward-outline" class="icona1"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="icona2"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="icona3"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="icona4"></ion-icon>
            <h1 class="inserisciEmail">Inserisci qui l'e-mail:</h1>
            <input class="email" type="text" name="email">
            <h1 class="inserisciPass">Inserisci qui la password:</h1>
            <input class="password" type="text" name="password">
            <input class="bottone" type="submit" name="button" value="Registrati">
        </div>
    </form>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>

<?php

    if(isset($_POST['button'])) {
        
        $utente->registraUtente($connessione, $_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password']);
        header('Location: accesso.php');

    }

?>
