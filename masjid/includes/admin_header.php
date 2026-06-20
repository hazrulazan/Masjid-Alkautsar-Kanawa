<?php
// includes/admin_header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Masjid Al-Ikhlas</title>
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
<body class="font-sans text-gray-900 bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-mosque-dark text-white flex flex-col hidden md:flex shrink-0 shadow-2xl z-20">
        <!-- Sidebar Header -->
        <div class="h-20 flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3 text-mosque-gold">
                <i class="fa-solid fa-mosque"></i>
            </div>
            <span class="font-bold text-lg tracking-wide">Panel Admin</span>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 scrollbar-hide">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Utama</p>
            <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-chart-pie w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-mosque-gold' : ''; ?>"></i> Dashboard
            </a>
            
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Kelola Konten</p>
            <a href="profile.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-building w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'text-mosque-gold' : ''; ?>"></i> Profil Masjid
            </a>
            <a href="management.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'management.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-list-check w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'management.php' ? 'text-mosque-gold' : ''; ?>"></i> Manajemen
            </a>
            <a href="articles.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'articles.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-newspaper w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'articles.php' ? 'text-mosque-gold' : ''; ?>"></i> Artikel / Berita
            </a>
            <a href="organization.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'organization.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-sitemap w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'organization.php' ? 'text-mosque-gold' : ''; ?>"></i> Organisasi
            </a>
            
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Pengaturan</p>
            <a href="users.php" class="flex items-center gap-3 px-3 py-2.5 <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'bg-mosque-primary/40 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'; ?> rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-users-gear w-5 text-center <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'text-mosque-gold' : ''; ?>"></i> Pengguna Admin
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/10">
            <a href="logout.php" class="flex items-center justify-center gap-2 w-full py-2.5 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Navbar -->
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-6 shrink-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-500 hover:text-mosque-primary">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="hidden sm:flex items-center gap-2 text-gray-500">
                    <span class="font-medium text-gray-900">Dashboard</span>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                    <span class="text-sm">Ringkasan</span>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <!-- Notifications -->
                <button class="relative text-gray-400 hover:text-mosque-primary transition-colors">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                
                <!-- Profile Dropdown -->
                <div class="flex items-center gap-3 border-l pl-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin Utama'); ?></p>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                    <?php if(!empty($_SESSION['user_image'])): ?>
                        <img src="<?php echo htmlspecialchars(resolve_image_url($_SESSION['user_image'], true)); ?>" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm object-cover">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Admin'); ?>&background=047857&color=fff" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm">
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-auto p-6 md:p-8">
