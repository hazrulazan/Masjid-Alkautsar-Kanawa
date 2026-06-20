<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/Article.php';

Auth::requireLogin();

$articleModel = new Article($pdo);

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $articleModel->delete($id);
    header("Location: articles.php?success=deleted");
    exit;
}

// Handle Add / Edit
$isEdit = false;
$editArticle = null;
if (isset($_GET['edit'])) {
    $isEdit = true;
    $editArticle = $articleModel->getById($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category' => $_POST['category'],
        'image' => $_POST['image'],
        'user_id' => $_SESSION['user_id']
    ];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $articleModel->update($_POST['id'], $data);
        header("Location: articles.php?success=updated");
    } else {
        $articleModel->create($data);
        header("Location: articles.php?success=added");
    }
    exit;
}

$articles = $articleModel->getAll();

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Artikel</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola berita dan artikel di website masjid.</p>
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
        <h2 class="text-lg font-bold text-gray-900 mb-4"><?php echo $isEdit ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?></h2>
        
        <form action="articles.php" method="POST" class="space-y-4">
            <?php if($isEdit): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editArticle['id']); ?>">
            <?php endif; ?>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                <input type="text" name="title" value="<?php echo $isEdit ? htmlspecialchars($editArticle['title']) : ''; ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                    <option value="Berita" <?php echo ($isEdit && $editArticle['category'] == 'Berita') ? 'selected' : ''; ?>>Berita</option>
                    <option value="Artikel" <?php echo ($isEdit && $editArticle['category'] == 'Artikel') ? 'selected' : ''; ?>>Artikel</option>
                    <option value="Pengumuman" <?php echo ($isEdit && $editArticle['category'] == 'Pengumuman') ? 'selected' : ''; ?>>Pengumuman</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Gambar</label>
                <input type="text" name="image" value="<?php echo $isEdit ? htmlspecialchars($editArticle['image']) : ''; ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all" placeholder="https://example.com/image.jpg">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                <textarea name="content" required rows="5" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo $isEdit ? htmlspecialchars($editArticle['content']) : ''; ?></textarea>
            </div>
            
            <div class="pt-2 flex gap-2">
                <button type="submit" class="flex-1 bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2 px-4 rounded-xl transition-colors">
                    <?php echo $isEdit ? 'Update' : 'Simpan'; ?>
                </button>
                <?php if($isEdit): ?>
                    <a href="articles.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-xl transition-colors text-center">Batal</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Daftar Artikel -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-900">Daftar Artikel</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium">Judul</th>
                        <th class="px-6 py-4 font-medium">Kategori</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach($articles as $row): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900"><?php echo htmlspecialchars($row['title']); ?></p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-700 rounded-md text-xs font-medium"><?php echo htmlspecialchars($row['category']); ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <?php echo date('d M Y', strtotime($row['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="articles.php?edit=<?php echo $row['id']; ?>" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <a href="articles.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if(count($articles) === 0): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data artikel.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
