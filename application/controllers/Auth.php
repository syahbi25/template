<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	/**
	 * Halaman login
	 */
	public function index()
	{
		// Jika sudah login, redirect ke dashboard
		if ($this->session->userdata('user_id')) {
			redirect('dashboard');
		}

		$this->load->view('auth/login');
	}

	/**
	 * Proses login
	 */
	public function login()
	{
		// Redirect jika sudah login
		if ($this->session->userdata('user_id')) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->User_model->verify_password($username, $password);

			if ($user) {
				// Check status user
				if ($user->status !== 'aktif') {
					$this->session->set_flashdata('error', 'Akun Anda sedang nonaktif. Hubungi administrator.');
					redirect('auth');
				}

				// Set session
				$session_data = array(
					'user_id' => $user->id,
					'username' => $user->username,
					'nama_lengkap' => $user->nama_lengkap,
					'email' => $user->email,
					'role' => $user->role
				);
				$this->session->set_userdata($session_data);

				// Log aktivitas
				$this->log_activity('LOGIN', 'User ' . $user->username . ' berhasil login', 'users', $user->id);

				$this->session->set_flashdata('message', 'Selamat datang ' . $user->nama_lengkap . '!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Username atau password salah!');
				redirect('auth');
			}
		}
	}

	/**
	 * Logout
	 */
	public function logout()
	{
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		// Log aktivitas
		$this->log_activity('LOGOUT', 'User ' . $username . ' logout', 'users', $user_id);

		$this->session->unset_userdata(array(
			'user_id',
			'username',
			'nama_lengkap',
			'email',
			'role'
		));

		$this->session->set_flashdata('message', 'Anda telah logout. Terima kasih!');
		redirect('auth');
	}

	/**
	 * Log aktivitas
	 */
	private function log_activity($aksi, $deskripsi, $tabel = null, $record_id = null)
	{
		$log_data = array(
			'user_id' => $this->session->userdata('user_id'),
			'aksi' => $aksi,
			'deskripsi' => $deskripsi,
			'tabel' => $tabel,
			'record_id' => $record_id,
			'ip_address' => $this->input->ip_address(),
			'user_agent' => $this->input->user_agent()
		);

		$this->db->insert('log_aktivitas', $log_data);
	}
}
