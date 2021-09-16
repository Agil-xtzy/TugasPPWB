<?php 

//Mmebuat Koneksi dengan database
    $servername = "localhost"; //Nama Server
    $database = "db_user"; //Nama Database
    $username = "root"; //Username database
    $password = ""; //password database


    $conn = mysqli_connect($servername, $username, $password, $database);


    if (!$conn) {
        die("Maaf Login anda gagal : " . mysqli_connect_error()); //Pesan Yang keluar apabila tidak bisa connect dgn database
    }else{
        echo "<h1>Berhasil terhubung dengan Database</h1>"; //apabila koneksi berhasil
    }

    if(isset($_POST["tujuan"])){  //Mengambil username,password,email dari LoginDaftar.html
        $tujuan = $_POST["tujuan"];
        
        //Membuat koneksi ke Database. Mengambil data untuk Login

        if($tujuan == "LOGIN"){
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            
            $query_sql = "SELECT * FROM tabel 
                                   WHERE username = '$username' AND password = '$password'";//mengecek data pengguna di database. Apakah sesuai dengan input  
            
            $result = mysqli_query($conn, $query_sql);

            if(mysqli_num_rows($result) > 0){
                echo "<h1>Selamat Datang, ".$username."!</h1>"; //Menampilkan pesan apabila data login sesuai dengan data di database
            }else{
                echo "<h2>Username atau Password Salah!<br><a style='text-decoration:none'href='LoginDaftar.html'>Kembali</a></h2>"; //Pesan yang keluar apabila data yang dimasukan tidak sesuai
            }
    
        }else{
            //Membuat data dari form untuk dimasukan ke dalam database
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            $email = $_POST["email"];
            
            //Memasukan data input pengguna ke dalam database
            $query_sql = "INSERT INTO tabel (username, password, email) 
                                               VALUES ('$username', '$password', '$email')";

            if (mysqli_query($conn, $query_sql)) {
                echo "
                        <h1>Username $username berhasil terdaftar</h1>
                        <a href='LoginDaftar.html'>Kembali Login</h1>";//Membuat Tombol untuk mengarahkan kembali ke halaman login
                     //Pesan yang keluar apabila pengguna berhasil mendaftar
            } else {
                echo "Pendaftaran Gagal <a href='LoginDaftar.html'>Kembali Daftar</a> " . mysqli_error($conn);
            } //Pesan yang keluar apabila pengguna tidak berhasil mendaftar atau koneksi gagal
        }
    }
    mysqli_close($conn); //Memutuskan Koneksi dengan Database

?>