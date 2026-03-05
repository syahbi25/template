<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');
        require_role(['admin', 'petugas']);
        $this->load->model('Peminjaman_model');
        $this->load->model('Pengembalian_model');
    }

    /**
     * Tampilkan halaman laporan utama
     */
    public function index()
    {
        $data['peminjaman'] = $this->Peminjaman_model->get_all();
        $data['pengembalian'] = $this->Pengembalian_model->get_all();
        $this->load->view('laporan/index', $data);
    }

    /**
     * Laporan peminjaman saja
     */
    public function peminjaman()
    {
        $data['peminjaman'] = $this->Peminjaman_model->get_all();
        $this->load->view('laporan/peminjaman', $data);
    }

    /**
     * Laporan pengembalian saja
     */
    public function pengembalian()
    {
        $data['pengembalian'] = $this->Pengembalian_model->get_all();
        $this->load->view('laporan/pengembalian', $data);
    }

    /**
     * Print laporan peminjaman
     */
    public function print_peminjaman()
    {
        $data['peminjaman'] = $this->Peminjaman_model->get_all();
        $this->load->view('laporan/print_peminjaman', $data);
    }

    /**
     * Print laporan pengembalian
     */
    public function print_pengembalian()
    {
        $data['pengembalian'] = $this->Pengembalian_model->get_all();
        $this->load->view('laporan/print_pengembalian', $data);
    }
}
