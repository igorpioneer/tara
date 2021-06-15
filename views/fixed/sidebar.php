<?php
    $postovi = najnovijiPostovi();
?>

<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form id="search_form" method="post" action="">
                        <input type="text" id="pretraga" class="searchText" placeholder="Pretraži..." autocomplete="on">
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Najnoviji postovi</h2>
                    </div>
                    <div class="content">
                        <ul id="mali-postovi">
                            <?php
                            foreach ($postovi as $post):
                            ?>
                            <li><a href="index.php?page=single-post&post_id=<?= $post->id_post ?>">
                                    <h5><?= $post->naslov ?></h5>
                                    <span><?= $post->datum_unosa ?></span>
                                </a></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>Kategorije</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <?php
                            $kategorije = dohvatiSve("kategorije");
                            foreach ($kategorije as $kat) {
                                echo "<li><a class='filter-po-kategoriji' href='#' data-idkat='$kat->id_kategorija'> $kat->naziv_kategorija </a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>