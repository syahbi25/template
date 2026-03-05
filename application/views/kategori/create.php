<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Tambah Kategori')); ?>

<div class="max-w-lg mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-plus-circle text-blue-600 mr-2"></i> Tambah Kategori Alat</h2>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="post" action="<?php echo site_url('kategori/store'); ?>" class="space-y-4">
            <div>
                <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" id="nama_kategori" name="nama_kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Contoh: Alat Elektronik">
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Jelaskan kategori ini"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i> Simpan Kategori
                </button>
                <a href="<?php echo site_url('kategori'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>