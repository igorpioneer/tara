<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {

            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $idKorisnik = $_POST["idKorisnik"];
            $email = $_POST["email"];
            $lozinka = $_POST["lozinka"];
            $mesto = $_POST["mesto"];
            $uloga = $_POST["uloga"];
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
            if($uloga == "0"){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka!"];
            }
            else{
                $update = izmenaPodatakaOKorisniku($ime, $prezime, $mesto, $email, $sifrovanaLozinka, $uloga, $idKorisnik);

                if($update){
                    $odgovor = ["poruka" => "Uspešno ste izmenili podatke o korisniku"];
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
            echo json_encode($odgovor);
            greske($exception->getMessage());
        }
    }
    else{
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }