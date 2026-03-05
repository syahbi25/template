<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Daftar Peminjaman Alat')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-handshake text-blue-600 mr-2"></i> Daftar Peminjaman Alat</h2>
    <a href="<?php echo site_url('peminjaman/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
        <i class="fas fa-plus mr-2"></i> Tambah Peminjaman
    </a>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert-box bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-exclamation-circle mr-2"></i> <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<!-- Search Form -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="<?php echo site_url('peminjaman'); ?>" class="flex gap-2">
        <div class="flex-grow">
            <input type="text" name="search" placeholder="Cari berdasarkan nama alat, peminjam, atau keperluan..." 
                   value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
            <i class="fas fa-search mr-2"></i> Cari
        </button>
        <?php if (isset($search) && $search): ?>
            <a href="<?php echo site_url('peminjaman'); ?>" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-times mr-2"></i> Bersihkan
            </a>
        <?php endif; ?>
    </form>
</div>

<?php
$columns = [
    ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Nama Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Peminjam', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Tgl Pinjam', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Tgl Kembali', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
                    <?php if (!empty($peminjaman)): ?>
                    <?php $no = 1; foreach ($peminjaman as $item): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($item->nama_alat); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($item->peminjam); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($item->tanggal_pinjam)); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($item->tanggal_kembali)); ?></td>
                        <td class="px-4 py-3 text-sm space-x-2 flex flex-wrap gap-1">
                            <a href="<?php echo site_url('peminjaman/view/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-cyan-500 hover:bg-cyan-600 text-white" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                                <span>Lihat</span>
                            </a>
                            <?php $role = $this->session->userdata('role'); ?>
                            <?php if ($role === 'admin'): ?>
                            <a href="<?php echo site_url('peminjaman/edit/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="<?php echo site_url('peminjaman/delete/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('Yakin ingin menghapus?');" title="Hapus">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                            <?php endif; ?>
                            <?php if ($role === 'petugas' && isset($item->status) && $item->status === 'menunggu'): ?>
                            <a href="<?php echo site_url('peminjaman/approve/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-green-500 hover:bg-green-600 text-white" onclick="return confirm('Setujui peminjaman ini?');" title="Setujui">
                                <i class="fas fa-check"></i>
                                <span>Setujui</span>
                            </a>
                            <a href="<?php echo site_url('peminjaman/reject/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-gray-500 hover:bg-gray-600 text-white" onclick="return confirm('Tolak peminjaman ini?');" title="Tolak">
                                <i class="fas fa-times"></i>
                                <span>Tolak</span>
                            </a>
                            <?php endif; ?>
                            <?php if ($role === 'peminjam' && isset($item->status) && $item->status === 'disetujui'): ?>
                            <a href="<?php echo site_url('pengembalian/create/' . $item->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-blue-500 hover:bg-blue-600 text-white" title="Kembalikan">
                                <i class="fas fa-undo"></i>
                                <span>Kembalikan</span>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>
    <?php else: ?>
        <div class="px-8 py-12 text-center">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4 block"></i>
            <p class="text-gray-600 text-lg font-semibold mb-4">Tidak ada data peminjaman</p>
            <a href="<?php echo site_url('peminjaman/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Tambah Peminjaman Sekarang
            </a>
        </div>
    <?php endif; ?>
</div>

<?php $this->load->view('partials/footer'); ?>
