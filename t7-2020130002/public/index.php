<?php
require '../vendor/autoload.php';

use App\Controllers\BookController;

$books = null;
$makshal = BookController::maksHalaman();
$rating = BookController::averageRate();
$jumlah = BookController::jumlahBuku();

if (isset($_GET['param'])) {
    if ($_GET['param']) {
        $books = BookController::sortAscLihat($_GET['param']);
    } else {
        $books = BookController::getAllBooks();
    }
} else {
    $books = BookController::getAllBooks();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <title>Home Books</title>
    <style>
        .checked {
            color: orange;
        }

        .menu:hover {
            opacity: 1;
        }

        .d-block {
            height: 450px !important;
            width: 100% !important;
        }

        @keyframes showoffmenu {
            from {
                right: 0px;
                opacity: 0.2;
            }

            to {
                right: 10%;
                opacity: 0.9;
            }
        }

        @keyframes hidemenu {
            from {
                right: 10%;
                opacity: 1;
            }

            to {
                right: 0%;
                opacity: 0.2;
            }
        }

        h4 {
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 900;
            font-size: 3em;
        }
    </style>
</head>

<body>
    <header>
        <div class="container-fluid p-5 bg-dark text-white text-center">
            <h1>BOOKS LIBRARY</h1>
            <p>Welcome To Digital Bookshelf</p>
        </div>
    </header>
    <main>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://free4kwallpapers.com/uploads/wallpaper/the-library-wallpaper-1280x720-wallpaper.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h5>Now It's Easy To Read</h5>
                        <p>Penyediaan Perpustakaan Online Memudahkan Pengguna Dalam Membaca</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.teahub.io/photos/full/18-189916_eraashu001-images-apps-for-business-hd-wallpaper-and.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h5>Access It From Anywhere</h5>
                        <p>Pengguna Dapat Membuka Perpustakaan Dari Manapun</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://cdn.wallpapersafari.com/2/65/UgFrHA.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h5>Keep Enjoy Yourself</h5>
                        <p>Pengguna Dapat Menikmati Kemudahan Ini</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container-lg mt-3">
            <div class="container-sm">
                <button type="button" id="menubutton" class="btn btn-dark menu" onclick="showMenu()" style="opacity:0.4; position:fixed; z-index:3 ; bottom: 5%; right: 5%; ">
                    <span class="material-symbols-outlined" style="vertical-align: -6px; font-size: 48px">
                        menu
                    </span>
                </button>
                <div class="card" id="floatmenu" style="display:none;position: fixed ; 
            z-index:3 ; bottom: 5%; right: 5%;
            animation: showoffmenu 1s;
            animation-fill-mode: 
            forwards;animation-timing-function: ease; ">
                    <div class="card-header">
                        <button onclick="closeMenu()" type="button" class="btn-close" style="float: right; margin-left: 1em; flex-wrap: wrap;">
                            <span aria-hidden="true"></span>
                        </button>
                        <h5>Menu</h5>
                        <a href="index.php" type="button" class="btn btn-primary mt-3">
                            <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                home
                            </span> Ke Halaman Utama
                        </a>
                        <br>
                        <button href="#" class="btn btn-success mt-3 my-2" data-bs-toggle="modal" data-bs-target="#tambah">
                            <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                add
                            </span> Tambah Data Buku
                        </button>
                    </div>

                    <div class="card-footer">
                        <h5>Sort Berdasarkan</h5>
                        <div class="container" style="display: inline-block;flex-wrap: wrap;">
                            <form action="index.php?" method="get">
                                <button href="#" class="btn btn-dark text-white my-2">
                                    <input type="hidden" name="param" value="rating">
                                    <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                        grade
                                    </span> Rating
                                </button>
                            </form>
                            <form action="index.php?" method="get">
                                <button href="#" class="btn btn-dark my-2">
                                    <input type="hidden" name="param" value="kategori">
                                    <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                        collections_bookmark
                                    </span> Kategori
                                </button>
                            </form>
                            <form action="index.php?" method="get">
                                <button href="#" class="btn btn-dark my-2">
                                    <input type="hidden" name="param" value="halaman">
                                    <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                        import_contacts
                                    </span> Halaman
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h2><b>TENTANG WEB INI</b></h2>
            <div class="container-fluid  mt-3 text-center align-items-center">
                <div class="row">
                    <div class="col-lg bg-dark text-white">
                        <h2 style="margin-top: 3%;">
                            HIGH QUALITY
                        </h2>
                        <span class="material-symbols-outlined" style="font-size: 16em;">
                            workspace_premium
                        </span>
                        <div class="mt-2">
                            <h4>
                                <?= round($rating, 2) ?>
                            </h4>
                            <p>Of Average Rating All Books</p>
                        </div>
                    </div>
                    <div class="col-lg text-dark">
                        <h2 style="margin-top: 3%;">
                            MANY BOOKS
                        </h2>
                        <span class="material-symbols-outlined" style="font-size: 16em;">
                            library_books
                        </span>
                        <div class="mt-2">
                            <h4>
                                <?= round($jumlah, 0) ?>
                            </h4>
                            <p>Of Quality Books Here</p>
                        </div>
                    </div>
                    <div class="col-lg bg-dark text-white">
                        <h2 style="margin-top: 3%;">
                            SUPPORT PAGES
                        </h2>
                        <span class="material-symbols-outlined" style="font-size: 16em;">
                            auto_stories
                        </span>
                        <div class="mt-2">
                            <h4>
                                <?= round($makshal, 0) ?>
                            </h4>
                            <p>Of Biggest Page Here</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h2><b>DAFTAR LIST BUKU</b></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-1">
                <?php foreach ($books as $book) : ?>
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card <?php
                                            if (strtoupper($book->getKategori()) == 'PROGRAMMING')
                                                echo 'border-primary';
                                            else if (strtoupper($book->getKategori()) == 'BUSINESS')
                                                echo 'border-success';
                                            else if (strtoupper($book->getKategori()) == 'FINANCE')
                                                echo 'border-dark';
                                            else if (strtoupper($book->getKategori()) == 'EDUCATION')
                                                echo 'border-warning';
                                            else echo 'border-danger' ?>">
                            <img class="card-img-top" src=<?php if (strtoupper($book->getKategori()) == 'PROGRAMMING')
                                                                echo 'https://media.gcflearnfree.org/content/5e31ca08bc7eff08e4063776_01_29_2020/ProgrammingIllustration.png';
                                                            else if (strtoupper($book->getKategori()) == 'BUSINESS')
                                                                echo 'https://png.pngtree.com/illustration/20190226/ourmid/pngtree-2-5d-learn-know-how-online-education-image_11002.jpg';
                                                            else if (strtoupper($book->getKategori()) == 'FINANCE')
                                                                echo 'https://omniaccounts.co.za/wp-content/uploads/2021/03/Everything-you-need-to-know-about-Corporate-Accounting.jpg';
                                                            else if (strtoupper($book->getKategori()) == 'EDUCATION')
                                                                echo 'https://elearningindustry.com/wp-content/uploads/2020/04/virtual-classrooms-and-covid19.png';
                                                            else echo 'https://www.dictio.id/uploads/db3342/original/3X/1/b/1b0d0fe7fbeefce989607b4f77f67e8be37d74d0.jpeg' ?> alt="About Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-family: 'Mulish', sans-serif; font-weight:700 ;"><?= $book->getJudul() ?></h5>
                                <p class="card-text"><span class="badge <?php
                                                                        if (strtoupper($book->getKategori()) == 'PROGRAMMING')
                                                                            echo 'bg-primary';
                                                                        else if (strtoupper($book->getKategori()) == 'BUSINESS')
                                                                            echo 'bg-success';
                                                                        else if (strtoupper($book->getKategori()) == 'FINANCE')
                                                                            echo 'bg-dark';
                                                                        else if (strtoupper($book->getKategori()) == 'EDUCATION')
                                                                            echo 'bg-warning';
                                                                        else echo 'bg-danger' ?>"><?= $book->getKategori() ?></span></p>
                            </div>
                            <div class="card-footer" style="background-color: whitesmoke;">
                                <p class="card-text">
                                <div class="row">
                                    <div class="col">
                                        <h2>Rating</h2>
                                        <?php for ($i = 0; $i < $book->getRating(); $i++) : ?>
                                            <span class="
                                            <?php
                                            if (($book->getRating() - $i) != 0.5)
                                                echo 'fa fa-star checked';
                                            else
                                                echo 'fa fa-star-half-full checked';
                                            ?>"></span>
                                        <?php endfor ?>
                                        <?php while ($i <  5) {
                                            echo '<span class="fa fa-star-o checked"></span> ';
                                            $i++;
                                        } ?>
                                    </div>
                                    <div class="col">
                                        <h2 style="float: right; margin-right: 1em;font-family: 'Signika Negative', sans-serif; font-weight: 900;
                                         padding: 0.6em; border-radius: 80%; background-color:
                                         <?php
                                            if ($book->getRating() > 4)
                                                echo 'green';
                                            else if ($book->getRating() > 3)
                                                echo 'yellow';
                                            else echo 'red'; ?>; opacity:0.8;"><?= $book->getRating(); ?></h2>
                                    </div>
                                </div>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="look.php?id=<?= $book->getId() ?>" type="button" class="btn btn-sm btn-outline-primary">View</a>
                                <button type="button" onclick="setEditItem(<?= $book->getId() ?>, `<?= $book->getJudul() ?>`,'<?= $book->getKategori() ?>','<?= $book->getHalaman() ?>','<?= $book->getRating() ?>')" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                <button type="button" onclick="deleteItem(<?= $book->getId() ?>)" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- edit data buku -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title d-flex align-items-center" id="editTitle"> <span class="material-symbols-outlined">
                                warning
                            </span> Edit Library Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <form action="processBook.php" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="" id="toBeUpdated">
                        <div class="modal-body">
                            <!-- Form Data Buku -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="judulBuku" placeholder="judul Buku" name="judul" required>
                                <label for="judulBuku" class="form-label">Judul Buku</label>
                            </div>
                            <div class="mb-3">
                                <label for="bukukategori" class="form-label">Kategori</label>
                                <select class="form-select" aria-label="kategori" id="bukukategori" name="kategori" required>
                                    <option value="" selected>Pilih Kategori Buku</option>
                                    <option>Programming</option>
                                    <option>Business</option>
                                    <option>Finance</option>
                                    <option>Education</option>
                                    <option>Self-Help</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="halaman" class="form-label">Halaman Buku</label>
                                        <input type="number" class="form-control" id="halaman" placeholder="Jumlah Halaman Buku" name="halaman" step="0" required>
                                    </div>
                                    <div class="col">
                                        <label for="rating" class="form-label">Rating Buku</label>
                                        <input type="number" class="form-control" id="rating" placeholder="Rating Buku 1-5" name="rating" step="0.5" max="5" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tambah data buku -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambahTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTitle">Tambah Library Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <form action="processBook.php" method="post">
                        <div class="modal-body">
                            <!-- Form Data Buku -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="judulBuku" placeholder="judul Buku" name="judul" required>
                                <label for="judulBuku" class="form-label">Judul Buku</label>
                            </div>
                            <div class="mb-3">
                                <label for="bukukategori" class="form-label">Kategori</label>
                                <select class="form-select" aria-label="kategori" id="bukukategori" name="kategori" required>
                                    <option value="" selected>Pilih Kategori Buku</option>
                                    <option>Programming</option>
                                    <option>Business</option>
                                    <option>Finance</option>
                                    <option>Education</option>
                                    <option>Self-Help</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="halaman" class="form-label">Halaman Buku</label>
                                        <input type="number" class="form-control" id="halamanBuku" placeholder="Jumlah Halaman Buku" name="halaman" step="0" min="1" required>
                                    </div>
                                    <div class="col">
                                        <label for="rating" class="form-label">Rating Buku</label>
                                        <input type="number" class="form-control" id="ratingBuku" placeholder="Rating Buku 1-5" name="rating" step="0.5" max="5" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Konfirmasi Penghapusan-->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title d-flex align-items-center" id="deleteTitle">
                            <span class="material-symbols-outlined">
                                report
                            </span>Menghapus Data Buku
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        Ingin Menghapus Buku dari Library? <strong>Data Tidak Akan Kembali Setelah Dihapus</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="processBook.php" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input id="idtoset" type="hidden" name="id" value="">
                            <button type="submot" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid mt-3 p-3 bg-dark text-white text-center">
            <h5>Developed by @Yozzy Lazzy</h5>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function showMenu() {
            const p = document.getElementById('floatmenu');
            if (p.style.display == 'none') {
                p.style.animationName = "showoffmenu";
                p.style.animationFillMode = "forwards";
                p.style.animationTimingFunction = "ease";
                p.style.display = "block";
            }

            const m = document.getElementById('menubutton');
            m.innerHTML = '<span class = "material-symbols-outlined" style="vertical-align: -6px; font-size: 48px"> menu_open </span>';
        }

        function closeMenu() {
            const p = document.getElementById('floatmenu');
            if (p.style.display != 'none') {
                p.style.animationName = "hidemenu";
                p.style.animationFillMode = "forwards";
                p.style.animationTimingFunction = "ease";
                p.style.animationDuration = "1s";
                setTimeout(() => {
                    p.style.display = "none";
                }, 1000);
            }
            const m = document.getElementById('menubutton');
            m.innerHTML = '<span class = "material-symbols-outlined" style="vertical-align: -6px; font-size: 48px"> menu </span>';
        }

        function deleteItem(id) {
            const x = document.getElementById('idtoset');
            x.value = id;
        }

        function setEditItem(id, judul, kategori, halaman, rating) {
            const x = document.getElementById('toBeUpdated');
            const a = document.getElementById('judulBuku');
            const b = document.getElementById('bukukategori');
            const c = document.getElementById('halaman');
            const d = document.getElementById('rating');

            x.setAttribute('value', id);
            a.setAttribute('value', judul);
            const optToSelect = Array.from(b.options).find(item => item.text === kategori);
            optToSelect.selected = true;
            c.setAttribute('value', halaman);
            d.setAttribute('value', rating);
        }

        function ajaxRequest() {
            var svr = new XMLHttpRequest();
            svr.open("POST", "processBook.php");
            svr.onload = function() {
                alert(this.response);
            };
        }

        var alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        var alertTrigger = document.getElementById('liveAlertBtn')

        function alert(message, type) {
            var wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

            alertPlaceholder.append(wrapper)
        }

        if (alertTrigger) {
            alertTrigger.addEventListener('click', function() {
                alert('Nice, you triggered this alert message!', 'success')
            })
        }
    </script>
</body>

</html>