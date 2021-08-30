<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_login extends CI_Model
{

    public function validasi($username, $password)
    {
        $data = $this->db->get_where('admin', ['username' => $username])->result();
        if (count($data) === 1) {
            if (password_verify($password, $data[0]->password)) {
                return $dt        =    array(
                    'is_logged_in'  => true,
                    'id'            => $data[0]->id,
                    'username'      => $username,
                    'level'         => $data[0]->role,
                    'role'          => 'admin'
                );
            } else {
                return 0;
            }
        } else {
            $data = $this->db->get_where('siswa', ['nisn' => $username])->result();
            if (count($data) === 1) {
                if (password_verify($password, $data[0]->password)) {
                    return $dt        =    array(
                        'is_logged_in'  => true,
                        'nisn'          => $data[0]->nisn,
                        'username'      => $username,
                        'id_siswa'      => $data[0]->id,
                        'role'          => 'siswa'
                    );
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }
}
