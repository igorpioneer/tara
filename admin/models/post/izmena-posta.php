<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $conn->beginTransaction();

            $idPost = $_POST["idPost"];
            $idKorisnik = $_POST["idKorisnik"];
            $naslov = $_POST["naslov"];
            $podnaslov = $_POST["podnaslov"];
            $slika = $_FILES["slika"];
            $kategorija = $_POST["kategorija"];
            $tekst = $_POST["tekst"];
            $brojGresaka = 0;

            $slikaNaziv = time()."_".$slika["name"];
            $malaSlikaNaziv = time()."_mala_".$slika["name"];
            $tmpSlika = $slika["tmp_name"];
            $tipSlika = $slika["type"];
            $velicinaSlika = $slika["size"];
            $dozvoljeniTipovi = ["image/jpg", "image/png", "image/jpeg"];
            list($sirina, $visina) = getimagesize($tmpSlika);
            $novaSirina = 400;


            $reNaslov = '/^[A-Z][A-Za-z0-9\s\-_,\.:;?()\'\"]{2,99}$/';
            $reSlika = '/^[a-zA-Z0-9-_\.]+\.(jpg|png)$/';
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
                    $upis = izmeniPost($naslov, $podnaslov, $tekst, $idPost, $kategorija);

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
                        imagejpeg($novaSlika, "../../../".$putanjaNoveSlika, 75);
                    }
                    elseif($tipSlika == "image/png"){
                        imagepng($novaSlika, "../../../".$putanjaNoveSlika, 7);
                    }

                    $putanjaOriginalneSlike = "assets/images/upload-images/".$slikaNaziv;

                    if(move_uploaded_file($tmpSlika, "../../../".$putanjaOriginalneSlike)){

                    }

                    if($upis){

                        $upisSlike = izmeniSliku($slikaNaziv, $malaSlikaNaziv, $idPost);

                        $odgovor = ["poruka" => "Uspešno ste izmenili post!"];
                        http_response_code(200);
                    }
                    else{
                        $odgovor = ["poruka" => "Prvi"];
                    }
            }
            echo json_encode($odgovor);
            $conn->commit();
        }
        catch (PDOException $exception){
            $conn->rollBack();
            $odgovor = ["poruka" => "Drugi"];
            http_response_code(500);
            echo json_encode($odgovor);
        }
    }
    else{
        http_response_code(404);
        header("Location: ../../views/fixed/forbidden.php");
    }