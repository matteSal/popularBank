<?php

    class Movimento {

        public static function creaTabella($connessione) {

            try {
                $query = 'create table if not exists movimenti (id int auto_increment primary key,idUtente int, nome text(20), verso text(20), soldi double)';
                $statement = $connessione->prepare($query);
                $statement->execute();
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
    
        }

        public static function getUltimiMovimenti($connessione, $id) {

            try {
                $query = 'select * from movimenti where idUtente = ? order by id desc limit 3';
                $statement = $connessione->prepare($query);
                $statement->execute([$id]);
                $row = $statement->fetchAll();
                return $row;
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
    
        }

        public static function getMovimenti($connessione, $id) {

            try {
                $query = 'select * from movimenti where idUtente = ? order by id desc';
                $statement = $connessione->prepare($query);
                $statement->execute([$id]);
                $row = $statement->fetchAll();
                return $row;
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
    
        }

        public static function addMovimento($connessione, $idUtente, $nome, $verso, $soldi) {

            try {
                $query = 'insert into movimenti values(?, ?, ?, ?, ?)';
                $statement = $connessione->prepare($query);
                $statement->execute([NULL, $idUtente, $nome, $verso, $soldi]);
            } catch (PDOException $error) {
                echo $error->getMessage();
    
            }
    
        }

    }

?>