<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Daftar Penjualan</h3>
    <a href="<?= base_url('tambah_penjualan'); ?>" class="btn btn-sm btn-primary">Tambah Data</a>
</div>
<?= $this->session->flashdata('pesan'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table1">
                            <thead>
                                <tr class="text-capitalize">
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">nomor transaksi</th>
                                    <th class="text-center">nama pelanggan</th>
                                    <th class="text-center">tag</th>
                                    <th class="text-center">kurir</th>
                                    <th class="text-center">tanggal penjualan</th>
                                    <th class="text-center" width="15%">total</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penjualan as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1; ?>.</td>
                                        <td class="text-center"><?= $value['nomor_transaksi']; ?></td>
                                        <td class="text-center"><?= ucwords($value['nama_pelanggan']); ?></td>
                                        <td class="text-center"><?= ucwords($value['tag']); ?></td>
                                        <td class="text-center"><?= $value['kurir']; ?></td>
                                        <td class="text-center"><?= tanggalIndonesia($value['tanggal_penjualan']); ?></td>
                                        <td class="text-center">Rp <?= number_format($value['total'], 0, ',', '.'); ?>,-</td>
                                        <td class="text-center">
                                            <a href="<?= base_url('detail_penjualan/' . $value['id_penjualan']); ?>" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-eye-fill"></i> </a>
                                            <a href="<?= base_url('edit_penjualan/' . $value['id_penjualan']); ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('hapus_penjualan/' . $value['id_penjualan']); ?>')">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>