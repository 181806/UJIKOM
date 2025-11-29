<?php
  require("function.php");

    $id = $_GET['id'];


    $query = query("SELECT * FROM buku WHERE id = $id")[0];
    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";
    $buku = $query;

    $kategori = [];
    $result = mysqli_query($conn, "SELECT * FROM kategori");
while($row = mysqli_fetch_assoc($result)) {
    $kategori[] = $row;
}
    // ketika tombol submit nya di klik
    if(isset($_POST['tombol_submit'])){
       
        if(ubah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }


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
                <a class="nav-link active text-white" aria-current="page" href="#">Data Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Link</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Tambah Data Buku Disini</h1>
            <a href="index.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">
                <!-- <form action="" method="POST"> -->
                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $buku['id'] ?>" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label fw-bold">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?= $buku['isbn'] ?>"placeholder="isbn" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" id="judul" value="<?= $buku['judul'] ?>" placeholder="judul buku" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" value="<?= $buku['penulis'] ?>" placeholder="penulis" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku['penerbit'] ?>" placeholder="penerbit" autocomplete="off">
                    </div>
                     <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" id="tahun_penerbit" value="<?= $buku['tahun_terbit'] ?>" placeholder="tahun terbit" autocomplete="off">
                    </div> 
                    <div>
                         <label class="form-label fw-bold">Kategori Buku </label>
                        <select name="id_kategori" id="id_kategori" required>
                             <option class="form-select" size="3"value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $genre): ?>
                                <option value="<?= $genre['id_kategori']; ?>">
                                    <?= $genre['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cover</label>
                        <input type="file" class="form-control" name="cover" id="cover" value="<?= $buku['cover'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="tombol_submit" class="btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
