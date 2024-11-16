<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                    Silahkan login terlebih dahulu!
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('auth');
        }

        // FORMAT BULAN
        function tanggalIndonesia($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            $timestamp = strtotime($tanggal);
            $hari = date('d', $timestamp);
            $bulanNama = $bulan[date('n', $timestamp)];
            $tahun = date('Y', $timestamp);
            $waktu = date('H:i:s', $timestamp);
            return "$hari $bulanNama $tahun - $waktu WIB";
        }
    }


    // DASHBOARD
    public function dashboard()
    {
        $data = [
            'title'         => 'Dashboard',
            'barang'        => $this->Model_barang->getTotalData(),
            'barang_masuk'  => $this->Model_barang_masuk->getTotalData(),
            'barang_keluar' => $this->Model_barang_keluar->getTotalData(),
            'penjualan'     => $this->Model_penjualan->getTotalData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }
    // END DASHBOARD


    // BARANG
    public function barang()
    {
        $data = [
            'title'     => 'Barang',
            'barang'    => $this->Model_barang->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/barang');
        $this->load->view('templates/footer');
    }

    public function tambah_barang()
    {
        $data = [
            'kode_barang'   => htmlspecialchars($this->input->post('kode_barang', true)),
            'nama_barang'   => htmlspecialchars($this->input->post('nama_barang', true)),
            'kategori'      => htmlspecialchars($this->input->post('kategori', true)),
            'stok'          => htmlspecialchars($this->input->post('stok', true)),
            'harga'         => htmlspecialchars($this->input->post('harga', true)),
        ];

        $this->Model_barang->tambah($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible show fade">
                Data berhasil disimpan.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('barang');
    }

    public function edit_barang($id_barang)
    {
        $data = [
            'id_barang'     => htmlspecialchars($this->input->post('id_barang', true)),
            'kode_barang'   => htmlspecialchars($this->input->post('kode_barang', true)),
            'nama_barang'   => htmlspecialchars($this->input->post('nama_barang', true)),
            'kategori'      => htmlspecialchars($this->input->post('kategori', true)),
            'stok'          => htmlspecialchars($this->input->post('stok', true)),
            'harga'         => htmlspecialchars($this->input->post('harga', true)),
        ];

        $this->Model_barang->edit($id_barang, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible text-white show fade">Data berhasil diperbarui.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('barang');
    }

    // public function hapus_barang($id_barang)
    // {
    //     $this->Model_barang->hapus($id_barang);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-danger alert-dismissible show fade">
    //             Data berhasil dihapus.
    //             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    //         </div>'
    //     );
    //     redirect('barang');
    // }
    // END BARANG


    // BARANG MASUK
    public function barang_masuk()
    {
        $data = [
            'title'         => 'Barang Masuk',
            'barang'        => $this->Model_barang->getAllData(),
            'barang_masuk'  => $this->Model_barang_masuk->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/barang_masuk');
        $this->load->view('templates/footer');
    }

    public function hitung_barang_masuk()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'title'         => 'Hitung Barang Masuk',
            'barang'        => $this->Model_barang->getAllData(),
            'barang_masuk'  => $this->Model_barang_masuk->getAllData(),
            'id_barang'     => $this->input->post('id_barang'),
            'kode_barang'   => $this->input->post('kode_barang'),
            'nama_barang'   => $this->input->post('nama_barang'),
            'tanggal'       => date('Y-m-d H:i:s'),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/hitung_barang_masuk');
        $this->load->view('templates/footer');
    }

    public function tambah_barang_masuk()
    {
        $id_barang      = htmlspecialchars($this->input->post('id_barang', true));
        $stok_masuk     = htmlspecialchars($this->input->post('stok_masuk', true));
        $tanggal_masuk  = htmlspecialchars($this->input->post('tanggal_masuk', true));

        $data = [
            'id_barang'     => $id_barang,
            'tanggal_masuk' => $tanggal_masuk,
            'stok_masuk'    => $stok_masuk,
        ];

        $this->Model_barang_masuk->tambah($data);
        $this->Model_barang_masuk->editStokBarang($id_barang, $stok_masuk);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible show fade">
            Data berhasil disimpan.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('barang_masuk');
    }

    public function edit_barang_masuk($id_barang_masuk)
    {
        $id_barang          = htmlspecialchars($this->input->post('id_barang', true));
        $stok_masuk_baru    = htmlspecialchars($this->input->post('stok_masuk', true));
        $tanggal_masuk      = htmlspecialchars($this->input->post('tanggal_masuk', true));

        $data_lama = $this->Model_barang_masuk->getBarangMasuk($id_barang_masuk);

        if ($data_lama) {
            $stok_masuk_lama    = $data_lama->stok_masuk;
            $selisih_stok       = $stok_masuk_baru - $stok_masuk_lama;

            $data = [
                'id_barang_masuk'   => $id_barang_masuk,
                'id_barang'         => $id_barang,
                'tanggal_masuk'     => $tanggal_masuk,
                'stok_masuk'        => $stok_masuk_baru,
            ];

            $this->Model_barang_masuk->edit($id_barang_masuk, $data);
            $this->Model_barang_masuk->editStokBarang($id_barang, $selisih_stok);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible text-white show fade">Data berhasil diperbarui.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
            );
        }

        redirect('barang_masuk');
    }

    public function hapus_barang_masuk($id_barang_masuk)
    {
        $data_lama = $this->Model_barang_masuk->getBarangMasuk($id_barang_masuk);

        if ($data_lama) {
            $id_barang  = $data_lama->id_barang;
            $stok_masuk = $data_lama->stok_masuk;

            $this->Model_barang_masuk->editStokBarang($id_barang, -$stok_masuk);
            $this->Model_barang_masuk->hapus($id_barang_masuk);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                Data berhasil dihapus.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
            );
        }

        redirect('barang_masuk');
    }
    // END BARANG MASUK


    // BARANG KELUAR
    public function barang_keluar()
    {
        $data = [
            'title'         => 'Barang Keluar',
            'barang'        => $this->Model_barang->getAllData(),
            'barang_keluar' => $this->Model_barang_keluar->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/barang_keluar');
        $this->load->view('templates/footer');
    }

    public function tambah_barang_keluar()
    {
        $id_barang      = htmlspecialchars($this->input->post('id_barang', true));
        $stok_keluar    = htmlspecialchars($this->input->post('stok_keluar', true));
        $tanggal_keluar = htmlspecialchars($this->input->post('tanggal_keluar', true));

        $barang = $this->Model_barang_keluar->getBarang($id_barang);

        // Validasi stok keluar tidak boleh lebih dari stok yang tersedia
        if ($stok_keluar > $barang->stok) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                    Stok yang tersedia untuk <strong>' . $barang->nama_barang . '</strong> hanya <strong>' . $barang->stok . '</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
            redirect('barang_keluar');
            return;
        }

        $data = [
            'id_barang'         => $id_barang,
            'tanggal_keluar'    => $tanggal_keluar,
            'stok_keluar'       => $stok_keluar,
        ];

        $this->Model_barang_keluar->tambah($data);
        $this->Model_barang_keluar->editStokBarang($id_barang, $stok_keluar);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible show fade">
                Data berhasil disimpan.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('barang_keluar');
    }

    public function edit_barang_keluar($id_barang_keluar)
    {
        $id_barang          = htmlspecialchars($this->input->post('id_barang', true));
        $stok_keluar_baru   = htmlspecialchars($this->input->post('stok_keluar', true));
        $tanggal_keluar     = htmlspecialchars($this->input->post('tanggal_keluar', true));

        $data_lama  = $this->Model_barang_keluar->getBarangKeluar($id_barang_keluar);
        $barang     = $this->Model_barang_keluar->getBarang($id_barang);

        if ($data_lama && $barang) {
            $stok_keluar_lama = $data_lama->stok_keluar;
            $selisih_stok = $stok_keluar_baru - $stok_keluar_lama;
            $stok_tersisa = $barang->stok - $selisih_stok;

            // Validasi stok tidak boleh kurang dari nol setelah perubahan
            if ($stok_tersisa < 0) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible show fade">
                        Stok yang tersedia untuk <strong>' . $barang->nama_barang . '</strong> hanya <strong>' . $barang->stok . '</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );
                redirect('barang_keluar');
                return;
            }

            $data = [
                'id_barang_keluar'  => $id_barang_keluar,
                'id_barang'         => $id_barang,
                'tanggal_keluar'    => $tanggal_keluar,
                'stok_keluar'       => $stok_keluar_baru,
            ];

            $this->Model_barang_keluar->edit($id_barang_keluar, $data);
            $this->Model_barang_keluar->editStokBarang($id_barang, $selisih_stok);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible text-white show fade">Data berhasil diperbarui.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
        }

        redirect('barang_keluar');
    }

    public function hapus_barang_keluar($id_barang_keluar)
    {
        $data_lama = $this->Model_barang_keluar->getBarangKeluar($id_barang_keluar);

        if ($data_lama) {
            $id_barang      = $data_lama->id_barang;
            $stok_keluar    = $data_lama->stok_keluar;

            $this->Model_barang_keluar->editStokBarang($id_barang, -$stok_keluar);
            $this->Model_barang_keluar->hapus($id_barang_keluar);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                     Data berhasil dihapus.
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'
            );
        }

        redirect('barang_keluar');
    }
    // END BARANG KELUAR


    // PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title' => 'Profile',
            'user'  => $this->Model_user->getUserById($id_user),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/profile');
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');
        $cekData = $this->Model_user->getUserById($id_user);

        $data = [
            'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', true)),
            'no_telp'       => htmlspecialchars($this->input->post('no_telp', true)),
            'username'      => htmlspecialchars($this->input->post('username', true)),
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $changes_made = false;

        foreach ($data as $key => $value) {
            if ($key === 'password') {
                if (!empty($this->input->post('password'))) {
                    $changes_made = true;
                    break;
                }
            } else {
                if ($value != $cekData[$key]) {
                    $changes_made = true;
                    break;
                }
            }
        }

        if ($changes_made) {
            $this->Model_user->editUser($id_user, $data);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible show fade text-white">Profile berhasil diperbarui.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-warning alert-dismissible show fade text-white">Tidak ada perubahan yang dilakukan.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
        }

        redirect('profile');
    }


    // PENJUALAN
    public function penjualan()
    {
        $data = [
            'title'     => 'Penjualan',
            'penjualan' => $this->Model_penjualan->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/penjualan');
        $this->load->view('templates/footer');
    }

    public function get_barang_detail($id_barang)
    {
        $barang = $this->Model_barang->getDataById($id_barang);
        echo json_encode($barang);
    }

    public function tambah_penjualan()
    {
        $data = [
            'title'     => 'Tambah Penjualan',
            'barang'    => $this->Model_barang->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/tambah_penjualan');
        $this->load->view('templates/footer');
    }

    public function tambah_penjualan_baru()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->db->trans_start();

        $data = [
            'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
            'nomor_transaksi'   => $this->input->post('nomor_transaksi'),
            'tag'               => $this->input->post('tag'),
            'kurir'             => $this->input->post('kurir'),
            'tanggal_penjualan' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('penjualan', $data);
        $id_penjualan = $this->db->insert_id();

        $total = 0;
        $id_barang  = $this->input->post('id_barang');
        $stok       = $this->input->post('stok');

        foreach ($id_barang as $i => $barang_id) {
            if (empty($barang_id)) continue;

            $barang = $this->Model_barang->getDataById($barang_id);
            $stok_diminta = intval($stok[$i]);
            $total += $barang['harga'] * $stok_diminta;

            $this->db->insert('barang_keluar', [
                'id_penjualan'   => $id_penjualan,
                'id_barang'      => $barang_id,
                'tanggal_keluar' => date('Y-m-d H:i:s'),
                'stok_keluar'    => $stok_diminta
            ]);

            $this->db->update('barang', ['stok' => $barang['stok'] - $stok_diminta], ['id_barang' => $barang_id]);
        }

        $this->db->update('penjualan', ['total' => $total], ['id_penjualan' => $id_penjualan]);

        $this->db->trans_complete();

        $message        = $this->db->trans_status() ? 'Data berhasil disimpan.' : 'Gagal menyimpan data penjualan.';
        $alert_class    = $this->db->trans_status() ? 'success' : 'danger';

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-{$alert_class} alert-dismissible show fade text-white'>{$message}
            <button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
        );

        redirect('penjualan');
    }

    public function edit_penjualan($id_penjualan)
    {
        $penjualan          = $this->Model_penjualan->getDataById($id_penjualan);
        $barangPenjualan    = $this->Model_penjualan->getBarangByPenjualanId($id_penjualan);

        $data = [
            'title'             => 'Edit Penjualan',
            'barang'            => $this->Model_barang->getAllData(),
            'penjualan'         => $penjualan,
            'barangPenjualan'   => $barangPenjualan
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/edit_penjualan');
        $this->load->view('templates/footer');
    }

    public function edit_penjualan_baru($id_penjualan)
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->db->trans_start();

        $detail_penjualan = $this->Model_penjualan->getDetailPenjualan($id_penjualan);

        $data_penjualan = [
            'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
            'nomor_transaksi'   => $this->input->post('nomor_transaksi'),
            'tag'               => $this->input->post('tag'),
            'kurir'             => $this->input->post('kurir'),
            'tanggal_penjualan' => date('Y-m-d H:i:s')
        ];

        $this->db->update('penjualan', $data_penjualan, ['id_penjualan' => $id_penjualan]);

        $id_barang = $this->input->post('id_barang');
        $stok_baru = $this->input->post('stok');

        $total = 0;

        $input_barang_ids = array_filter($id_barang);
        if (!empty($input_barang_ids)) {
            // Kembalikan stok barang yang dihapus ke tabel barang
            $this->db->where('id_penjualan', $id_penjualan);
            $this->db->where_not_in('id_barang', $input_barang_ids);
            $barang_keluar_dihapus = $this->db->get('barang_keluar')->result_array();

            foreach ($barang_keluar_dihapus as $barang_keluar) {
                $this->db->query(
                    "UPDATE barang SET stok = stok + ? WHERE id_barang = ?",
                    [$barang_keluar['stok_keluar'], $barang_keluar['id_barang']]
                );
            }

            // Hapus barang_keluar yang tidak ada dalam input terbaru
            $this->db->where('id_penjualan', $id_penjualan);
            $this->db->where_not_in('id_barang', $input_barang_ids);
            $this->db->delete('barang_keluar');
        }

        foreach ($id_barang as $i => $barang_id) {
            if (empty($barang_id)) continue;

            $barang = $this->Model_barang->getDataById($barang_id);
            $stok_diminta = intval($stok_baru[$i]);

            $stok_sebelumnya = 0;
            foreach ($detail_penjualan as $detail) {
                if ($detail['id_barang'] == $barang_id) {
                    $stok_sebelumnya = intval($detail['stok_keluar']);
                    break;
                }
            }

            $total += $barang['harga'] * $stok_diminta;

            $this->db->query(
                "UPDATE barang SET stok = stok + ? - ? WHERE id_barang = ?",
                [$stok_sebelumnya, $stok_diminta, $barang_id]
            );

            $this->db->where('id_penjualan', $id_penjualan);
            $this->db->where('id_barang', $barang_id);
            $existing_record = $this->db->get('barang_keluar')->row();

            if ($existing_record) {
                $this->db->where('id_penjualan', $id_penjualan);
                $this->db->where('id_barang', $barang_id);
                $this->db->update('barang_keluar', ['stok_keluar' => $stok_diminta]);
            } else {
                $this->db->insert('barang_keluar', [
                    'id_penjualan'      => $id_penjualan,
                    'id_barang'         => $barang_id,
                    'stok_keluar'       => $stok_diminta,
                    'tanggal_keluar'    => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->db->update('penjualan', ['total' => $total], ['id_penjualan' => $id_penjualan]);
        $this->db->trans_complete();

        $message        = $this->db->trans_status() ? 'Data berhasil diperbarui.' : 'Gagal mengupdate data penjualan.';
        $alert_class    = $this->db->trans_status() ? 'success' : 'danger';

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-{$alert_class} alert-dismissible show fade text-white'>{$message}
            <button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
        );

        redirect('penjualan');
    }

    public function detail_penjualan($id_penjualan)
    {
        $penjualan          = $this->Model_penjualan->getDataById($id_penjualan);
        $barangPenjualan    = $this->Model_penjualan->getBarangByPenjualanId($id_penjualan);

        $data = [
            'title'             => 'Detail Penjualan',
            'barang'            => $this->Model_barang->getAllData(),
            'penjualan'         => $penjualan,
            'barangPenjualan'   => $barangPenjualan
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detail_penjualan');
        $this->load->view('templates/footer');
    }

    public function hapus_penjualan($id_penjualan)
    {
        $this->db->trans_start();

        try {
            $this->Model_penjualan->kembalikanStokBarang($id_penjualan);
            $this->Model_penjualan->hapus($id_penjualan);

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                    Data berhasil dihapus.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible show fade">
                    Terjadi kesalahan saat menghapus data.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
        }

        redirect('penjualan');
    }

    // END PENJUALAN


    // LAPORAN BARANG MASUK
    public function laporan_barang_masuk()
    {
        $data = [
            'title'         => 'Laporan Barang Masuk',
            'barang_masuk'  => $this->Model_barang_masuk->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/laporan_barang_masuk');
        $this->load->view('templates/footer');
    }

    public function laporan_barang_masuk_pdf()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'barang_masuk'  => $this->Model_barang_masuk->getFilterLaporan($tanggal_awal, $tanggal_akhir),
            'tanggal_awal'  => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ];

        $this->load->view('admin/laporan_barang_masuk_pdf', $data);
    }

    public function laporan_barang_masuk_excel()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'barang_masuk' => $this->Model_barang_masuk->getFilterLaporan($tanggal_awal, $tanggal_akhir)
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        // Set properties
        $object->getProperties()->setCreator("Hanseee");
        $object->getProperties()->setLastModifiedBy("Hanseee");
        $object->getProperties()->setTitle("Laporan Barang Masuk");

        $object->setActiveSheetIndex(0);

        // Set header cells
        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Barang');
        $object->getActiveSheet()->setCellValue('C1', 'Stok Masuk');
        $object->getActiveSheet()->setCellValue('D1', 'Tanggal Masuk');

        // Styling header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '095B34'],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:D1')->applyFromArray($headerStyle);

        // Set column width
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $row = 2;

        foreach ($data['barang_masuk'] as $tr) {
            $object->getActiveSheet()->setCellValue('A' . $row, $row - 1);
            $object->getActiveSheet()->setCellValue('B' . $row, ucwords($tr['nama_barang']));
            $object->getActiveSheet()->setCellValue('C' . $row, $tr['stok_masuk']);
            $object->getActiveSheet()->setCellValue('D' . $row, tanggalIndonesia($tr['tanggal_masuk']));

            $cellStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal'    => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'      => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ];

            $object->getActiveSheet()->getStyle('A' . $row . ':D' . $row)->applyFromArray($cellStyle);

            $row++;
        }

        $filename = "Laporan Barang Masuk " . $tanggal_awal . " - " . $tanggal_akhir . ".xlsx";

        $object->getActiveSheet()->setTitle('Laporan Barang Masuk');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
    // END LAPORAN BARANG MASUK


    // LAPORAN BARANG KELUAR
    public function laporan_barang_keluar()
    {
        $data = [
            'title'         => 'Laporan Barang Keluar',
            'barang_keluar' => $this->Model_barang_keluar->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/laporan_barang_keluar');
        $this->load->view('templates/footer');
    }

    public function laporan_barang_keluar_pdf()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'barang_keluar' => $this->Model_barang_keluar->getFilterLaporan($tanggal_awal, $tanggal_akhir),
            'tanggal_awal'  => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ];

        $this->load->view('admin/laporan_barang_keluar_pdf', $data);
    }

    public function laporan_barang_keluar_excel()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'barang_keluar' => $this->Model_barang_keluar->getFilterLaporan($tanggal_awal, $tanggal_akhir)
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        // Set properties
        $object->getProperties()->setCreator("Hanseee");
        $object->getProperties()->setLastModifiedBy("Hanseee");
        $object->getProperties()->setTitle("Laporan Barang Keluar");

        $object->setActiveSheetIndex(0);

        // Set header cells
        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Barang');
        $object->getActiveSheet()->setCellValue('C1', 'Stok Keluar');
        $object->getActiveSheet()->setCellValue('D1', 'Tanggal Keluar');

        // Styling header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '095B34'],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:D1')->applyFromArray($headerStyle);

        // Set column width
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $row = 2;

        foreach ($data['barang_keluar'] as $tr) {
            $object->getActiveSheet()->setCellValue('A' . $row, $row - 1);
            $object->getActiveSheet()->setCellValue('B' . $row, ucwords($tr['nama_barang']));
            $object->getActiveSheet()->setCellValue('C' . $row, $tr['stok_keluar']);
            $object->getActiveSheet()->setCellValue('D' . $row, tanggalIndonesia($tr['tanggal_keluar']));

            $cellStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal'    => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'      => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ];

            $object->getActiveSheet()->getStyle('A' . $row . ':D' . $row)->applyFromArray($cellStyle);

            $row++;
        }

        $filename = "Laporan Barang Keluar " . $tanggal_awal . " - " . $tanggal_akhir . ".xlsx";

        $object->getActiveSheet()->setTitle('Laporan Barang Keluar');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
    // END LAPORAN BARANG KELUAR


    // LAPORAN PENJUALAN
    public function laporan_penjualan()
    {
        $data = [
            'title'     => 'Laporan Penjualan',
            'penjualan' => $this->Model_penjualan->getAllData(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/laporan_penjualan');
        $this->load->view('templates/footer');
    }

    public function laporan_penjualan_pdf()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'penjualan'     => $this->Model_penjualan->getFilterLaporan($tanggal_awal, $tanggal_akhir),
            'tanggal_awal'  => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ];

        $this->load->view('admin/laporan_penjualan_pdf', $data);
    }

    public function laporan_penjualan_excel()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'penjualan' => $this->Model_penjualan->getFilterLaporan($tanggal_awal, $tanggal_akhir)
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        // Set properties
        $object->getProperties()->setCreator("Hanseee");
        $object->getProperties()->setLastModifiedBy("Hanseee");
        $object->getProperties()->setTitle("Laporan Penjualan");

        $object->setActiveSheetIndex(0);

        // Set header cells
        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nomor Transaksi');
        $object->getActiveSheet()->setCellValue('C1', 'Nama Pelanggan');
        $object->getActiveSheet()->setCellValue('D1', 'TAG');
        $object->getActiveSheet()->setCellValue('E1', 'Kurir');
        $object->getActiveSheet()->setCellValue('F1', 'Tanggal Penjualan');
        $object->getActiveSheet()->setCellValue('G1', 'Total');

        // Styling header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '095B34'],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Set column width
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(30);

        $row = 2;

        foreach ($data['penjualan'] as $tr) {
            $object->getActiveSheet()->setCellValue('A' . $row, $row - 1);
            $object->getActiveSheet()->setCellValue('B' . $row, $tr['nomor_transaksi']);
            $object->getActiveSheet()->setCellValue('C' . $row, ucwords($tr['nama_pelanggan']));
            $object->getActiveSheet()->setCellValue('D' . $row, ucwords($tr['tag']));
            $object->getActiveSheet()->setCellValue('E' . $row, $tr['kurir']);
            $object->getActiveSheet()->setCellValue('F' . $row, tanggalIndonesia($tr['tanggal_penjualan']));
            $object->getActiveSheet()->setCellValue('G' . $row, 'Rp ' . number_format($tr['total']));

            $cellStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal'    => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'      => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ];

            $object->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($cellStyle);

            $row++;
        }

        $filename = "Laporan Penjualan " . $tanggal_awal . " - " . $tanggal_akhir . ".xlsx";

        $object->getActiveSheet()->setTitle('Laporan Penjualan');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
    // END LAPORAN PENJUALAN
}

/* End of file Admin.php */
