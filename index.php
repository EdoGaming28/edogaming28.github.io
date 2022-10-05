<?php 
    /* nama server kita */

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


    if(isset($_POST["tujuan"])){

        $tujuan = $_POST["tujuan"];
        
        if($tujuan == "LOGIN"){
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            $query_sql = "SELECT * FROM account 
                                   WHERE username = '$username' AND password = '$password'";
            
            $result = mysqli_query($conn, $query_sql);

            if(mysqli_num_rows($result) > 0){
                echo "<script>
                document.location.href = 'pages/home.html';
                </script>";
            }else{
                echo "<script> 
                alert('username atau password salah');
                document.location.href = 'pages/login.php';
                </script>";
            }
    
        }else{
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            
            $query_sql = "INSERT INTO account (username, password, email) 
                                               VALUES ('$username', '$password', '$email')";
            
            if(mysqli_query($conn, $query_sql)){
                echo "
                        <script> 
                        alert('username $username berhasil terdaftar! silahkan login kembali');
                        document.location.href = 'pages/login.php';
                        </script>
                    ";
            } else {
                 echo "
                    <script> 
                    alert('Akun tersebut sudah pernah terdaftar!' . mysqli_error($conn));
                    document.location.href = 'pages/daftar.php';
                    </script>
                    ";
            }
        }
    }
    
    
    // tutup koneksi
    mysqli_close($conn);
?>
