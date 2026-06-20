<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';
require_once '../models/User.php';

Auth::requireLogin();

$userModel = new User($pdo);

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = $_GET['id'];
$adminUser = $userModel->getById($id);

if (!$adminUser) {
    header("Location: users.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $id,
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => !empty($_POST['password']) ? $_POST['password'] : null
    ];

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/users/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = 'uploads/users/' . $fileName;
                
                // Update session if editing own profile
                if ($_SESSION['user_id'] == $id) {
                    $_SESSION['user_image'] = $data['image'];
                }
            }
        }
    }

    if ($userModel->update($data)) {
        // Update session if editing own profile
        if ($_SESSION['user_id'] == $id) {
            $_SESSION['user_name'] = $data['name'];
        }
        header("Location: users_edit.php?id=$id&success=1");
        exit;
    }
}

require_once '../includes/admin_header.php';
?>

<div class="mb-6 flex items-center gap-4">
    <a href="users.php" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-mosque-primary shadow-sm transition-colors">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Pengguna</h1>
        <p class="text-gray-500 text-sm mt-1">Ubah data akses dan informasi akun admin.</p>
    </div>
</div>

<?php if(isset($_GET['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">Data pengguna berhasil diupdate!</span>
    </div>
<?php endif; ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <form action="users_edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Foto Profil -->
            <div class="md:col-span-1 space-y-4">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">Foto Profil</h3>
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-50 shadow-md mb-4 bg-gray-100">
                        <?php if(!empty($adminUser->image)): ?>
                            <img src="<?php echo htmlspecialchars(resolve_image_url($adminUser->image, true)); ?>" alt="Profile" class="w-full h-full object-cover" id="preview-image">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminUser->name); ?>&background=047857&color=fff" alt="Profile" class="w-full h-full object-cover" id="preview-image">
                        <?php endif; ?>
                    </div>
                    
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Foto Baru (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-mosque-primary/10 file:text-mosque-primary hover:file:bg-mosque-primary/20">
                    </div>
                </div>
            </div>

            <!-- Detail Akun -->
            <div class="md:col-span-2 space-y-4">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">Detail Akun</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($adminUser->name); ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($adminUser->email); ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($adminUser->username); ?>" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mosque-primary/20 focus:border-mosque-primary outline-none transition-all">
                </div>

                <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100 mt-6">
                    <label class="block text-sm font-bold text-yellow-800 mb-1">Ganti Password</label>
                    <p class="text-xs text-yellow-600 mb-3">Kosongkan jika Anda tidak ingin mengubah password akun ini.</p>
                    <input type="password" name="password" placeholder="Password Baru" class="w-full px-4 py-2 border border-yellow-200 rounded-xl focus:ring-2 focus:ring-yellow-400/20 focus:border-yellow-400 outline-none transition-all">
                </div>
            </div>
        </div>
        
        <div class="pt-4 border-t flex justify-end">
            <button type="submit" class="bg-mosque-primary hover:bg-mosque-dark text-white font-medium py-2.5 px-6 rounded-xl transition-colors flex items-center gap-2 shadow-lg shadow-mosque-primary/30">
                <i class="fa-solid fa-save"></i> Simpan Pengguna
            </button>
        </div>
    </form>
</div>

<?php require_once '../includes/admin_footer.php'; ?>
