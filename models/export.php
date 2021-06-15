<?php
    include "../config/connection.php";
    include "functions.php";
    $author = autor();
    header("Content-type:application/vnd.ms-word");
    header("Content-Disposition:attachment;Filename=author.doc");



    echo "<html>";
    echo"<metahttp-equiv=\"ContentType\"content=\"text/html;charset=Windows-1252\">";
    echo"<body>";
    echo"<h6>Ime:$author->ime_prezime</h6>";
    echo"<h6>Broj indeksa:$author->broj_indeksa</h6>";
    echo"<h6>Smer: $author->smer_ict</h6>";
    echo"<h6>Mesto:$author->mesto</h6>";
    echo"<h6>Email:$author->email</h6>";
    echo"</body>";
    http_response_code(200);

?>