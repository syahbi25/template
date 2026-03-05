<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Detail Peminjaman Alat')); ?>

<div class="max-w-3xl mx-auto">
	<h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-file-alt text-blue-600 mr-2"></i> Detail Peminjaman Alat</h2>

	<div class="bg-white rounded-lg shadow-md overflow-hidden">
		<div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-6">
			<h3 class="text-2xl font-bold">Peminjaman ID: <span class="text-blue-100">#<?php echo htmlspecialchars($peminjaman->id); ?></span></h3>
		</div>
		
		<div class="p-8 space-y-6">
			<div class="border-b border-gray-200 pb-4">
				<p class="text-sm text-gray-600 mb-1">Nama Alat</p>
				<p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($peminjaman->nama_alat); ?></p>
			</div>

			<div class="border-b border-gray-200 pb-4">
				<p class="text-sm text-gray-600 mb-1">Nama Peminjam</p>
				<p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($peminjaman->peminjam); ?></p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 pb-4">
				<div>
					<p class="text-sm text-gray-600 mb-1">Tanggal Pinjam</p>
					<p class="text-lg font-semibold text-gray-800"><?php echo date('d/m/Y', strtotime($peminjaman->tanggal_pinjam)); ?></p>
				</div>
				<div>
					<p class="text-sm text-gray-600 mb-1">Tanggal Kembali Rencana</p>
					<p class="text-lg font-semibold text-gray-800"><?php echo date('d/m/Y', strtotime($peminjaman->tanggal_kembali_rencana)); ?></p>
				</div>
			</div>

			<div class="border-b border-gray-200 pb-4">
				<p class="text-sm text-gray-600 mb-2">Keperluan/Tujuan</p>
				<p class="text-gray-800 bg-gray-50 p-4 rounded-lg"><?php echo htmlspecialchars($peminjaman->keterangan); ?></p>
			</div>

			<?php if (isset($peminjaman->created_at) && !empty($peminjaman->created_at)): ?>
			<div class="border-b border-gray-200 pb-4">
				<p class="text-sm text-gray-600 mb-1">Dibuat Tanggal</p>
				<p class="text-sm text-gray-700"><?php echo date('d/m/Y H:i', strtotime($peminjaman->created_at)); ?></p>
			</div>
			<?php endif; ?>
		</div>

		<div class="border-t border-gray-200 bg-gray-50 px-8 py-6 flex gap-3">
			<a href="<?php echo site_url('peminjaman/edit/' . $peminjaman->id); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
				<i class="fas fa-edit mr-2"></i> Edit
			</a>
			<a href="<?php echo site_url('peminjaman/delete/' . $peminjaman->id); ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition" onclick="return confirm('Yakin ingin menghapus data peminjaman ini?');">
				<i class="fas fa-trash mr-2"></i> Hapus
			</a>
			<a href="<?php echo site_url('peminjaman'); ?>" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
				<i class="fas fa-arrow-left mr-2"></i> Kembali
			</a>
		</div>
	</div>
</div>

<?php $this->load->view('partials/footer'); ?>
