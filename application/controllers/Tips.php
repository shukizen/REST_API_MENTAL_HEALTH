<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tips extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tips_model');
        $this->load->helper('url');
    }

    public function index()
    {
        // Ambil data dari model
        $data = $this->Tips_model->getTips();

        // Set header untuk output JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
