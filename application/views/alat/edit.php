<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Edit Alat')); ?>

<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-edit text-blue-600 mr-2"></i> Edit Data Alat</h2>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-4 pb-4 border-b border-gray-200">
            <p class="text-sm text-gray-600"><i class="fas fa-wrench text-blue-600 mr-2"></i>Form Edit Alat: <strong><?php echo htmlspecialchars($alat->nama_alat); ?></strong></p>
        </div>

        <form method="post" action="<?php echo site_url('alat/update/' . $alat->id); ?>" class="space-y-4">
            <div>
                <label for="nama_alat" class="block text-sm font-semibold text-gray-700 mb-2">Nama Alat <span class="text-red-500">*</span></label>
                <input type="text" id="nama_alat" name="nama_alat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo htmlspecialchars($alat->nama_alat); ?>" required placeholder="Masukkan nama alat">
            </div>

            <div>
                <label for="kategori_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                <select id="kategori_id" name="kategori_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <?php foreach ($kategori as $k): ?>
                    <option value="<?php echo $k->id; ?>" <?php echo $k->id == $alat->kategori_id ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($k->nama_kategori); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="kode_alat" class="block text-sm font-semibold text-gray-700 mb-2">Kode Alat</label>
                <input type="text" id="kode_alat" name="kode_alat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo htmlspecialchars($alat->kode_alat); ?>" placeholder="Contoh: ALT-001">
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo htmlspecialchars($alat->lokasi); ?>" placeholder="Tempat penyimpanan alat">
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="Tersedia" <?php echo strtolower($alat->status) === 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                    <option value="Dipinjam" <?php echo strtolower($alat->status) === 'dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
                    <option value="Diperbaiki" <?php echo strtolower($alat->status) === 'diperbaiki' ? 'selected' : ''; ?>>Diperbaiki</option>
                </select>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" placeholder="Jelaskan lebih detail tentang alat ini"><?php echo htmlspecialchars($alat->deskripsi); ?></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i> Update Alat
                </button>
                <a href="<?php echo site_url('alat'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>