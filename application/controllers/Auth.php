<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if ($this->input->post()) {
            $username   = htmlspecialchars($this->input->post('username', true));;
            $password   = htmlspecialchars($this->input->post('password', true));;

            $user = $this->Model_user->cekUsername($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata([
                        'id_user' => $user['id_user'],
                    ]);

                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Selamat datang, <strong>' . htmlspecialchars(ucwords($user['nama_lengkap']), ENT_QUOTES, 'UTF-8') . '</strong>!
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                    );

                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-dismissible show fade">
                            Maaf, password yang Anda masukkan salah.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible show fade">
                        Username yang Anda masukkan belum terdaftar. Silakan lakukan registrasi.
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
            }
        }

        $this->load->view('auth/login');
    }

    public function registrasi()
    {
        if ($this->input->post()) {
            $username       = htmlspecialchars($this->input->post('username', true));
            $no_telp        = htmlspecialchars($this->input->post('no_telp', true));
            $nama_lengkap   = htmlspecialchars($this->input->post('nama_lengkap', true));

            $cekUsername    = $this->Model_user->cekUsername($username);
            $cekNoTelp      = $this->Model_user->cekNoTelp($no_telp);

            if ($cekUsername) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username sudah terdaftar! Silakan gunakan username lain.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('registrasi');
            } elseif ($cekNoTelp) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Nomor telepon sudah terdaftar! Silakan gunakan nomor telepon lain.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
                redirect('registrasi');
            } else {
                $data = [
                    'nama_lengkap'  => $nama_lengkap,
                    'username'      => $username,
                    'no_telp'       => $no_telp,
                    'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

                ];

                $this->Model_user->tambahUser($data);
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Registrasi berhasil! Silakan login.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );

                redirect('login');
            }
        } else {
            $this->load->view('auth/registrasi');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        redirect('login');
    }
}

/* End of file Auth.php */
