window.onload = () => {
    let url = window.location.href;

    if(url.indexOf("registration") != -1){
        document.querySelector("#btnReg").addEventListener("click", function (){
            let ime, prezime, mesto, email, lozinka, lozinkaPonovo, reIme, rePrezime, reEmail, reLozinka, brojGresaka, podaci;

            ime = document.querySelector("#tbIme")
            prezime = document.querySelector("#tbPrezime")
            mesto = document.querySelector("#tbMesto")
            email = document.querySelector("#tbEmail")
            lozinka = document.querySelector("#tbPass")
            lozinkaPonovo = document.querySelector("#tbPassAgain")
            brojGresaka = 0
            podaci = new FormData();

            reIme = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,14}$/
            rePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/
            reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/
            reLozinka = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

            if(!proveraRegEx(reIme, ime)){
                brojGresaka++;
            }
            else{
                podaci.append("ime", ime.value)
            }

            if(!proveraRegEx(rePrezime, prezime)){
                brojGresaka++;
            }
            else{
                podaci.append("prezime", prezime.value)
            }

            if(!proveraRegEx(reEmail, email)){
                brojGresaka++;
            }
            else{
                podaci.append("email", email.value)
            }

            if(!proveraRegEx(reLozinka, lozinka)){
                brojGresaka++;
            }
            else{
                podaci.append("lozinka", lozinka.value)
            }

            if(!proveraRegEx(reLozinka, lozinkaPonovo) && lozinka.value == lozinkaPonovo.value){
                brojGresaka++;
            }

            if(!proveraRegEx(rePrezime, mesto)){
                brojGresaka++;
            }
            else{
                podaci.append("mesto", mesto.value)
            }

            if(brojGresaka == 0){
                ajaxCallBack("models/registration.php", "post", podaci,".reg-ispis",function (data){
                    $(".reg-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=login")
                    }, 1000)
                })
            }
        })
    }

    if(url.indexOf("login") != -1){
        document.querySelector("#btnLogin").addEventListener("click", function (){
            let email, lozinka, podaci, brojGresaka, reEmail, reLozinka;

            email = document.querySelector("#tbEmailLog")
            lozinka = document.querySelector("#tbPassLog")
            brojGresaka = 0
            podaci = new FormData()

            reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/
            reLozinka = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

            if(!proveraRegEx(reEmail, email)){
                brojGresaka++;
            }
            else{
                podaci.append("email", email.value)
            }

            if(!proveraRegEx(reLozinka, lozinka)){
                brojGresaka++;
            }
            else{
                podaci.append("lozinka", lozinka.value)
            }

            if(brojGresaka == 0){
                ajaxCallBack("models/login.php", "post", podaci, ".log-ispis",function (data){
                    $(".log-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=home")
                    }, 1000)
                })
            }
        })
    }

    if(url.indexOf("insert-post") != -1){
        document.querySelector("#btnUnosPosta").addEventListener("click", function (){
        let naslov, podNaslov, slika, kategorija, tekst, reNaslov, reSlika, reTekst, brojGresaka, podaci

            naslov = document.querySelector("#tbNaslov")
            podNaslov = document.querySelector("#tbPodnaslov")
            slika = document.querySelector("#fSlika").files[0]
            kategorija = document.querySelector("#ddlKategorije")
            tekst = document.querySelector("#taTekst")
            brojGresaka = 0
            podaci = new FormData()

            reNaslov = /^[A-Z][A-Za-z0-9\s\-_,\.:;?()'"]{2,99}$/
            reSlika = /^[a-zA-Z0-9-_\.]+\.(jpg|png|jpeg)$/
            reTekst = /^[A-Z][A-Za-z0-9\s\-_,\.:;()'"]+$/

            if(!naslov.value.match(reNaslov)){
                brojGresaka++
                naslov.classList.add("error")
            }
            else{
                naslov.classList.remove("error")
                naslov.classList.add("ok")
                podaci.append("naslov", naslov.value)
            }

            if(!podNaslov.value.match(reNaslov)){
                brojGresaka++
                podNaslov.classList.add("error")
            }
            else{
                podNaslov.classList.remove("error")
                podNaslov.classList.add("ok")
                podaci.append("podnaslov", podNaslov.value)
            }

            if(!slika.name.match(reSlika) || slika.size > 3000000){
                brojGresaka++
                document.querySelector("#fSlika").classList.add("error")
            }
            else{
                document.querySelector("#fSlika").classList.remove("error")
                document.querySelector("#fSlika").classList.add("ok")
                podaci.append("slika", slika)
            }

            if(kategorija.value == "0"){
                brojGresaka++
                kategorija.classList.add("error")
            }
            else{
                kategorija.classList.remove("error")
                kategorija.classList.add("ok")
                podaci.append("kategorija", kategorija.value)
            }

            if(!tekst.value.match(reTekst)){
                brojGresaka++
                tekst.classList.add("error")
            }
            else{
                tekst.classList.remove("error")
                tekst.classList.add("ok")
                podaci.append("tekst", tekst.value)
            }

            if(brojGresaka == 0){
                $(".req").addClass("hide");
                ajaxCallBack("models/user/insert-post.php", "post", podaci, ".user-insert-post",function (data){
                    $(".user-insert-post").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=insert-post")
                    }, 1000)
                })
            }

        })
    }

    if(url.indexOf("single-post") != -1){
        document.querySelector("#btnKomentar").addEventListener("click", function (){
            let komentar, postId, reKomentar, podaci;

            komentar = document.querySelector("#taKomentar")
            postId = document.querySelector("#postId").value
            podaci = new FormData()

            reKomentar = /^[A-Z][A-Za-z0-9\s\-_,\.:<>;!?()'"]+$/

            if(!proveraRegEx(reKomentar, komentar)){
                $(".ispis-komentar").html("<p class='alert alert alert-danger text-center'>Komentar mora početi velikim slovom!</p>")
            }
            else{
                podaci.append("komentar", komentar.value)
                podaci.append("postId", postId)

                ajaxCallBack("models/user/insert-comment.php", "post", podaci, ".ispis-komentar",function (data){
                    $(".ispis-komentar").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace(`index.php?page=single-post&post_id=${postId}`)
                    }, 1000)
                })
            }
        })
    }

    if(url.indexOf("korisnici") != -1){
        $(document).on("click", ".paginacija-korisnika", function (e){
            e.preventDefault()

            let limit = $(this).data("limit")
            let data = {
                limit: limit,
                nazivTabele: "korisnici"
            }

            ajaxCallBack2("models/korisnik/paginacija.php", "post", data,function (result){
                ispisiKorisnike(result.korisnici, limit)
                ispisPaginacije(result.brojStranica, "paginacijaRb", "paginacija-korisnika")
            })
        })

        $(document).on("click", ".brisi-korisnika", function (e){
            e.preventDefault();

            let idKorisnik = $(this).data("idkorisnik")
            let data = {
                idKorisnik: idKorisnik
            }

            ajaxCallBack2("models/korisnik/brisanje-korisnika.php", "post", data, function (result){
                ispisiKorisnike(result.korisnici, result.limit)
            })
        })
    }

    if(url.indexOf("izmeni-korisnika") != -1) {
        $(document).on("click", "#btnIzmena", function (){
            let ime, prezime, mesto, email, lozinka, idKorisnik, uloga, reIme, rePrezime, reEmail, reLozinka, greske, podaci;
            ime = document.querySelector("#izmeniIme")
            prezime = document.querySelector("#izmeniPrezime")
            mesto = document.querySelector("#izmeniMesto")
            email = document.querySelector("#izmeniEmail")
            lozinka = document.querySelector("#izmeniLozinku")
            uloga = document.querySelector("#izmeniUlogu").value
            idKorisnik = document.querySelector("#idKorisnik").value

            greske = []
            podaci = new FormData()

            reIme = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,14}$/
            rePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/
            reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/
            reLozinka = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

            if(!proveraRegEx(reIme, ime)){
                greske.push("Morate pravilno popuniti ime (prim. Igor)")
            }
            else{
                podaci.append("ime", ime.value)
                podaci.append("idKorisnik", idKorisnik)
            }

            if(!proveraRegEx(rePrezime, prezime)){
                greske.push("Morate pravilno popuniti prezime (prim. Rankovic)")
            }
            else{
                podaci.append("prezime", prezime.value)
            }

            if(!proveraRegEx(reEmail, email)){
                greske.push("Morate pravilno popuniti email (prim. igor@gmail.com)")
            }
            else{
                podaci.append("email", email.value)
            }

            if(!proveraRegEx(reLozinka, lozinka)){
                greske.push("Lozinka mora poceti velikim slovom i mora imati bar 8 karaktera)")
            }
            else{
                podaci.append("lozinka", lozinka.value)
            }

            if(!proveraRegEx(rePrezime, mesto)){
                greske.push("Morate pravilno popuniti polje za mesto prebivalista (prim. Beograd)")
            }
            else{
                podaci.append("mesto", mesto.value)
            }

            if(uloga == "0"){
                greske.push("Morate izabrati ulogu")
            }
            else{
                podaci.append("uloga", uloga)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".izmena-ispis").html(html)
            }
            else{
                ajaxCallBack("models/korisnik/izmena-korisnika.php", "post", podaci,".izmena-ispis",function (data){
                    $(".izmena-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=korisnici")
                    }, 1000)
                })
            }

        })
    }

    if(url.indexOf("dodaj-korisnika") != -1) {
        $(document).on("click", "#btnUnesiKorisnika", function (){
            let ime, prezime, email, lozinka, mesto, uloga, reIme, rePrezime, reEmail, reLozinka, greske, podaci;

            ime = document.querySelector("#unosIme")
            prezime = document.querySelector("#unosPrezime")
            email = document.querySelector("#unosEmail")
            lozinka = document.querySelector("#unosLozinka")
            mesto = document.querySelector("#unosMesto")
            greske = []
            podaci = new FormData();

            reIme = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,14}$/
            rePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/
            reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?(\.[a-z]{2,3})+$/
            reLozinka = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/

            if(!proveraRegEx(reIme, ime)){
                greske.push("Niste ispravno uneli ime");
            }
            else{
                podaci.append("ime", ime.value)
            }

            if(!proveraRegEx(rePrezime, prezime)){
                greske.push("Niste ispravno uneli prezime");
            }
            else{
                podaci.append("prezime", prezime.value)
            }

            if(!proveraRegEx(reEmail, email)){
                greske.push("Niste ispravno uneli email adresu");
            }
            else{
                podaci.append("email", email.value)
            }

            if(!proveraRegEx(reLozinka, lozinka)){
                greske.push("Niste ispravno uneli lozinku");
            }
            else{
                podaci.append("lozinka", lozinka.value)
            }

            if(!proveraRegEx(rePrezime, mesto)){
                greske.push("Niste ispravno uneli mesto prebivališta");
            }
            else{
                podaci.append("mesto", mesto.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".unos-ispis").html(html)
            }
            else{
                ajaxCallBack("../models/registration.php", "post", podaci,".unos-ispis",function (data){
                    $(".unos-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=korisnici")
                    }, 1000)
                })
            }
        })
    }

    if(url.indexOf("postovi") != -1){
        {
            $(document).on("click", ".paginacija-postova", function (e){
                e.preventDefault()

                let limit = $(this).data("limit")
                let data = {
                    limit: limit,
                    nazivTabele: "postovi"
                }

                ajaxCallBack2("models/post/paginacija.php", "post", data,function (result){
                    ispisiPostove(result.postovi, limit)
                    ispisPaginacije(result.brojStranica, "pagRb", "paginacija-postova")
                })
            })

            $(document).on("click", ".brisi-post", function (e){
                e.preventDefault();

                let idKorisnik = $(this).data("idkorisnik")
                let data = {
                    idKorisnik: idKorisnik
                }

                ajaxCallBack2("models/post/brisanje-posta.php", "post", data, function (result){
                    ispisiPostove(result.postovi, result.limit)
                })
            })
        }
    }

    if(url.indexOf("izmeni-post") != -1){
        document.querySelector("#btnIzmenaPost").addEventListener("click", function (){
            let idPost, idKorisnik, naslov, podNaslov, slika, kategorija, tekst, reNaslov, reSlika, reTekst, greske, podaci

            idPost = document.querySelector("#idPost")
            idKorisnik = document.querySelector("#idKorisnik");
            naslov = document.querySelector("#izmeniNaslov")
            podNaslov = document.querySelector("#izmeniPodnaslov")
            slika = document.querySelector("#izmenaSlika").files[0]
            kategorija = document.querySelector("#izmeniKategoriju")
            tekst = document.querySelector("#izmeniTekst")
            greske = []
            podaci = new FormData()

            reNaslov = /^[A-Z][A-Za-z0-9\s\-_,\.:;?()'"]{2,99}$/
            reSlika = /^[a-zA-Z0-9-_\.]+\.(jpg|png|jpeg)$/
            reTekst = /^[A-Z][A-Za-z0-9\s\-_,\.:;()'"]+$/


            podaci.append("naslov", naslov.value)
            podaci.append("idPost", idPost.value)

            if(!naslov.value.match(reNaslov)){
                greske.push("Morate ispravno upisati naslov prim. Naslov")
                naslov.classList.add("error")
            }
            else{
                naslov.classList.remove("error")
                naslov.classList.add("ok")
                podaci.append("idKorisnik", idKorisnik.value)
            }

            if(!podNaslov.value.match(reNaslov)){
                greske.push("Morate ispravno upisati podnaslov prim. Podnaslov")
                podNaslov.classList.add("error")
            }
            else{
                podNaslov.classList.remove("error")
                podNaslov.classList.add("ok")
                podaci.append("podnaslov", podNaslov.value)
            }

            if(!slika.name.match(reSlika) || slika.size > 3000000){
                greske.push("Slika moze biti u jpg i png formatu, i ne moze biti veca od 3MB")
                document.querySelector("#izmenaSlika").classList.add("error")
            }
            else{
                document.querySelector("#izmenaSlika").classList.remove("error")
                document.querySelector("#izmenaSlika").classList.add("ok")
                podaci.append("slika", slika)
            }

            if(kategorija.value == "0"){
                greske.push("Morate izabrati kategoriju")
                kategorija.classList.add("error")
            }
            else{
                kategorija.classList.remove("error")
                kategorija.classList.add("ok")
                podaci.append("kategorija", kategorija.value)
            }

            if(!tekst.value.match(reTekst)){
                greske.push("Niste ispravno uneli sadrzaj za post")
                tekst.classList.add("error")
            }
            else{
                tekst.classList.remove("error")
                tekst.classList.add("ok")
                podaci.append("tekst", tekst.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".izmenaPost-ispis").html(html)
            }
            else{
                ajaxCallBack("models/post/izmena-posta.php", "post", podaci, ".izmenaPost-ispis",function (data){
                    $(".izmenaPost-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=postovi")
                    }, 1000)
                })
            }

        })
    }

    if(url.indexOf("dodaj-post") != -1){
        document.querySelector("#btnUnosPost").addEventListener("click", function (){
            let naslov, podNaslov, slika, autor, kategorija, tekst, reNaslov, reSlika, reTekst, greske, podaci

            naslov = document.querySelector("#unesiNaslov")
            podNaslov = document.querySelector("#unesiPodnaslov")
            slika = document.querySelector("#unesiSliku").files[0]
            autor = document.querySelector("#unesiAutora")
            kategorija = document.querySelector("#unesiKategoriju")
            tekst = document.querySelector("#unesiTekst")
            greske = []
            podaci = new FormData()

            reNaslov = /^[A-Z][A-Za-z0-9\s\-_,\.:;()?'"]{2,99}$/
            reSlika = /^[a-zA-Z0-9-_\.]+\.(jpg|png|jpeg)$/
            reTekst = /^[A-Z][A-Za-z0-9\s\-_,\.:;()'"]+$/

            if(!naslov.value.match(reNaslov)){
                greske.push("Pogrešno ste uneli naslov - prim. Tara je planina")
                naslov.classList.add("error")
            }
            else{
                naslov.classList.remove("error")
                naslov.classList.add("ok")
                podaci.append("naslov", naslov.value)
            }

            if(!podNaslov.value.match(reNaslov)){
                greske.push("Pogrešno ste uneli podnaslov - prim. Najlepša planina Srbije")
                podNaslov.classList.add("error")
            }
            else{
                podNaslov.classList.remove("error")
                podNaslov.classList.add("ok")
                podaci.append("podnaslov", podNaslov.value)
            }

            if(!slika.name.match(reSlika) || slika.size > 3000000){
                greske.push("Slika moze biti u jpg i png formatu, i ne moze biti veca od 3MB")
                document.querySelector("#unesiSliku").classList.add("error")
            }
            else{
                document.querySelector("#unesiSliku").classList.remove("error")
                document.querySelector("#unesiSliku").classList.add("ok")
                podaci.append("slika", slika)
            }

            if(kategorija.value == "0"){
                greske.push("Morate izabrati kategoriju")
                kategorija.classList.add("error")
            }
            else{
                kategorija.classList.remove("error")
                kategorija.classList.add("ok")
                podaci.append("kategorija", kategorija.value)
            }

            if(autor.value == "0"){
                greske.push("Morate izabrati autora")
                autor.classList.add("error")
            }
            else{
                autor.classList.remove("error")
                autor.classList.add("ok")
                podaci.append("autor", autor.value)
            }

            if(!tekst.value.match(reTekst)){
                greske.push("Morate uneti sadržaj posta")
                tekst.classList.add("error")
            }
            else{
                tekst.classList.remove("error")
                tekst.classList.add("ok")
                podaci.append("tekst", tekst.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".unesPost-ispis").html(html)
            }
            else{
                ajaxCallBack("models/post/dodaj-post.php", "post", podaci, ".unesPost-ispis",function (data){
                    $(".unesPost-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=postovi")
                    }, 1000)
                })
            }

        })
    }

    if(url.indexOf("kategorije") != -1){
        $(document).on("click", ".brisi-kategoriju", function (e){
            e.preventDefault();

            let idKategorija = $(this).data("idkategorija")
            let data = {
                idKategorija: idKategorija
            }

            ajaxCallBack2("models/kategorija/brisanje-kategorije.php", "post", data, function (result){
                ispisiKategorije(result.kategorije)
            })
        })
    }

    if(url.indexOf("izmeni-kategoriju") != -1){
        document.querySelector("#btnIzmenaKat").addEventListener("click", function (){
            let naziv, idKategorija, reNaziv, podaci, greske

            naziv = document.querySelector("#izmeniKategoriju")
            idKategorija = document.querySelector("#idKategorija")
            greske = []
            podaci = new FormData()

            reNaziv = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/

            if(!naziv.value.match(reNaziv)){
                greske.push("Morate ispravno uneti naziv kategorije - prim. Naziv kategorije")
                naziv.classList.add("error")
            }
            else{
                naziv.classList.remove("error")
                naziv.classList.add("ok")
                podaci.append("naziv", naziv.value)
                podaci.append("idKategorija", idKategorija.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".izmenaKategorije-ispis").html(html)
            }
            else{
                ajaxCallBack("models/kategorija/izmena-kategorije.php", "post", podaci, ".izmenaKategorije-ispis",function (data){
                    $(".izmenaKategorije-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=kategorije")
                    }, 1000)
                })
            }


        })
    }

    if(url.indexOf("dodaj-kategorije") != -1){
        document.querySelector("#btnUnosKat").addEventListener("click", function (){
            let naziv, reNaziv, podaci, greske

            naziv = document.querySelector("#unesiKat")
            greske = []
            podaci = new FormData()

            reNaziv = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,19})*$/

            if(!naziv.value.match(reNaziv)){
                greske.push("Morate ispravno uneti naziv kategorije - svaka reč mora poćeti velikim slovom")
                naziv.classList.add("error")
            }
            else{
                naziv.classList.remove("error")
                naziv.classList.add("ok")
                podaci.append("naziv", naziv.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".unosKat-ispis").html(html)
            }
            else{
                ajaxCallBack("models/kategorija/dodaj-kategoriju.php", "post", podaci, ".unosKat-ispis",function (data){
                    $(".unosKat-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=kategorije")
                    }, 1000)
                })
            }


        })
    }

    if(url.indexOf("komentari") != -1){
        $(document).on("click", ".paginacija-komentara", function (e){
            e.preventDefault()

            let limit = $(this).data("limit")
            let data = {
                limit: limit,
                nazivTabele: "komentari"
            }

            ajaxCallBack2("models/komentar/paginacija.php", "post", data,function (result){
                ispisiKomentare(result.komentari, limit)
                ispisPaginacije(result.brojStranica, "pagKRb", "paginacija-komentara")
            })
        })

        $(document).on("click", ".brisi-komentar", function (e){
            e.preventDefault();

            let idKomentar = $(this).data("idkomentar")
            let data = {
                idKomentar: idKomentar
            }

            ajaxCallBack2("models/komentar/brisanje-komentara.php", "post", data, function (result){
                ispisiKomentare(result.komentari, result.limit)
            })
        })
    }

    if(url.indexOf("izmeni-komentar") != -1){
        document.querySelector("#btnIzmeniKomentar").addEventListener("click", function (){
            let sadrzaj, idKomentar, reSadrzaj, podaci, greske

            sadrzaj = document.querySelector("#izmeniKomentar")
            idKomentar = document.querySelector("#idKomentar")
            greske = []
            podaci = new FormData()

            reNaziv = /^[A-Z][A-Za-z0-9\s\-_,\.:<>;!?()'"]+$/

            if(!sadrzaj.value.match(reNaziv)){
                greske.push("Niste dobro uneli sadržaj posta")
                sadrzaj.classList.add("error")
            }
            else{
                sadrzaj.classList.remove("error")
                sadrzaj.classList.add("ok")
                podaci.append("sadrzaj", sadrzaj.value)
                podaci.append("idKomentar", idKomentar.value)
            }

            if(greske.length != 0){
                let html = "";
                for(let i = 0; i < greske.length; i++){
                    html += `<p class="alert alert-danger mt-3">${greske[i]}</p>`
                }

                $(".izmenaKomentara-ispis").html(html)
            }
            else{
                ajaxCallBack("models/komentar/izmena-komentara.php", "post", podaci, ".izmenaKomentara-ispis",function (data){
                    $(".izmenaKomentara-ispis").html(`<p class="alert alert-success text-center">${data.poruka}</p>`)
                    window.setTimeout(function()
                    {
                        window.location.replace("index.php?page=komentari")
                    }, 1000)
                })
            }


        })
    }

    if(url.indexOf("index.php") != -1 || url.indexOf("index.php?page=home") != -1){
        $(document).on("click", ".filter-po-autoru", function (e){
            e.preventDefault();

            let idAutor = $(this).data("idautor")
            let data = {
                idAutor: idAutor
            }

            ajaxCallBack2("models/post/filter-autor.php", "post", data, function (result){
                homePost(result.postovi)
            })
        })

        $(document).on("click", ".filter-po-kategoriji", function (e){
            e.preventDefault();

            let idKat = $(this).data("idkat")
            let data = {
                idKat: idKat
            }

            ajaxCallBack2("models/post/filter-kategorija.php", "post", data, function (result){
                homePost(result.postovi)
            })
        })

        document.querySelector("#pretraga").addEventListener("keyup", function (){
            let unos = this.value
            let data = {
                "unos": unos
            }

            ajaxCallBack2("models/post/pretraga.php", "post", data, function (result){
                homePost(result.pretraga)
            })
        })
    }

    document.querySelector("#btnExportKorisnici").addEventListener("click", function (){
        console.log("igor")
    })
}

