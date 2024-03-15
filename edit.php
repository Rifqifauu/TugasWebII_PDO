<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Data Pegawai</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="pegawaiForm" action="Process.php" method="POST">
                    <?php
                    require 'koneksi.php';
                    require 'Pegawai.php';

                    // Ambil ID pegawai yang akan diedit dari parameter GET
                    $id_pegawai = $_GET['id'] ?? null;

                    try {
                        // Membuat koneksi PDO
                        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        // Menentukan mode error menjadi exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // Membuat objek Pegawai
                        $pegawai = new Pegawai($conn);

                        // Memanggil metode edit untuk mendapatkan data pegawai yang akan di-edit
                        $data_pegawai = $pegawai->edit($id_pegawai);

                        // Setel nilai-nilai default pada input formulir
                        echo "<input type='hidden' name='id_pegawai' value='" . $data_pegawai['id_pegawai'] . "'>";
                        echo "<div class='mb-3'>";
                        echo "<label for='nama' class='form-label'>Nama</label>";
                        echo "<input type='text' class='form-control' name='nama' value='" . $data_pegawai['nama'] . "' required>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='jabatan' class='form-label'>Jabatan</label>";
                        echo "<select name='jabatan' class='form-select' required>";
                        echo "<option hidden disabled value=''>Pilih Jabatan</option>";
                        $jabatan_options = array("Direktur", "Manajer", "HRD", "Ketua Divisi", "Anggota");
                        foreach ($jabatan_options as $jabatan_option) {
                            if ($jabatan_option == $data_pegawai['jabatan']) {
                                echo "<option value='$jabatan_option' selected>$jabatan_option</option>";
                            } else {
                                echo "<option value='$jabatan_option'>$jabatan_option</option>";
                            }
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "<div class='mb-3'>";
                        echo "<label for='gaji' class='form-label'>Gaji</label>";
                        echo "<input type='number' class='form-control' name='gaji' value='" . $data_pegawai['gaji'] . "' required>";
                        echo "</div>";
                    } catch (PDOException $e) {
                        // Menampilkan pesan kesalahan jika terjadi kesalahan dalam kueri
                        echo '<p>Gagal: ' . $e->getMessage() . '</p>';
                    }
                    ?>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Data input akan ditampilkan di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-dark" onclick="submitForm()">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function submitForm() {
            // Tambahkan atribut name ke formulir
            var form = document.getElementById('pegawaiForm');
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'UPD'; // Ganti 'SUBMIT' menjadi 'UPD'
            form.appendChild(input);

            // Mengirim formulir
            form.submit();
        }
    </script>
</body>

</html>
