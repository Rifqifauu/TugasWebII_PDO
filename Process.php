<?php
require 'koneksi.php'; // Memuat file koneksi.php
require 'Pegawai.php'; // Memuat file kelas Pegawai

// Menangkap data dari formulir jika ada pengiriman POST
if (isset($_POST["SUBMIT"])) {
    // Mendapatkan nilai dari formulir
    $id_pegawai = $_POST["id_pegawai"];
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $gaji = $_POST["gaji"];

    try {
        // Membuat koneksi PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Menentukan mode error menjadi exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Membuat objek Pegawai
        $pegawai = new Pegawai($conn);

        // Memanggil metode insert untuk menyimpan data ke database
        $pegawai->insert($id_pegawai, $nama, $jabatan, $gaji);

        echo '<script>alert("Berhasil Menyimpan ke Database")</script>';
        header("Location: view.php"); // Ubah 'input.php' menjadi halaman tujuan yang benar
        exit(); // Hentikan eksekusi skrip
    } catch (PDOException $e) {
        echo '<script>alert("Gagal: ' . $e->getMessage() . '")</script>';
    }

    // Menutup koneksi PDO
    $conn = null;
}

// Pengecekan untuk penghapusan data menggunakan metode GET
if (isset($_GET['del'])) {
    $id = $_GET['del']; // Menggunakan $_GET
    try {
        // Membuat koneksi PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Menentukan mode error menjadi exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Membuat objek Pegawai
        $pegawai = new Pegawai($conn);
        // Memanggil metode delete
        $pegawai->delete($id);
        // Pengalihan header
        header("Location: view.php");
        exit(); // Hentikan eksekusi skrip
    } catch (PDOException $e) {
        echo '<script>alert("Gagal: ' . $e->getMessage() . '")</script>';
    }
}
if (isset($_POST["UPD"])) {
    // Mendapatkan nilai dari formulir
    $id_pegawai = $_POST["id_pegawai"];
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $gaji = $_POST["gaji"];

    try {
        // Membuat koneksi PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Menentukan mode error menjadi exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Membuat objek Pegawai
        $pegawai = new Pegawai($conn);

        // Memanggil metode insert untuk menyimpan data ke database
        $pegawai->update($id_pegawai, $nama, $jabatan, $gaji);

        echo '<script>alert("Berhasil Menyimpan ke Database")</script>';
        header("Location: view.php"); // Ubah 'input.php' menjadi halaman tujuan yang benar
        exit(); // Hentikan eksekusi skrip
    } catch (PDOException $e) {
        echo '<script>alert("Gagal: ' . $e->getMessage() . '")</script>';
    }
}
