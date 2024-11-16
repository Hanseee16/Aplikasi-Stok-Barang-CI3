<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Tambah Penjualan</h3>
</div>
<?= $this->session->flashdata('pesan'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?= form_open('tambah_penjualan_baru'); ?>
                    <div class="row">
                        <div class="col-6">
                            <label for="nama_pelanggan">Pelanggan: </label>
                            <div class="form-group">
                                <input id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Masukkan Nama Pelanggan" class="form-control" oninvalid="this.setCustomValidity('Masukkan Nama Pelanggan')" oninput="this.setCustomValidity('')" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="nomor_transaksi">No. Transaksi: </label>
                            <div class="form-group">
                                <input id="nomor_transaksi" name="nomor_transaksi" type="text" placeholder="Masukkan No. Transaksi" class="form-control" oninvalid="this.setCustomValidity('Masukkan No. Transaksi')" oninput="this.setCustomValidity('')" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="tag">Tag: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="tag" oninvalid="this.setCustomValidity('Pilih Tag')" oninput="this.setCustomValidity('')" required>
                                    <option selected disabled value="">Pilih</option>
                                    <option value="Shopee">Shopee</option>
                                    <option value="TokoPedia">TokoPedia</option>
                                    <option value="TikTok">TikTok</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="kurir">Kurir: </label>
                            <div class="form-group">
                                <select class="choices form-select" name="kurir" oninvalid="this.setCustomValidity('Pilih Kurir')" oninput="this.setCustomValidity('')" required>
                                    <option selected disabled value="">Pilih</option>
                                    <option value="Shopee">Shopee</option>
                                    <option value="JNT">JNT</option>
                                    <option value="JNE">JNE</option>
                                    <option value="Instant">Instant</option>
                                    <option value="Sicepat">Sicepat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-capitalize">
                                    <th class="text-center">nama barang</th>
                                    <th class="text-center">kategori</th>
                                    <th class="text-center">stok</th>
                                    <th class="text-center">harga</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="barang-table-body">
                                <tr class="barang-row">
                                    <td class="text-center" width="30%">
                                        <select class="choices form-select" name="id_barang[]" oninvalid="this.setCustomValidity('Silahkan Pilih Barang')" oninput="this.setCustomValidity('')" required>
                                            <option selected disabled value="">Pilih</option>
                                            <?php foreach ($barang as $value) : ?>
                                                <option value="<?= $value['id_barang']; ?>"><?= ucwords($value['kode_barang'] . ' | ' . $value['nama_barang']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center text-capitalize kategori"></td>
                                    <td class="text-center stok-container"></td>
                                    <td class="text-center harga"></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger remove-row" style="display: none;">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
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
                <select class="choices form-select" name="id_barang[]" oninvalid="this.setCustomValidity('Silahkan Pilih Barang')" oninput="this.setCustomValidity('')">
                    <option selected disabled value="">Pilih</option>
                    <?php foreach ($barang as $value) : ?>
                        <option value="<?= $value['id_barang']; ?>"><?= ucwords($value['nama_barang']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="text-center text-capitalize kategori"></td>
            <td class="text-center stok-container"></td>
            <td class="text-center harga"></td>
            <td class="text-center">
                <button class="btn btn-sm btn-danger remove-row" style="display: none;">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </td>
        </tr>`;
            $('#barang-table-body').append(newRow);
            updateDropdownOptions();
        }

        function updateDropdownOptions() {
            var selectedValues = [];
            $('select[name="id_barang[]"]').each(function() {
                var value = $(this).val();
                if (value) selectedValues.push(value);
            });

            $('select[name="id_barang[]"]').each(function() {
                var currentValue = $(this).val();
                var currentSelect = $(this);
                currentSelect.find('option').not(':first').each(function() {
                    var option = $(this);
                    option.prop('disabled', false);
                    option.text(option.text().replace(' (Sudah dipilih)', ''));
                });

                selectedValues.forEach(function(value) {
                    if (value !== currentValue) {
                        var option = currentSelect.find('option[value="' + value + '"]');
                        option.prop('disabled', true);
                        if (!option.text().includes('(Sudah dipilih)')) {
                            option.text(option.text() + ' (Sudah dipilih)');
                        }
                    }
                });
            });
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

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

                        // Format harga dengan Rp dan format ribuan
                        row.find('.harga').text(formatRupiah(data.harga));

                        row.find('.remove-row').show();
                        updateDropdownOptions();

                        if (row.is(':last-child')) {
                            addNewDropdownRow();
                        }
                    }
                });
            } else {
                row.find('.kategori').text('');
                row.find('.stok-container').empty();
                row.find('.harga').text('');
                row.find('.remove-row').hide();

                updateDropdownOptions();
            }
        });

        $(document).on('click', '.remove-row', function() {
            var row = $(this).closest('tr');

            // Menampilkan konfirmasi sebelum menghapus
            var confirmDelete = confirm("Apakah Anda yakin ingin menghapus barang ini?");
            if (confirmDelete) {
                row.remove();

                // Jika hanya satu baris tersisa, set kolom pertama menjadi required
                if ($('#barang-table-body tr').length === 1) {
                    $('#barang-table-body tr:first-child select').prop('required', true);
                }

                updateDropdownOptions();
            }
        });

        $(document).on('input', '.stok-input', function() {
            var max = parseInt($(this).attr('max'));
            var value = parseInt($(this).val());

            if (value > max) {
                $(this).val(max);
                alert('Stok tidak mencukupi! Stok yang tersedia: ' + max);
            }
            if (value < 1) {
                $(this).val(1);
            }
        });

        updateDropdownOptions();
    });
</script>