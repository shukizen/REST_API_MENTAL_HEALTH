<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tips_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getTips()
    {
        $query = $this->db->get('tips');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
}
