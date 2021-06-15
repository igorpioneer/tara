<?php
    session_start();
    include "../../../config/connection.php";
    include "../admin-functions.php";
    header("Content-type:application/xls");
    header("Content-Disposition:attachment;Filename=Korisnici.xls");

    if(isset($_POST['btnExportKorisnici'])){

        $ispis="";
        $korisnici = vratiSve("korisnici");
        if(count($korisnici) > 0):
            $ispis.='
                <table>
                    <thead>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>EMail</th>
                            <th>Datum registracije</th>
                            <th>Uloga</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach($korisnici as $k):
            ?>
        <tr>
            <td><?= $k->ime_korisnik." ".$k->prezime_korisnik ?></td>
            <td><?= $k->email ?></td>
            <td><?= $k->datum_registracije ?></td>
            <td><?= $k->prebivaliste ?></td>
        </tr>
<?php
        endforeach;
        $ispis.= `</tbody></table>`;
        endif;


        echo $ispis;
    }
    else{
        http_response_code(404);
    }
    ?>