<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try {
        $idAutor = $_POST["idAutor"];

        $postovi = filterAutor($idAutor);
        if($postovi){
            echo json_encode([
                "postovi" => $postovi
            ]);
        }
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