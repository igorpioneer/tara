<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "../config/connection.php";
    include "functions.php";

    try {
        $email = $_POST["email"];
        $lozinka = $_POST["lozinka"];
        $brojGresaka = 0;

        $reEmail = '/^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/';
        $reLozinka = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/';

        $sifrovanaLozinka = md5($lozinka);

        if(!preg_match($reEmail, $email)){
            $brojGresaka++;
        }
        if(!preg_match($reLozinka, $lozinka)){
            $brojGresaka++;
        }

        if($brojGresaka != 0){
            $odgovor = ["poruka" => "Došlo je do greške prilikom obrade podataka!"];
        }
        else{
            $logovanje = logovanje($email, $sifrovanaLozinka);

            if($logovanje){
                $_SESSION["korisnik"] = $logovanje;
                $odgovor = ["poruka" => "Uspešno ste se ulogovali"];
                http_response_code(200);
            }
            else{
                $odgovor = ["poruka" => "Niste uneli dobre parametre"];
                http_response_code(401);
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