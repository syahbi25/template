<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Laporan Pengembalian')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-undo text-green-600 mr-2"></i> Laporan Pengembalian Alat</h2>
    <div class="space-x-2">
        <a href="<?php echo site_url('laporan'); ?>" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <a href="<?php echo site_url('laporan/print_pengembalian'); ?>" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition" target="_blank">
            <i class="fas fa-print mr-1"></i> Cetak PDF
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <?php if (!empty($pengembalian)): ?>
    <?php
    $columns = [
        ['label' => '#', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12'],
        ['label' => 'Peminjaman ID', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Tanggal Dikembalikan', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Kondisi Alat', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
        ['label' => 'Keterangan', 'class' => 'px-4 py-3 text-left text-sm font-semibold text-gray-700'],
    ];
    $this->load->view('partials/table', array('columns' => $columns, 'table_part' => 'header'));
    ?>
    <?php $no = 1; foreach ($pengembalian as $r): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                        <td class="px-4 py-3 text-sm"><code class="bg-gray-100 px-2 py-1 rounded text-xs">#<?php echo $r->peminjaman_id; ?></code></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($r->tanggal_dikembalikan)); ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php 
                                $kondisi = $r->kondisi_alat;
                                $badge = 'bg-gray-200 text-gray-800';
                                if (strpos($kondisi, 'Baik') !== false || $kondisi === 'baik') {
                                    $badge = 'bg-green-200 text-green-800';
                                } elseif (strpos($kondisi, 'rusak_ringan') !== false || strpos($kondisi, 'Rusak Ringan') !== false) {
                                    $badge = 'bg-yellow-200 text-yellow-800';
                                } elseif (strpos($kondisi, 'rusak_berat') !== false || strpos($kondisi, 'Rusak Berat') !== false) {
                                    $badge = 'bg-red-200 text-red-800';
                                }
                            ?>
                            <span class="<?php echo $badge; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                <?php echo htmlspecialchars($kondisi); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($r->keterangan); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php $this->load->view('partials/table', array('table_part' => 'footer')); ?>
        <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-3 block"></i>
            <p class="text-gray-600 text-xl font-semibold">Tidak ada data pengembalian</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
