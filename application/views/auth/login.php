<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Sistem Peminjaman Alat</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-800 min-h-screen flex items-center justify-center">
	<div class="w-full max-w-md">
		<div class="bg-white rounded-lg shadow-xl p-8">
			<!-- Header -->
			<div class="text-center mb-8">
				<div class="flex justify-center mb-4">
					<div class="bg-blue-600 text-white rounded-full p-4">
						<i class="fas fa-tools text-3xl"></i>
					</div>
				</div>
				<h1 class="text-3xl font-bold text-gray-800">Peminjaman Alat</h1>
				<p class="text-gray-600 mt-2">Sistem Manajemen Peminjaman Alat</p>
			</div>

			<!-- Messages -->
			<?php if ($this->session->flashdata('message')): ?>
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-start" role="alert">
				<i class="fas fa-check-circle mt-1 mr-3 flex-shrink-0"></i>
				<div><?php echo $this->session->flashdata('message'); ?></div>
			</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')): ?>
			<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-start" role="alert">
				<i class="fas fa-exclamation-circle mt-1 mr-3 flex-shrink-0"></i>
				<div><?php echo $this->session->flashdata('error'); ?></div>
			</div>
			<?php endif; ?>

			<!-- Form -->
			<form method="post" action="<?php echo site_url('auth/login'); ?>" novalidate class="space-y-4">
				<div>
					<label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
						<i class="fas fa-user mr-2 text-blue-600"></i>Username
					</label>
					<input type="text" 
						class="w-full px-4 py-2 border <?php echo (form_error('username')) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
						id="username" name="username" value="<?php echo set_value('username'); ?>" required autofocus placeholder="Masukkan username">
					<?php if (form_error('username')): ?>
					<div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-triangle mr-1"></i><?php echo form_error('username'); ?></div>
					<?php endif; ?>
				</div>

				<div>
					<label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
						<i class="fas fa-lock mr-2 text-blue-600"></i>Password
					</label>
					<input type="password" 
						class="w-full px-4 py-2 border <?php echo (form_error('password')) ? 'border-red-500 bg-red-50' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
						id="password" name="password" required placeholder="Masukkan password">
					<?php if (form_error('password')): ?>
					<div class="text-red-600 text-sm mt-1"><i class="fas fa-exclamation-triangle mr-1"></i><?php echo form_error('password'); ?></div>
					<?php endif; ?>
				</div>

				<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition mt-6">
					<i class="fas fa-sign-in-alt mr-2"></i> Login Sekarang
				</button>
			</form>

			<!-- Info Box -->
			<div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
				<h6 class="font-semibold text-gray-800 mb-3">
					<i class="fas fa-info-circle text-blue-600 mr-2"></i> Data Login untuk Testing:
				</h6>
				<div class="text-sm text-gray-700 space-y-2">
					<p><span class="font-semibold">Admin:</span> <code class="bg-gray-200 px-2 py-1 rounded text-xs">admin</code> / <code class="bg-gray-200 px-2 py-1 rounded text-xs">password123</code></p>
					<p><span class="font-semibold">Petugas:</span> <code class="bg-gray-200 px-2 py-1 rounded text-xs">petugas1</code> / <code class="bg-gray-200 px-2 py-1 rounded text-xs">password123</code></p>
					<p><span class="font-semibold">Peminjam:</span> <code class="bg-gray-200 px-2 py-1 rounded text-xs">peminjam1</code> / <code class="bg-gray-200 px-2 py-1 rounded text-xs">password123</code></p>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
