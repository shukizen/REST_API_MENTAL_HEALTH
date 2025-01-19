<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penyakit_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Ambil data dari model
        $data = $this->Penyakit_model->getPenyakit();

        // Set header untuk output JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
