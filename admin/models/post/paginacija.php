<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $limit = $_POST["limit"];
            $nazivTabele = $_POST["nazivTabele"];

            $postovi = vratiSvePodatkeZaPostove($limit);
            $brojStranica = vratiBrojStranica($nazivTabele);

            echo json_encode([
                $nazivTabele => $postovi,
                "brojStranica" => $brojStranica
            ]);
            http_response_code(200);
        }
        catch (PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }