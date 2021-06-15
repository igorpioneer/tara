<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../../config/connection.php";
        include "../admin-functions.php";

        try {
            $limit = $_POST["limit"];
            $nazivTabele = $_POST["nazivTabele"];

            $korisnici = korisniciSaUlogom($limit);
            $brojStranica = vratiBrojStranica($nazivTabele);

            echo json_encode([
                $nazivTabele => $korisnici,
                "brojStranica" => $brojStranica
            ]);
            http_response_code(200);
        }
        catch (PDOException $exception){
            http_response_code(500);
            greske($exception->getMessage());
        }
    }
    else{
        header("Location: ../../views/fixed/forbidden.php");
        http_response_code(404);
    }