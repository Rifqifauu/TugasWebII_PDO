<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Data Pegawai</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Gaji</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'koneksi.php';
                        require 'Pegawai.php';

                        try {
                            // Membuat koneksi PDO
                            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            // Menentukan mode error menjadi exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // Membuat objek Pegawai
                            $pegawai = new Pegawai($conn);

                            // Memanggil metode view untuk mendapatkan data pegawai
                            $data = $pegawai->view();

                            // Menampilkan data pegawai
                            foreach ($data as $pegawai) {
                                echo "<tr>";
                                echo "<td>" . $pegawai['id_pegawai'] . "</td>";
                                echo "<td>" . $pegawai['nama'] . "</td>";
                                echo "<td>" . $pegawai['jabatan'] . "</td>";
                                echo "<td>" . $pegawai['gaji'] . "</td>";
                                echo "<td><a href='edit.php?id=" . $pegawai['id_pegawai'] . "' class='btn btn-primary'>Edit</a>&nbsp;&nbsp;<a href='#' data-id='" . $pegawai['id_pegawai'] . "' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>Hapus</a></td>";
                                echo "</tr>";
                            }
                        } catch (PDOException $e) {
                            // Menampilkan pesan kesalahan jika terjadi kesalahan dalam kueri
                            echo '<tr><td colspan="4">Gagal: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <p>Yakin ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" name="submit" class="btn btn-primary" id="hapusBtn">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hapusBtn = document.getElementById('hapusBtn');
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));

            document.querySelectorAll('.btn-danger').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    modal.show();
                    hapusBtn.setAttribute('data-id', id);
                });
            });

            hapusBtn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                window.location.href = 'Process.php?del=' + id;
            });
        });
    </script>
</body>

</html>
