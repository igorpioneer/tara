<?php

    $idKategorija = $_GET["id"];
    $kategorija = kategorijaSaId($idKategorija);

?>
<div class="container my-5">
    <div class="row"><div class="container my-5">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="" method="post">
                        <input type="hidden" name="" id="idKategorija" value="<?= $idKategorija ?>">
                        <div class="form-group">
                            <label for="izmeniKategoriju">Naziv kategorije</label>
                            <input type="text" name="izmeniKategoriju" id="izmeniKategoriju" class="form-control" value="<?= $kategorija->naziv_kategorija ?>">
                        </div>
                        <input type="button" value="Izmeni kategoriju" class="btn btn-primary" id="btnIzmenaKat">
                    </form>
                    <div class="izmenaKategorije-ispis mt-5">

                    </div>
                </div>
            </div>
        </div>
