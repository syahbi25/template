<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Log Aktivitas'));

?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-history text-blue-600 mr-2"></i> Log Aktivitas Sistem</h2>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<!-- Search Form -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="<?php echo site_url('log'); ?>" class="flex gap-2">
        <div class="flex-grow">
            <input type="text" name="search" placeholder="Cari berdasarkan user, aksi, deskripsi, atau tabel..." 
                   value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
            <i class="fas fa-search mr-2"></i> Cari
        </button>
        <?php if (isset($search) && $search): ?>
            <a href="<?php echo site_url('log'); ?>" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-times mr-2"></i> Bersihkan
            </a>
        <?php endif; ?>
    </form>
</div>

<?php if (!empty($logs)): ?>
    <?php
    $columns = [
        ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
        ['label' => 'User ID', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Deskripsi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Tabel', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Tanggal', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'IP Address', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ];
    $this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
    ?>
    <?php $no = 1; foreach ($logs as $l): ?>
    <tr class="hover:bg-gray-50 transition">
        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
        <td class="px-4 py-3 text-sm">
            <span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                <?php echo htmlspecialchars($l->user_id); ?>
            </span>
        </td>
        <td class="px-4 py-3 text-sm">
            <?php
                $aksi_class = 'bg-gray-200 text-gray-800';
                if ($l->aksi === 'CREATE') {
                    $aksi_class = 'bg-green-200 text-green-800';
                } elseif ($l->aksi === 'UPDATE') {
                    $aksi_class = 'bg-yellow-200 text-yellow-800';
                } elseif ($l->aksi === 'DELETE') {
                    $aksi_class = 'bg-red-200 text-red-800';
                } else {
                    $aksi_class = 'bg-cyan-200 text-cyan-800';
                }
            ?>
            <span class="<?php echo $aksi_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                <?php echo htmlspecialchars($l->aksi); ?>
            </span>
        </td>
        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($l->deskripsi); ?></td>
        <td class="px-4 py-3 text-sm"><code class="bg-gray-100 px-2 py-1 rounded text-xs"><?php echo htmlspecialchars($l->tabel); ?></code></td>
        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y H:i:s', strtotime($l->created_at)); ?></td>
        <td class="px-4 py-3 text-sm text-gray-600 font-mono text-xs"><?php echo htmlspecialchars($l->ip_address); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>
<?php else: ?>
    <div class="text-center py-12">
        <i class="fas fa-inbox text-gray-300 text-6xl mb-3 block"></i>
        <p class="text-gray-600 text-lg font-semibold">Belum ada log aktivitas</p>
    </div>
<?php endif; ?>

<?php $this->load->view('partials/footer'); ?>
