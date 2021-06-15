<?php

define("BASE_URL", $_SERVER["DOCUMENT_ROOT"]."/idegas/Tara/");
define("ENV_FILE", BASE_URL."config/.env");
define("LOG_FILE", BASE_URL."data/log.txt");


define("SERVER", env("SERVER"));
define("DATABASE", env("DATABASE"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($marker){
    $niz = file(ENV_FILE);

    $trazenaVrednost = "";

    foreach ($niz as $red) {
        $red = trim($red);

        list($key, $value) = explode("=", $red);

        if($marker == $key){
            $trazenaVrednost = $value;
            break;
        }
    }
    return $trazenaVrednost;
}