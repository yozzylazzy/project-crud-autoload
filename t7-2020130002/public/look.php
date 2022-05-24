<?php
require '../vendor/autoload.php';

use App\Controllers\BookController;

$book = null;
$avgRate = BookController::averageRate();

if (isset($_GET['id'])) {
    if ($_GET['id']) {
        $book = BookController::getOneBook($_GET['id']);
    }
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
    <title><?= $book['judul'] ?></title>
    <style>
        .checked {
            color: orange;
        }

        .menu:hover {
            opacity: 1;
        }

        @keyframes showoffmenu {
            from {
                right: 0px;
                opacity: 0.2;
            }

            to {
                right: 10%;
                opacity: 1;
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
    </style>
</head>

<body>
    <header>
        <div class="container-fluid p-5 bg-dark text-white text-center">
            <h1>BOOKS LIBRARY</h1>
            <p>Welcome To Digital Bookshelf</p>
            <audio style="position: fixed ; z-index:3 ; bottom: 5%; right: 5%;">
                <img src="https://imgur.com/Qa3A6uX">
                <source src="https://www.youtube.com/watch?v=3jWRrafhO7M&t=2930s" type="youtube">
            </audio>
        </div>
    </header>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <main>
        <div class="container">
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
                </div>
                <div class="card-footer">
                    <h5>Atur Data</h5>
                    <div class="container" style="display: inline-block;flex-wrap: wrap;">
                        <button href="#" class="btn btn-dark text-white my-2" data-bs-toggle="modal" data-bs-target="#edit" onclick="setEditItem(<?= $book['id'] ?>, `<?= $book['judul'] ?>`,'<?= $book['kategori'] ?>','<?= $book['halaman'] ?>','<?= $book['rating'] ?>')">
                            <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                grade
                            </span> Edit Data
                        </button>
                        <button href="#" class="btn btn-dark my-2" data-bs-toggle="modal" data-bs-target="#delete" onclick="deleteItem(<?= $book['id'] ?>)">
                            <span class="material-symbols-outlined" style="vertical-align: -6px;">
                                collections_bookmark
                            </span> Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-lg mt-4">
            <div class="mb-4">
                <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    <strong>Informasi! &nbsp;</strong>Berikut Informasi Mengenai Buku "<?= $book['judul'] ?>"
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="row">
                <?php if ($book) : ?>
                    <div class="col-md">
                        <img class="card-img-top" src=<?php if (strtoupper($book['kategori']) == 'PROGRAMMING')
                                                            echo 'https://media.gcflearnfree.org/content/5e31ca08bc7eff08e4063776_01_29_2020/ProgrammingIllustration.png';
                                                        else if (strtoupper($book['kategori']) == 'BUSINESS')
                                                            echo 'https://png.pngtree.com/illustration/20190226/ourmid/pngtree-2-5d-learn-know-how-online-education-image_11002.jpg';
                                                        else if (strtoupper($book['kategori']) == 'FINANCE')
                                                            echo 'https://omniaccounts.co.za/wp-content/uploads/2021/03/Everything-you-need-to-know-about-Corporate-Accounting.jpg';
                                                        else if (strtoupper($book['kategori']) == 'EDUCATION')
                                                            echo 'https://elearningindustry.com/wp-content/uploads/2020/04/virtual-classrooms-and-covid19.png';
                                                        else echo 'https://www.dictio.id/uploads/db3342/original/3X/1/b/1b0d0fe7fbeefce989607b4f77f67e8be37d74d0.jpeg' ?> alt="Card image cap">
                    </div>
                    <div class="col-sm">
                        <div class="album mt-2 bg-light">
                            <div class="container">
                                <div class="col-8">
                                    <h3><?= $book['judul'] ?></h3>
                                    <h5 class="badge bg-success"><?= $book['kategori'] ?></h5>
                                    <hr>
                                    <p>Jumlah Halaman Buku : <?= $book['halaman'] ?> halaman</p>
                                    <p>Rating Buku :
                                        <?php for ($i = 0; $i < $book['rating']; $i++) : ?>
                                            <span class="
                                            <?php
                                            if (($book['rating'] - $i) != 0.5)
                                                echo 'fa fa-star checked';
                                            else
                                                echo 'fa fa-star-half-full checked';
                                            ?>"></span>
                                        <?php endfor ?>
                                        <?php while ($i <  5) {
                                            echo '<span class="fa fa-star-o checked"></span> ';
                                            $i++;
                                        } ?>
                                        <span class="badge bg-primary"><?= $book['rating'] ?></span>
                                    </p>
                                    <p>Buku Ini <?php 
                                    if($book['rating']>=$avgRate){
                                        echo 'Berada Diatas Rata-Rata Rating Pada Website Ini';
                                    } else {
                                        echo 'Berada Dibawah Rata-Rata Rating Pada Website Ini';
                                    }
                                    ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="py-5 bg-light">
                        <p>No Data!</p>
                    </div>
                <?php endif ?>

            </div>
        </div>

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTitle">Edit Library Buku</h5>
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

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTitle">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Ingin Menghapus Buku dari Library?
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
        <div class="container-fluid mt-4 p-3 bg-dark text-white text-center">
            <h5>Developed by @Yozzy Lazzy</h5>
        </div>
    </footer>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>