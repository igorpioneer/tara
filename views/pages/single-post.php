<?php

    $id = $_GET["post_id"];
    $post = singlePost($id);

    $komentari = dohvatiKomentare($id);
?>
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-post">
                                <div class="blog-thumb slika_orig">
                                    <img src="assets/images/upload-images/<?= $post->src_original ?>" alt="<?= $post->naslov ?>">
                                </div>
                                <div class="down-content">
                                    <span><?= $post->naziv_kategorija ?></span>
                                    <h4><?= $post->naslov ?></h4>
                                    <ul class="post-info">
                                        <li><?= $post->ime_korisnik." ".$post->prezime_korisnik ?></li>
                                        <li><?= $post->datum_unosa ?></li>
                                    </ul>
                                    <p><?= $post->tekst ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item comments">
                                <div class="sidebar-heading">
                                    <h2><?= count($komentari) == 1 ? count($komentari)." Komentar" : count($komentari)." Komentara" ?></h2>
                                </div>
                                <?php
                                foreach ($komentari as $kom) {
                                    ?>
                                    <div class="content mt-5">
                                        <ul>
                                            <li>
                                                <div class=" col-12 right-content">
                                                    <h4><?= $kom->ime_korisnik." ".$kom->prezime_korisnik ?><span><?= $kom->datum_komentara ?></span></h4>
                                                    <p class="mt-3"><?= $kom->sadrzaj_komentar ?></p>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            if(isset($_SESSION["korisnik"])){
                                ?>
                                <div class="col-lg-12">
                                    <div class="sidebar-item submit-comment">
                                        <div class="sidebar-heading">
                                            <h2>Vaš Komentar</h2>
                                        </div>
                                        <div class="content">
                                            <form id="comment" action="" method="post">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <textarea name="taKomentar" rows="6" id="taKomentar" placeholder="Unesite komentar"></textarea>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="hidden" value="<?= $post->id_post ?>" id="postId">
                                                        <fieldset>
                                                            <input type="button" value="Unesi" id="btnKomentar" class="submit-comment">
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="ispis-komentar">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                            else{
                                ?>
                                <div class="col-lg-12 mt-5 loga">
                                    <h5>Morate se <a href="index.php?page=login">ulogovati</a> da biste ostavili komentar.</h5>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>