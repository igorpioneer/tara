<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {

            $sadrzaj = $_POST["sadrzaj"];
            $idKomentar = $_POST["idKomentar"];
            $brojGresaka = 0;

            $reSadrzaj = '/^[A-Z][A-Za-z0-9\s\-_,\.:;()\'\"]+$/';

            if(!preg_match($reSadrzaj, $sadrzaj)){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka!"];
                http_response_code(400);
            }
            else{
                $update = izmenaKomentara($sadrzaj, $idKomentar);

                if($update){
                    $odgovor = ["poruka" => "Uspešno ste izmenili komentar"];
                    http_response_code(200);
                }
                else{
                    $odgovor = ["poruka" => "Doslo je do greske prilikom upisa u bazu podataka, pokušajte kasnije!"];
                    http_response_code(500);
                }
            }

            echo json_encode($odgovor);
        }
        catch (PDOException $exception){
            http_response_code(500);
            $odgovor = ["poruka" => "Doslo je do greske prilikom upisa u bazu podataka, pokušajte kasnije!"];
            greske($exception->getMessage());
        }
    }
    else{
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }