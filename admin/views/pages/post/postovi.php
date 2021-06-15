<?php

    $postovi = vratiSvePodatkeZaPostove();
    if(count($postovi) == 0){
        echo "<p class='alert alert-danger text-center'>Trenutno nema postova u bazi podataka!</p>";
    }
    else{

        ?>
        <div class="main-panel">
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <table class="table table-striped" id="postovi">
                        <thead>
                        <tr>
                            <th scope="col"><i class="fas fa-sort-numeric-down"></i></th>
                            <th scope="col">Slika</th>
                            <th scope="col">Kategorija</th>
                            <th scope="col">Naslov</th>
                            <th scope="col">Sadržaj</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Datum unosa</th>
                            <th scope="col">Brisanje</th>
                            <th scope="col">Izmena</th>
                        </tr>
                        </thead>
                        <tbody id="ispisPostova">
                        <?php
                        foreach ($postovi as $index => $p):
                            $skracenSadrzaj = substr($p->tekst, 0, 31);
                            ?>
                            <tr>
                                <th><?= $index + 1 ?></th>
                                <td><img class="img-fluid" src="../assets/images/small-images/mala_<?= $p->src_mala ?>" alt="<?= $p->naslov ?>"></td>
                                <td><?= $p->naziv_kategorija ?></td>
                                <td><?= $p->naslov ?></td>
                                <td><?= $skracenSadrzaj."..." ?></td>
                                <td><?= $p->ime_korisnik." ".$p->prezime_korisnik ?></td>
                                <td><?= $p->datum_unosa ?></td>
                                <td><a href="#" class="brisi-post" data-idkorisnik="<?= $p->id_post ?>"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                                <td><a href="index.php?page=izmeni-post&id=<?= $p->id_post ?>"><i class="far fa-edit alert alert-warning"></i></a></td>
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
                    $brojStranica = vratiBrojStranica("postovi");
                    ?>
                    <ul class="pagination" id="pagRb">
                        <?php
                        for($i = 0; $i < $brojStranica; $i++):
                            $_SESSION["limit"] = $i;
                            ?>
                            <li class="page-item"><a class="page-link paginacija-postova" href="#" data-limit="<?=$i?>" ><?= $i + 1 ?></a></li>
                        <?php
                        endfor;
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        <?php
    }