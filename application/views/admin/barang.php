<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Daftar Barang</h3>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
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
                                    <th class="text-center">kode</th>
                                    <th class="text-center">nama barang</th>
                                    <th class="text-center">kategori</th>
                                    <th class="text-center">stok</th>
                                    <th class="text-center">harga</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $value['kode_barang']; ?></td>
                                        <td class="text-center"><?= ucwords($value['nama_barang']); ?></td>
                                        <td class="text-center"><?= ucwords($value['kategori']); ?></td>
                                        <td class="text-center"><?= $value['stok']; ?></td>
                                        <td class="text-center">Rp <?= number_format($value['harga'], 0, ',', '.'); ?>,-</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_barang']; ?>">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </button>
                                            <!-- <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('hapus_barang/' . $value['id_barang']); ?>')">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button> -->
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

<!-- MODAL TAMBAH DATA -->
<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <?= form_open('tambah_barang'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label for="kode_barang">Kode Barang: </label>
                        <div class="form-group">
                            <input id="kode_barang" name="kode_barang" type="number" placeholder="Masukkan Kode Barang" class="form-control" oninvalid="this.setCustomValidity('Masukkan Kode Barang')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="nama_barang">Nama Barang: </label>
                        <div class="form-group">
                            <input id="nama_barang" name="nama_barang" type="text" placeholder="Masukkan Nama Barang" class="form-control" oninvalid="this.setCustomValidity('Masukkan Nama Barang')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="kategori">Kategori: </label>
                        <div class="form-group">
                            <select class="choices form-select" name="kategori" oninvalid="this.setCustomValidity('Pilih Kategori')" oninput="this.setCustomValidity('')" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="dress">Dress</option>
                                <option value="shirt">Shirt</option>
                                <option value="top">Top</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="stok">Stok: </label>
                        <div class="form-group">
                            <input id="stok" name="stok" type="number" min="0" placeholder="Masukkan Stok" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="harga">Harga: </label>
                        <div class="form-group">
                            <input id="harga" name="harga" type="number" min="0" placeholder="Masukkan Harga" class="form-control" oninvalid="this.setCustomValidity('Masukkan Harga')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Keluar</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- MODAL EDIT DATA -->
<?php foreach ($barang as $value) : ?>
    <div class="modal fade text-left" id="edit<?= $value['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Data</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <?= form_open('edit_barang/' . $value['id_barang']) ?>
                <?= form_hidden('id_barang', $value['id_barang']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="kode_barang">Kode Barang: </label>
                            <div class="form-group">
                                <input id="kode_barang" name="kode_barang" type="number" placeholder="Masukkan Kode Barang" class="form-control" oninvalid="this.setCustomValidity('Masukkan Kode Barang')" oninput="this.setCustomValidity('')" value="<?= $value['kode_barang']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="nama_barang">Nama Barang: </label>
                            <div class="form-group">
                                <input id="nama_barang" name="nama_barang" type="text" placeholder="Masukkan Nama Barang" class="form-control" oninvalid="this.setCustomValidity('Masukkan Nama Barang')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['nama_barang']); ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="kategori">Kategori: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="kategori" oninvalid="this.setCustomValidity('Pilih Kategori')" oninput="this.setCustomValidity('')" required>
                                    <option selected disabled value="">Pilih</option>
                                    <option value="dress" <?= $value['kategori'] == 'dress' ? 'selected' : '' ?>>Dress</option>
                                    <option value="shirt" <?= $value['kategori'] == 'shirt' ? 'selected' : '' ?>>Shirt</option>
                                    <option value="top" <?= $value['kategori'] == 'top' ? 'selected' : '' ?>>Top</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="stok">Stok: </label>
                            <div class="form-group">
                                <input id="stok" name="stok" type="number" min="0" placeholder="Masukkan Stok" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok')" oninput="this.setCustomValidity('')" value="<?= $value['stok']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="harga">Harga: </label>
                            <div class="form-group">
                                <input id="harga" name="harga" type="number" min="0" placeholder="Masukkan Harga" class="form-control" oninvalid="this.setCustomValidity('Masukkan Harga')" oninput="this.setCustomValidity('')" value="<?= $value['harga']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Keluar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Edit</span>
                    </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>