function proveraRegEx(reg, element){
    if(!$(element).val().match(reg)){
        $(element).addClass("error");
        $(".req").removeClass("hide");
        $(".exp").removeClass("hide");
        return false;
    }
    else{
        $(element).removeClass("error");
        $(element).addClass("ok");
        $(".req").addClass("hide")
        $(".exp").addClass("hide")
        return true;
    }
}

function ajaxCallBack(url, method, data, greska, result){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: result,
        error: function (data){
            let odgovor = data.responseJSON
            let niz = Object.values(odgovor);
            $(greska).html(`<p class="alert alert-danger text-center">${niz[0]}</p>`)
        }
    })
}

function ajaxCallBack2(url, method, data, result){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        success: result,
        error: function (xhr){
            console.error(xhr)
        }
    })
}

function ispisiKorisnike(korisnici, limit){
    let html = "";

    if(korisnici.length == 0){
        html += `<p class='alert alert-danger text-center'>Trenutno nema korisnika u bazi podataka!</p>`;
    }
    else{
        let rb = limit * 5 + 1
        korisnici.forEach(el => {
            html += `
                <tr>
                    <th>${rb}</th>
                    <td>${el.ime_korisnik} ${el.prezime_korisnik}</td>
                    <td>${el.prebivaliste}</td>
                    <td>${el.email}</td>
                    <td>${el.datum_registracije}</td>
                    <td>${el.naziv_uloga}</td>
                    <td><a href="#" class="brisi-korisnika" data-idkorisnik="${el.id_korisnik}"><i class="fas fa-user-minus alert alert-danger"></i></a></td>
                    <td><a href="index.php?page=izmeni-korisnika&id=${el.id_korisnik}"><i class="fas fa-user-edit alert alert-warning"></i></a></td>
                </tr>
            `
            rb++
        })
    }

    $("#ispisKorisnika").html(html);
}

