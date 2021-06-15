<?php
    session_start();
    header("Content-type: application/json");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $idKategorija = $_POST["idKategorija"];

            $brisanje = brisanje("kategorije", "id_kategorija", $idKategorija);

            if($brisanje){
                $kategorije = vratiSve("kategorije");

                echo json_encode([
                    "kategorije" => $kategorije,
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
        }
    } else {
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }