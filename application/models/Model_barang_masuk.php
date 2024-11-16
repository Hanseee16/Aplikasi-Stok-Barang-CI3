<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang_masuk extends CI_Model
{
    public function getAllData()
    {
        return $this->db
            // ->order_by('nama_barang', 'ASC')
            ->join('barang AS b', 'b.id_barang = bm.id_barang', 'INNER')
            ->get('barang_masuk AS bm')
            ->result_array();
    }

    public function getTotalData()
    {
        return $this->db->count_all('barang_masuk');
    }

    public function getDataById($id_barang_masuk)
    {
        return $this->db
            ->get_where('barang_masuk', ['id_barang_masuk' => $id_barang_masuk])
            ->row_array();
    }

    public function getBarangMasuk($id_barang_masuk)
    {
        return $this->db
            ->get_where('barang_masuk', ['id_barang_masuk' => $id_barang_masuk])
            ->row();
    }

    public function getFilterLaporan($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('barang AS b', 'b.id_barang = bm.id_barang', 'INNER');
        $this->db->where('tanggal_masuk >=', $tanggal_awal);
        $this->db->where('tanggal_masuk <=', $tanggal_akhir . ' 23:59:59');
        return $this->db->get('barang_masuk AS bm')->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('barang_masuk', $data);
    }

    public function edit($id_barang_masuk, $data)
    {
        $this->db
            ->where('id_barang_masuk', $id_barang_masuk)
            ->update('barang_masuk', $data);
    }

    public function editStokBarang($id_barang, $stok_masuk)
    {
        $this->db->select('stok');
        $this->db->where('id_barang', $id_barang);
        $barang = $this->db->get('barang')->row();

        if ($barang) {
            $stok_baru = $barang->stok + $stok_masuk;

            $this->db->where('id_barang', $id_barang);
            $this->db->update('barang', ['stok' => $stok_baru]);
        }
    }

    public function hapus($id_barang_masuk)
    {
        $this->db->delete('barang_masuk', ['id_barang_masuk' => $id_barang_masuk]);
    }
}

/* End of file Model_barang_masuk.php */
