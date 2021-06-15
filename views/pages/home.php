<!-- Page Content -->
<section class="call-to-action">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-content">
                    <div class="row text-box">
                        <div class="col-lg-12 text-center">
                            <h1>Nacionalni park Tara</h1>
                            <h4>Ovde ćete otkriti sve tajne prirodnih lepota naše najlepše planine</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row" id="ispisPostova">
            <?php
                $postovi = dohvatiSvePodatke();
                if(count($postovi) == 0){
                    echo '
                        <div class="col-lg-8">
                        <div class="all-blog-posts">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <p class="alert alert-danger text-center">Trenutno nema postova u bazi podataka!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
                else{
                foreach ($postovi as $post):
            ?>
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <a href="index.php?page=single-post&post_id=<?= $post->id_post ?>"><img src="assets/images/small-images/mala_<?= $post->src_mala ?>" alt="<?= $post->naslov?>"></a>
                                        </div>
                                        <div class="down-content">
                                            <span><?= $post->naziv_kategorija ?></span>
                                            <a href="index.php?page=single-post&post_id=<?= $post->id_post ?>"><h4><?= $post->naslov ?></h4></a>
                                            <ul class="post-info">
                                                <li><a href="#" class="filter-po-autoru" data-idautor="<?= $post->id_korisnik ?>"><?= $post->ime_korisnik." ".$post->prezime_korisnik?></a></li>
                                                <li><?= $post->datum_unosa?></li>
                                                <li><i class="far fa-comment-dots"></i> <?= count(dohvatiKomentare($post->id_post))?></li>
                                            </ul>
                                            <p><?= $post->podnaslov ?></p>
                                        </div>
                                    </div>
                                </div>
            <?php
                endforeach;
                }
            ?>
                    </div>
                </div>
            </div>

            <?php
                include "views/fixed/sidebar.php";
            ?>
        </div>
    </div>
</section>