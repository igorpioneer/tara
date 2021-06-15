<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-mountain"></i>Tara</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php
                        if(isset($_SESSION["korisnik"])){
                            $korisnik = $_SESSION["korisnik"];
                            if($korisnik->naziv_uloga == "admin"){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=home">Početna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin/index.php?page=korisnici">Admin Panel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="models/logout.php">Izloguj se</a>
                                </li>
                    <?php
                            }
                            else{
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=home">Početna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=about">O nama</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=insert-post">Unos postova</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=author">Autor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="models/logout.php">Izloguj se</a>
                                </li>
                    <?php
                            }
                        }
                        else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=home">Početna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=about">O nama</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=author">Autor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=login">Uloguj se</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=registration">Registracija</a>
                            </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<a href="index.php" class="navbar-brand"></a>