<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Laporan Barang Keluar</h3>
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
            <button type="submit" formaction="<?= base_url('laporan_barang_keluar_excel') ?>" formtarget="_blank" class="btn btn-sm btn-success text-white">Excel</button>
            <button type="submit" formaction="<?= base_url('laporan_barang_keluar_pdf') ?>" formtarget="_blank" class="btn btn-sm btn-danger text-white">PDF</button>
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
                                    <th class="text-center">nama barang</th>
                                    <th class="text-center">tanggal keluar</th>
                                    <th class="text-center">stok keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang_keluar as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1; ?>.</td>
                                        <td class="text-center"><?= ucwords($value['nama_barang']); ?></td>
                                        <td class="text-center"><?= tanggalIndonesia($value['tanggal_keluar']); ?></td>
                                        <td class="text-center"><?= $value['stok_keluar']; ?></td>
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