<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Edit Penjualan</h3>
    <button type="button" id="add-row" class="btn btn-sm btn-success">Tambah Barang</button>
</div>
<?= $this->session->flashdata('pesan'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?= form_open("edit_penjualan_baru/{$penjualan['id_penjualan']}"); ?>
                    <div class="row">
                        <div class="col-6">
                            <label for="nama_pelanggan">Pelanggan: </label>
                            <div class="form-group">
                                <input id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Masukkan Nama Pelanggan" class="form-control" required value="<?= ucwords($penjualan['nama_pelanggan']); ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="nomor_transaksi">No. Transaksi: </label>
                            <div class="form-group">
                                <input id="nomor_transaksi" name="nomor_transaksi" type="text" placeholder="Masukkan No. Transaksi" class="form-control" required value="<?= ($penjualan['nomor_transaksi']); ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="tag">Tag: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="tag" required>
                                    <option selected disabled value="">Pilih</option>
                                    <option value="Shopee" <?= $penjualan['tag'] == 'Shopee' ? 'selected' : '' ?>>Shopee</option>
                                    <option value="TokoPedia" <?= $penjualan['tag'] == 'TokoPedia' ? 'selected' : '' ?>>TokoPedia</option>
                                    <option value="TikTok" <?= $penjualan['tag'] == 'TikTok' ? 'selected' : '' ?>>TikTok</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="kurir">Kurir: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="kurir" required>
                                    <option selected disabled value="">Pilih</option>
                                    <option value="Shopee" <?= $penjualan['kurir'] == 'Shopee' ? 'selected' : '' ?>>Shopee</option>
                                    <option value="JNT" <?= $penjualan['kurir'] == 'JNT' ? 'selected' : '' ?>>JNT</option>
                                    <option value="JNE" <?= $penjualan['kurir'] == 'JNE' ? 'selected' : '' ?>>JNE</option>
                                    <option value="Instant" <?= $penjualan['kurir'] == 'Instant' ? 'selected' : '' ?>>Instant</option>
                                    <option value="Sicepat" <?= $penjualan['kurir'] == 'Sicepat' ? 'selected' : '' ?>>Sicepat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-capitalize">
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="barang-table-body">
                                <?php if (!empty($barangPenjualan)) : ?>
                                    <?php foreach ($barangPenjualan as $item) : ?>
                                        <tr class="barang-row">
                                            <td class="text-center" width="30%">
                                                <select class=" choices form-select" name="id_barang[]" oninvalid="this.setCustomValidity('Silahkan Pilih Barang')" oninput="this.setCustomValidity('')" required>
                                                    <option selected disabled value="">Pilih</option>
                                                    <?php foreach ($barang as $value) : ?>
                                                        <option value="<?= $value['id_barang']; ?>" <?= $value['id_barang'] == $item['id_barang'] ? 'selected' : ''; ?>>
                                                            <?= ucwords($value['kode_barang'] . ' | ' . $value['nama_barang']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td class="text-center kategori"><?= ucwords($item['kategori']); ?></td>
                                            <td class="text-center stok-container">
                                                <input type="number" class="form-control stok-input" name="stok[]" value="<?= $item['stok_keluar']; ?>" min="1" max="<?= $item['stok']; ?>" style="width: 80px; margin: 0 auto;">
                                                <small class="text-muted">Stok tersedia: <?= $item['stok']; ?></small>
                                            </td>
                                            <td class="text-center harga">Rp <?= number_format($item['harga']); ?>,-</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger remove-row">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <a href="<?= base_url('penjualan'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function addNewDropdownRow() {
            var newRow = `<tr class="barang-row">
            <td class="text-center" width="30%">
                <select class="choices form-select" name="id_barang[]" oninvalid="this.setCustomValidity('Silahkan Pilih Barang')" oninput="this.setCustomValidity('')" required>
                    <option selected disabled value="">Pilih</option>
                    <?php foreach ($barang as $value) : ?>
                        <option value="<?= $value['id_barang']; ?>"><?= ucwords($value['kode_barang'] . ' | ' . $value['nama_barang']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="text-center text-capitalize kategori"></td>
            <td class="text-center text-capitalize stok-container">
                <input type="number" class="form-control stok-input" name="stok[]" min="1" style="width: 80px; margin: 0 auto;">
            </td>
            <td class="text-center harga"></td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-row">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </td>
        </tr>`;
            $('#barang-table-body').append(newRow);
            updateDropdownOptions();
            updateRemoveButtonVisibility();
        }

        function updateDropdownOptions() {
            var selectedValues = [];

            // Ambil semua nilai barang yang sudah dipilih
            $('select[name="id_barang[]"]').each(function() {
                var value = $(this).val();
                if (value) selectedValues.push(value);
            });

            // Update opsi pada setiap dropdown
            $('select[name="id_barang[]"]').each(function() {
                var currentSelect = $(this);
                var currentValue = currentSelect.val();

                // Aktifkan semua opsi pada dropdown
                currentSelect.find('option').prop('disabled', false);

                // Nonaktifkan opsi yang sudah dipilih di dropdown lainnya
                selectedValues.forEach(function(value) {
                    if (value !== currentValue) {
                        currentSelect.find('option[value="' + value + '"]').prop('disabled', true);
                    }
                });
            });
        }

        function updateRemoveButtonVisibility() {
            var rowCount = $('#barang-table-body .barang-row').length;
            $('#barang-table-body .remove-row').toggle(rowCount > 1);
        }

        $('#add-row').click(function() {
            addNewDropdownRow();
        });

        $(document).on('change', 'select[name="id_barang[]"]', function() {
            var id_barang = $(this).val();
            var row = $(this).closest('tr');

            if (id_barang) {
                $.ajax({
                    url: '<?= base_url("admin/get_barang_detail/"); ?>' + id_barang,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        row.find('.kategori').text(data.kategori);

                        var stokHtml = `
                        <input type="number" class="form-control stok-input" name="stok[]" value="1" min="1" max="${data.stok}" style="width: 80px; margin: 0 auto;">
                        <small class="text-muted">Stok tersedia: ${data.stok}</small>
                    `;
                        row.find('.stok-container').html(stokHtml);
                        row.find('.harga').text(data.harga);
                        row.find('.remove-row').show();
                        updateDropdownOptions();
                    }
                });
            } else {
                row.find('.kategori').text('');
                row.find('.stok-container').empty();
                row.find('.harga').text('');
                row.find('.remove-row').hide();
            }
        });

        $(document).on('click', '.remove-row', function() {
            var row = $(this).closest('tr');

            // Konfirmasi sebelum menghapus baris
            var confirmDelete = confirm("Apakah Anda yakin ingin menghapus barang ini?");
            if (confirmDelete) {
                row.remove();
                updateDropdownOptions();
                updateRemoveButtonVisibility();
            }
        });

        $(document).on('input', '.stok-input', function() {
            var max = parseInt($(this).attr('max'));
            var value = parseInt($(this).val());

            if (value > max) {
                $(this).val(max);
                alert('Stok tidak mencukupi! Stok yang tersedia hanya: ' + max);
            }
            if (value < 1) {
                $(this).val(1);
            }
        });

        // Initial check to set remove button visibility and disable options
        updateDropdownOptions();
        updateRemoveButtonVisibility();
    });
</script>