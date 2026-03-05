<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Kelola Kategori')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-tag text-blue-600 mr-2"></i> Kelola Kategori Alat</h2>
    <a href="<?php echo site_url('kategori/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
        <i class="fas fa-plus mr-2"></i> Tambah Kategori
    </a>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<!-- Search Form -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="<?php echo site_url('kategori'); ?>" class="flex gap-2">
        <div class="flex-grow">
            <input type="text" name="search" placeholder="Cari berdasarkan nama kategori..." 
                   value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
            <i class="fas fa-search mr-2"></i> Cari
        </button>
        <?php if (isset($search) && $search): ?>
            <a href="<?php echo site_url('kategori'); ?>" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-times mr-2"></i> Bersihkan
            </a>
        <?php endif; ?>
    </form>
</div>

<?php
$columns = [
    ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Nama Kategori', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-48'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
                <?php if (count($kategori) > 0): ?>
                    <?php $no = 1; foreach ($kategori as $k): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($k->nama_kategori); ?></td>
                        <td class="px-4 py-3 text-sm space-x-2 flex">
                            <a href="<?php echo site_url('kategori/edit/' . $k->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="<?php echo site_url('kategori/delete/' . $k->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" title="Hapus">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            <p class="font-semibold">Tidak ada data kategori</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>


<?php $this->load->view('partials/footer'); ?>