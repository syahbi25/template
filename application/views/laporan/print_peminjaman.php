<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Peminjaman Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { margin: 20px; }
            .no-print { display: none; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
        }
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body class="bg-white">
    <div class="max-w-6xl mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-2">Laporan Peminjaman Alat</h1>
        <p class="text-center text-gray-600 mb-6">Dicetak pada: <?php echo date('d-m-Y H:i:s'); ?></p>
        
        <button class="no-print bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition mb-6" onclick="window.print()">
            <i class="fas fa-print mr-2"></i>Print
        </button>
        <hr class="my-4">

        <?php if (!empty($peminjaman)): ?>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-400">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">#</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">ID</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Alat</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Peminjam</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Tgl Pinjam</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Tgl Kembali Rencana</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Keperluan</th>
                        <th class="border border-gray-400 px-3 py-2 text-left font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($peminjaman as $p): ?>
                    <tr>
                        <td class="border border-gray-400 px-3 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-400 px-3 py-2 font-mono text-xs"><?php echo $p->id; ?></td>
                        <td class="border border-gray-400 px-3 py-2"><?php echo htmlspecialchars($p->nama_alat); ?></td>
                        <td class="border border-gray-400 px-3 py-2"><?php echo htmlspecialchars($p->peminjam); ?></td>
                        <td class="border border-gray-400 px-3 py-2"><?php echo $p->tanggal_pinjam; ?></td>
                        <td class="border border-gray-400 px-3 py-2"><?php echo $p->tanggal_kembali_rencana; ?></td>
                        <td class="border border-gray-400 px-3 py-2"><?php echo htmlspecialchars($p->keperluan); ?></td>
                        <td class="border border-gray-400 px-3 py-2"><strong><?php echo ucfirst($p->status); ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="bg-cyan-100 border border-cyan-400 text-cyan-700 px-4 py-3 rounded-lg mt-4">
            Tidak ada data peminjaman.
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
