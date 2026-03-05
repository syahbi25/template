<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model');
		$this->load->helper('auth');
		require_role('admin');
	}

	public function index()
	{
		$search = $this->input->get('search');
		if ($search) {
			$data['kategori'] = $this->Kategori_model->search($search);
		} else {
			$data['kategori'] = $this->Kategori_model->get_all();
		}
		$data['search'] = $search;
		$this->load->view('kategori/index', $data);
	}

	public function create()
	{
		$this->load->view('kategori/create');
	}

	public function store()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('kategori/create');
		} else {
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
				'deskripsi' => $this->input->post('deskripsi')
			);

			if ($this->Kategori_model->insert($data)) {
				$this->session->set_flashdata('message', 'Kategori berhasil ditambahkan');
				redirect('kategori');
			} else {
				$this->session->set_flashdata('error', 'Gagal menambahkan kategori');
				redirect('kategori/create');
			}
		}
	}

	public function edit($id)
	{
		$data['kategori'] = $this->Kategori_model->get_by_id($id);
		if (empty($data['kategori'])) show_404();
		$this->load->view('kategori/edit', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id);
		} else {
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
				'deskripsi' => $this->input->post('deskripsi')
			);

			if ($this->Kategori_model->update($id, $data)) {
				$this->session->set_flashdata('message', 'Kategori berhasil diupdate');
				redirect('kategori');
			} else {
				$this->session->set_flashdata('error', 'Gagal mengupdate kategori');
				redirect('kategori/edit/' . $id);
			}
		}
	}

	public function delete($id)
	{
		if ($this->Kategori_model->delete($id)) {
			$this->session->set_flashdata('message', 'Kategori berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus kategori');
		}
		redirect('kategori');
	}
}
