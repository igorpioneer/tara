<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try {
            $komentar = $_POST["komentar"];
            $postId = $_POST["postId"];
            $userId = $_SESSION["korisnik"]->id_korisnik;
            $brojGresaka = 0;

            $reKomentar = '/^[A-Z][A-Za-z0-9\s\-_,\.:;!?()\'\"]+$/';

            if(!preg_match($reKomentar, $komentar)){
                $brojGresaka++;
            }
            if($postId <= 0){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka"];
                http_response_code(400);
            }
            else{
                $upis = upisKomentara($komentar, $userId, $postId);

                if($upis){
                    $odgovor = ["poruka" => "Uspešno ste uneli komentar!"];
                    http_response_code(201);
                }
                else{
                    $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo!"];
                    http_response_code(500);
                }
            }

            echo json_encode($odgovor);
        }
        catch (PDOException $exception){
            $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo!"];
            http_response_code(500);
            echo json_encode($odgovor);
            greske($exception->getMessage());
            var_dump($exception);
        }
    }
    else{
        http_response_code(404);
        header("Location: ../../views/fixed/forbidden.php");
    }