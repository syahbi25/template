<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Peminjaman Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-800">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Header Navigation -->
        <div class="fixed top-0 left-0 right-0 bg-blue-900 bg-opacity-90 shadow-lg z-50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-tools text-yellow-400 text-3xl"></i>
                    <h1 class="text-white text-2xl font-bold">Sistem Peminjaman Alat</h1>
                </div>
                <a href="<?php echo site_url('auth/login'); ?>" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold py-2 px-6 rounded-lg transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mt-24 max-w-4xl mx-auto text-center">
            <!-- Hero Section -->
            <div class="mb-12">
                <div class="bg-white bg-opacity-10 backdrop-blur-md rounded-2xl p-12 shadow-2xl">
                    <div class="mb-6">
                        <i class="fas fa-cube text-yellow-300 text-6xl block mb-4"></i>
                    </div>
                    <h2 class="text-white text-5xl font-bold mb-4">Selamat Datang</h2>
                    <p class="text-blue-100 text-xl mb-8">
                        Platform manajemen peminjaman alat yang efisien dan mudah digunakan
                    </p>
                    
                    <!-- Features -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white bg-opacity-10 rounded-lg p-6 hover:bg-opacity-20 transition">
                            <i class="fas fa-list-check text-cyan-300 text-3xl mb-3 block"></i>
                            <h3 class="text-white font-semibold mb-2">Kelola Alat</h3>
                            <p class="text-blue-100 text-sm">Atur dan pantau semua peralatan dengan mudah</p>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-6 hover:bg-opacity-20 transition">
                            <i class="fas fa-handshake text-green-300 text-3xl mb-3 block"></i>
                            <h3 class="text-white font-semibold mb-2">Peminjaman</h3>
                            <p class="text-blue-100 text-sm">Proses peminjaman yang transparan dan terukur</p>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-6 hover:bg-opacity-20 transition">
                            <i class="fas fa-chart-bar text-pink-300 text-3xl mb-3 block"></i>
                            <h3 class="text-white font-semibold mb-2">Laporan</h3>
                            <p class="text-blue-100 text-sm">Analisis data dan laporan akurat secara real-time</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="<?php echo site_url('auth/login'); ?>" class="inline-block bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-blue-900 font-bold py-4 px-12 rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-white bg-opacity-95 rounded-lg p-8 shadow-xl text-left">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-3"></i> Informasi Akun Demo
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-600">
                        <h4 class="font-bold text-blue-900 mb-2 flex items-center">
                            <i class="fas fa-crown text-yellow-500 mr-2"></i> Admin
                        </h4>
                        <p class="text-gray-700 mb-1"><strong>Username:</strong> admin</p>
                        <p class="text-gray-700"><strong>Password:</strong> password123</p>
                        <p class="text-gray-600 text-sm mt-2"><i class="fas fa-check text-green-600 mr-1"></i> Akses penuh ke semua fitur</p>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-600">
                        <h4 class="font-bold text-green-900 mb-2 flex items-center">
                            <i class="fas fa-user-tie text-blue-500 mr-2"></i> Petugas
                        </h4>
                        <p class="text-gray-700 mb-1"><strong>Username:</strong> petugas1</p>
                        <p class="text-gray-700"><strong>Password:</strong> password123</p>
                        <p class="text-gray-600 text-sm mt-2"><i class="fas fa-check text-green-600 mr-1"></i> Kelola peminjaman & pengembalian</p>
                    </div>

                    <div class="bg-purple-50 rounded-lg p-4 border-l-4 border-purple-600">
                        <h4 class="font-bold text-purple-900 mb-2 flex items-center">
                            <i class="fas fa-user text-green-500 mr-2"></i> Peminjam
                        </h4>
                        <p class="text-gray-700 mb-1"><strong>Username:</strong> peminjam1</p>
                        <p class="text-gray-700"><strong>Password:</strong> password123</p>
                        <p class="text-gray-600 text-sm mt-2"><i class="fas fa-check text-green-600 mr-1"></i> Ajukan & lihat peminjaman</p>
                    </div>
                </div>

                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800 flex items-start">
                        <i class="fas fa-lightbulb text-yellow-600 mr-3 mt-1 flex-shrink-0"></i>
                        <span><strong>Tips:</strong> Gunakan akun demo di atas untuk mencoba semua fitur sistem. Setiap akun memiliki hak akses yang berbeda sesuai dengan peran mereka.</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-16 text-center text-blue-100 pb-8">
            <p class="mb-2">© 2026 Sistem Manajemen Peminjaman Alat</p>
            <p class="text-sm text-blue-200">Dibangun dengan teknologi modern dan responsive design</p>
        </footer>
    </div>
</body>
</html>
