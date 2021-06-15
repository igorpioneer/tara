<?php
    $posete = posetaStranica("1 day ago");
    $brojPoseta = brojPosetaStranica("1 day ago");

?>
<div class="main-panel">
    <!-- End Navbar -->
    <div class="content ">
        <div class="container-fluid">
            <table class="table">
                <h4 class="text-center font-weight-bold my-5">Statistika posećenih stranica u poslednja 24h</h4>
                <thead>
                <tr>
                    <th>Početna</th>
                    <th>O nama</th>
                    <th>Unos postova</th>
                    <th>Autor</th>
                    <th>Admin panel</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                     <?php foreach ($posete as $p):?>
                        <td><?= $p ?> %</td>
                     <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($brojPoseta as $p):?>
                        <td><?= $p ?> poseta</td>
                    <?php endforeach; ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>