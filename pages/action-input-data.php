<?php

use pocketmine\level\Location;

$servername = "localhost";

/* nama database kita */
$database = "db_user"; 

/* nama user yang terdaftar pada database (default: root) */
$username = "root";

/* password yang terdaftar pada database (default : "") */ 
$password = ""; 

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// mengecek koneksi
if (!$conn) {
    die("Maaf koneksi anda gagal : " . mysqli_connect_error());
}//else{
//     echo "<h1>Yes! Koneksi Berhasil..</h1>";
// }
//cek button    

    if ($_POST['Submit'] == "Submit") {
    $nama            = $_POST['nama'];
    $kelas        = $_POST['kelas'];
    $id        = $_POST['id'];
    $alamat            = $_POST['alamat'];
    $telepon        = $_POST['telepon'];
    //validasi data data kosong
    if (empty($_POST['id'])||empty($_POST['nama'])||empty($_POST['kelas'])||empty($_POST['alamat'])||empty($_POST['telepon'])) {
        ?>
            <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
                document.location='home.html';
            </script>
        <?php
    }
    //cek NIM di database
    $query_sql = "SELECT id FROM users 
                           WHERE id = '$id'";
    $result = mysqli_query($conn, $query_sql);
    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
    ?>
        <script language="JavaScript">
        alert('ID sudah dipakai!, silahkan ganti ID yang lain');
        document.location='home.html';
        </script>
    <?php
    }
    //Masukan data ke Table
    $input = "INSERT INTO users (id,nama,kelas,alamat,telepon) VALUES ('$id','$nama','$kelas','$alamat','$telepon')";
    if(mysqli_query($conn, $input)){
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Data Siswa Berhasil');
        document.location='home.html';
        </script>
    <?php
    } else {
    //Jika Gagal
    echo "Input Data Siswa Gagal!, Silahkan diulangi!";
    }
//Tutup koneksi engine MySQL
    mysqli_close($conn);
    }
?>