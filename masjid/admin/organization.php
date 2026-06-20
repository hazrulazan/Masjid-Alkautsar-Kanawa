<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/Organization.php';

Auth::requireLogin();

$organizationModel = new Organization($pdo);

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $organizationModel->delete($id);
    header("Location: organization.php?success=deleted");
    exit;
}

// Handle Add / Edit
$isEdit = false;
$editItem = null;
if (isset($_GET['edit'])) {
    $isEdit = true;
    $editItem = $organizationModel->getById($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'position' => $_POST['position'],
        'image' => $_POST['image'],
        'linkedin' => $_POST['linkedin'],
        'email' => $_POST['email']
    ];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $organizationModel->update($_POST['id'], $data);
        header("Location: organization.php?success=updated");
    } else {
        $organizationModel->create($data);
        header("Location: organization.php?success=added");
    }
    exit;
}

$organizations = $organizationModel->getAll();

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pengurus Organisasi</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola daftar takmir dan pengurus masjid.</p>
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
        <h2 class="text-lg font-bold text-gray-900 mb-4"><?php echo $isEdit ? 'Edit Pengurus' : 'Tambah Pengurus Baru'; ?></h2>
        
        <form action="organization.php" method="POST" class="space-y-4">
            <?php if($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editItem['id']); ?>">
            <?php endif; ?>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="<?php echo $isEdit ? htmlspecialchars($editItem['name']) : ''; ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi / Jabatan</label>
                <input type="text" name="position" value="<?php echo $isEdit ? htmlspecialchars($editItem['position']) : ''; ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Foto (Opsional)</label>
                <input type="text" name="image" value="<?php echo $isEdit ? htmlspecialchars($editItem['image'] ?? '') : ''; ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn (Opsional)</label>
                <input type="text" name="linkedin" value="<?php echo $isEdit ? htmlspecialchars($editItem['linkedin'] ?? '') : ''; ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email (Opsional)</label>
                <input type="email" name="email" value="<?php echo $isEdit ? htmlspecialchars($editItem['email'] ?? '') : ''; ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div class="pt-2 flex gap-2">
                <button type="submit" class="flex-1 bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2 px-4 rounded-xl transition-colors">
                    <?php echo $isEdit ? 'Update' : 'Simpan'; ?>
                </button>
                <?php if($isEdit): ?>
                    <a href="organization.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-xl transition-colors text-center">Batal</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Daftar Pengurus -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-900">Daftar Pengurus Organisasi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b">
                        <th class="px-6 py-4 font-medium">Nama</th>
                        <th class="px-6 py-4 font-medium">Posisi</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach($organizations as $row): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="<?php echo !empty($row['image']) ? htmlspecialchars($row['image']) : 'https://ui-avatars.com/api/?name='.urlencode($row['name']).'&background=047857&color=fff'; ?>" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm object-cover">
                                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($row['name']); ?></p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-md text-xs font-medium"><?php echo htmlspecialchars($row['position']); ?></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="organization.php?edit=<?php echo $row['id']; ?>" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <a href="organization.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if(count($organizations) === 0): ?>
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data pengurus organisasi.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