function ispisPaginacije(brojStranica, blok, klasa){
    let html = ""

    for(let i = 0; i < brojStranica; i++){
        html += `<li class="page-item"><a class="page-link ${klasa}" href="#" data-limit="${i}" >${i + 1}</a></li>`
    }

    $(blok).html(html)
}

function ispisiPostove(postovi, limit){
    let html = "";

    if(postovi.length == 0){
        html += `<p class='alert alert-danger text-center'>Trenutno nema postova u bazi podataka!</p>`;
    }
    else{
        let rb = limit * 5 + 1
        postovi.forEach(el => {
            let sadrzaj = el.tekst
            let skraceniFormat = sadrzaj.substring(0, 31)
            let formatIspisa = "";
            if(sadrzaj.length <= 50){
                formatIspisa = skraceniFormat
            }
            else{
                formatIspisa = skraceniFormat + "...";
            }
            html += `
                <tr>
                    <th>${rb}</th>
                    <td><img class="img-fluid" src="../assets/images/small-images/mala_${el.src_mala}" alt="${el.naslov}"></td>
                    <td>${el.naziv_kategorija}</td>
                    <td>${el.naslov}</td>
                    <td>${formatIspisa}</td>
                    <td>${el.ime_korisnik} ${el.prezime_korisnik}</td>
                    <td>${el.datum_unosa}</td>
                    <td><a href="#" class="brisi-post" data-idkorisnik="${el.id_post}"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                    <td><a href="index.php?page=izmeni-post&id=${el.id_post}"><i class="far fa-edit alert alert-warning"></i></a></td>
                </tr>
            `
            rb++
        })
    }

    $("#ispisPostova").html(html);
}

