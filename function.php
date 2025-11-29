<?php
$conn = mysqli_connect("localhost", "root", "", "simb");

function query($query){
    global $conn;
    

    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// fungsi untuk menambahkan data ke database
function tambah_data($data){
    global $conn;


    $isbn = $data['isbn'];
    $judul = $data['judul'];
    $penulis = $data['penulis'];
    $penerbit = $data['penerbit'];
    $tahun_terbit = $data['tahun_terbit'];
    $id_kategori = $data['id_kategori'];
    // $gambar = $data['gambar'];

    // upload gambar
   $cover = upload_gambar($judul, $penulis);
    if(!$cover){
        return false;
    }

    $query = "INSERT INTO buku (isbn, judul, penulis, penerbit, tahun_terbit, id_kategori, cover)
              VALUES ('$isbn', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$id_kategori', '$cover')";
    
    mysqli_query($conn, $query);

    if(mysqli_error($conn)){
        echo mysqli_error($conn);
    }

    return mysqli_affected_rows($conn);
}
    // fungsi untuk upload gambar
function upload_gambar($judul, $penulis) {


    // setting gambar
    $namaFile = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];


    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('Masukkan cover bukunya!');
              </script>";
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }


    // cek jika ukurannya terlalu besar
    // maks --> 5MB
    if( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }


    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $judul . "_" . $penulis;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


    return $namaFileBaru;
}

// fungsi untuk menghapus data dari database
function hapus_data($id){
    global $conn;


    $query = "DELETE FROM buku WHERE id = $id";


    $result = mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk mengubah data dari database
function ubah_data($data){
    global $conn;

    $id = $data['id'];
    $isbn = $data['isbn'];
    $judul = $data['judul'];
    $penulis = $data['penulis'];
    $penerbit = $data['penerbit'];
    $tahun_terbit = $data['tahun_terbit'];
    $id_kategori = $data['id_kategori'];
    $cover =$data['cover'];

    $query = "UPDATE buku SET
                isbn = '$isbn',
                judul = '$judul',
                penulis = '$penulis',
                penerbit = '$penerbit',
                tahun_terbit = '$tahun_terbit',
                id_kategori = '$id_kategori',
                cover = '$cover'
              WHERE id = $id";

     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn);
}

// fungsi untuk mencari data
function search_data($keyword){
    global $conn;


    $query = "SELECT * FROM mahasiswa
              WHERE
              judul LIKE '%$keyword%' OR
              penulis LIKE '%$keyword%' OR
              penerbit LIKE '%$keyword%' OR
              tahun_terbit LIKE '%$keyword%' OR
              nama_kategori LIKE '%$keyword%' OR
              tanggal_inpput LIKE '%$keyword'
            ";
    return query($query);
}

// fungsi untuk register
function register($data){
    global $conn;


    $username = strtolower($data['username']);
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);


    // query untuk ngecek username yang diinputkan oleh user di database
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);


    if($result != NULL){
        return "Username sudah terdaftar!";
    }


    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");


    return true;
}

/// fungsi untuk login
function login($data){
    global $conn;


    $username = $data['username'];
    $password = $data['password'];


    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION ['username'] = $row['username'];
            return true;
        } else {
           
            return "Password salah!";
        }


    }else{
        return "Username tidak terdaftar!";
    }
}


?>
