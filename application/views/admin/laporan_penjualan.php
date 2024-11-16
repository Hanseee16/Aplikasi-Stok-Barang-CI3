<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Laporan Penjualan</h3>
    <?= form_open() ?>
    <div style="display: flex; align-items: flex-end; gap: 8px;">
        <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal" required oninvalid="this.setCustomValidity('Silakan pilih Tanggal Awal')" oninput="this.setCustomValidity('')">
        </div>
        <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir" required oninvalid="this.setCustomValidity('Silakan pilih Tanggal Akhir')" oninput="this.setCustomValidity('')">
        </div>
        <div class="form-group">
            <button type="submit" formaction="<?= base_url('laporan_penjualan_excel') ?>" formtarget="_blank" class="btn btn-sm btn-success text-white">Excel</button>
            <button type="submit" formaction="<?= base_url('laporan_penjualan_pdf') ?>" formtarget="_blank" class="btn btn-sm btn-danger text-white">PDF</button>
        </div>
    </div>
    <?= form_close() ?>
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
                                    <th class="text-center" width="10%">No.</th>
                                    <th class="text-center">nomor transaksi</th>
                                    <th class="text-center">nama pelanggan</th>
                                    <th class="text-center">tag</th>
                                    <th class="text-center">kurir</th>
                                    <th class="text-center">tanggal penjualan</th>
                                    <th class="text-center">total</th>
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
                                        <td class="text-center">Rp <?= number_format($value['total']); ?></td>
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