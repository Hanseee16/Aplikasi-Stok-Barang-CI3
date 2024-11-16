<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang_keluar extends CI_Model
{
    public function getAllData()
    {
        return $this->db
            // ->order_by('nama_barang', 'ASC')
            ->join('barang AS b', 'b.id_barang = bm.id_barang', 'INNER')
            ->get('barang_keluar AS bm')
            ->result_array();
    }

    public function getTotalData()
    {
        return $this->db->count_all('barang_keluar');
    }

    public function getDataById($id_barang_keluar)
    {
        return $this->db
            ->get_where('barang_keluar', ['id_barang_keluar' => $id_barang_keluar])
            ->row_array();
    }

    public function getFilterLaporan($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('barang AS b', 'b.id_barang = bk.id_barang', 'INNER');
        $this->db->where('tanggal_keluar >=', $tanggal_awal);
        $this->db->where('tanggal_keluar <=', $tanggal_akhir . ' 23:59:59');
        return $this->db->get('barang_keluar AS bk')->result_array();
    }

    // public function getBarangKeluar($id_barang_keluar)
    // {
    //     return $this->db
    //         ->get_where('barang_keluar', ['id_barang_keluar' => $id_barang_keluar])
    //         ->row();
    // }

    // public function getBarang($id_barang)
    // {
    //     return $this->db->select('nama_barang, stok')
    //         ->where('id_barang', $id_barang)
    //         ->get('barang')
    //         ->row();
    // }

    // public function tambah($data)
    // {
    //     $this->db->insert('barang_keluar', $data);
    // }

    // public function edit($id_barang_keluar, $data)
    // {
    //     $this->db
    //         ->where('id_barang_keluar', $id_barang_keluar)
    //         ->update('barang_keluar', $data);
    // }

    // public function editStokBarang($id_barang, $stok_keluar)
    // {
    //     $this->db->select('stok');
    //     $this->db->where('id_barang', $id_barang);
    //     $barang = $this->db->get('barang')->row();

    //     if ($barang) {
    //         $stok_baru = $barang->stok - $stok_keluar;

    //         $this->db->where('id_barang', $id_barang);
    //         $this->db->update('barang', ['stok' => $stok_baru]);
    //     }
    // }

    // public function hapus($id_barang_keluar)
    // {
    //     $this->db->delete('barang_keluar', ['id_barang_keluar' => $id_barang_keluar]);
    // }
}

/* End of file Model_barang_keluar.php */
