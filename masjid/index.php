<?php
require_once 'config/database.php';
require_once 'models/Profile.php';
require_once 'models/Management.php';
require_once 'models/Article.php';
require_once 'models/Organization.php';

$profileModel = new Profile($pdo);
$profileData = $profileModel->getProfile();

$managementModel = new Management($pdo);
$managements = $managementModel->getAll();

$articleModel = new Article($pdo);
$articles = $articleModel->getAll(3);

$orgModel = new Organization($pdo);
$organizations = $orgModel->getAll();

require_once 'includes/header.php';
?>
    <!-- Hero Section -->
    <section id="home" class="relative pt-20 pb-32 lg:pt-48 lg:pb-64 flex items-center hero-pattern min-h-screen">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center lg:text-left flex flex-col lg:flex-row items-center">
            <div class="lg:w-2/3">
                <span class="inline-block py-1 px-3 rounded-full bg-mosque-gold/20 text-mosque-gold font-semibold text-sm mb-6 border border-mosque-gold/30 backdrop-blur-sm">
                    Pusat Ibadah & Dakwah
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 anime-hero-title" style="opacity: 0;">
                    Menjalin Ukhuwah,<br>
                    <span class="text-mosque-yellow">Memakmurkan Masjid</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-200 mb-10 max-w-2xl mx-auto lg:mx-0 anime-hero-desc" style="opacity: 0;">
                    Selamat datang di website resmi Masjid Al-Ikhlas. Pusat kegiatan ibadah, pendidikan, dan sosial kemasyarakatan yang membawa rahmat bagi seluruh alam.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#profil" class="anime-hero-btn px-8 py-4 bg-mosque-gold text-white rounded-full font-bold hover:bg-yellow-600 transition-all shadow-lg shadow-mosque-gold/40 flex items-center justify-center gap-2" style="opacity: 0;">
                        Kenali Kami <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="#kontak" class="anime-hero-btn px-8 py-4 bg-white/10 text-white border border-white/30 rounded-full font-bold hover:bg-white/20 backdrop-blur-sm transition-all flex items-center justify-center gap-2" style="opacity: 0;">
                        Jadwal Kegiatan
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Curve/Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-16 lg:h-32" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,121.22,201.5,114.36,242.41,110.37,282.87,100.82,321.39,56.44Z" fill="#F5F5F5"></path>
            </svg>
        </div>
    </section>

    <!-- Statistik Section (Overlapping Hero) -->
    <section class="relative z-10 -mt-16 sm:-mt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-mosque-primary rounded-2xl p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300 anime-stat-card" style="opacity: 0;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold opacity-50">01</span>
                    </div>
                    <h3 class="text-3xl font-extrabold mb-1">1,500+</h3>
                    <p class="text-mosque-light text-sm font-medium">Kapasitas Jamaah</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-gray-900 rounded-2xl p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300 anime-stat-card" style="opacity: 0;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-book-open text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold text-gray-700">02</span>
                    </div>
                    <h3 class="text-3xl font-extrabold mb-1">24</h3>
                    <p class="text-gray-400 text-sm font-medium">Program Kajian Rutin</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-mosque-gold rounded-2xl p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300 anime-stat-card" style="opacity: 0;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-hand-holding-heart text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold opacity-50">03</span>
                    </div>
                    <h3 class="text-3xl font-extrabold mb-1">15+</h3>
                    <p class="text-yellow-200 text-sm font-medium">Program Sosial Kemasyarakatan</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-mosque-purple rounded-2xl p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300 anime-stat-card" style="opacity: 0;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-graduation-cap text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold opacity-50">04</span>
                    </div>
                    <h3 class="text-3xl font-extrabold mb-1">350</h3>
                    <p class="text-purple-200 text-sm font-medium">Santri TPQ & Madin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Masjid Section -->
    <section id="profil" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 anime-fade-up">
                <span class="text-mosque-primary font-bold uppercase tracking-wider text-sm">Tentang Kami</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-2 mb-4">Profil Masjid Al-Ikhlas</h2>
                <div class="w-24 h-1 bg-mosque-gold mx-auto rounded-full"></div>
            </div>

            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <div class="lg:w-1/2 relative anime-fade-up">
                    <div class="absolute -inset-4 bg-mosque-primary/10 rounded-3xl transform -rotate-3"></div>
                    <?php if (!empty($profileData['image'])): ?>
                        <img src="<?php echo htmlspecialchars(resolve_image_url($profileData['image'])); ?>" alt="Masjid Interior" class="relative rounded-2xl shadow-2xl w-full object-cover h-[500px]">
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?q=80&w=800&auto=format&fit=crop" alt="Masjid Interior" class="relative rounded-2xl shadow-2xl w-full object-cover h-[500px]">
                    <?php endif; ?>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-mosque-gold/20 rounded-full flex items-center justify-center text-mosque-gold text-2xl">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Berdiri Sejak</p>
                                <p class="text-2xl font-bold text-gray-900">1998</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 anime-fade-up">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sejarah Singkat</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($profileData['history'])); ?>
                    </p>
                    
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4 items-start">
                            <div class="w-12 h-12 bg-mosque-primary/10 rounded-xl flex items-center justify-center text-mosque-primary shrink-0">
                                <i class="fa-solid fa-eye text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Visi Kami</h4>
                                <p class="text-gray-600 text-sm"><?php echo nl2br(htmlspecialchars($profileData['vision'])); ?></p>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4 items-start">
                            <div class="w-12 h-12 bg-mosque-gold/10 rounded-xl flex items-center justify-center text-mosque-gold shrink-0">
                                <i class="fa-solid fa-bullseye text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Misi Kami</h4>
                                <ul class="text-gray-600 text-sm space-y-2 list-disc list-inside">
                                    <?php echo $profileData['mission']; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Manajemen Masjid Section -->
    <section id="manajemen" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 anime-fade-up">
                <span class="text-mosque-gold font-bold uppercase tracking-wider text-sm">Layanan & Program</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-2 mb-4">Manajemen Masjid</h2>
                <div class="w-24 h-1 bg-mosque-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach($managements as $m): ?>
                <div class="group bg-gray-50 rounded-3xl p-8 hover:bg-mosque-primary transition-colors duration-300 anime-card-stagger" style="opacity: 0;">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-mosque-primary mb-6 group-hover:text-mosque-primary group-hover:scale-110 transition-transform">
                        <i class="fa-solid <?php echo htmlspecialchars($m['icon']); ?> text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition-colors"><?php echo htmlspecialchars($m['title']); ?></h3>
                    <p class="text-gray-600 group-hover:text-gray-100 transition-colors leading-relaxed">
                        <?php echo htmlspecialchars($m['description']); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Artikel Terbaru Section -->
    <section id="artikel" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 anime-fade-up">
                <div>
                    <span class="text-mosque-purple font-bold uppercase tracking-wider text-sm">Berita & Publikasi</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-2">Artikel Terbaru</h2>
                </div>
                <a href="#" class="hidden md:inline-flex items-center gap-2 text-mosque-primary font-semibold hover:text-mosque-dark transition-colors">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($articles as $a): ?>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col group anime-card-stagger" style="opacity: 0;">
                    <div class="relative overflow-hidden h-60">
                        <img src="<?php echo htmlspecialchars($a['image']); ?>" alt="Artikel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-mosque-primary">
                            <?php echo htmlspecialchars($a['category']); ?>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center text-sm text-gray-500 mb-3 gap-4">
                            <span><i class="fa-regular fa-calendar mr-2"></i> <?php echo date('d M Y', strtotime($a['created_at'])); ?></span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-mosque-primary transition-colors">
                            <a href="#"><?php echo htmlspecialchars($a['title']); ?></a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            <?php echo htmlspecialchars(substr($a['content'], 0, 150)) . '...'; ?>
                        </p>
                        <a href="#" class="mt-auto inline-flex items-center text-mosque-primary font-semibold hover:text-mosque-dark text-sm">
                            Baca Selengkapnya <i class="fa-solid fa-angle-right ml-2"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if(count($articles) == 0): ?>
                    <div class="col-span-full text-center text-gray-500 py-10">Belum ada artikel.</div>
                <?php endif; ?>
            </div>
            
            <div class="mt-10 text-center md:hidden">
                <a href="#" class="inline-flex items-center gap-2 text-white bg-gray-900 px-6 py-3 rounded-full font-semibold hover:bg-gray-800 transition-colors">
                    Lihat Semua Artikel
                </a>
            </div>
        </div>
    </section>

    <!-- Organisasi Section -->
    <section id="organisasi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 anime-fade-up">
                <span class="text-mosque-primary font-bold uppercase tracking-wider text-sm">Pengurus & Takmir</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-2 mb-4">Struktur Organisasi</h2>
                <div class="w-24 h-1 bg-mosque-gold mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach($organizations as $org): ?>
                <div class="bg-gray-50 rounded-2xl p-6 text-center shadow-sm hover:shadow-xl transition-all border border-gray-100 group anime-card-stagger" style="opacity: 0;">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-6 border-4 border-white shadow-lg group-hover:border-mosque-primary transition-colors">
                        <img src="<?php echo !empty($org['image']) ? htmlspecialchars($org['image']) : 'https://ui-avatars.com/api/?name='.urlencode($org['name']).'&background=047857&color=fff'; ?>" alt="Pengurus" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1"><?php echo htmlspecialchars($org['name']); ?></h3>
                    <p class="text-mosque-primary font-medium text-sm mb-4"><?php echo htmlspecialchars($org['position']); ?></p>
                    <div class="flex justify-center gap-3 text-gray-400">
                        <?php if(!empty($org['linkedin'])): ?>
                            <a href="<?php echo htmlspecialchars($org['linkedin']); ?>" class="hover:text-mosque-primary"><i class="fa-brands fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if(!empty($org['email'])): ?>
                            <a href="mailto:<?php echo htmlspecialchars($org['email']); ?>" class="hover:text-mosque-primary"><i class="fa-solid fa-envelope"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if(count($organizations) == 0): ?>
                    <div class="col-span-full text-center text-gray-500 py-10">Belum ada data pengurus.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Daftar Kontak Section -->
    <section id="kontak" class="py-20 bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <pattern id="islamic-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M10 0 L20 10 L10 20 L0 10 Z" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    <circle cx="10" cy="10" r="3" fill="none" stroke="currentColor" stroke-width="0.5"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#islamic-pattern)" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 anime-fade-up">
                <h2 class="text-3xl sm:text-4xl font-extrabold mt-2 mb-4">Hubungi Kami</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Kami senantiasa terbuka untuk kritik, saran, pertanyaan, maupun diskusi terkait program dan kegiatan masjid.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8 anime-fade-up">
                    <div class="flex items-start gap-6 bg-white/5 p-6 rounded-2xl backdrop-blur-sm border border-white/10">
                        <div class="w-14 h-14 bg-mosque-primary rounded-full flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Alamat Lengkap</h3>
                            <p class="text-gray-400"><?php echo nl2br(htmlspecialchars($profileData['address'] ?? '')); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6 bg-white/5 p-6 rounded-2xl backdrop-blur-sm border border-white/10">
                        <div class="w-14 h-14 bg-mosque-gold rounded-full flex items-center justify-center shrink-0 text-gray-900">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Telepon & WhatsApp</h3>
                            <p class="text-gray-400 mb-1">Telepon: <?php echo htmlspecialchars($profileData['phone'] ?? ''); ?></p>
                            <p class="text-gray-400">WhatsApp: <?php echo htmlspecialchars($profileData['whatsapp'] ?? ''); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6 bg-white/5 p-6 rounded-2xl backdrop-blur-sm border border-white/10">
                        <div class="w-14 h-14 bg-mosque-purple rounded-full flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Email</h3>
                            <p class="text-gray-400"><?php echo htmlspecialchars($profileData['email_1'] ?? ''); ?></p>
                            <?php if(!empty($profileData['email_2'])): ?>
                                <p class="text-gray-400"><?php echo htmlspecialchars($profileData['email_2']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Contact Form & Map placeholder -->
                <div class="bg-white rounded-3xl p-8 text-gray-900 shadow-2xl anime-fade-up">
                    <h3 class="text-2xl font-bold mb-6">Kirim Pesan</h3>
                    <form action="#" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="email@anda.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="Tujuan pesan">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-mosque-primary focus:border-transparent transition-shadow" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-mosque-primary text-white rounded-xl font-bold hover:bg-mosque-dark transition-colors shadow-lg shadow-mosque-primary/30">
                            Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
