<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengembalian_model');
		$this->load->model('Peminjaman_model');
		$this->load->model('Alat_model');
		$this->load->model('Log_model');
		$this->load->helper('auth');
	}

	public function index()
	{
		$search = $this->input->get('search');
		
		// Petugas lihat semua pengembalian, peminjam lihat pengembalian sendiri
		if (has_role(['admin','petugas'])) {
			if ($search) {
				$data['pengembalian'] = $this->Pengembalian_model->search($search);
			} else {
				$data['pengembalian'] = $this->Pengembalian_model->get_all();
			}
		} else {
			$user_id = get_user_id();
			if ($search) {
				$all = $this->Pengembalian_model->search($search);
			} else {
				$all = $this->Pengembalian_model->get_all();
			}
			// Filter by user
			$data['pengembalian'] = array();
			foreach ($all as $p) {
				if ($p->peminjam_id == $user_id) $data['pengembalian'][] = $p;
			}
		}
		$data['search'] = $search;
		$this->load->view('pengembalian/index', $data);
	}

	public function create($peminjaman_id = null)
	{
		require_role('peminjam');
		$data = array();
		$data['peminjaman'] = $this->Peminjaman_model->get_by_id($peminjaman_id);
		if (empty($data['peminjaman'])) show_404();
		$this->load->view('pengembalian/create', $data);
	}

	public function store()
	{
		require_role('peminjam');
		$this->form_validation->set_rules('peminjaman_id', 'Peminjaman', 'required');
		$this->form_validation->set_rules('tanggal_dikembalikan', 'Tanggal Dikembalikan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Form tidak valid');
			redirect('peminjaman');
		}
		$peminjaman_id = $this->input->post('peminjaman_id');
		$p = $this->Peminjaman_model->get_by_id($peminjaman_id);
		if (empty($p)) show_404();

		$data = array(
			'peminjaman_id' => $peminjaman_id,
			'tanggal_dikembalikan' => $this->input->post('tanggal_dikembalikan'),
			'kondisi_alat' => $this->input->post('kondisi_alat') ?: 'baik',
			'keterangan' => $this->input->post('keterangan'),
			'diperiksa_oleh' => null,
			'kerusakan_biaya' => $this->input->post('kerusakan_biaya') ?: 0,
			'created_at' => date('Y-m-d H:i:s')
		);

		if ($this->Pengembalian_model->insert($data)) {
			// update peminjaman status
			$this->Peminjaman_model->update($peminjaman_id, array('status' => 'dikembalikan', 'tanggal_kembali_aktual' => $data['tanggal_dikembalikan'], 'updated_at' => date('Y-m-d H:i:s')));
			// set alat status tersedia
			if (!empty($p->alat_id)) {
				$this->Alat_model->set_status($p->alat_id, 'tersedia');
			}
			$this->Log_model->insert(get_user_id(), 'PENGEMBALIAN', 'Pengembalian untuk peminjaman_id='.$peminjaman_id, 'pengembalian', $peminjaman_id);
			$this->session->set_flashdata('message', 'Pengembalian berhasil dicatat.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menyimpan pengembalian');
		}
		redirect('pengembalian');
	}

	public function view($id)
	{
		$data['pengembalian'] = $this->Pengembalian_model->get_by_peminjaman($id);
		if (empty($data['pengembalian'])) show_404();
		$this->load->view('pengembalian/view', $data);
	}
}
