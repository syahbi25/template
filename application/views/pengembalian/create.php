<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Form Pengembalian')); ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800"><i class="fas fa-undo text-blue-600 mr-2"></i> Form Pengembalian Alat</h2>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
    <form method="post" action="<?php echo site_url('pengembalian/store'); ?>" class="space-y-4">
        <input type="hidden" name="peminjaman_id" value="<?php echo $peminjaman->id; ?>">
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dikembalikan <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_dikembalikan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi Alat <span class="text-red-500">*</span></label>
            <select name="kondisi_alat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="">-- Pilih Kondisi --</option>
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Tambahkan keterangan jika ada"></textarea>
        </div>
        
        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-check mr-2"></i> Simpan
            </button>
            <a href="<?php echo site_url('pengembalian'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?php $this->load->view('partials/footer'); ?>