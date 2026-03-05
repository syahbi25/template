<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Detail Pengembalian')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-file-alt text-blue-600 mr-2"></i> Detail Pengembalian</h2>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-gray-50 border-b border-gray-200 px-8 py-6">
        <h3 class="text-xl font-bold text-gray-800">Peminjaman ID: <span class="text-blue-600">#<?php echo htmlspecialchars($pengembalian->peminjaman_id); ?></span></h3>
    </div>
    
    <div class="p-8 space-y-6">
        <div class="border-b border-gray-200 pb-4">
            <p class="text-sm text-gray-600 mb-1">Tanggal Dikembalikan</p>
            <p class="text-lg font-semibold text-gray-800"><?php echo date('d/m/Y', strtotime($pengembalian->tanggal_dikembalikan)); ?></p>
        </div>
        
        <div class="border-b border-gray-200 pb-4">
            <p class="text-sm text-gray-600 mb-2">Kondisi Alat</p>
            <?php 
                $kondisi = strtolower($pengembalian->kondisi_alat);
                if (strpos($kondisi, 'baik') !== false) {
                    $badge_class = 'bg-green-200 text-green-800';
                } elseif (strpos($kondisi, 'rusak_ringan') !== false || strpos($kondisi, 'ringan') !== false) {
                    $badge_class = 'bg-yellow-200 text-yellow-800';
                } else {
                    $badge_class = 'bg-red-200 text-red-800';
                }
            ?>
            <span class="<?php echo $badge_class; ?> px-4 py-2 rounded-full text-sm font-semibold inline-block">
                <?php echo htmlspecialchars($pengembalian->kondisi_alat); ?>
            </span>
        </div>
        
        <div>
            <p class="text-sm text-gray-600 mb-2">Keterangan</p>
            <p class="text-gray-800 bg-gray-50 p-4 rounded-lg"><?php echo htmlspecialchars($pengembalian->keterangan) ?: '<span class="text-gray-400 italic">Tidak ada keterangan</span>'; ?></p>
        </div>
    </div>
    
    <div class="border-t border-gray-200 bg-gray-50 px-8 py-4">
        <a href="<?php echo site_url('pengembalian'); ?>" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>