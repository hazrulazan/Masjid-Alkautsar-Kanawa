<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/Management.php';

Auth::requireLogin();

$managementModel = new Management($pdo);

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $managementModel->delete($id);
    header("Location: management.php?success=deleted");
    exit;
}

// Handle Add / Edit
$isEdit = false;
$editItem = null;
if (isset($_GET['edit'])) {
    $isEdit = true;
    $editItem = $managementModel->getById($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'icon' => $_POST['icon']
    ];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $managementModel->update($_POST['id'], $data);
        header("Location: management.php?success=updated");
    } else {
        $managementModel->create($data);
        header("Location: management.php?success=added");
    }
    exit;
}

$managements = $managementModel->getAll();

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Layanan & Program</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola daftar layanan dan program kegiatan masjid.</p>
    </div>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">Data berhasil disimpan/dihapus!</span>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah/Edit -->
    <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
        <h2 class="text-lg font-bold text-gray-900 mb-4"><?php echo $isEdit ? 'Edit Program' : 'Tambah Program Baru'; ?></h2>
        
        <form action="management.php" method="POST" class="space-y-4">
            <?php if($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editItem['id']); ?>">
            <?php endif; ?>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Layanan / Program</label>
                <input type="text" name="title" value="<?php echo $isEdit ? htmlspecialchars($editItem['title']) : ''; ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ikon (FontAwesome)</label>
                <input type="text" name="icon" value="<?php echo $isEdit ? htmlspecialchars($editItem['icon']) : ''; ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all" placeholder="Contoh: fa-book-quran">
                <p class="text-xs text-gray-500 mt-1">Cari ikon di fontawesome.com</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" required rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo $isEdit ? htmlspecialchars($editItem['description']) : ''; ?></textarea>
            </div>
            
            <div class="pt-2 flex gap-2">
                <button type="submit" class="flex-1 bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2 px-4 rounded-xl transition-colors">
                    <?php echo $isEdit ? 'Update' : 'Simpan'; ?>
                </button>
                <?php if($isEdit): ?>
                    <a href="management.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-xl transition-colors text-center">Batal</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Daftar Program -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-900">Daftar Layanan & Program</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b">
                        <th class="px-6 py-4 font-medium w-16">Ikon</th>
                        <th class="px-6 py-4 font-medium">Layanan / Program</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach($managements as $row): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-center">
                                <div class="w-10 h-10 rounded-lg bg-mosque-primary/10 text-mosque-primary flex items-center justify-center">
                                    <i class="fa-solid <?php echo htmlspecialchars($row['icon']); ?>"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900"><?php echo htmlspecialchars($row['title']); ?></p>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2"><?php echo htmlspecialchars($row['description']); ?></p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="management.php?edit=<?php echo $row['id']; ?>" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <a href="management.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if(count($managements) === 0): ?>
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data layanan/program.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
