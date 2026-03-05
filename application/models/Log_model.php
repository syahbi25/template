<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function insert($user_id, $aksi, $deskripsi = null, $tabel = null, $record_id = null)
	{
		$data = array(
			'user_id' => $user_id,
			'aksi' => $aksi,
			'deskripsi' => $deskripsi,
			'tabel' => $tabel,
			'record_id' => $record_id,
			'ip_address' => $this->input->ip_address(),
			'user_agent' => $this->input->user_agent(),
			'created_at' => date('Y-m-d H:i:s')
		);
		return $this->db->insert('log_aktivitas', $data);
	}

	/**
	 * Get semua log aktivitas, terbaru dulu
	 */
	public function get_all()
	{
		$this->db->from('log_aktivitas');
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result();
	}
}
