<?php

    class Utente {

        public static function creaTabella($connessione) {

            try {
                $query = 'create table if not exists utenti (id int auto_increment primary key, nome text(20),cognome text(20), email varchar(30), password varchar(20), iban varchar(30), saldo double)';
                $statement = $connessione->prepare($query);
                $statement->execute();
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
    
        }

        public function registraUtente($connessione, $nome, $cognome, $email, $password) {

            if($this->controlloEmail($connessione, $email) === false) {
    
                try {
                    $query = 'insert into utenti values (?, ?, ?, ?, ?, ?, ?)';
                    $statement = $connessione->prepare($query);
                    $statement->execute([NULL, $nome, $cognome, $email, $password, $nome.$cognome, 0]);
                } catch (PDOException $error) {
                    echo $error->getMessage();
        
                }
    
            }
    
        }

        public function controlloEmail($connessione, $email) {

            try {
                $query = 'select * from utenti where email = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$email]);
                $row = $statement->fetch();
    
                if($row != NULL) {
                    return true;
                }else{
                    return false;
                }
    
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }
        
        public static function accessoUtente($connessione, $email, $password) {

            try {
                $query = 'select * from utenti where email = ? and password = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$email, $password]);
                $row = $statement->fetch();
                return $row;
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

        public function getSaldo($connessione, $id) {

            try {
                $query = 'select * from utenti where id = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$id]);
                $row = $statement->fetch();
                return $row['saldo'];
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

        public static function controlloIban($connessione, $iban) {

            try {
                $query = 'select * from utenti where iban = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$iban]);
                $row = $statement->fetch();
                if($row != NULL){
                    return true;
                }else {
                    return false;
                }
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

        public function controlloSoldi($connessione, $id, $soldi) {

            if($this->getSaldo($connessione, $id) - $soldi >= 0){
                return true;
            }else {
                return false;
            }
        
        }

        public static function setSoldi($connessione, $id, $soldi){

            try {
                $query = 'update utenti set saldo = ? where id = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$soldi, $id]);
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }

        }

        public static function getID($connessione, $iban) {

            try {
                $query = 'select * from utenti where iban = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$iban]);
                $row = $statement->fetch();
                return $row['id'];
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

        public static function getNome($connessione, $iban) {

            try {
                $query = 'select * from utenti where iban = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$iban]);
                $row = $statement->fetch();
                return $row['nome'];
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

        public static function getIban($connessione, $id) {

            try {
                $query = 'select * from utenti where id = ?';
                $statement = $connessione->prepare($query);
                $statement->execute([$id]);
                $row = $statement->fetch();
                return $row['iban'];
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
        
        }

    }

?>