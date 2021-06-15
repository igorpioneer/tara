<?php
    $kategorije = vratiSve("kategorije");
    if(count($kategorije) == 0){
        echo "<p class='alert alert-danger text-center'>Trenutno nema kategorija u bazi podataka!</p>";
}
else{

    ?>
    <div class="main-panel">
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <table class="table table-striped" id="kategorije">
                    <thead>
                    <tr>
                        <th scope="col"><i class="fas fa-sort-numeric-down"></i></th>
                        <th scope="col">Naziv kategorije</th>
                        <th scope="col">Brisanje</th>
                        <th scope="col">Izmena</th>
                    </tr>
                    </thead>
                    <tbody id="ispisKategorija">
                    <?php
                    foreach ($kategorije as $index=> $k):
                        ?>
                        <tr>
                            <th><?= $index + 1 ?></th>
                            <td><?= $k->naziv_kategorija?></td>
                            <td><a href="#" class="brisi-kategoriju" data-idkategorija="<?= $k->id_kategorija ?>"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                            <td><a href="index.php?page=izmeni-kategoriju&id=<?= $k->id_kategorija ?>"><i class="far fa-edit alert alert-warning"></i></a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
}