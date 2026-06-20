<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';

Auth::requireLogin();

// Ambil daftar pengguna admin
$stmt = $pdo->query("SELECT id, name, username, email, created_at FROM users ORDER BY id ASC");
$users = $stmt->fetchAll();

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Pengguna Admin</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar akun yang memiliki akses ke panel administrasi.</p>
    </div>
    <button onclick="alert('Fitur tambah admin sedang dalam pengembangan.')" class="bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2 px-4 rounded-xl transition-colors flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Tambah Admin
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500 uppercase tracking-wider">
                    <th class="p-4 font-semibold">No</th>
                    <th class="p-4 font-semibold">Nama Lengkap</th>
                    <th class="p-4 font-semibold">Username</th>
                    <th class="p-4 font-semibold">Email</th>
                    <th class="p-4 font-semibold">Terdaftar</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $no = 1; foreach($users as $user): ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 text-sm text-gray-500"><?php echo $no++; ?></td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user->name); ?>&background=random" alt="" class="w-8 h-8 rounded-full">
                            <span class="font-medium text-gray-900"><?php echo htmlspecialchars($user->name); ?></span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600 font-medium">@<?php echo htmlspecialchars($user->username); ?></td>
                    <td class="p-4 text-gray-500 text-sm"><?php echo htmlspecialchars($user->email); ?></td>
                    <td class="p-4 text-gray-500 text-sm"><?php echo date('d M Y', strtotime($user->created_at)); ?></td>
                    <td class="p-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="users_edit.php?id=<?php echo $user->id; ?>" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(count($users) == 0): ?>
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">Belum ada data admin.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
