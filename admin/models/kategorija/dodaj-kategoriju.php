<?php
    session_start();
    header("Content-type: application/json");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $naziv = $_POST["naziv"];
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
                $upis = upisKategorije($naziv);

                if($upis){
                    $odgovor = ["poruka" => "Uspešno ste uneli kategoriju u bazu podataka!"];
                    http_response_code(201);
                }
                else{
                    $odgovor = ["poruka" => "Došlo je go greške prilikom upisa u bazu podataka, pokušajte kasnije!"];
                    http_response_code(500);
                }
            }
            echo json_encode($odgovor);

        }
        catch (PDOException $exception) {
            http_response_code(500);
            $odgovor = ["poruka" => "Došlo je go greške prilikom upisa u bazu podataka, pokušajte kasnije."];
            echo json_encode($odgovor);
            greske($exception->getMessage());
        }
    }
    else {
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }