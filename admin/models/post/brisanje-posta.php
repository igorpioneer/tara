<?php
    session_start();
    header("Content-type: application/json");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $idKorisnik = $_POST["idKorisnik"];

            $brisanje = brisanje("postovi", "id_post", $idKorisnik);
            $limit = $_SESSION["limit"];

            if($brisanje){
                $postovi = vratiSvePodatkeZaPostove($limit);

                echo json_encode([
                    "postovi" => $postovi,
                    "limit" => $limit
                ]);
                http_response_code(200);
            }
            else{
                http_response_code(404);
            }

            http_response_code(200);
        } catch (PDOException $exception) {
            http_response_code(500);
            greske($exception->getMessage());
            var_dump($exception);
        }
    } else {
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }