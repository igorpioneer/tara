<?php
    $logovi = dohvatiLog();
?>
<div class="main-panel">
    <!-- End Navbar -->
    <div class="content ">
        <div class="container-fluid">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-sort-numeric-down"></i></th>
                    <th scope="col">Korisnik</th>
                    <th scope="col">Posećena stranica</th>
                    <th scope="col">Datum i vreme posete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($logovi as $index => $red):
                $log = explode("\t", $red);
                ?>

                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $log[0] ?></td>
                    <td><?= $log[1]  ?></td>
                    <td><?= $log[2]  ?></td>
                </tr>

                <?php
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>