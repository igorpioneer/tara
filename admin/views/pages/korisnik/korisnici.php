<?php
    $korisnici = korisniciSaUlogom();
    if(count($korisnici) == 0){
        echo "<p class='alert alert-danger text-center'>Trenutno nema korisnika u bazi podataka!</p>";
    }
    else{

?>
<div class="main-panel">
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <table class="table table-striped" id="korisnici">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-sort-numeric-down"></i></th>
                    <th scope="col">Ime i prezime</th>
                    <th scope="col">Mesto boravka</th>
                    <th scope="col">Email</th>
                    <th scope="col">Datum registracije</th>
                    <th scope="col">Uloga</th>
                    <th scope="col">Brisanje</th>
                    <th scope="col">Izmena</th>
                </tr>
                </thead>
                <tbody id="ispisKorisnika">
                <?php
                foreach ($korisnici as $index=> $k):
                ?>
                <tr>
                    <th><?= $index + 1 ?></th>
                    <td><?= $k->ime_korisnik." ".$k->prezime_korisnik ?></td>
                    <td><?= $k->prebivaliste ?></td>
                    <td><?= $k->email ?></td>
                    <td><?= $k->datum_registracije ?></td>
                    <td><?= $k->naziv_uloga ?></td>
                    <td><a href="#" class="brisi-korisnika" data-idkorisnik="<?= $k->id_korisnik ?>"><i class="fas fa-user-minus alert alert-danger"></i></a></td>
                    <td><a href="index.php?page=izmeni-korisnika&id=<?= $k->id_korisnik ?>"><i class="fas fa-user-edit alert alert-warning"></i></a></td>
                </tr>
                <?php
                    endforeach;
                ?>
                </tbody>
            </table>
            <form method="POST" action="models/korisnik/export.php">
                <input type="submit" value="Preuzmi listu korisnika" id="btnExportKorisnici" name="btnExportKorisnici" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="col-12 mx-auto">
        <nav aria-label="Page navigation example">
            <?php
                $brojStranica = vratiBrojStranica("korisnici");
            ?>
            <ul class="pagination" id="paginacijaRb">
                <?php
                    for($i = 0; $i < $brojStranica; $i++):
                        $_SESSION["limit"] = $i;
                ?>
                    <li class="page-item"><a class="page-link paginacija-korisnika" href="#" data-limit="<?=$i?>" ><?= $i + 1 ?></a></li>
                <?php
                    endfor;
                ?>
            </ul>
        </nav>
    </div>
</div>

<?php
    }