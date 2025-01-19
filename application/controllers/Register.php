<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model untuk mengelola data user
        $this->load->model('User_models');
        // Load helper untuk validasi form
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Ambil input dari request (x-www-form-urlencoded)
        $data = $this->input->post();

        // Validasi input
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $response = [
                'status' => false,
                'errors' => $this->form_validation->error_array()
            ];
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode($response));
        }

        // Jika validasi berhasil, simpan data ke database
        $insert_data = [
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        $this->db->insert('users', $insert_data);

        // Response sukses
        $response = [
            'status' => true,
            'message' => 'Registrasi berhasil.',
            'data' => [
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => $data['password']
            ]
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
