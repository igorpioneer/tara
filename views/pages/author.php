<?php
    $autor = autor("autor");
?>
<main>
    <!-- Section author starts -->
    <section class="author container">
        <aside>
            <img src="assets/images/author.jpg" alt="Igor Rankovic">
        </aside>
        <div class="about-author">
            <h2 class="pading"><?= $autor->ime_prezime ?></h2>
            <p class="pading">Broj indeksa: <?= $autor->broj_indeksa ?></p>
            <p class="pading">Smer: <?= $autor->smer_ict ?></p>
            <p class="pading">Mesto: <?= $autor->mesto ?></p>
            <p class="pading">Kontakt email: <?= $autor->email ?></p>
        </div>
    </section>
    <div class="col-12 text-center">
        <form method="POST" action="models/export.php">
            <input type="submit" value="Preuzmite podatke o autoru" class="btn btn-success" name="export">
        </form>
    </div>
    <!-- Section author ends -->
</main>