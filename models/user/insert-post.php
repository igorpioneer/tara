<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try {
            $conn->beginTransaction();

            $naslov = $_POST["naslov"];
            $podnaslov = $_POST["podnaslov"];
            $slika = $_FILES["slika"];
            $kategorija = $_POST["kategorija"];
            $tekst = $_POST["tekst"];
            $brojGresaka = 0;
            $idKorisnik = $_SESSION["korisnik"]->id_korisnik;

            $slikaNaziv = time()."_".$slika["name"];
            $malaSlikaNaziv = time()."_mala_".$slika["name"];
            $tmpSlika = $slika["tmp_name"];
            $tipSlika = $slika["type"];
            $velicinaSlika = $slika["size"];
            $dozvoljeniTipovi = ["image/jpg", "image/png", "image/jpeg"];
            list($sirina, $visina) = getimagesize($tmpSlika);
            $novaSirina = 400;


            $reNaslov = '/^[A-Z][A-Za-z0-9\s\-_,\.:;?()\'\"]{2,99}$/';
            $reSlika = '/^[a-zA-Z0-9-_\.]+\.(jpg|png|jpeg)$/';
            $reTekst = '/^[A-Z][A-Za-z0-9\s\-_,\.:;()\'\"]+$/';

            if(!preg_match($reNaslov, $naslov)){
                $brojGresaka++;
            }
            if(!preg_match($reNaslov, $podnaslov)){
                $brojGresaka++;
            }
            if(!in_array($tipSlika, $dozvoljeniTipovi)){
                $brojGresaka++;
            }
            if($velicinaSlika > 3000000){
                $brojGresaka++;
            }
            if($kategorija == "0"){
                $brojGresaka++;
            }
            if(!preg_match($reTekst, $tekst)){
                $brojGresaka++;
            }

            if($brojGresaka != 0){
                $odgovor = ["poruka" => "Niste ispravno uneli podatke!"];
            }
            else{
                $exist = ifExist("postovi", $naslov, "naslov");

                if($exist){
                    $odgovor = ["poruka" => "U bazi već postoji post sa naslovom koji ste uneli!"];
                    http_response_code(409);
                }
                else{
                    $upis = unosPosta($naslov, $podnaslov, $tekst, $idKorisnik, $kategorija);

                    $postojecaSlika = null;
                    if($tipSlika == "image/jpeg"){
                        $postojecaSlika = imagecreatefromjpeg($tmpSlika);
                    }
                    elseif($tipSlika == "image/png"){
                        $postojecaSlika = imagecreatefrompng($tmpSlika);
                    }

                    $novaVisina = $visina * $novaSirina / $sirina;
                    $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

                    imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);

                    $putanjaNoveSlika = "assets/images/small-images/mala_".$malaSlikaNaziv;

                    if($tipSlika == "image/jpeg"){
                        imagejpeg($novaSlika, "../../".$putanjaNoveSlika, 75);
                    }
                    elseif($tipSlika == "image/png"){
                        imagepng($novaSlika, "../../".$putanjaNoveSlika, 7);
                    }

                    $putanjaOriginalneSlike = "assets/images/upload-images/".$slikaNaziv;

                    if(move_uploaded_file($tmpSlika, "../../".$putanjaOriginalneSlike)){

                    }

                    if($upis){
                        $idPost = $conn->lastInsertId();

                        $upisSlike = upisSlike($slikaNaziv, $malaSlikaNaziv, $idPost);

                        $odgovor = ["poruka" => "Uspešno ste uneli post!"];
                        http_response_code(201);
                    }
                    else{
                        $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo"];
                    }
                }
            }
            echo json_encode($odgovor);
            $conn->commit();
        }
        catch (PDOException $exception){
            $conn->rollBack();
            $odgovor = ["poruka" => "Došlo je do greške prilikom upisa u bazu podataka, pokušajte ponovo!"];
            http_response_code(500);
            echo json_encode($odgovor);
            greske($exception->getMessage());
        }
    }
    else{
        http_response_code(404);
        header("Location: ../../views/fixed/forbidden.php");
    }