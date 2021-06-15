<?php
   session_start();
   if(isset($_SESSION["korisnik"])){
       $korisnik = $_SESSION["korisnik"];
       if($korisnik->naziv_uloga == "admin"){
           include "../config/connection.php";
           include "models/admin-functions.php";
           include "views/fixed/head.php";
           include "views/fixed/nav.php";
           include "views/fixed/sidebar.php";


           if(isset($_GET["page"])){
               switch ($_GET["page"]){
                   case 'korisnici':
                       include "views/pages/korisnik/korisnici.php";
                       break;
                   case 'dodaj-korisnika':
                       include "views/pages/korisnik/dodaj-korisnika.php";
                       break;
                   case 'postovi':
                       include "views/pages/post/postovi.php";
                       break;
                   case 'dodaj-post':
                       include "views/pages/post/dodaj-post.php";
                       break;
                   case 'kategorije':
                       include "views/pages/kategorija/kategorije.php";
                       break;
                   case 'dodaj-kategorije':
                       include "views/pages/kategorija/dodaj-kategorije.php";
                       break;
                   case 'komentari':
                       include "views/pages/komentar/komentari.php";
                       break;
                   case 'dodaj-komentar':
                       include "views/pages/komentar/dodaj-komentar.php";
                       break;
                   case 'prikaz-log':
                       include "views/pages/statistika/prikaz-log.php";
                       break;
                   case 'posecenost':
                       include "views/pages/statistika/posecenost.php";
                       break;
                   case 'izmeni-korisnika':
                       include "views/pages/korisnik/izmeni-korisnika.php";
                       break;
                   case 'izmeni-post':
                       include "views/pages/post/izmeni-post.php";
                       break;
                   case 'izmeni-kategoriju':
                       include "views/pages/kategorija/izmeni-kategoriju.php";
                       break;
                   case 'izmeni-komentar':
                       include "views/pages/komentar/izmeni-komentar.php";
                       break;
                   default:
                       include "views/fixed/forbidden.php";
               }
           }

           include "views/fixed/footer.php";

       }
       else{
           header('Location: views/fixed/forbidden.php');
       }
   }
   else{
       header('Location: views/fixed/forbidden.php');
   }
?>