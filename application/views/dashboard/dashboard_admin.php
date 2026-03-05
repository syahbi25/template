<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('auth');
$this->load->view('partials/header', array('title' => 'Dashboard Admin'));
?>

<h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-chart-line text-blue-600 mr-2"></i> Dashboard Admin</h2>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Total Users -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $total_users; ?></div>
                <div class="text-green-100 mt-2">Total User</div>
            </div>
            <div class="text-5xl opacity-20"><i class="fas fa-users"></i></div>
        </div>
    </div>

    <!-- Total Alat -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $total_alat; ?></div>
                <div class="text-blue-100 mt-2">Total Alat</div>
            </div>
            <div class="text-5xl opacity-20"><i class="fas fa-wrench"></i></div>
        </div>
    </div>

    <!-- Total Peminjaman -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-4xl font-bold"><?php echo $total_peminjaman; ?></div>
                <div class="text-purple-100 mt-2">Total Peminjaman</div>
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
</div>

<!-- Quick Access -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-gray-200 px-6 py-4 border-b border-gray-300">
        <h3 class="font-bold text-gray-800"><i class="fas fa-tachometer-alt text-blue-600 mr-2"></i> Akses Cepat</h3>
    </div>
    <div class="divide-y divide-gray-200">
        <a href="<?php echo site_url('user'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-users text-2xl text-blue-600"></i>
                <span class="font-semibold text-gray-800">Kelola User</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
        <a href="<?php echo site_url('alat'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-wrench text-2xl text-cyan-600"></i>
                <span class="font-semibold text-gray-800">Kelola Alat</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
        <a href="<?php echo site_url('peminjaman'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-handshake text-2xl text-orange-600"></i>
                <span class="font-semibold text-gray-800">Peminjaman</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
        <a href="<?php echo site_url('laporan'); ?>" class="block px-6 py-4 hover:bg-blue-50 transition flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <i class="fas fa-file-pdf text-2xl text-red-600"></i>
                <span class="font-semibold text-gray-800">Lihat Laporan</span>
            </div>
            <i class="fas fa-chevron-right text-gray-400"></i>
        </a>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
