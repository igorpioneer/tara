<?php
$komentari = vratiKomentareSaKorisnikomIPostomLimit();
if(count($komentari) == 0){
    echo "<p class='alert alert-danger text-center'>Trenutno nema komentara u bazi podataka!</p>";
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
                        <th scope="col">Autor</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Post</th>
                        <th scope="col">Datum komentarisanja</th>
                        <th scope="col">Brisanje</th>
                        <th scope="col">Izmena</th>
                    </tr>
                    </thead>
                    <tbody id="ispisKomentara">
                    <?php
                    foreach ($komentari as $index=> $k):
                        ?>
                        <tr>
                            <th><?= $index + 1 ?></th>
                            <td><?= $k->ime_korisnik ?> <?= $k->prezime_korisnik ?></td>
                            <td><?= $k->sadrzaj_komentar ?></td>
                            <td><?= $k->naslov ?></td>
                            <td><?= $k->datum_komentara ?></td>
                            <td><a href="#" class="brisi-komentar" data-idkomentar="<?= $k->id_komentar ?>"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                            <td><a href="index.php?page=izmeni-komentar&id=<?= $k->id_komentar ?>"><i class="far fa-edit alert alert-warning"></i></a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 mx-auto">
            <nav aria-label="Page navigation example">
                <?php
                $brojStranica = vratiBrojStranica("komentari");
                ?>
                <ul class="pagination" id="pagKRb">
                    <?php
                    for($i = 0; $i < $brojStranica; $i++):
                        $_SESSION["limit"] = $i;
                        ?>
                        <li class="page-item"><a class="page-link paginacija-komentara" href="#" data-limit="<?=$i?>" ><?= $i + 1 ?></a></li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </nav>
        </div>
    </div>

    <?php
}