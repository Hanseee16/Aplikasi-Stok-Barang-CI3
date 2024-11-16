<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_penjualan extends CI_Model
{
    public function getAllData()
    {
        return $this->db
            ->get('penjualan')
            ->result_array();
    }

    public function getTotalData()
    {
        return $this->db->count_all('penjualan');
    }

    public function getFilterLaporan($tanggal_awal, $tanggal_akhir)
    {
        $this->db->where('tanggal_penjualan >=', $tanggal_awal);
        $this->db->where('tanggal_penjualan <=', $tanggal_akhir . ' 23:59:59');
        return $this->db->get('penjualan')->result_array();
    }

    public function getDataById($id_penjualan)
    {
        return $this->db
            ->get_where('penjualan', ['id_penjualan' => $id_penjualan])
            ->row_array();
    }

    public function getBarangByPenjualanId($id_penjualan)
    {
        $this->db->select('barang.*, barang_keluar.stok_keluar');
        $this->db->from('barang_keluar');
        $this->db->join('barang', 'barang_keluar.id_barang = barang.id_barang');
        $this->db->where('barang_keluar.id_penjualan', $id_penjualan);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDetailPenjualan($id_penjualan)
    {
        $this->db->select('barang_keluar.*, barang.nama_barang, barang.harga');
        $this->db->from('barang_keluar');
        $this->db->join('barang', 'barang_keluar.id_barang = barang.id_barang');
        $this->db->where('barang_keluar.id_penjualan', $id_penjualan);

        $query = $this->db->get();
        return $query->result_array();
    }


    // public function tambah($data)
    // {
    //     $this->db->insert('barang', $data);
    // }

    // public function edit($id_barang, $data)
    // {
    //     $this->db
    //         ->where('id_barang', $id_barang)
    //         ->update('barang', $data);
    // }

    public function kembalikanStokBarang($id_penjualan)
    {
        $barang_keluar = $this->db->get_where('barang_keluar', ['id_penjualan' => $id_penjualan])->result_array();

        foreach ($barang_keluar as $item) {
            $this->db->set('stok', 'stok + ' . $item['stok_keluar'], FALSE)
                ->where('id_barang', $item['id_barang'])
                ->update('barang');
        }
    }

    public function hapus($id_penjualan)
    {
        $this->db->delete('barang_keluar', ['id_penjualan' => $id_penjualan]);
        $this->db->delete('penjualan', ['id_penjualan' => $id_penjualan]);
    }
}

/* End of file Model_penjualan.php */
