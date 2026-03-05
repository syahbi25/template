<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		// CI_Model does not require explicit parent constructor call in this environment
		$this->load->database();
	}

	/**
	 * Get user berdasarkan username
	 */
	public function get_by_username($username)
	{
		return $this->db->get_where('users', array('username' => $username))->row();
	}

	/**
	 * Get user berdasarkan ID
	 */
	public function get_by_id($id)
	{
		return $this->db->get_where('users', array('id' => $id))->row();
	}

	/**
	 * Get semua user
	 */
	public function get_all()
	{
		return $this->db->get('users')->result();
	}

	/**
	 * Get user berdasarkan role
	 */
	public function get_by_role($role)
	{
		return $this->db->get_where('users', array('role' => $role))->result();
	}

	/**
	 * Insert user baru
	 */
	public function insert($data)
	{
		if (isset($data['password'])) {
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		}
		return $this->db->insert('users', $data);
	}

	/**
	 * Update user
	 */
	public function update($id, $data)
	{
		if (isset($data['password']) && !empty($data['password'])) {
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		} else {
			unset($data['password']);
		}
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}

	/**
	 * Delete user
	 */
	public function delete($id)
	{
		return $this->db->delete('users', array('id' => $id));
	}

	/**
	 * Verifikasi password
	 */
	public function verify_password($username, $password)
	{
		$user = $this->get_by_username($username);
		
		if ($user && password_verify($password, $user->password)) {
			return $user;
		}
		return false;
	}

	/**
	 * Count user
	 */
	public function count_all()
	{
		return $this->db->count_all('users');
	}

	/**
	 * Check username exists
	 */
	public function username_exists($username, $exclude_id = null)
	{
		$this->db->where('username', $username);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('users');
		return $query->num_rows() > 0;
	}

	/**
	 * Check email exists
	 */
	public function email_exists($email, $exclude_id = null)
	{
		$this->db->where('email', $email);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('users');
		return $query->num_rows() > 0;
	}
}
