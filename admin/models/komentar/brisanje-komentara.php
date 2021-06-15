<?php
    session_start();
    header("Content-type: application/json");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $idKomentar = $_POST["idKomentar"];

            $brisanje = brisanje("komentari", "id_komentar", $idKomentar);
            $limit = $_SESSION["limit"];

            if($brisanje){
                $komentari = vratiKomentareSaKorisnikomIPostomLimit($limit);

                echo json_encode([
                    "komentari" => $komentari,
                    "limit" => $limit
                ]);
                http_response_code(200);
            }
            else{
                http_response_code(404);
            }

            http_response_code(200);

        }
        catch (PDOException $exception) {
            http_response_code(500);
            greske($exception->getMessage());
        }
    }
    else {
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }