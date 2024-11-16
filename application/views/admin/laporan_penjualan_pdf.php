<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        font-family: "Poppins", sans-serif;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center text-uppercase fw-bold my-5 text-dark">laporan penjualan</h4>
                <p class="text-dark">Laporan dari tanggal: <?= tanggalIndonesia($tanggal_awal); ?> sampai dengan <?= tanggalIndonesia($tanggal_akhir); ?></p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr align="center" class="text-capitalize">
                            <th scope="col">No.</th>
                            <th scope="col">nomor transaksi</th>
                            <th scope="col">nama pelanggan</th>
                            <th scope="col">tag</th>
                            <th scope="col">kurir</th>
                            <th scope="col">tanggal penjualan</th>
                            <th scope="col">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penjualan as $key => $value) : ?>
                            <tr align="center">
                                <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= $value['nomor_transaksi']; ?></td>
                                <td><?= ucwords($value['nama_pelanggan']); ?></td>
                                <td><?= ucwords($value['tag']); ?></td>
                                <td><?= $value['kurir']; ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_penjualan']); ?></td>
                                <td>Rp <?= number_format($value['total']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>