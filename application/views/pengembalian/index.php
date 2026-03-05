<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Daftar Pengembalian')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-undo text-blue-600 mr-2"></i> Daftar Pengembalian Alat</h2>
</div>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 fade-out transition">
        <i class="fas fa-check-circle mr-2"></i> <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<?php
$columns = [
    ['label' => 'No', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
    ['label' => 'Peminjaman ID', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Tanggal Dikembalikan', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Kondisi Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ['label' => 'Aksi', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-32'],
];
$this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
?>
                <?php if (count($pengembalian) > 0): ?>
                    <?php $no = 1; foreach ($pengembalian as $p): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">#<?php echo $p->peminjaman_id; ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($p->tanggal_dikembalikan)); ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php 
                                $kondisi_class = 'bg-gray-200 text-gray-800';
                                if (strpos($p->kondisi_alat, 'Baik') !== false) {
                                    $kondisi_class = 'bg-green-200 text-green-800';
                                } elseif (strpos($p->kondisi_alat, 'Rusak') !== false) {
                                    $kondisi_class = 'bg-red-200 text-red-800';
                                } else {
                                    $kondisi_class = 'bg-yellow-200 text-yellow-800';
                                }
                            ?>
                            <span class="<?php echo $kondisi_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                <?php echo htmlspecialchars($p->kondisi_alat); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm space-x-2 flex">
                            <a href="<?php echo site_url('pengembalian/view/' . $p->peminjaman_id); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-semibold transition bg-cyan-500 hover:bg-cyan-600 text-white" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                                <span>Lihat</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 block"></i>
                        <p class="font-semibold">Tidak ada data pengembalian</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>


<?php $this->load->view('partials/footer'); ?>