<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_models extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$data = $this->db->get('users');
		return $data->row_array();
	}

	public function register($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update_password($username, $new_password)
{
    $this->db->where('username', $username);
    $this->db->update('users', ['password' => $new_password]);

    if ($this->db->affected_rows() > 0) {
        return true; // Password berhasil diupdate
    } else {
        return false; // Tidak ada perubahan pada data
    }
}
    

}
?>
