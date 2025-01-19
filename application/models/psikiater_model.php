<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Psikiater_model extends CI_Model{

    function __construct()
    {
     parent::__construct();
     $this->load->database();
    }

    public function getPsikiater(){
        $data =  $this->db->get('psikiater');
        return $data->result_array();
    }
}
?>