<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                <div>
                    <h5 class="font-bold text-lg mb-2"><i class="fas fa-tools"></i> Sistem Peminjaman Alat</h5>
                    <p class="text-gray-400 text-sm">Kelola peminjaman alat Anda dengan mudah dan efisien melalui platform kami.</p>
                </div>
                <div>
                    <h5 class="font-bold text-lg mb-2">Informasi Cepat</h5>
                    <ul class="text-gray-400 text-sm space-y-1">
                        <li><a href="<?php echo site_url('dashboard'); ?>" class="hover:text-white transition"><i class="fas fa-arrow-right"></i> Dashboard</a></li>
                        <li><a href="<?php echo site_url('alat'); ?>" class="hover:text-white transition"><i class="fas fa-arrow-right"></i> Daftar Alat</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-lg mb-2">Kontak</h5>
                    <p class="text-gray-400 text-sm"><i class="fas fa-envelope"></i> support@peminjaman.local</p>
                    <p class="text-gray-400 text-sm"><i class="fas fa-phone"></i> +62 XXX-XXXX-XXXX</p>
                </div>
            </div>
            <hr class="border-gray-700">
            <div class="text-center text-gray-400 text-sm">
                <p>&copy; <?php echo date('Y'); ?> Sistem Peminjaman Alat. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-box');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
</html>
