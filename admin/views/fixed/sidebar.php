<?php
   $ulogovanKorisnik = get_current_user();
?>
<div class="sidebar-wrapper">
    <h5 class="text-center"> Trenutno ulogovan: <?= $ulogovanKorisnik ?></h5>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=korisnici">
                <i class="fas fa-users"></i>
                <p>Korisnici</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dodaj-korisnika">
                <i class="fas fa-user-plus"></i>
                <p>Dodaj korisnika</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=postovi">
                <i class="far fa-newspaper"></i>
                <p>Postovi</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dodaj-post">
                </i><i class="fas fa-plus"></i>
                <p>Dodaj post</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=kategorije">
                <i class="fab fa-kickstarter-k"></i>
                <p>Kategorije</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dodaj-kategorije">
                </i><i class="fas fa-plus"></i>
                <p>Dodaj kategorije</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=komentari">
                <i class="far fa-comment-alt"></i>
                <p>Komentari</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=prikaz-log">
                <i class="fas fa-list"></i>
                <p>Prikaz akcija korisnika</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=posecenost">
                <i class="fas fa-percent"></i>
                <p>Prikaz posećenosti stranica</p>
            </a>
        </li>
    </ul>
</div>
</div>