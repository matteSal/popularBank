<?php

     $host = "localhost";

     $user = "root";

     $password = "";

     $db = "popularbank";



    try{
        $connessione = new PDO("mysql:host=$host;dbname=$db",$user,$password);
        $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $error){
        echo "connection failed" . $error->getMessage();
    }

?>