function ispisiKategorije(kategorije){
    let html = "";

    if(kategorije.length == 0){
        html += `<p class='alert alert-danger text-center'>Trenutno nema postova u bazi podataka!</p>`;
    }
    else{
        kategorije.forEach((el, index) => {
            html += `
                <tr>
                    <th>${index + 1}</th>
                    <td>${el.naziv_kategorija}</td>
                    <td><a href="#" class="brisi-kategoriju" data-idkategorija="${el.id_kategorija}"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                    <td><a href="index.php?page=izmeni-kategoriju&id=${el.id_kategorija}"><i class="far fa-edit alert alert-warning"></a></td>
                </tr>
            `
        })
    }

    $("#ispisKategorija").html(html);
}

function ispisiKomentare(komentari, limit){
    let html = "";

    if(komentari.length == 0){
        html += `<p class='alert alert-danger text-center'>Trenutno nema komentara u bazi podataka!</p>`;
    }
    else{
        let rb = limit * 5 + 1
        komentari.forEach(el => {
            html += `
                <tr>
                    <th>${rb}</th>
                    <td>${el.ime_korisnik} ${el.prezime_korisnik}</td>
                    <td>${el.sadrzaj_komentar}</td>
                    <td>${el.naslov}</td>
                    <td>${el.datum_komentara}</td>
                    <td><a href="#" class="brisi-komentar" data-idkomentar="${el.id_komentar}"><i class="far fa-trash-alt alert alert-danger"></i></a></td>
                    <td><a href="index.php?page=izmeni-komentar&id=${el.id_komentar}"><i class="far fa-edit alert alert-warning"></i></a></td>
                </tr>
            `
            rb++
        })
    }

    $("#ispisKomentara").html(html);
}

function homePost(postovi){
    let html = "";

    if(postovi.length == 0){
        html += `<div class="col-lg-8">
                        <div class="all-blog-posts">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <p class="alert alert-danger text-center">Trenutno nema postova sa takvim naslovom u bazi podataka!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
    }
    else{
        postovi.forEach(el => {
            html += `<div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <a href="index.php?page=single-post&post_id=${el.id_post}"><img src="assets/images/small-images/mala_${el.src_mala}" alt="${el.naslov}"></a>
                                        </div>
                                        <div class="down-content">
                                            <span>${el.naziv_kategorija}</span>
                                            <a href="index.php?page=single-post&post_id=${el.id_post}"><h4>${el.naslov}</h4></a>
                                            <ul class="post-info">
                                                <li><a href="#" class="filter-po-autoru" data-idautor="${el.id_korisnik}">${el.ime_korisnik} ${el.prezime_korisnik}</a></li>
                                                <li>${el.datum_unosa}</li>
                                            </ul>
                                            <p>${el.podnaslov}</p>
                                        </div>
                                    </div>
                                </div>`
        })
    }

    $("#ispisPostova").html(html)
}