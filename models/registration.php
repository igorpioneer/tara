<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../config/connection.php";
        include "functions.php";

        try {
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $email = $_POST["email"];
            $lozinka = $_POST["lozinka"];
            $mesto = $_POST["mesto"];
            $brojGresaka = 0;

            $reIme = '/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,14}$/';
            $rePrezime = '/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/';
            $reEmail = '/^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/';
            $reLozinka = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/';

            $sifrovanaLozinka = md5($lozinka);

            if(!preg_match($reIme, $ime)){
                $brojGresaka++;
            }
            if(!preg_match($rePrezime, $prezime)){
                $brojGresaka++;
            }
            if(!preg_match($reEmail, $email)){
                $brojGresaka++;
            }
            if(!preg_match($reLozinka, $lozinka)){
                $brojGresaka++;
            }
            if(!preg_match($rePrezime, $mesto)){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka!"];
                http_response_code(400);
            }
            else{
                $exist = ifExist("korisnici", $email, "email");

                if($exist){
                    $odgovor = ["poruka" => "Vaš email je već registrovan!"];
                    http_response_code(409);
                }
                else{
                    $idUloga = 2;
                    $upis = unosKorisnika($ime, $prezime, $email, $sifrovanaLozinka, $mesto, $idUloga);
                    if($upis){
                        $odgovor = ["poruka" => "Uspešno ste se registrovali!"];
                        http_response_code(201);
                    }
                    else{
                        $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo!"];
                        http_response_code(500);
                    }
                }
            }
            echo json_encode($odgovor);
        }
        catch (PDOException $exception){
            $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo!"];
            http_response_code(500);
            echo json_encode($odgovor);
            greske($exception->getMessage());
        }
    }
    else{
        http_response_code(404);
        header("Location: ../views/fixed/forbidden.php");
    }