<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Detail Penjualan</h3>
    <a href="<?= base_url('penjualan'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h5 class="text-capitalize">rincian pelanggan</h5>
                        <hr>
                        <table class="table table-striped table-hover table-sm">
                            <tbody>
                                <tr class="text-capitalize">
                                    <th width="18%">nama pelanggan</th>
                                    <td width="1%">:</td>
                                    <td><?= ucwords($penjualan['nama_pelanggan']); ?></td>
                                </tr>
                                <tr class="text-capitalize">
                                    <th width="18%">no. transaksi</th>
                                    <td width="1%">:</td>
                                    <td><?= $penjualan['nomor_transaksi']; ?></td>
                                </tr>
                                <tr class="text-capitalize">
                                    <th width="18%">TAG</th>
                                    <td width="1%">:</td>
                                    <td><?= $penjualan['tag']; ?></td>
                                </tr>
                                <tr class="text-capitalize">
                                    <th width="18%">kurir</th>
                                    <td width="1%">:</td>
                                    <td><?= $penjualan['kurir']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <h5 class="text-capitalize">rincian barang</h5>
                        <hr>
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr class="text-capitalize">
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody id="barang-table-body">
                                <?php
                                $totalHarga = 0;

                                if (!empty($barangPenjualan)) :
                                    foreach ($barangPenjualan as $key => $item) :
                                        $subtotal = $item['harga'] * $item['stok_keluar'];
                                        $totalHarga += $subtotal;
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1; ?>.</td>
                                            <td class="text-center"><?= ucwords($item['kode_barang']); ?></td>
                                            <td class="text-center"><?= ucwords($item['nama_barang']); ?></td>
                                            <td class="text-center"><?= ucwords($item['kategori']); ?></td>
                                            <td class="text-center"><?= $item['stok_keluar']; ?></td>
                                            <td class="text-center">Rp <?= number_format($item['harga'], 0, ',', '.'); ?>,-</td>
                                            <td class="text-center">Rp <?= number_format($subtotal, 0, ',', '.'); ?>,-</td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                                <tr>
                                    <th colspan="6" class="text-center">Sub Total</th>
                                    <td class="text-center">Rp <?= number_format($totalHarga, 0, ',', '.'); ?>,-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>