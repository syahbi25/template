<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		require_login();
	}

	/**
	 * Dashboard utama
	 */
	public function index()
	{
		$role = get_user_role();

		switch ($role) {
			case 'admin':
				$this->dashboard_admin();
				break;
			case 'petugas':
				$this->dashboard_petugas();
				break;
			case 'peminjam':
				$this->dashboard_peminjam();
				break;
			default:
				redirect('auth/logout');
		}
	}

	/**
	 * Dashboard untuk Admin
	 */
	private function dashboard_admin()
	{
		$this->load->model('User_model');

		$data['total_users'] = $this->User_model->count_all();
		$data['total_alat'] = $this->db->count_all('alat');
		$data['total_peminjaman'] = $this->db->count_all('peminjaman');
		$data['peminjaman_menunggu'] = $this->db->where('status', 'menunggu')->count_all_results('peminjaman');

		$this->load->view('dashboard/dashboard_admin', $data);
	}

	/**
	 * Dashboard untuk Petugas
	 */
	private function dashboard_petugas()
	{
		$data['peminjaman_menunggu'] = $this->db->where('status', 'menunggu')->count_all_results('peminjaman');
		$data['peminjaman_disetujui'] = $this->db->where('status', 'disetujui')->count_all_results('peminjaman');
		$data['alat_dipinjam'] = $this->db->where('status', 'dipinjam')->count_all_results('alat');

		$this->load->view('dashboard/dashboard_petugas', $data);
	}

	/**
	 * Dashboard untuk Peminjam
	 */
	private function dashboard_peminjam()
	{
		$user_id = get_user_id();
		
		$this->db->where('peminjam_id', $user_id);
		$data['peminjaman_saya'] = $this->db->count_all_results('peminjaman');

		$this->db->where('peminjam_id', $user_id)
				->where('status', 'menunggu');
		$data['peminjaman_menunggu'] = $this->db->count_all_results('peminjaman');

		$this->db->where('peminjam_id', $user_id)
				->where('status', 'disetujui');
		$data['peminjaman_aktif'] = $this->db->count_all_results('peminjaman');

		$this->load->view('dashboard/dashboard_peminjam', $data);
	}
}
