<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Input Data Pegawai</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="pegawaiForm" action="Process.php" method="POST">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id Pegawai</label>
                        <input type="text" class="form-control" name="id_pegawai" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" class="form-select" required>
                            <option hidden disabled selected value="">Pilih Jabatan</option>
                            <option value="Direktur">Direktur</option>
                            <option value="Manajer">Manajer</option>
                            <option value="HRD">HRD</option>
                            <option value="Ketua Divisi">Ketua Divisi</option>
                            <option value="Anggota">Anggota</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <input type="number" class="form-control" name="gaji" required>
                    </div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Simpan</button>
<a href="index.php" class="btn btn-danger">Batal</a> <a href="view.php" class="btn btn-success">Lihat Data Pegawai</a>
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
            input.name = 'SUBMIT'; // Ganti 'SUBMIT' menjadi 'UPD'
            form.appendChild(input);

            // Mengirim formulir
            form.submit();
        }

        function updateModalContent() {
            var id_pegawai = document.getElementsByName('id_pegawai')[0].value;
            var nama = document.getElementsByName('nama')[0].value;
            var jabatan = document.getElementsByName('jabatan')[0].value;
            var gaji = document.getElementsByName('gaji')[0].value;

            var modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = "<p>Id: " + id_pegawai + "</p>" +
                                  "<p>Nama: " + nama + "</p>" +
                                  "<p>Jabatan: " + jabatan + "</p>" +
                                  "<p>Gaji: " + gaji + "</p>";
        }

        // Panggil fungsi updateModalContent() setiap kali formulir diubah
        document.getElementById('pegawaiForm').addEventListener('change', updateModalContent);
    </script>
</body>

</html>
