<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Daftar Barang Keluar</h3>
    <!-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button> -->
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
                                    <th class="text-center">stok keluar</th>
                                    <th class="text-center">tanggal keluar</th>
                                    <!-- <th class="text-center" width="10%">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang_keluar as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1; ?>.</td>
                                        <td class="text-center"><?= ucwords($value['nama_barang']); ?></td>
                                        <td class="text-center"><?= $value['stok_keluar']; ?></td>
                                        <td class="text-center"><?= tanggalIndonesia($value['tanggal_keluar']); ?></td>
                                        <!-- <td class="text-center">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_barang_keluar']; ?>">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('hapus_barang_keluar/' . $value['id_barang_keluar']); ?>')">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </td> -->
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <?= form_open('tambah_barang_keluar'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="id_barang">Nama Barang: </label>
                        <div class="form-group">
                            <select class="choices form-select" name="id_barang" oninvalid="this.setCustomValidity('Pilih Nama Barang')" oninput="this.setCustomValidity('')" required>
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($barang as $value) : ?>
                                    <option value="<?= $value['id_barang']; ?>"><?= ucwords($value['nama_barang']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_keluar">Tanggal Keluar: </label>
                        <div class="form-group">
                            <input id="tanggal_keluar" name="tanggal_keluar" type="date" class="form-control" oninvalid="this.setCustomValidity('Pilih Tanggal Keluar')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="stok_keluar">Stok Keluar: </label>
                        <div class="form-group">
                            <input id="stok_keluar" name="stok_keluar" type="number" min="0" placeholder="Masukkan Stok Keluar" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok Keluar')" oninput="this.setCustomValidity('')" required>
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
<?php foreach ($barang_keluar as $value) : ?>
    <div class="modal fade text-left" id="edit<?= $value['id_barang_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Data</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <?= form_open('edit_barang_keluar/' . $value['id_barang_keluar']) ?>
                <?= form_hidden('id_barang_keluar', $value['id_barang_keluar']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="id_barang">Nama Barang: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="id_barang" oninvalid="this.setCustomValidity('Pilih Nama Barang')" oninput="this.setCustomValidity('')" required>
                                    <option selected disabled value="">Pilih</option>
                                    <?php foreach ($barang as $data) : ?>
                                        <option value="<?= $data['id_barang']; ?>" <?= ($data['id_barang'] == $value['id_barang']) ? 'selected' : '' ?>><?= ucwords($data['nama_barang']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="tanggal_keluar">Tanggal Keluar: </label>
                            <div class="form-group">
                                <input id="tanggal_keluar" name="tanggal_keluar" type="date" class="form-control" oninvalid="this.setCustomValidity('Pilih Tanggal Keluar')" oninput="this.setCustomValidity('')" value="<?= $value['tanggal_keluar']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="stok_keluar">Stok Keluar: </label>
                            <div class="form-group">
                                <input id="stok_keluar" name="stok_keluar" type="number" min="0" placeholder="Masukkan Stok Keluar" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok Keluar')" oninput="this.setCustomValidity('')" value="<?= $value['stok_keluar']; ?>" required>
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