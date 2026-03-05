<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$role = isset($this->session) ? $this->session->userdata('role') : 'peminjam';
$current_page = $this->uri->segment(1);
?>
<?php if (!isset($GLOBALS['sidebar_rendered'])): ?>
<?php $GLOBALS['sidebar_rendered'] = true; ?>
<div class="p-6">
    <h5 class="text-lg font-bold text-gray-800 mb-6 flex items-center space-x-2">
        <i class="fas fa-bars"></i> 
        <span>Menu <?php echo ucfirst($role); ?></span>
    </h5>
    
    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="<?php echo site_url('dashboard'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
            <i class="fas fa-home w-5"></i> 
            <span>Dashboard</span>
        </a>

        <?php if ($role === 'admin'): ?>
            <!-- Admin Menu -->
            <a href="<?php echo site_url('user'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'user') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-users w-5"></i> 
                <span>Kelola User</span>
            </a>
            <a href="<?php echo site_url('kategori'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'kategori') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-tag w-5"></i> 
                <span>Kategori Alat</span>
            </a>
            <a href="<?php echo site_url('alat'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'alat') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-wrench w-5"></i> 
                <span>Kelola Alat</span>
            </a>
            <a href="<?php echo site_url('peminjaman'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'peminjaman') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-handshake w-5"></i> 
                <span>Peminjaman</span>
            </a>
            <a href="<?php echo site_url('pengembalian'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'pengembalian') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-undo w-5"></i> 
                <span>Pengembalian</span>
            </a>
            <a href="<?php echo site_url('laporan'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'laporan') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-file-pdf w-5"></i> 
                <span>Laporan</span>
            </a>
            <a href="<?php echo site_url('log'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'log') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-history w-5"></i> 
                <span>Log Aktivitas</span>
            </a>

        <?php elseif ($role === 'petugas'): ?>
            <!-- Petugas Menu -->
            <a href="<?php echo site_url('peminjaman'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'peminjaman') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-handshake w-5"></i> 
                <span>Peminjaman</span>
            </a>
            <a href="<?php echo site_url('pengembalian'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'pengembalian') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-undo w-5"></i> 
                <span>Pengembalian</span>
            </a>
            <a href="<?php echo site_url('alat'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'alat') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-wrench w-5"></i> 
                <span>Daftar Alat</span>
            </a>
            <a href="<?php echo site_url('laporan'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'laporan') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-file-pdf w-5"></i> 
                <span>Laporan</span>
            </a>

        <?php elseif ($role === 'peminjam'): ?>
            <!-- Peminjam Menu -->
            <a href="<?php echo site_url('alat'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'alat') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-wrench w-5"></i> 
                <span>Daftar Alat</span>
            </a>
            <a href="<?php echo site_url('peminjaman'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'peminjaman') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-handshake w-5"></i> 
                <span>Peminjaman Saya</span>
            </a>
            <a href="<?php echo site_url('peminjaman/create'); ?>" class="flex items-center space-x-3 px-4 py-2 rounded transition <?php echo ($current_page === 'peminjaman' && $this->uri->segment(2) === 'create') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50'; ?>">
                <i class="fas fa-plus-circle w-5"></i> 
                <span>Ajukan Peminjaman</span>
            </a>
        <?php endif; ?>
    </nav>
</div>
<?php endif; ?>
