<?php
// includes/footer.php
?>
    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400 py-12 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-mosque-primary rounded-full flex items-center justify-center text-white">
                            <i class="fa-solid fa-mosque text-sm"></i>
                        </div>
                        <span class="font-bold text-xl text-white tracking-tight"><?php echo htmlspecialchars($profileData['name'] ?? 'Masjid Al-Ikhlas'); ?></span>
                    </div>
                    <p class="max-w-md mb-6">Membangun generasi islami yang bertaqwa, cerdas, dan mandiri untuk kemajuan umat dan kesejahteraan masyarakat.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-mosque-primary hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-mosque-primary hover:text-white transition-all"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-mosque-primary hover:text-white transition-all"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-6">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#home" class="hover:text-mosque-primary transition-colors">Beranda</a></li>
                        <li><a href="#profil" class="hover:text-mosque-primary transition-colors">Profil Masjid</a></li>
                        <li><a href="#manajemen" class="hover:text-mosque-primary transition-colors">Program & Layanan</a></li>
                        <li><a href="#artikel" class="hover:text-mosque-primary transition-colors">Artikel Terbaru</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-6">Bantuan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-mosque-primary transition-colors">Cara Berdonasi</a></li>
                        <li><a href="#" class="hover:text-mosque-primary transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-mosque-primary transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="admin/login.php" target="_blank" class="hover:text-mosque-primary transition-colors">Login Pengurus</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($profileData['name'] ?? 'Masjid Al-Ikhlas'); ?>. All rights reserved.</p>
                <p class="mt-2 md:mt-0">Didesain dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> untuk Umat.</p>
            </div>
        </div>
    </footer>

    <!-- Script for sticky navbar shadow -->
    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 10) {
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        });
    </script>
    
    <!-- Anime.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    
    <!-- Animasi Interaktif -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animasi Hero Title
            anime({
                targets: '.anime-hero-title',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 1200,
                easing: 'easeOutExpo',
                delay: 200
            });

            // Animasi Hero Desc
            anime({
                targets: '.anime-hero-desc',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutExpo',
                delay: 400
            });

            // Animasi Tombol
            anime({
                targets: '.anime-hero-btn',
                scale: [0.9, 1],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutBack',
                delay: anime.stagger(150, {start: 600})
            });

            // Animasi Kartu Statistik (Stagger)
            anime({
                targets: '.anime-stat-card',
                translateY: [40, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutExpo',
                delay: anime.stagger(100, {start: 800})
            });

            // Intersection Observer untuk animasi scroll-triggered
            const observerOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            };

            const fadeUpObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        anime({
                            targets: entry.target,
                            translateY: [50, 0],
                            opacity: [0, 1],
                            duration: 1000,
                            easing: 'easeOutExpo'
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.anime-fade-up').forEach(el => {
                el.style.opacity = '0';
                fadeUpObserver.observe(el);
            });
            
            const staggerObserver = new IntersectionObserver((entries, observer) => {
                let targets = entries.filter(e => e.isIntersecting).map(e => {
                    observer.unobserve(e.target);
                    return e.target;
                });
                
                if (targets.length > 0) {
                    anime({
                        targets: targets,
                        translateY: [40, 0],
                        opacity: [0, 1],
                        duration: 800,
                        easing: 'easeOutExpo',
                        delay: anime.stagger(150)
                    });
                }
            }, observerOptions);
            
            document.querySelectorAll('.anime-card-stagger').forEach(el => {
                el.style.opacity = '0';
                staggerObserver.observe(el);
            });
        });
    </script>
</body>
</html>
