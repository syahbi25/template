<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_all()
	{
		return $this->db->get('kategori_alat')->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('kategori_alat', array('id' => $id))->row();
	}

	public function insert($data)
	{
		return $this->db->insert('kategori_alat', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('kategori_alat', $data);
	}

	public function delete($id)
	{
		return $this->db->delete('kategori_alat', array('id' => $id));
	}
}
