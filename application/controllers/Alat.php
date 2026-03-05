<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Alat_model');
		$this->load->model('Kategori_model');
		$this->load->helper('auth');
		// Admin or Petugas can manage alat, peminjam can only view
		// We'll allow admins and petugas to access create/edit/delete
	}

	public function index()
	{
		$data['alat'] = $this->Alat_model->get_all();
		$this->load->view('alat/index', $data);
	}

	public function create()
	{
		require_role(['admin']);
		$data['kategori'] = $this->Kategori_model->get_all();
		$this->load->view('alat/create', $data);
	}

	public function store()
	{
		require_role(['admin']);
		$this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nama_alat' => $this->input->post('nama_alat'),
				'kategori_id' => $this->input->post('kategori_id'),
				'kode_alat' => $this->input->post('kode_alat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'status' => $this->input->post('status') ?: 'tersedia',
				'lokasi' => $this->input->post('lokasi')
			);

			if ($this->Alat_model->insert($data)) {
				$this->session->set_flashdata('message', 'Alat berhasil ditambahkan');
				redirect('alat');
			} else {
				$this->session->set_flashdata('error', 'Gagal menambahkan alat');
				redirect('alat/create');
			}
		}
	}

	public function edit($id)
	{
		require_role(['admin']);
		$data['alat'] = $this->Alat_model->get_by_id($id);
		$data['kategori'] = $this->Kategori_model->get_all();
		if (empty($data['alat'])) show_404();
		$this->load->view('alat/edit', $data);
	}

	public function update($id)
	{
		require_role(['admin']);
		$this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id);
		} else {
			$data = array(
				'nama_alat' => $this->input->post('nama_alat'),
				'kategori_id' => $this->input->post('kategori_id'),
				'kode_alat' => $this->input->post('kode_alat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'status' => $this->input->post('status'),
				'lokasi' => $this->input->post('lokasi')
			);

			if ($this->Alat_model->update($id, $data)) {
				$this->session->set_flashdata('message', 'Alat berhasil diupdate');
				redirect('alat');
			} else {
				$this->session->set_flashdata('error', 'Gagal mengupdate alat');
				redirect('alat/edit/' . $id);
			}
		}
	}

	public function delete($id)
	{
		require_role(['admin']);
		if ($this->Alat_model->delete($id)) {
			$this->session->set_flashdata('message', 'Alat berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus alat');
		}
		redirect('alat');
	}
}
