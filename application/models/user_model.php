<?php
if (!defined ('BASEPATH')) exit ('No direct access allowed');
    class User_model extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function add_data($data_user)
    {
        $this->load->database();

        $this->db->insert('student',$data_user);
        return $this->db->insert_id();

    }
}

?>