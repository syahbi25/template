<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Edit Peminjaman Alat')); ?>

<div class="max-w-2xl mx-auto">
	<h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-edit text-blue-600 mr-2"></i> Edit Peminjaman Alat</h2>

	<div class="bg-white rounded-lg shadow-md p-8">
		<form method="post" action="<?php echo site_url('peminjaman/update/' . $peminjaman->id); ?>" class="space-y-4" novalidate>
			<div>
				<label for="nama_alat" class="block text-sm font-semibold text-gray-700 mb-2">Nama Alat</label>
				<input type="text" class="w-full px-4 py-2 bg-gray-100 text-gray-600 border border-gray-300 rounded-lg cursor-not-allowed" id="nama_alat" name="nama_alat" value="<?php echo set_value('nama_alat', $peminjaman->nama_alat); ?>" readonly>
				<p class="text-gray-500 text-xs mt-1">Tidak dapat diubah</p>
			</div>

			<div>
				<label for="peminjam" class="block text-sm font-semibold text-gray-700 mb-2">Nama Peminjam</label>
				<input type="text" class="w-full px-4 py-2 bg-gray-100 text-gray-600 border border-gray-300 rounded-lg cursor-not-allowed" id="peminjam" name="peminjam" value="<?php echo set_value('peminjam', $peminjaman->peminjam); ?>" readonly>
				<p class="text-gray-500 text-xs mt-1">Tidak dapat diubah</p>
			</div>

			<div>
				<label for="tanggal_pinjam" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pinjam</label>
				<input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('tanggal_pinjam')) ? 'border-red-500' : ''; ?>" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo set_value('tanggal_pinjam', $peminjaman->tanggal_pinjam); ?>" required>
				<?php if (form_error('tanggal_pinjam')): ?>
				<div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('tanggal_pinjam'); ?></div>
				<?php endif; ?>
			</div>

			<div>
				<label for="tanggal_kembali_rencana" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kembali Rencana</label>
				<input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('tanggal_kembali_rencana')) ? 'border-red-500' : ''; ?>" id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" value="<?php echo set_value('tanggal_kembali_rencana', $peminjaman->tanggal_kembali_rencana); ?>" required>
				<?php if (form_error('tanggal_kembali_rencana')): ?>
				<div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('tanggal_kembali_rencana'); ?></div>
				<?php endif; ?>
			</div>

			<div>
				<label for="keperluan" class="block text-sm font-semibold text-gray-700 mb-2">Keperluan</label>
				<textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('keperluan')) ? 'border-red-500' : ''; ?>" id="keperluan" name="keperluan" rows="3" required><?php echo set_value('keperluan', $peminjaman->keperluan); ?></textarea>
				<?php if (form_error('keperluan')): ?>
				<div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('keperluan'); ?></div>
				<?php endif; ?>
			</div>

			<div class="flex gap-3 pt-6">
				<button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
					<i class="fas fa-save mr-2"></i> Simpan Perubahan
				</button>
				<a href="<?php echo site_url('peminjaman'); ?>" class="flex-1 text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
					<i class="fas fa-arrow-left mr-2"></i> Kembali
				</a>
			</div>
		</form>
	</div>
</div>

<?php $this->load->view('partials/footer'); ?>
