<?php
    $idPost = $_GET["id"];
    $post = vratiSvePodatkeZaPostoveZaId($idPost);
    $kategorije = vratiSve("kategorije");
?>

<div class="container my-5">
    <div class="row">
                <div class="col-6 mx-auto">
                    <form action="" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="" id="idPost" value="<?= $idPost ?>">
                        <input type="hidden" name="" id="idKorisnik" value="<?= $post->id_korisnik ?>">
                        <div class="form-group">
                            <label for="izmeniNaslov">Naslov</label>
                            <input type="text" name="izmeniNaslov" id="izmeniNaslov" class="form-control" value="<?= $post->naslov ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmeniPodnaslov">Podnaslov</label>
                            <input type="text" name="izmeniPodnaslov" id="izmeniPodnaslov" class="form-control" value="<?= $post->podnaslov ?>">
                        </div>
                        <div class="form-group">
                            <label for="izmenaSlika">Izaberite sliku</label>
                            <input type="file" class="form-control-file" id="izmenaSlika">
                        </div>
                        <div class="form-group">
                            <label for="izmeniKategoriju">Kategorija</label>
                            <select name="izmeniKategoriju" id="izmeniKategoriju" class="form-control">
                                <option value="0">Izaberite</option>
                                <?php
                                foreach ($kategorije as $k) {
                                    echo "<option value='$k->id_kategorija'>$k->naziv_kategorija</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="izmeniTekst">Sadržaj</label><br>
                            <textarea class="form-control" name="izmeniTekst" id="izmeniTekst" cols="30" rows="10"><?= $post->tekst ?></textarea>
                        </div>
                        <input type="button" value="Izmeni post" class="btn btn-primary" id="btnIzmenaPost">
                    </form>
                    <div class="izmenaPost-ispis mt-5">

                    </div>
                </div>
            </div>
        </div>

