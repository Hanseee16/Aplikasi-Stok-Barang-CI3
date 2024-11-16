<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function getAllData()
    {
        return $this->db
            ->order_by('nama_barang', 'ASC')
            ->get('barang')
            ->result_array();
    }

    public function getDataById($id_barang)
    {
        return $this->db
            ->get_where('barang', ['id_barang' => $id_barang])
            ->row_array();
    }

    public function getTotalData()
    {
        return $this->db->count_all('barang');
    }

    public function tambah($data)
    {
        $this->db->insert('barang', $data);
    }

    public function edit($id_barang, $data)
    {
        $this->db
            ->where('id_barang', $id_barang)
            ->update('barang', $data);
    }

    public function hapus($id_barang)
    {
        $this->db->delete('barang_masuk', ['id_barang' => $id_barang]);
        $this->db->delete('barang_keluar', ['id_barang' => $id_barang]);
        $this->db->delete('barang', ['id_barang' => $id_barang]);
    }
}

/* End of file Model_barang.php */
