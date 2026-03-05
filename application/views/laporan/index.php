<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Laporan'));

?>

<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-file-pdf text-blue-600 mr-2"></i> Laporan Peminjaman dan Pengembalian Alat</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4"><i class="fas fa-file-alt text-blue-500 mr-2"></i> Pilih Tipe Laporan</h3>
    <div class="flex flex-wrap gap-3">
        <a href="<?php echo site_url('laporan/peminjaman'); ?>" class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 px-4 rounded-lg transition">
            <i class="fas fa-file-pdf mr-2"></i> Laporan Peminjaman
        </a>
        <a href="<?php echo site_url('laporan/pengembalian'); ?>" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition">
            <i class="fas fa-file-pdf mr-2"></i> Laporan Pengembalian
        </a>
        <a href="<?php echo site_url('laporan/print_peminjaman'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition" target="_blank">
            <i class="fas fa-print mr-2"></i> Cetak Peminjaman
        </a>
        <a href="<?php echo site_url('laporan/print_pengembalian'); ?>" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition" target="_blank">
            <i class="fas fa-print mr-2"></i> Cetak Pengembalian
        </a>
        
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6 mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4">
            <h3 class="text-lg font-semibold"><i class="fas fa-handshake mr-2"></i> Data Peminjaman</h3>
        </div>
        <div class="p-6">
            <?php if (!empty($peminjaman)): ?>
            <div class="overflow-x-auto">
                <table class="w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Alat</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Peminjam</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tgl Rencana Kembali</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Keperluan</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 w-20">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1; foreach ($peminjaman as $p): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800"><?php echo htmlspecialchars($p->nama_alat); ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800"><?php echo htmlspecialchars($p->peminjam); ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($p->tanggal_pinjam)); ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($p->tanggal_kembali_rencana)); ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($p->keperluan); ?></td>
                            <td class="px-4 py-3 text-sm">
                                <?php
                                    $status_class = 'bg-gray-200 text-gray-800';
                                    if ($p->status === 'menunggu') {
                                        $status_class = 'bg-yellow-200 text-yellow-800';
                                    } elseif ($p->status === 'disetujui') {
                                        $status_class = 'bg-green-200 text-green-800';
                                    } elseif ($p->status === 'ditolak') {
                                        $status_class = 'bg-red-200 text-red-800';
                                    }
                                ?>
                                <span class="<?php echo $status_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                    <?php echo ucfirst($p->status); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-inbox text-gray-300 text-4xl mb-2 block"></i>
                <p class="text-gray-600 text-lg font-semibold">Tidak ada data peminjaman</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
            <h3 class="text-lg font-semibold"><i class="fas fa-undo mr-2"></i> Data Pengembalian</h3>
        </div>
        <div class="p-6">
            <?php if (!empty($pengembalian)): ?>
            <div class="overflow-x-auto">
                <table class="w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 w-12">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Peminjaman ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tgl Dikembalikan</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kondisi</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $no = 1; foreach ($pengembalian as $r): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-800">#<?php echo $r->peminjaman_id; ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo date('d/m/Y', strtotime($r->tanggal_dikembalikan)); ?></td>
                            <td class="px-4 py-3 text-sm">
                                <?php
                                    $kondisi_class = 'bg-gray-200 text-gray-800';
                                    if (strpos($r->kondisi_alat, 'Baik') !== false) {
                                        $kondisi_class = 'bg-green-200 text-green-800';
                                    } elseif (strpos($r->kondisi_alat, 'Rusak') !== false) {
                                        $kondisi_class = 'bg-red-200 text-red-800';
                                    } else {
                                        $kondisi_class = 'bg-yellow-200 text-yellow-800';
                                    }
                                ?>
                                <span class="<?php echo $kondisi_class; ?> px-3 py-1 rounded-full text-xs font-semibold">
                                    <?php echo htmlspecialchars($r->kondisi_alat); ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?php echo htmlspecialchars($r->keterangan); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-inbox text-gray-300 text-4xl mb-2 block"></i>
                <p class="text-gray-600 text-lg font-semibold">Tidak ada data pengembalian</p>
            </div>
            <?php endif; ?>
        </div>
    </div> -->
</div>

<?php $this->load->view('partials/footer'); ?>