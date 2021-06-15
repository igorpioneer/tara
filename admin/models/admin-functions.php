<?php
    define("OFFSET", 5);
    function korisniciSaUlogom($limit = 0){
        try {
            global $conn;

            $upit = "SELECT * FROM korisnici k JOIN uloga u ON k.id_uloga = u.id_uloga LIMIT :limit, :ofset";
            $priprema = $conn->prepare($upit);

            $limit = ((int) $limit) * OFFSET;
            $priprema->bindValue(":limit", $limit, PDO::PARAM_INT);

            $offset = OFFSET;
            $priprema->bindValue("ofset", $offset, PDO::PARAM_INT);

            $priprema->execute();
            $podaci = $priprema->fetchAll();
            return $podaci;
        }
        catch (PDOException $exception){
            http_response_code(500);
        }
    }

    function vratiBrojPodataka($tabela){
        global $conn;

        $upit = "SELECT COUNT(*) AS broj FROM $tabela";
        $podatak = $conn->query($upit)->fetch();
        return $podatak;
    }

    function vratiBrojStranica($tabela){
        $brojPodataka = vratiBrojPodataka($tabela);

        $brojStranica = ceil($brojPodataka->broj / OFFSET);
        return $brojStranica;
    }

    function brisanje($tabela, $kolona, $idKorisnik){
        global $conn;

        $upit = "DELETE FROM $tabela WHERE $kolona = ?";

        $obrisi = $conn->prepare($upit);
        $rezultat = $obrisi->execute([$idKorisnik]);

        return $rezultat;
    }

    function dohvatiKorisnikaSaUlogom($idKorisnik){
        global $conn;

        $upit = "SELECT * FROM korisnici k JOIN uloga u ON k.id_uloga = u.id_uloga WHERE k.id_korisnik = ?";

        $priprema = $conn->prepare($upit);
        $priprema->execute([$idKorisnik]);
        $podatak = $priprema->fetch();
        return $podatak;
    }

    function vratiSve($tabela){
        global $conn;

        $upit = "SELECT * FROM $tabela";
        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;
    }

    function izmenaPodatakaOKorisniku($ime, $prezime, $mesto, $email, $sifrovanaLozinka, $uloga, $idKorisnik){
        global $conn;

        $upit = "UPDATE korisnici SET ime_korisnik = ?, prezime_korisnik = ?, prebivaliste = ?, email = ?, lozinka = ?, id_uloga = ? WHERE id_korisnik = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$ime, $prezime, $mesto, $email, $sifrovanaLozinka, $uloga, $idKorisnik]);
        return $rezultat;
    }

    function vratiSvePodatkeZaPostove($limit = 0){
        global $conn;

        $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post LIMIT :limit, :ofset";
        $priprema = $conn->prepare($upit);

        $limit = ((int) $limit) * OFFSET;
        $priprema->bindValue(":limit", $limit, PDO::PARAM_INT);

        $offset = OFFSET;
        $priprema->bindValue("ofset", $offset, PDO::PARAM_INT);

        $priprema->execute();
        $podaci = $priprema->fetchAll();
        return $podaci;
    }

    function vratiSvePodatkeZaPostoveZaId($idPost){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post WHERE p.id_post = ?";
    $priprema = $conn->prepare($upit);

    $priprema->execute([$idPost]);
    $rezultat = $priprema->fetch();
    return $rezultat;
}

    function izmeniPost($naslov, $podnaslov, $tekst, $idPost, $kategorija){
        global $conn;

        $upit = "UPDATE postovi SET naslov = ?, podnaslov = ?, tekst = ?, id_kategorija = ? WHERE id_post = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$naslov, $podnaslov, $tekst, $kategorija, $idPost]);
        return $rezultat;
    }

    function upisSlike($slikaNaziv, $malaSlikaNaziv, $idPost){
        global $conn;

        $upit = "UPDATE postovi SET src_original = ?, src_mala = ?, id_post = ? WHERE id_korisnik = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$slikaNaziv, $malaSlikaNaziv, $idPost]);
        return $rezultat;
    }

    function ifExist($tabela, $podatak, $kolona){
    global $conn;

    $upit = "SELECT * FROM $tabela WHERE $kolona = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$podatak]);
    $rezultat = $priprema->fetch();

    return $rezultat;
}

    function izmeniSliku($slikaNaziv, $malaSlikaNaziv, $idPost){
        global $conn;

        $upit = "UPDATE slike SET src_original = ?, src_mala = ? WHERE id_post = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$slikaNaziv, $malaSlikaNaziv, $idPost]);
        return $rezultat;
    }

    function kategorijaSaId($idKategorija){
        global $conn;

        $upit = "SELECT * FROM kategorije WHERE id_kategorija = ?";

        $priprema = $conn->prepare($upit);
        $priprema->execute([$idKategorija]);
        $podatak = $priprema->fetch();
        return $podatak;
    }

    function izmenaKategorije($naziv, $idKategorija){
        global $conn;

        $upit = "UPDATE kategorije SET naziv_kategorija = ? WHERE id_kategorija = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$naziv, $idKategorija]);
        return $rezultat;
    }

    function upisKategorije($naziv){
        global $conn;

        $upit = "INSERT INTO kategorije(naziv_kategorija) VALUES(?)";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$naziv]);
        return $rezultat;
    }

    function vratiKomentareSaKorisnikomIPostomLimit($limit = 0){
        try {
            global $conn;

            $upit = "SELECT * FROM komentari k JOIN postovi p ON k.id_post = p.id_post JOIN korisnici kor ON kor.id_korisnik = k.id_korisnik LIMIT :limit, :ofset";
            $priprema = $conn->prepare($upit);

            $limit = ((int) $limit) * OFFSET;
            $priprema->bindValue(":limit", $limit, PDO::PARAM_INT);

            $offset = OFFSET;
            $priprema->bindValue("ofset", $offset, PDO::PARAM_INT);

            $priprema->execute();
            $podaci = $priprema->fetchAll();
            return $podaci;
        }
        catch (PDOException $exception){
            var_dump($exception);
        }
}

    function komentarSaId($idKomentar){
        global $conn;

        $upit = "SELECT * FROM komentari WHERE id_komentar = ?";

        $priprema = $conn->prepare($upit);
        $priprema->execute([$idKomentar]);
        $podatak = $priprema->fetch();
        return $podatak;
    }

    function izmenaKomentara($sadrzaj, $idKomentar){
        global $conn;

        $upit = "UPDATE komentari SET sadrzaj_komentar = ? WHERE id_komentar = ?";

        $priprema = $conn->prepare($upit);
        $rezultat = $priprema->execute([$sadrzaj, $idKomentar]);
        return $rezultat;
    }

    function dohvatiLog(){
        $file = fopen("../data/log.txt","r");

        $podaci = file("../data/log.txt");

        fclose($file);

        return $podaci;
    }

    function posetaStranica($dan){
        $niz = [];
        $sum = 0;
        $home = 0;
        $about = 0;
        $insertPost = 0;
        $author = 0;
        $admin = 0;

        $logovi = dohvatiLog();

        if(count($logovi)){
            foreach ($logovi as $log){
                $red = explode("\t", $log);
                $url = explode(".php", $red[1]);

                if(isset($url[1])){
                    if(strtotime($red[2]) <= strtotime($dan)){
                        switch ($url[1]){
                            case "":
                                $home++;
                                $sum++;
                                break;
                            case "?page=about":
                                $about++;
                                $sum++;
                                break;
                            case "?page=insert-post":
                                $insertPost++;
                                $sum++;
                                break;
                            case "?page=author":
                                $author++;
                                $sum++;
                                break;
                            case "?page=korisnici":
                                $admin++;
                                $sum++;
                                break;
                            default:
                                $home++;
                                $sum++;
                                break;
                        }
                    }
                }
            }

            if($sum > 0){
                $niz[] = round($home * 100 / $sum, 2);
                $niz[] = round($about * 100 / $sum, 2);
                $niz[] = round($insertPost * 100 / $sum, 2);
                $niz[] = round($author * 100 / $sum, 2);
                $niz[] = round($admin * 100 / $sum, 2);
            }
        }
        return $niz;
    }

    function brojPosetaStranica($dan){
    $niz = [];
    $sum = 0;
    $home = 0;
    $about = 0;
    $insertPost = 0;
    $author = 0;
    $admin = 0;

    $logovi = dohvatiLog();

    if(count($logovi)){
        foreach ($logovi as $log){
            $red = explode("\t", $log);
            $url = explode(".php", $red[1]);

            if(isset($url[1])){
                if(strtotime($red[2]) <= strtotime($dan)){
                    switch ($url[1]){
                        case "?page=home":
                            $home++;
                            $sum++;
                            break;
                        case "?page=about":
                            $about++;
                            $sum++;
                            break;
                        case "?page=insert-post":
                            $insertPost++;
                            $sum++;
                            break;
                        case "?page=author":
                            $author++;
                            $sum++;
                            break;
                        case "?page=korisnici":
                            $admin++;
                            $sum++;
                            break;
                        default:
                            $home++;
                            $sum++;
                            break;
                    }
                }
            }
        }

        if($sum > 0){
            $niz[] = round($home);
            $niz[] = round($about);
            $niz[] = round($insertPost);
            $niz[] = round($author);
            $niz[] = round($admin);
        }
    }
    return $niz;
}