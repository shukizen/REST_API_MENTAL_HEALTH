<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Psikiater extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Psikiater_model');
    }

    function index_get()
    {
        $data = $this->Psikiater_model->getPsikiater();

        $result = $data;

        $this->response($result, REST_Controller::HTTP_OK);
    }
}
