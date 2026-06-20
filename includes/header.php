<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Profil Masjid</title>
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
    <style>
        .hero-pattern {
            background-image: url('<?php echo !empty($profileData['hero_image']) ? htmlspecialchars(resolve_image_url($profileData['hero_image'])) : 'https://images.unsplash.com/photo-1564683214965-3619addd900d?q=80&w=1920&auto=format&fit=crop'; ?>');
            background-size: cover;
            background-position: center;
        }
        .hero-overlay {
            background: linear-gradient(to right, rgba(4, 120, 87, 0.9), rgba(6, 78, 59, 0.7));
        }
    </style>
</head>
<body class="font-sans text-gray-900 bg-gray-50 antialiased selection:bg-mosque-light selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer">
                    <?php if (!empty($profileData['logo'])): ?>
                        <img src="<?php echo htmlspecialchars(resolve_image_url($profileData['logo'])); ?>" alt="Logo Masjid" class="w-10 h-10 object-contain">
                    <?php else: ?>
                        <div class="w-10 h-10 bg-mosque-primary rounded-full flex items-center justify-center text-white">
                            <i class="fa-solid fa-mosque text-xl"></i>
                        </div>
                    <?php endif; ?>
                    <span class="font-bold text-2xl text-mosque-dark tracking-tight"><?php echo htmlspecialchars($profileData['name'] ?? 'Masjid Al-Ikhlas'); ?></span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#home" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Beranda</a>
                    <a href="#profil" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Profil</a>
                    <a href="#manajemen" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Manajemen</a>
                    <a href="#artikel" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Artikel</a>
                    <a href="#organisasi" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Organisasi</a>
                    <a href="#kontak" class="text-gray-600 hover:text-mosque-primary font-medium transition-colors">Kontak</a>
                    <a href="admin/login.php" target="_blank" class="px-5 py-2.5 bg-mosque-primary text-white rounded-full font-medium hover:bg-mosque-dark transition-colors shadow-lg shadow-mosque-primary/30">
                        Login Admin
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-mosque-primary focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
