<?php

function unosKorisnika($ime, $prezime, $email, $sifrovanaLozinka, $mesto, $idUloga){
    global $conn;

    $upit = "INSERT INTO korisnici(ime_korisnik, prezime_korisnik, email, lozinka, prebivaliste, id_uloga) VALUES(?, ?, ?, ?, ?, ?)";

    $priprema = $conn->prepare($upit);
    $rezultat = $priprema->execute([$ime, $prezime, $email, $sifrovanaLozinka, $mesto, $idUloga]);
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

function logovanje($email, $sifrovanaLozinka){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN uloga u ON k.id_uloga = u.id_uloga WHERE k.email = ? AND k.lozinka = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$email, $sifrovanaLozinka]);
    $rezultat = $priprema->fetch();

    return $rezultat;
}

function dohvatiSve($tabela){
    global $conn;

    $upit = "SELECT * FROM $tabela";
    $rezultat = $conn->query($upit)->fetchAll();
    return $rezultat;
}

function unosPosta($naslov, $podnaslov, $tekst, $idKorisnik, $kategorija){
    global $conn;

    $upit = "INSERT INTO postovi(naslov, podnaslov, tekst, id_korisnik, id_kategorija) VALUES (?, ?, ?, ?, ?)";
    $priprema = $conn->prepare($upit);
    $rezultat = $priprema->execute([$naslov, $podnaslov, $tekst, $idKorisnik, $kategorija]);
    return $rezultat;
}

function upisSlike($slikaNaziv, $malaSlikaNaziv, $idPost){
    global $conn;

    $upit = "INSERT INTO slike(src_original, src_mala, id_post) VALUES (?, ?, ?)";
    $priprema = $conn->prepare($upit);
    $rezultat = $priprema->execute([$slikaNaziv, $malaSlikaNaziv, $idPost]);
    return $rezultat;
}

function dohvatiSvePodatke(){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post";
    $rezultat = $conn->query($upit)->fetchAll();
    return $rezultat;
}

function singlePost($idPost){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post WHERE p.id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idPost]);
    $rezultat = $priprema->fetch();
    return $rezultat;
}

function upisKomentara($komentar, $userId, $postId){
    global $conn;

    $upit = "INSERT INTO komentari (sadrzaj_komentar, id_korisnik, id_post) VALUES (?, ?, ?)";
    $priprema = $conn->prepare($upit);
    $rezultat = $priprema->execute([$komentar, $userId, $postId]);
    return $rezultat;
}

function dohvatiKomentare($postId){
    global $conn;

    $upit = "SELECT * FROM komentari k JOIN korisnici kor ON k.id_korisnik = kor.id_korisnik WHERE id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$postId]);
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}

function filterAutor($idAutor){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post WHERE k.id_korisnik = ?";

    $priprema = $conn->prepare($upit);
    $priprema->execute([$idAutor]);
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}

function pretraga($unos){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post WHERE LOWER(p.naslov) LIKE ?";

    $priprema = $conn->prepare($upit);
    $priprema->execute([$unos]);
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}

function filterKategorija($idKat){
    global $conn;

    $upit = "SELECT * FROM korisnici k JOIN postovi p ON k.id_korisnik = p.id_korisnik JOIN kategorije kat ON kat.id_kategorija = p.id_kategorija JOIN slike s ON s.id_post = p.id_post WHERE kat.id_kategorija = ?";

    $priprema = $conn->prepare($upit);
    $priprema->execute([$idKat]);
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}

function najnovijiPostovi($limit = 3){
    global $conn;

    $upit = "SELECT * FROM postovi ORDER BY datum_unosa DESC LIMIT :limit";
    $priprema = $conn->prepare($upit);
    $limit = ((int) $limit);
    $priprema->bindValue(":limit", $limit, PDO::PARAM_INT);

    $priprema->execute();
    $podaci = $priprema->fetchAll();
    return $podaci;
}

function autor(){

    global $conn;

        $author = $conn->prepare("SELECT * FROM autor WHERE id_autor=?");
        $author_id = "1";
        $author->execute([$author_id]);
        $res = $author->fetch();
        return $res;

}