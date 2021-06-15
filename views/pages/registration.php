<div class="container">
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="" method="post">
                <div class="form-group">
                    <label for="tbIme">Ime <span class="req">*</span></label>
                    <input type="text" name="tbIme" id="tbIme" class="form-control">
                    <small class="exp">Ime mora poćeti velikim slovom (prim. Igor)</small>
                </div>
                <div class="form-group">
                    <label for="tbPrezime">Prezime <span class="req">*</span></label>
                    <input type="text" name="tbPrezime" id="tbPrezime" class="form-control">
                    <small class="exp">Prezime mora poćeti velikim slovom (prim. Ranković)</small>
                </div>
                <div class="form-group">
                    <label for="tbEmail">Email <span class="req">*</span></label>
                    <input type="text" name="tbEmail" id="tbEmail" class="form-control">
                    <small class="exp">Morate koristiti validnu email adresu (prim. igor@ict.edu.rs)</small>
                </div>
                <div class="form-group">
                    <label for="tbPass">Lozinka <span class="req">*</span></label>
                    <input type="password" name="tbPass" id="tbPass" class="form-control">
                    <small class="exp">Lozinka mora sadržati veliko slovo i minimum 8 karaktera (prim. Lozinka123)</small>
                </div>
                <div class="form-group">
                    <label for="tbPassAgain">Lozinka ponovo <span class="req">*</span></label>
                    <input type="password" name="tbPassAgain" id="tbPassAgain" class="form-control">
                    <small class="exp">Unesite lozinku ponovo</small>
                </div>
                <div class="form-group">
                    <label for="tbMesto">Mesto prebivalista <span class="req">*</span></label>
                    <input type="text" name="tbMesto" id="tbMesto" class="form-control">
                    <small class="exp">Naziv mesta mora početi velikim slovom (prim. Beograd)</small>
                </div>
                <input type="button" value="Registruj se" class="btn btn-primary" id="btnReg">
            </form>
            <div class="reg-ispis mt-5">

            </div>
        </div>
    </div>
</div>