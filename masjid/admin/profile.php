<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/Profile.php';

Auth::requireLogin();

$profileModel = new Profile($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'history' => $_POST['history'],
        'vision' => $_POST['vision'],
        'mission' => $_POST['mission'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email']
    ];
    // Handle file uploads
    $uploadDir = '../uploads/profiles/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp', 'svg');
    
    // Logo upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_logo_' . basename($_FILES['logo']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
                $data['logo'] = 'uploads/profiles/' . $fileName;
            }
        }
    }
    
    // Main image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_img_' . basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = 'uploads/profiles/' . $fileName;
            }
        }
    }

    // Hero image upload
    if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_hero_' . basename($_FILES['hero_image']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $targetFilePath)) {
                $data['hero_image'] = 'uploads/profiles/' . $fileName;
            }
        }
    }

    $profileModel->update($data);
    header("Location: profile.php?success=updated");
    exit;
}

$profile = $profileModel->getProfile();

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Profil Masjid</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola informasi sejarah, visi, misi, dan kontak.</p>
    </div>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">Profil berhasil diupdate!</span>
    </div>
<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="profile.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">Informasi Utama</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Masjid</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo htmlspecialchars($profile['address'] ?? ''); ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($profile['email_1'] ?? ''); ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">Visual & Media</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo Masjid (Opsional)</label>
                        <?php if(!empty($profile['logo'])): ?>
                            <div class="mb-2"><img src="<?php echo htmlspecialchars(resolve_image_url($profile['logo'], true)); ?>" alt="Logo" class="h-16 object-contain"></div>
                        <?php endif; ?>
                        <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-mosque-primary/10 file:text-mosque-primary hover:file:bg-mosque-primary/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Profil (Beranda)</label>
                        <?php if(!empty($profile['image'])): ?>
                            <div class="mb-2"><img src="<?php echo htmlspecialchars(resolve_image_url($profile['image'], true)); ?>" alt="Image" class="h-16 object-cover rounded-lg"></div>
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-mosque-primary/10 file:text-mosque-primary hover:file:bg-mosque-primary/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Latar Hero</label>
                        <?php if(!empty($profile['hero_image'])): ?>
                            <div class="mb-2"><img src="<?php echo htmlspecialchars(resolve_image_url($profile['hero_image'], true)); ?>" alt="Hero" class="h-16 object-cover rounded-lg"></div>
                        <?php endif; ?>
                        <input type="file" name="hero_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-mosque-primary/10 file:text-mosque-primary hover:file:bg-mosque-primary/20">
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mt-6">Sejarah & Visi Misi</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sejarah Singkat</label>
                    <textarea name="history" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo htmlspecialchars($profile['history'] ?? ''); ?></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                    <textarea name="vision" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo htmlspecialchars($profile['vision'] ?? ''); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                    <textarea name="mission" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all"><?php echo htmlspecialchars($profile['mission'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="pt-4 border-t flex justify-end">
            <button type="submit" class="bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2.5 px-6 rounded-xl transition-colors flex items-center gap-2">
                <i class="fa-solid fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
