<div class="page-heading">
    <h3>Hitung Barang Masuk</h3>
</div>
<?= $this->session->flashdata('pesan'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?= form_open('tambah_barang_masuk'); ?>
                    <?= form_hidden('id_barang', $id_barang); ?>
                    <?= form_hidden('kode_barang', $kode_barang); ?>
                    <?= form_hidden('nama_barang', $nama_barang); ?>
                    <?= form_hidden('tanggal_masuk', $tanggal); ?>
                    <?= form_hidden('stok_masuk', ''); ?> <!-- Inisial untuk stok_masuk, akan diisi via IoT -->
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>ID Barang</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="idBarang" value="<?= $id_barang; ?>" readonly></td>
                                <td rowspan="4" class="border text-center">Jam Berjalan dan Tanggal Terbaru</td>
                            </tr>
                            <tr>
                                <td>Kode Barang</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="kodeBarang" value="<?= $kode_barang; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama Barang</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="namaBarang" value="<?= $nama_barang; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="tanggal" value="<?= $tanggal; ?>" readonly></td>
                            </tr>
                        </table>
                        <div class="col-12 text-center mt-3">
                            <div class="display-1 fw-bold" id="stokValue">0</div> <!-- Menampilkan stok yang diterima -->
                        </div>
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="<?= base_url('barang_masuk'); ?>" type="button" class="btn btn-secondary">
                                <span>Batal</span>
                            </a>
                            <button type="button" class="btn btn-warning">
                                <span>Pause</span>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span>Simpan</span>
                            </button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>