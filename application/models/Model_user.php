<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function cekUsername($username)
    {
        return $this->db
            ->get_where('user', ['username' => $username])
            ->row_array();
    }

    public function cekNoTelp($no_telp)
    {
        return $this->db
            ->get_where('user', ['no_telp' => $no_telp])
            ->row_array();
    }

    public function getUserById($id_user)
    {
        return $this->db
            ->get_where('user', ['id_user' => $id_user])
            ->row_array();
    }

    public function getAllUser()
    {
        return $this->db
            ->order_by('user.id_user', 'DESC')
            ->join('role', 'user.id_role = role.id_role')
            ->get('user')
            ->result_array();
    }

    public function tambahUser($data)
    {
        $this->db->insert('user', $data);
    }

    public function editUser($id_user, $data)
    {
        $this->db
            ->where('id_user', $id_user)
            ->update('user', $data);
    }

    public function hapusUser($id_user)
    {
        $this->db->delete('user', ['id_user' => $id_user]);
    }
}

/* End of file Model_user.php */
