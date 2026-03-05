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
        $search = $this->input->get('search');
        if ($search) {
            $data['logs'] = $this->Log_model->search($search);
        } else {
            $data['logs'] = $this->Log_model->get_all();
        }
        $data['search'] = $search;
        $this->load->view('log/index', $data);
    }
}
