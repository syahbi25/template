<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Helper untuk role-based access control
 */

/**
 * Check apakah user sudah login
 */
if (!function_exists('is_logged_in')) {
	function is_logged_in()
	{
		$CI = &get_instance();
		return $CI->session->userdata('user_id');
	}
}

/**
 * Check user role
 */
if (!function_exists('has_role')) {
	function has_role($roles)
	{
		$CI = &get_instance();
		$user_role = $CI->session->userdata('role');

		if (is_array($roles)) {
			return in_array($user_role, $roles);
		}

		return $user_role === $roles;
	}
}

/**
 * Check apakah user adalah admin
 */
if (!function_exists('is_admin')) {
	function is_admin()
	{
		return has_role('admin');
	}
}

/**
 * Check apakah user adalah petugas
 */
if (!function_exists('is_petugas')) {
	function is_petugas()
	{
		return has_role('petugas');
	}
}

/**
 * Check apakah user adalah peminjam
 */
if (!function_exists('is_peminjam')) {
	function is_peminjam()
	{
		return has_role('peminjam');
	}
}

/**
 * Get nama user yang login
 */
if (!function_exists('get_user_name')) {
	function get_user_name()
	{
		$CI = &get_instance();
		return $CI->session->userdata('nama_lengkap');
	}
}

/**
 * Get role user
 */
if (!function_exists('get_user_role')) {
	function get_user_role()
	{
		$CI = &get_instance();
		return $CI->session->userdata('role');
	}
}

/**
 * Get user ID
 */
if (!function_exists('get_user_id')) {
	function get_user_id()
	{
		$CI = &get_instance();
		return $CI->session->userdata('user_id');
	}
}

/**
 * Require login - gunakan di controller
 * Akan redirect ke login jika user belum login
 */
if (!function_exists('require_login')) {
	function require_login()
	{
		$CI = &get_instance();
		
		if (!is_logged_in()) {
			$CI->session->set_flashdata('error', 'Anda harus login terlebih dahulu!');
			redirect('auth');
		}
	}
}

/**
 * Require role - gunakan di controller
 * Akan redirect ke dashboard jika user tidak memiliki role
 */
if (!function_exists('require_role')) {
	function require_role($roles)
	{
		$CI = &get_instance();

		require_login();

		if (!has_role($roles)) {
			$CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini!');
			redirect('dashboard');
		}
	}
}

/**
 * Redirect ke login jika tidak authorized - untuk di view
 */
if (!function_exists('check_access')) {
	function check_access($roles)
	{
		if (!is_logged_in()) {
			redirect('auth');
		}

		if (!has_role($roles)) {
			redirect('dashboard');
		}

		return true;
	}
}
