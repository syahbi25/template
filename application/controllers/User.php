<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('auth');
        $this->load->library('form_validation');
        // Only admin can access user management
        require_role('admin');
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all();
        $this->load->view('user/index', $data);
    }

    public function create()
    {
        $this->load->view('user/create');
    }

    public function store()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/create');
            return;
        }

        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status') ?: 'aktif',
            'password' => $this->input->post('password')
        );

        $this->User_model->insert($data);
        $this->session->set_flashdata('message', 'User berhasil dibuat');
        redirect('user');
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->get_by_id($id);
        if (!$data['user']) show_404();
        $this->load->view('user/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $data = array(
            'email' => $this->input->post('email'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status') ?: 'aktif'
        );
        $password = $this->input->post('password');
        if (!empty($password)) $data['password'] = $password;

        $this->User_model->update($id, $data);
        $this->session->set_flashdata('message', 'User berhasil diupdate');
        redirect('user');
    }

    public function delete($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('message', 'User dihapus');
        redirect('user');
    }
}
