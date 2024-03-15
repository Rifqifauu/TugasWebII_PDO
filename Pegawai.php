<?php
require 'koneksi.php'; // Memuat file koneksi.php

class Pegawai
{
    private $conn; // Variabel untuk menyimpan koneksi database

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insert($id_pegawai, $nama, $jabatan, $gaji)
    {
        // Prepare statement
        $stmt = $this->conn->prepare("INSERT INTO pegawai (id_pegawai, nama, jabatan, gaji) VALUES (:id_pegawai, :nama, :jabatan, :gaji)");

        // Bind parameters
        $stmt->bindParam(':id_pegawai', $id_pegawai);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':gaji', $gaji);

        // Execute statement
        $stmt->execute();
    }

    public function update($id_pegawai, $nama, $jabatan, $gaji)
    {
        $stmt = $this->conn->prepare("UPDATE pegawai SET nama = :nama, jabatan = :jabatan, gaji = :gaji WHERE id_pegawai = :id_pegawai");
        // Bind parameters
        $stmt->bindParam(':id_pegawai', $id_pegawai);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':gaji', $gaji);
        // Execute statement
        $stmt->execute();
    }
    public function view()
    {
        $stmt = $this->conn->prepare("SELECT * FROM pegawai");
        $stmt->execute();
        // Mengambil semua baris hasil sebagai array assosiatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; // Mengembalikan hasil
    }
    public function delete($id_pegawai)
    {
        $stmt = $this->conn->prepare("DELETE FROM pegawai WHERE id_pegawai = :id_pegawai");
        $stmt->bindParam(':id_pegawai', $id_pegawai);
        $stmt->execute();
    }
    public function edit($id_pegawai){
        $stmt = $this->conn->prepare("SELECT * FROM pegawai WHERE id_pegawai = :id_pegawai");
        $stmt->bindParam(':id_pegawai', $id_pegawai);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil baris hasil sebagai array asosiatif
        return $result; // Mengembalikan hasil
    }
    
}
