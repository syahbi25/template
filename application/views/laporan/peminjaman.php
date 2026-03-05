<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Laporan Peminjaman')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-handshake text-blue-600 mr-2"></i> Laporan Peminjaman Alat</h2>
    <div class="space-x-2">
        <a href="<?php echo site_url('laporan'); ?>" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <a href="<?php echo site_url('laporan/print_peminjaman'); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition" target="_blank">
            <i class="fas fa-print mr-1"></i> Cetak PDF
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <?php if (!empty($peminjaman)): ?>
    <?php
    $columns = [
        ['label' => '#', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
        ['label' => 'ID', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-16'],
        ['label' => 'Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Peminjam', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Tgl Pinjam', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Tgl Rencana Kembali', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Keperluan', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Status', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-20'],
    ];
    $this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
    ?>
    <?php $no = 1; foreach ($peminjaman as $p): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm"><code class="bg-gray-100 px-2 py-1 rounded text-xs"><?php echo $p->id; ?></code></td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?php echo htmlspecialchars($p->nama_alat); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?php echo htmlspecialchars($p->peminjam); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($p->tanggal_pinjam)); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($p->tanggal_kembali_rencana)); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($p->keperluan); ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php 
                                $status = $p->status;
                                $badge = 'bg-gray-200 text-gray-800';
                                if ($status == 'menunggu') $badge = 'bg-yellow-200 text-yellow-800';
                                elseif ($status == 'disetujui') $badge = 'bg-green-200 text-green-800';
                                elseif ($status == 'ditolak') $badge = 'bg-red-200 text-red-800';
                            ?>
                            <span class="<?php echo $badge; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                <?php echo ucfirst($status); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>
        <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-3 block"></i>
            <p class="text-gray-600 text-xl font-semibold">Tidak ada data peminjaman</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
