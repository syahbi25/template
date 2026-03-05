<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function insert($data)
	{
		return $this->db->insert('pengembalian', $data);
	}

	public function get_by_peminjaman($peminjaman_id)
	{
		return $this->db->get_where('pengembalian', array('peminjaman_id' => $peminjaman_id))->row();
	}

	public function get_all()
	{
		$this->db->select('pengembalian.*, peminjaman.alat_id, peminjaman.peminjam_id');
		$this->db->from('pengembalian');
		$this->db->join('peminjaman', 'peminjaman.id = pengembalian.peminjaman_id', 'left');
		return $this->db->get()->result();
	}

	/**
	 * Search pengembalian berdasarkan keyword
	 */
	public function search($keyword)
	{
		$this->db->select('pengembalian.*, peminjaman.alat_id, peminjaman.peminjam_id');
		$this->db->from('pengembalian');
		$this->db->join('peminjaman', 'peminjaman.id = pengembalian.peminjaman_id', 'left');
		$this->db->group_start()
			->like('pengembalian.peminjaman_id', $keyword)
			->or_like('pengembalian.kondisi_alat', $keyword)
			->group_end();
		return $this->db->get()->result();
	}
}
