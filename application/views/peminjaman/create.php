<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('partials/header', array('title' => 'Ajukan Peminjaman')); ?>

<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-plus-circle text-blue-600 mr-2"></i> Ajukan Peminjaman Alat</h2>

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-6 pb-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700"><i class="fas fa-handshake text-blue-500 mr-2"></i> Form Permintaan Peminjaman</h3>
        </div>

        <form method="post" action="<?php echo site_url('peminjaman/store'); ?>" class="space-y-4" novalidate>
            <div>
                <label for="alat_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Alat <span class="text-red-500">*</span></label>
                <select name="alat_id" id="alat_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('alat_id')) ? 'border-red-500' : ''; ?>" required>
                    <option value="">-- Pilih Alat --</option>
                    <?php if (!empty($alat)): foreach ($alat as $a): ?>
                    <option value="<?php echo $a->id; ?>">
                        <?php echo htmlspecialchars($a->nama_alat); ?> 
                        <?php 
                            $status_class = strtolower($a->status) === 'tersedia' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800';
                        ?>
                        (<span class="<?php echo $status_class; ?> px-2 py-1 rounded-full text-xs font-semibold"><?php echo $a->status; ?></span>)
                    </option>
                    <?php endforeach; endif; ?>
                </select>
                <?php if (form_error('alat_id')): ?>
                <div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('alat_id'); ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="tanggal_pinjam" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pinjam <span class="text-red-500">*</span></label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('tanggal_pinjam')) ? 'border-red-500' : ''; ?>" 
                    id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo set_value('tanggal_pinjam', date('Y-m-d')); ?>" required>
                <?php if (form_error('tanggal_pinjam')): ?>
                <div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('tanggal_pinjam'); ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="tanggal_kembali_rencana" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kembali Rencana <span class="text-red-500">*</span></label>
                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('tanggal_kembali_rencana')) ? 'border-red-500' : ''; ?>" 
                    id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" value="<?php echo set_value('tanggal_kembali_rencana'); ?>" required>
                <?php if (form_error('tanggal_kembali_rencana')): ?>
                <div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('tanggal_kembali_rencana'); ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="keperluan" class="block text-sm font-semibold text-gray-700 mb-2">Keperluan/Tujuan Peminjaman</label>
                <textarea name="keperluan" id="keperluan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php echo (form_error('keperluan')) ? 'border-red-500' : ''; ?>" 
                    rows="4" placeholder="Jelaskan tujuan dan keperluan peminjaman alat ini"><?php echo set_value('keperluan'); ?></textarea>
                <?php if (form_error('keperluan')): ?>
                <div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i> <?php echo form_error('keperluan'); ?></div>
                <?php endif; ?>
            </div>

            <div class="flex gap-3 pt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    <i class="fas fa-check mr-2"></i> Ajukan Peminjaman
                </button>
                <a href="<?php echo site_url('peminjaman'); ?>" class="flex-1 text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
        <p class="text-blue-800"><i class="fas fa-info-circle text-blue-600 mr-2"></i> <strong>Catatan:</strong> Mohon isi semua data dengan benar. Permintaan peminjaman Anda akan ditinjau oleh petugas sistem.</p>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
