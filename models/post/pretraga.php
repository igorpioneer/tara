<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try {
        $unos = "%".strtolower($_POST["unos"])."%";

        $pretraga = pretraga($unos);

        echo json_encode([
            "pretraga" => $pretraga
        ]);
        http_response_code(200);

    }
    catch (PDOException $exception){
        $odgovor = ["poruka" => "Došlo je do greške sa bazom podataka, pokušajte ponovo!"];
        http_response_code(500);
        echo json_encode($odgovor);
        greske($exception->getMessage());
    }
}
else{
    http_response_code(404);
    header("Location: ../views/fixed/forbidden.php");
}