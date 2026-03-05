<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header', array('title' => 'Kelola User')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-users text-blue-600 mr-2"></i> Kelola User</h2>
    <a href="<?php echo site_url('user/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
        <i class="fas fa-plus mr-2"></i> Tambah User
    </a>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<?php
$columns = [
    ['label' => '#', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Username', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Nama Lengkap', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Role', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-20'],
    ['label' => 'Status', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-20'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-24'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $u->id; ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($u->username); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($u->nama_lengkap); ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php
                                $role_class = '';
                                if ($u->role === 'admin') {
                                    $role_class = 'bg-red-200 text-red-800';
                                } elseif ($u->role === 'petugas') {
                                    $role_class = 'bg-blue-200 text-blue-800';
                                } else {
                                    $role_class = 'bg-gray-200 text-gray-800';
                                }
                            ?>
                            <span class="<?php echo $role_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                <?php echo ucfirst($u->role); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <?php
                                $status_class = ($u->status === 'aktif') ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800';
                            ?>
                            <span class="<?php echo $status_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                <?php echo ucfirst($u->status); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm space-x-2 flex">
                            <a href="<?php echo site_url('user/edit/' . $u->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-yellow-500 hover:bg-yellow-600 text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <a href="<?php echo site_url('user/delete/' . $u->id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');" title="Hapus">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            <p class="font-semibold">Tidak ada data user</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>


<?php $this->load->view('partials/footer'); ?>
