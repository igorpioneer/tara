<?php

    $idKorisnik = $_GET["id"];
    $korisnik = dohvatiKorisnikaSaUlogom($idKorisnik);
    $uloge = vratiSve("uloga");

?>
<div class="container my-5">
    <div class="row"><div class="container my-5">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="" method="post">
                        <input type="hidden" name="" id="idKorisnik" value="<?= $idKorisnik ?>">
                        <div class="form-group">
                            <label for="izmeniIme">Ime</label>
                            <input type="text" name="izmeniIme" id="izmeniIme" class="form-control" value="<?= $korisnik->ime_korisnik ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmeniPrezime">Prezime</label>
                            <input type="text" name="izmeniPrezime" id="izmeniPrezime" class="form-control" value="<?= $korisnik->prezime_korisnik ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmeniEmail">Email</label>
                            <input type="text" name="izmeniEmail" id="izmeniEmail" class="form-control" value="<?= $korisnik->email ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmeniLozinku">Lozinka</label>
                            <input type="text" name="izmeniLozinku" id="izmeniLozinku" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="izmeniMesto">Mesto prebivalista</label>
                            <input type="text" name="izmeniMesto" id="izmeniMesto" class="form-control" value="<?= $korisnik->prebivaliste ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmeniUlogu">Uloga</label>
                            <select name="izmeniUlogu" id="izmeniUlogu" class="form-control">
                                <option value="0">Izaberite</option>
                                <?php
                                foreach ($uloge as $u) {
                                    echo "<option value='$u->id_uloga'>$u->naziv_uloga</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="button" value="Izmeni korisnika" class="btn btn-primary" id="btnIzmena">
                    </form>
                    <div class="izmena-ispis mt-5">

                    </div>
                </div>
            </div>
        </div>
