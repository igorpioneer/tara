<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {

            $naziv = $_POST["naziv"];
            $idKategorija = $_POST["idKategorija"];
            $brojGresaka = 0;

            $reNaziv = '/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/';

            if(!preg_match($reNaziv, $naziv)){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka!"];
                http_response_code(400);
            }
            else{
                $update = izmenaKategorije($naziv, $idKategorija);

                if($update){
                    $odgovor = ["poruka" => "Uspešno ste izmenili kategoriju"];
                    http_response_code(200);
                }
                else{
                    $odgovor = ["poruka" => "Doslo je do greske prilikom upisa u bazu podataka"];
                    http_response_code(500);
                }
            }

            echo json_encode($odgovor);
        }
        catch (PDOException $exception){
            http_response_code(500);
            $odgovor = ["poruka" => "Doslo je do greske prilikom upisa u bazu podataka"];
            greske($exception->getMessage());
        }
    }
    else{
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }