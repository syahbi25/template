<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');
        require_role('admin');
        $this->load->model('Log_model');
    }

    public function index()
    {
        $data['logs'] = $this->Log_model->get_all();
        $this->load->view('log/index', $data);
    }
}
