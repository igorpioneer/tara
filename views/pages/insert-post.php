<?php
if(isset($_SESSION["korisnik"])){
?>

    <section class="contact-us">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sidebar-item contact-form">
                                    <div class="sidebar-heading">
                                        <h2>Unesite Vaš post</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact" action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <label for="tbNaslov">Naslov posta <span class="req">*</span></label>
                                                        <input name="tbNaslov" type="text" id="tbNaslov" placeholder="Naslov">
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <label for="tbPodnaslov">Podnaslov posta <span class="req">*</span></label>
                                                        <input name="tbPodnaslov" type="text" id="tbPodnaslov" placeholder="Podnaslov" required="">
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="slika-uploadB">Izaberite sliku <span class="req">*</span></label>
                                                    <input type="file" class="form-control-file" id="fSlika">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="ddlKategorije">Izaberite kategoriju <span class="req">*</span></label>
                                                    <select name="ddlKategorije" id="ddlKategorije" class="form-control">
                                                        <option value="0">Izaberite..</option>
                                                        <?php
                                                            $kategorije = dohvatiSve("kategorije");
                                                        foreach ($kategorije as $kat) {
                                                            echo "<option value='$kat->id_kategorija'>$kat->naziv_kategorija</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 mt-5">
                                                    <fieldset>
                                                        <label for="taTekst">Unesite tekst <span class="req">*</span></label>
                                                        <textarea name="taTekst" rows="6" id="taTekst" placeholder="Vaša poruka" required=""></textarea>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="button" id="btnUnosPosta" class="main-button">Unesi</button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="user-insert-post mt-5">

                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </section>

<?php
}
else{
    header("Location: views/fixed/forbidden.php");
}