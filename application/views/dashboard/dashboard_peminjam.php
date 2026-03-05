<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('auth');
$this->load->view('partials/header', array('title' => 'Dashboard Peminjam'));
?>

<h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-chart-line text-blue-600 mr-2"></i> Dashboard Peminjam</h2>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Total Peminjaman Saya -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $peminjaman_saya; ?></div>
                <div class="text-blue-100 mt-2">Total Peminjaman Saya</div>
            </div>
            <div class="text-5xl opacity-20"><i class="fas fa-handshake"></i></div>
        </div>
    </div>

    <!-- Peminjaman Menunggu -->
    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $peminjaman_menunggu; ?></div>
                <div class="text-red-100 mt-2">Peminjaman Menunggu</div>
            </div>
            <div class="text-5xl opacity-20"><i class="fas fa-clock"></i></div>
        </div>
    </div>

    <!-- Peminjaman Aktif -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $peminjaman_aktif; ?></div>
                <div class="text-green-100 mt-2">Peminjaman Aktif</div>
            </div>
            <div class="text-5xl opacity-20"><i class="fas fa-check"></i></div>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-gray-200 px-6 py-4 border-b border-gray-300">
        <h3 class="font-bold text-gray-800"><i class="fas fa-tachometer-alt text-blue-600 mr-2"></i> Akses Cepat</h3>
    </div>
    <div class="divide-y divide-gray-200">
        <a href="<?php echo site_url('alat'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-wrench text-2xl text-cyan-600"></i>
                <span class="font-semibold text-gray-800">Lihat Daftar Alat</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
        <a href="<?php echo site_url('peminjaman/create'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-plus-circle text-2xl text-green-600"></i>
                <span class="font-semibold text-gray-800">Ajukan Peminjaman</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
        <a href="<?php echo site_url('peminjaman'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-handshake text-2xl text-orange-600"></i>
                <span class="font-semibold text-gray-800">Peminjaman Saya</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
