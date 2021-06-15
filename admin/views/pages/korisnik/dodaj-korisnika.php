<div class="container mt-5">
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="" method="post">
                <div class="form-group">
                    <label for="unosIme">Ime </label>
                    <input type="text" name="unosIme" id="unosIme" class="form-control">
                    <small class="exp">Ime mora poćeti velikim slovom (prim. Igor)</small>
                </div>
                <div class="form-group">
                    <label for="unosPrezime">Prezime </label>
                    <input type="text" name="unosPrezime" id="unosPrezime" class="form-control">
                    <small class="exp">Prezime mora poćeti velikim slovom (prim. Ranković)</small>
                </div>
                <div class="form-group">
                    <label for="unosEmail">Email </label>
                    <input type="text" name="unosEmail" id="unosEmail" class="form-control">
                    <small class="exp">Morate koristiti validnu email adresu (prim. igor@ict.edu.rs)</small>
                </div>
                <div class="form-group">
                    <label for="unosLozinka">Lozinka </label>
                    <input type="text" name="unosLozinka" id="unosLozinka" class="form-control">
                    <small class="exp">Lozinka mora sadržati veliko slovo i minimum 8 karaktera (prim. Lozinka123)</small>
                </div>
                <div class="form-group">
                    <label for="unosMesto">Mesto prebivalista </label>
                    <input type="text" name="unosMesto" id="unosMesto" class="form-control">
                    <small class="exp">Naziv mesta mora početi velikim slovom (prim. Beograd)</small>
                </div>
                <input type="button" value="Unesi korisnika" class="btn btn-primary" id="btnUnesiKorisnika">
            </form>
            <div class="unos-ispis mt-5">

            </div>
        </div>
    </div>
</div>