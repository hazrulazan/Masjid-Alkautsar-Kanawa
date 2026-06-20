<?php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';

$auth = new Auth($pdo);

// Redirect if already logged in
if (Auth::check()) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($email_or_username, $password)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Email/Username atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Masjid Al-Ikhlas</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mosque: {
                            dark: '#064E3B',
                            primary: '#047857',
                            light: '#10B981',
                            gold: '#F59E0B',
                            yellow: '#FBBF24',
                            purple: '#7C3AED',
                            lightPurple: '#A855F7',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-900 bg-gray-50 antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-mosque-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-mosque-gold/10 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md px-4">
        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-mosque-primary/10 text-mosque-primary rounded-2xl mb-4">
                        <i class="fa-solid fa-mosque text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Login Pengurus</h2>
                    <p class="text-sm text-gray-500 mt-2">Masuk untuk mengelola konten website masjid.</p>
                </div>

                <?php if ($error): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email / Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <input type="text" id="email" name="email" required class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="Masukkan email atau username" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" id="password" name="password" required class="block w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="••••••••">
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-mosque-primary focus:ring-mosque-primary border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-mosque-primary hover:text-mosque-dark transition-colors">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-mosque-primary/30 text-sm font-bold text-white bg-mosque-primary hover:bg-mosque-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mosque-primary transition-all">
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Bottom Footer Card -->
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <a href="../index.php" class="text-sm font-medium text-gray-600 hover:text-mosque-primary inline-flex items-center gap-2 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>
