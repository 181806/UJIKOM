<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require("function.php");


    $jumlahDataPerHalaman = 4;
    $jumlahData = count(query("SELECT * FROM buku"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;


    $buku = query("SELECT buku.*, kategori.nama_kategori 
               FROM buku
               JOIN kategori ON buku.id_kategori = kategori.id_kategori
               ORDER BY tanggal_input DESC
               LIMIT $awalData, $jumlahDataPerHalaman");

       
    if(isset($_POST['tombol_search'])){
       
        $simb = search_data($_POST['keyword']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
     <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-light white bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIMB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">E-Library</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Link</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->

    <!-- CONTENT SECTION START -->
      <section class="p-3">
        <div class="container">

        <!-- <h1>Hallo, Selamat Datang <?= $_SESSION['username']?></h1> -->

        <h1 class= "fw-bold">Selamat Datang <?= $_SESSION['username']?></h1>
        <h2 class ="mb-3">Sistem Informasi dan Manajemen Buku</h2>
    
            <div class="mb-3 justify-content-between align-items-center">
                <a href="tambah_data.php">
                    <button class="mb-2 btn-sm btn-primary">Tambah Data</button>
                </a>
                <a href="logout.php">
                    <button class="mb-2 btn-sm btn-primary">Logout</button>
                </a>

             <form class="mb-2" action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari produk..." autocomplete="off">
                        <button class="btn btn-primary" type="submit" name="tombol_search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

               
            
           <!-- DATA START -->
            <table class="table table-striped table-hover">
                <tr>
                    <th>No.</th>
                    <th>ISBN</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Tanggal Input</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1 ?>
                <?php foreach($buku as $data): ?>
                <tr>
                    <td> <?= $no ?> </td>
                    <td> <?= $data['isbn'] ?> </td>
                    <td> <?= $data['judul'] ?> </td>
                    <td> <?= $data['penulis'] ?> </td>
                    <td> <?= $data['penerbit'] ?> </td>
                    <td> <?= $data['tahun_terbit'] ?> </td>
                    <td> <?= $data['nama_kategori'] ?> </td>
                    <td><?= $data['tanggal_input']?></td>
                    <td>
                      <img src="img/<?= $data['cover'] ?> " height="70" width="70" alt="">
                    </td>
                    <td>
                           <a href="ubah_data.php?id=<?= $data['id'] ?>">
                        <button class="btn-sm btn-success">Edit</button>
                        <a href="hapus_data.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>

                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </table>
                
            <div class = "d-flex justify-content-between align-items-center">            
             <nav aria-label="Page navigation example">
                    <ul class="pagination">
                            <!-- Tombol Previous -->
                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>


                        <!-- Daftar halaman -->
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>


                        <!-- Tombol Next -->
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                    </div>



        </div>
    </section>
    <!-- CONTENT SECTION END -->

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>