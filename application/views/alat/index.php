<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Daftar Alat')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-wrench text-blue-600 mr-2"></i> Daftar Alat</h2>
    <?php if (has_role('admin')): ?>
        <a href="<?php echo site_url('alat/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i> Tambah Alat Baru
        </a>
    <?php endif; ?>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<?php
$columns = [
    ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Nama Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Kategori', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Status', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-24'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-48'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
                <?php if (count($alat) > 0): ?>
                    <?php $no = 1; foreach ($alat as $a): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($a->nama_alat); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($a->nama_kategori); ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php if ($a->status === 'Tersedia'): ?>
                                <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Tersedia</span>
                            <?php else: ?>
                                <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Dipinjam</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-sm space-x-2 flex">
                            <a href="<?php echo site_url('peminjaman/create?alat_id='.$a->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-cyan-500 hover:bg-cyan-600 text-white" title="Pinjam Alat">
                                <i class="fas fa-check"></i>
                                <span>Pinjam</span>
                            </a>
                            <?php if (has_role('admin')): ?>
                                <a href="<?php echo site_url('alat/edit/' . $a->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-white" title="Edit Alat">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="<?php echo site_url('alat/delete/' . $a->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?');" title="Hapus Alat">
                                    <i class="fas fa-trash"></i>
                                    <span>Hapus</span>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            <p class="font-semibold">Tidak ada data alat</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>


<?php $this->load->view('partials/footer'); ?>