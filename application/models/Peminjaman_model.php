<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Get semua data peminjaman dengan JOIN ke alat dan users
	 */
	public function get_all()
	{
		$this->db->select('peminjaman.*, alat.nama_alat, users.nama_lengkap as peminjam, peminjaman.keperluan as keterangan, peminjaman.tanggal_kembali_rencana as tanggal_kembali');
		$this->db->from('peminjaman');
		$this->db->join('alat', 'alat.id = peminjaman.alat_id', 'left');
		$this->db->join('users', 'users.id = peminjaman.peminjam_id', 'left');
		return $this->db->get()->result();
	}

	/**
	 * Get semua data peminjaman untuk peminjam tertentu, dengan JOIN
	 */
	public function get_by_peminjam($peminjam_id)
	{
		$this->db->select('peminjaman.*, alat.nama_alat, users.nama_lengkap as peminjam, peminjaman.keperluan as keterangan, peminjaman.tanggal_kembali_rencana as tanggal_kembali');
		$this->db->from('peminjaman');
		$this->db->join('alat', 'alat.id = peminjaman.alat_id', 'left');
		$this->db->join('users', 'users.id = peminjaman.peminjam_id', 'left');
		$this->db->where('peminjaman.peminjam_id', $peminjam_id);
		return $this->db->get()->result();
	}

	/**
	 * Get peminjaman berdasarkan status, dengan JOIN
	 */
	public function get_by_status($status)
	{
		$this->db->select('peminjaman.*, alat.nama_alat, users.nama_lengkap as peminjam, peminjaman.keperluan as keterangan, peminjaman.tanggal_kembali_rencana as tanggal_kembali');
		$this->db->from('peminjaman');
		$this->db->join('alat', 'alat.id = peminjaman.alat_id', 'left');
		$this->db->join('users', 'users.id = peminjaman.peminjam_id', 'left');
		$this->db->where('peminjaman.status', $status);
		return $this->db->get()->result();
	}

	/**
	 * Get data peminjaman berdasarkan ID, dengan JOIN
	 */
	public function get_by_id($id)
	{
		$this->db->select('peminjaman.*, alat.nama_alat, users.nama_lengkap as peminjam, peminjaman.keperluan as keterangan, peminjaman.tanggal_kembali_rencana as tanggal_kembali');
		$this->db->from('peminjaman');
		$this->db->join('alat', 'alat.id = peminjaman.alat_id', 'left');
		$this->db->join('users', 'users.id = peminjaman.peminjam_id', 'left');
		$this->db->where('peminjaman.id', $id);
		return $this->db->get()->row();
	}

	/**
	 * Insert data peminjaman baru
	 */
	public function insert($data)
	{
		return $this->db->insert('peminjaman', $data);
	}

	/**
	 * Update data peminjaman
	 */
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('peminjaman', $data);
	}

	/**
	 * Delete data peminjaman
	 */
	public function delete($id)
	{
		return $this->db->delete('peminjaman', array('id' => $id));
	}

	/**
	 * Count total data peminjaman
	 */
	public function count_all()
	{
		return $this->db->count_all('peminjaman');
	}
}
