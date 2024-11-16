<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Daftar Barang Masuk</h3>
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
                                    <th class="text-center" width="10%">No.</th>
                                    <th class="text-center">nama barang</th>
                                    <th class="text-center">stok masuk</th>
                                    <th class="text-center">tanggal masuk</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang_masuk as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1; ?>.</td>
                                        <td class="text-center"><?= ucwords($value['nama_barang']); ?></td>
                                        <td class="text-center"><?= $value['stok_masuk']; ?></td>
                                        <td class="text-center"><?= tanggalIndonesia($value['tanggal_masuk']); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_barang_masuk']; ?>">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('hapus_barang_masuk/' . $value['id_barang_masuk']); ?>')">
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

<!-- MODAL TAMBAH DATA -->
<!-- <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <?= form_open('tambah_barang_masuk'); ?>
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
                        <label for="tanggal_masuk">Tanggal Masuk: </label>
                        <div class="form-group">
                            <input id="tanggal_masuk" name="tanggal_masuk" type="date" class="form-control" oninvalid="this.setCustomValidity('Pilih Tanggal Masuk')" oninput="this.setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="stok_masuk">Stok Masuk: </label>
                        <div class="form-group">
                            <input id="stok_masuk" name="stok_masuk" type="number" min="0" placeholder="Masukkan Stok Masuk" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok Masuk')" oninput="this.setCustomValidity('')" required>
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
</div> -->

<!-- MODAL EDIT DATA -->
<?php foreach ($barang_masuk as $value) : ?>
    <div class="modal fade text-left" id="edit<?= $value['id_barang_masuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Data</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <?= form_open('edit_barang_masuk/' . $value['id_barang_masuk']) ?>
                <?= form_hidden('id_barang_masuk', $value['id_barang_masuk']) ?>
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
                            <label for="tanggal_masuk">Tanggal Masuk: </label>
                            <div class="form-group">
                                <input id="tanggal_masuk" name="tanggal_masuk" type="date" class="form-control" oninvalid="this.setCustomValidity('Pilih Tanggal Masuk')" oninput="this.setCustomValidity('')" value="<?= $value['tanggal_masuk']; ?>" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="stok_masuk">Stok Masuk: </label>
                            <div class="form-group">
                                <input id="stok_masuk" name="stok_masuk" type="number" min="0" placeholder="Masukkan Stok Masuk" class="form-control" oninvalid="this.setCustomValidity('Masukkan Stok Masuk')" oninput="this.setCustomValidity('')" value="<?= $value['stok_masuk']; ?>" required>
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

<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <?= form_open('hitung_barang_masuk', ['id' => 'formHitungBarang']); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="id_barang">Nama Barang: </label>
                        <div class="form-group">
                            <select class="choices form-select" id="selectBarang" name="id_barang" required>
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($barang as $value) : ?>
                                    <option value="<?= $value['id_barang']; ?>"
                                        data-kode-barang="<?= $value['kode_barang']; ?>"
                                        data-nama-barang="<?= ucwords($value['nama_barang']); ?>">
                                        <?= ucwords($value['nama_barang']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Keluar</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" id="btnHitung">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Hitung</span>
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnHitung').addEventListener('click', function(event) {
        const selectBarang = document.getElementById('selectBarang');
        const selectedOption = selectBarang.options[selectBarang.selectedIndex];

        const kodeBarang = selectedOption.getAttribute('data-kode-barang');
        const namaBarang = selectedOption.getAttribute('data-nama-barang');

        const form = document.getElementById('formHitungBarang');
        form.appendChild(createHiddenInput('kode_barang', kodeBarang));
        form.appendChild(createHiddenInput('nama_barang', namaBarang));

        const tanggal = new Date().toISOString().split('T')[0];
        form.appendChild(createHiddenInput('tanggal', tanggal));
    });

    function createHiddenInput(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        return input;
    }
</script>