<?php
    session_start();
    include "config/connection.php";
    include "models/functions.php";
    include "views/fixed/head.php";


    if(isset($_GET["page"])){
        switch ($_GET["page"]){
            case 'about':
                include "views/fixed/nav.php";
                include "views/pages/about.php";
                break;
            case 'author':
                include "views/fixed/nav.php";
                include "views/pages/author.php";
                break;
            case 'insert-post':
                include "views/fixed/nav.php";
                include "views/pages/insert-post.php";
                break;
            case 'single-post':
                include "views/fixed/nav.php";
                include "views/pages/single-post.php";
                break;
            case 'login':
                include "views/fixed/nav.php";
                include "views/pages/login.php";
                break;
            case 'registration':
                include "views/fixed/nav.php";
                include "views/pages/registration.php";
                break;
            case 'home':
                include "views/fixed/nav.php";
                include "views/pages/home.php";
                break;
            default:
                include "views/fixed/forbidden.php";
        }
    }
    else{
        include "views/fixed/nav.php";
        include "views/pages/home.php";
    }



    include "views/fixed/footer.php";
?>


