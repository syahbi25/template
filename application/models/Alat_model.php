<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_all()
	{
		$this->db->select('alat.*, kategori_alat.nama_kategori');
		$this->db->from('alat');
		$this->db->join('kategori_alat', 'kategori_alat.id = alat.kategori_id', 'left');
		return $this->db->get()->result();
	}

	public function get_by_id($id)
	{
		$this->db->select('alat.*, kategori_alat.nama_kategori');
		$this->db->from('alat');
		$this->db->join('kategori_alat', 'kategori_alat.id = alat.kategori_id', 'left');
		$this->db->where('alat.id', $id);
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		return $this->db->insert('alat', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('alat', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('alat', array('id' => $id));
	}

	public function set_status($id, $status)
	{
		$this->db->where('id', $id);
		return $this->db->update('alat', array('status' => $status));
	}

	/**
	 * Search alat berdasarkan keyword
	 */
	public function search($keyword)
	{
		$this->db->select('alat.*, kategori_alat.nama_kategori');
		$this->db->from('alat');
		$this->db->join('kategori_alat', 'kategori_alat.id = alat.kategori_id', 'left');
		$this->db->group_start()
			->like('alat.nama_alat', $keyword)
			->or_like('alat.kode_alat', $keyword)
			->or_like('kategori_alat.nama_kategori', $keyword)
			->group_end();
		return $this->db->get()->result();
	}
}
