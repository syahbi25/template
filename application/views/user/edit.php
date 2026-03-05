<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('partials/header', array('title' => 'Edit User')); ?>

<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6"><i class="fas fa-edit text-blue-600 mr-2"></i> Edit Data User</h2>

    <?php if (validation_errors()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-start">
            <i class="fas fa-exclamation-circle mt-1 mr-3 flex-shrink-0"></i>
            <div><?php echo validation_errors(); ?></div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-4 pb-4 border-b border-gray-200">
            <p class="text-sm text-gray-600"><i class="fas fa-users text-blue-600 mr-2"></i>Form Edit User: <strong><?php echo htmlspecialchars($user->username); ?></strong></p>
        </div>

        <form method="post" action="<?php echo site_url('user/update/' . $user->id); ?>" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed" value="<?php echo htmlspecialchars($user->username); ?>" disabled>
                <small class="text-gray-500 mt-1 block">Username tidak dapat diubah</small>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo set_value('email', $user->email); ?>" required placeholder="Masukkan email">
            </div>

            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?php echo set_value('nama_lengkap', $user->nama_lengkap); ?>" required placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                    <select id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="petugas" <?php echo ($user->role == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
                        <option value="peminjam" <?php echo ($user->role == 'peminjam') ? 'selected' : ''; ?>>Peminjam</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="aktif" <?php echo ($user->status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                        <option value="nonaktif" <?php echo ($user->status == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i> Update User
                </button>
                <a href="<?php echo site_url('user'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
