<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Peminjaman_model');
		$this->load->model('Alat_model');
		$this->load->model('Log_model');
		$this->load->helper('auth');
	}

	/**
	 * Tampilkan list semua peminjaman
	 */
	public function index()
	{
		// Get search keyword from GET
		$search = $this->input->get('search');
		
		// Admin & Petugas lihat semua, Peminjam lihat miliknya
		if (has_role(['admin','petugas'])) {
			if ($search) {
				$data['peminjaman'] = $this->Peminjaman_model->search($search);
			} else {
				$data['peminjaman'] = $this->Peminjaman_model->get_all();
			}
		} else {
			if ($search) {
				$data['peminjaman'] = $this->Peminjaman_model->search($search, get_user_id());
			} else {
				$data['peminjaman'] = $this->Peminjaman_model->get_by_peminjam(get_user_id());
			}
		}
		$data['search'] = $search;
		$this->load->view('peminjaman/index', $data);
	}

	/**
	 * Tampilkan form tambah peminjaman
	 */
	public function create()
	{
		require_role('peminjam');
		// Ambil daftar alat yang tersedia
		$this->load->model('Alat_model');
		$data['alat'] = $this->Alat_model->get_all();
		$this->load->view('peminjaman/create', $data);
	}

	/**
	 * Simpan peminjaman baru
	 */
	public function store()
	{
		require_role('peminjam');
		$this->form_validation->set_rules('alat_id', 'Alat', 'required');
		$this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tanggal_kembali_rencana', 'Tanggal Kembali', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('peminjaman/create');
		}
		else
		{
			$data = array(
				'alat_id' => $this->input->post('alat_id'),
				'peminjam_id' => get_user_id(),
				'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
				'tanggal_kembali_rencana' => $this->input->post('tanggal_kembali_rencana'),
				'keperluan' => $this->input->post('keperluan'),
				'status' => 'menunggu',
				'created_at' => date('Y-m-d H:i:s')
			);

			if ($this->Peminjaman_model->insert($data))
			{
				$this->Log_model->insert(get_user_id(), 'AJUKAN_PEMINJAMAN', 'Ajukan peminjaman untuk alat_id='.$data['alat_id'], 'peminjaman');
				$this->session->set_flashdata('message', 'Permintaan peminjaman berhasil diajukan!');
				redirect('peminjaman');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal menambahkan data peminjaman!');
				redirect('peminjaman/create');
			}
		}
	}

	/**
	 * Tampilkan detail peminjaman
	 */
	public function view($id)
	{
		$data['peminjaman'] = $this->Peminjaman_model->get_by_id($id);
		
		if (empty($data['peminjaman']))
		{
			show_404();
		}

		$this->load->view('peminjaman/view', $data);
	}

	/**
	 * Petugas approve peminjaman
	 */
	public function approve($id)
	{
		require_role('petugas');
		$p = $this->Peminjaman_model->get_by_id($id);
		if (empty($p)) show_404();
		// update peminjaman
		$this->Peminjaman_model->update($id, array('status' => 'disetujui', 'disetujui_oleh' => get_user_id(), 'updated_at' => date('Y-m-d H:i:s')));
		// set alat status jadi dipinjam
		if (!empty($p->alat_id)) {
			$this->Alat_model->set_status($p->alat_id, 'dipinjam');
		}
		$this->Log_model->insert(get_user_id(), 'SETUJU_PEMINJAMAN', 'Setujui peminjaman id='.$id, 'peminjaman', $id);
		$this->session->set_flashdata('message', 'Peminjaman telah disetujui.');
		redirect('peminjaman');
	}

	/**
	 * Petugas reject peminjaman
	 */
	public function reject($id)
	{
		require_role('petugas');
		$p = $this->Peminjaman_model->get_by_id($id);
		if (empty($p)) show_404();
		$this->Peminjaman_model->update($id, array('status' => 'ditolak', 'updated_at' => date('Y-m-d H:i:s')));
		$this->Log_model->insert(get_user_id(), 'TOLAK_PEMINJAMAN', 'Tolak peminjaman id='.$id, 'peminjaman', $id);
		$this->session->set_flashdata('message', 'Peminjaman telah ditolak.');
		redirect('peminjaman');
	}

	/**
	 * Tampilkan form edit peminjaman
	 */
	public function edit($id)
	{
		$data['peminjaman'] = $this->Peminjaman_model->get_by_id($id);
		
		if (empty($data['peminjaman']))
		{
			show_404();
		}

		$this->load->view('peminjaman/edit', $data);
	}

	/**
	 * Update peminjaman
	 */
	public function update($id)
	{
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tanggal_kembali_rencana', 'Tanggal Kembali Rencana', 'required');
		$this->form_validation->set_rules('keperluan', 'Keperluan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$data = array(
				'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
				'tanggal_kembali_rencana' => $this->input->post('tanggal_kembali_rencana'),
				'keperluan' => $this->input->post('keperluan'),
				'updated_at' => date('Y-m-d H:i:s')
			);

			if ($this->Peminjaman_model->update($id, $data))
			{
				$this->session->set_flashdata('message', 'Data peminjaman berhasil diupdate!');
				redirect('peminjaman');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal mengupdate data peminjaman!');
				redirect('peminjaman/edit/' . $id);
			}
		}
	}

	/**
	 * Delete peminjaman
	 */
	public function delete($id)
	{
		if ($this->Peminjaman_model->delete($id))
		{
			$this->session->set_flashdata('message', 'Data peminjaman berhasil dihapus!');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal menghapus data peminjaman!');
		}
		redirect('peminjaman');
	}
}
