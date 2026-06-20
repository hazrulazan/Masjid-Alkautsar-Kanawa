<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/Profile.php';

Auth::requireLogin();

$profileModel = new Profile($pdo);
$profileData = $profileModel->getProfile();

require_once '../includes/admin_header.php';
?>
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Assalamu'alaikum, Admin!</h1>
                    <p class="text-gray-500 text-sm">Berikut adalah ringkasan informasi website <?php echo htmlspecialchars($profileData['name'] ?? 'Masjid Al-Ikhlas'); ?> hari ini.</p>
                </div>
                <div class="flex gap-3">
                    <a href="index.php" target="_blank" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-mosque-primary transition-colors shadow-sm inline-flex items-center gap-2">
                        <i class="fa-solid fa-globe"></i> Lihat Website
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-newspaper text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Artikel</p>
                        <h3 class="text-2xl font-bold text-gray-900">42</h3>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-sitemap text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pengurus</p>
                        <h3 class="text-2xl font-bold text-gray-900">12</h3>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-list-check text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Program Masjid</p>
                        <h3 class="text-2xl font-bold text-gray-900">8</h3>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-eye text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pengunjung Hari Ini</p>
                        <h3 class="text-2xl font-bold text-gray-900">156</h3>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column (Wider) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Artikel Table -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900">Artikel Terakhir Ditambahkan</h3>
                            <a href="#" class="text-sm font-medium text-mosque-primary hover:text-mosque-dark">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold">Judul Artikel</th>
                                        <th class="px-6 py-4 font-semibold">Kategori</th>
                                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-medium text-gray-900">Semarak Menyambut Idul Adha 1447 H...</td>
                                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">Kegiatan</span></td>
                                        <td class="px-6 py-4 text-gray-500">14 Jun 2026</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-medium text-gray-900">Ringkasan Kajian Tafsir Ibnu Katsir...</td>
                                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-medium">Kajian</span></td>
                                        <td class="px-6 py-4 text-gray-500">10 Jun 2026</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-medium text-gray-900">Penyaluran Bantuan Sembako untuk Dhuafa...</td>
                                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-purple-100 text-purple-700 rounded-lg text-xs font-medium">Sosial</span></td>
                                        <td class="px-6 py-4 text-gray-500">05 Jun 2026</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Narrow) -->
                <div class="space-y-8">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="flex flex-col items-center justify-center gap-2 p-4 bg-gray-50 rounded-xl hover:bg-mosque-primary hover:text-white transition-colors group">
                                <i class="fa-solid fa-plus text-xl text-gray-400 group-hover:text-white mb-1"></i>
                                <span class="text-xs font-medium">Tulis Artikel</span>
                            </button>
                            <button class="flex flex-col items-center justify-center gap-2 p-4 bg-gray-50 rounded-xl hover:bg-mosque-primary hover:text-white transition-colors group">
                                <i class="fa-solid fa-user-plus text-xl text-gray-400 group-hover:text-white mb-1"></i>
                                <span class="text-xs font-medium">Tambah Pengurus</span>
                            </button>
                            <button class="flex flex-col items-center justify-center gap-2 p-4 bg-gray-50 rounded-xl hover:bg-mosque-primary hover:text-white transition-colors group">
                                <i class="fa-solid fa-image text-xl text-gray-400 group-hover:text-white mb-1"></i>
                                <span class="text-xs font-medium">Ubah Banner</span>
                            </button>
                            <button class="flex flex-col items-center justify-center gap-2 p-4 bg-gray-50 rounded-xl hover:bg-mosque-primary hover:text-white transition-colors group">
                                <i class="fa-solid fa-gear text-xl text-gray-400 group-hover:text-white mb-1"></i>
                                <span class="text-xs font-medium">Pengaturan</span>
                            </button>
<?php require_once '../includes/admin_footer.php'; ?>
