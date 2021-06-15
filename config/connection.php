<?php

    include "config.php";

prikazPoseta();

try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);

    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function prikazPoseta(){
    if(isset($_SESSION["korisnik"])){
        $korisnik = $_SESSION["korisnik"];
        $ime = $korisnik->ime_korisnik;
        $prezime = $korisnik->prezime_korisnik;
        $posecenaStranica = $_SERVER["REQUEST_URI"];
        $datum = date("d. m. Y. h:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];

        $formatUpisa = $ime." ".$prezime."\t".$posecenaStranica."\t".$datum."\t".$ip."\n";

        $fajl = fopen(LOG_FILE, "a");
        $upis = fwrite($fajl, $formatUpisa);
        if($upis){
            fclose($fajl);
        }
    }
}

function greske($error){
    $fajl = fopen(BASE_URL . "data/errors.txt", "a");
    $string = date("d.m.Y h:i:s") ."\t" . $error . "\n";
    fwrite($fajl, $string);
    fclose($fajl);
}