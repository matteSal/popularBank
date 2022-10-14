<?php
    session_start();

    include '../backEnd/Utente.php';
    include '../backEnd/Config.php';

    Utente::creaTabella($connessione);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stileAccesso.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <title>Accedi alla tua banca online</title>
</head>
<body>
    <form action="" method="POST">
        <div class="contenitore">
            <ion-icon name="mail-outline" class="icona1"></ion-icon>
            <ion-icon name="lock-closed-outline" class="icona2"></ion-icon>
            <h1 class="inserisciEmail">Inserisci qui l'e-mail:</h1>
            <input class="email" type="text" name="email">
            <h1 class="inserisciPass">Inserisci qui la password:</h1>
            <input class="password" type="text" name="password">
            <input class="bottone" type="submit" name="button" value="Accedi">
        </div>
    </form>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>

<?php

    if(isset($_POST['button'])) {
        
        $array = Utente::accessoUtente($connessione, $_POST['email'], $_POST['password']);

        if($array != NULL) {
            $_SESSION['sessioneid'] = $array['id'];
            header('Location: Home.php');
        }
    }

?>
