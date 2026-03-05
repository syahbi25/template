<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? $title : 'Sistem Peminjaman Alat'; ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar-active { @apply bg-blue-600 text-white; }
        .sidebar a:hover { @apply bg-blue-50 text-blue-700; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="<?php echo site_url('dashboard'); ?>" class="flex items-center space-x-2 font-bold text-lg hover:text-blue-200 transition">
                    <i class="fas fa-tools text-xl"></i> 
                    <span>Peminjaman Alat</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm flex items-center space-x-2">
                        <i class="fas fa-user"></i> 
                        <span><?php echo get_user_name(); ?></span>
                    </span>
                    <a href="<?php echo site_url('auth/logout'); ?>" class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded transition text-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg overflow-y-auto">
            <?php $this->load->view('partials/sidebar'); ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-8">
