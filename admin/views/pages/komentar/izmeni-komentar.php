<?php

    $idKomentar = $_GET["id"];
    $komentar = komentarSaId($idKomentar);

?>
<div class="container my-5">
    <div class="row"><div class="container my-5">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="" method="post">
                        <input type="hidden" name="" id="idKomentar" value="<?= $idKomentar ?>">
                        <div class="form-group">
                            <label for="izmeniKomentar">Naziv kategorije</label>
                            <textarea name="izmeniKomentar" id="izmeniKomentar" cols="30" rows="10" class="form-control"><?= $komentar->sadrzaj_komentar ?></textarea>
                        </div>
                        <input type="button" value="Izmeni komentar" class="btn btn-primary" id="btnIzmeniKomentar">
                    </form>
                    <div class="izmenaKomentara-ispis mt-5">

                    </div>
                </div>
            </div>
        </div>
