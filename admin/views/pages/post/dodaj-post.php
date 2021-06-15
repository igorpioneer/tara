<?php

    $kategorije = vratiSve("kategorije");
    $autori = vratiSve("korisnici");
?>

<div class="container my-5">
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="unesiNaslov">Naslov</label>
                    <input type="text" name="unesiNaslov" id="unesiNaslov" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unesiPodnaslov">Podnaslov</label>
                    <input type="text" name="unesiPodnaslov" id="unesiPodnaslov" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unesiSliku">Izaberite sliku</label>
                    <input type="file" class="form-control-file" id="unesiSliku">
                </div>
                <div class="form-group">
                    <label for="unesiAutora">Autor</label>
                    <select name="unesiAutora" id="unesiAutora" class="form-control">
                        <option value="0">Izaberite</option>
                        <?php
                        foreach ($autori as $a) {
                            echo "<option value='$a->id_korisnik'>$a->ime_korisnik $a->prezime_korisnik</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unesiKategoriju">Kategorija</label>
                    <select name="unesiKategoriju" id="unesiKategoriju" class="form-control">
                        <option value="0">Izaberite</option>
                        <?php
                        foreach ($kategorije as $k) {
                            echo "<option value='$k->id_kategorija'>$k->naziv_kategorija</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unesiTekst">Sadržaj</label><br>
                    <textarea name="unesiTekst" id="unesiTekst" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <input type="button" value="Unesi post" class="btn btn-primary" id="btnUnosPost">
            </form>
            <div class="unesPost-ispis mt-5">

            </div>
        </div>
    </div>
</div>

