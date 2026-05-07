<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem PAZPUS - Modern & Digital</title>

    <!-- Google Fonts - Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        },
                        animation: {
                            'gradient': 'gradient 8s ease infinite',
                            'float': 'float 4s ease-in-out infinite',
                            'pulse-slow': 'pulse 5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                            'glow': 'glow 2s ease-in-out infinite alternate',
                        }
                    }
                }
            }
        </script>
    @endif
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(147, 51, 234, 0.3); }
            to { box-shadow: 0 0 30px rgba(147, 51, 234, 0.6); }
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f0f23 50%, #1a1a2e 75%, #16213e 100%);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        .animate-gradient {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f0f23 50%, #1a1a2e 75%, #16213e 100%);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .hero-text {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.1), rgba(59, 130, 246, 0.1));
            border: 1px solid rgba(147, 51, 234, 0.2);
            backdrop-filter: blur(10px);
        }

        .gradient-text {
            background: linear-gradient(135deg, #e879f9, #a855f7, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(90deg, #a855f7, #3b82f6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .cta-button {
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background: linear-gradient(135deg, #6d28d9, #2563eb);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.6);
            transform: translateY(-2px);
        }

        .feature-icon {
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.2), rgba(59, 130, 246, 0.2));
            border: 1px solid rgba(147, 51, 234, 0.3);
        }
    </style>
</head>
<body class="min-h-screen text-white overflow-x-hidden">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-pulse" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-indigo-900/15 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse" style="animation-delay: 6s;"></div>
    </div>

    <div class="relative z-10 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="relative z-20 w-full py-8 px-4 lg:px-8">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-transparent rounded-xl flex items-center justify-center shadow-lg" style="overflow: hidden;">
                            <img src="{{ asset('logo.png') }}" alt="Logo PAZPUS" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.outerHTML='<div class=\'w-14 h-14 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center shadow-lg\'><svg class=\'w-8 h-8 text-white\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path d=\'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg></div>'">
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">PAZPUS</h1>
                            <p class="text-purple-300/80 text-sm font-medium">SMK Modern Learning Center</p>
                        </div>
                    </div>
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="nav-link text-white/80 hover:text-white font-medium">Fitur</a>
                        <a href="#about" class="nav-link text-white/80 hover:text-white font-medium">Tentang</a>
                        <a href="#contact" class="nav-link text-white/80 hover:text-white font-medium">Kontak</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="glass-card text-white px-6 py-3 rounded-full hover:bg-white/10 transition-all font-medium">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-600/80 backdrop-blur-sm text-white px-6 py-3 rounded-full hover:bg-red-600 transition-all font-medium">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="cta-button text-white px-8 py-3 rounded-full font-semibold tracking-wide">
                                Masuk Sistem
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center px-4 lg:px-8 py-16">
            <div class="container mx-auto text-center">
                <div class="max-w-5xl mx-auto">
                    <div class="hero-text mb-12">
                        <h2 class="text-6xl lg:text-8xl font-black text-white mb-8 leading-tight tracking-tight">
                            PAZPUS
                            <span class="block gradient-text mt-2">
                                Modern & Digital
                            </span>
                        </h2>
                        <p class="text-xl lg:text-2xl text-gray-300 mb-12 leading-relaxed font-light max-w-3xl mx-auto">
                            Sistem manajemen perpustakaan terdepan dengan teknologi terkini untuk mendukung pembelajaran siswa SMK di era digital
                        </p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                        <div class="stats-card rounded-2xl p-8 text-center animate-float shadow-2xl">
                            <div class="text-5xl font-black text-white mb-3">10+</div>
                            <div class="text-purple-300 font-semibold">Koleksi Buku</div>
                        </div>
                        <div class="stats-card rounded-2xl p-8 text-center animate-float shadow-2xl" style="animation-delay: 1.5s;">
                            <div class="text-5xl font-black text-white mb-3">50+</div>
                            <div class="text-purple-300 font-semibold">Siswa Aktif</div>
                        </div>
                        <div class="stats-card rounded-2xl p-8 text-center animate-float shadow-2xl" style="animation-delay: 3s;">
                            <div class="text-5xl font-black text-white mb-3">24/7</div>
                            <div class="text-purple-300 font-semibold">Super Ultimate Ultra Gokil</div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-10 py-4 rounded-full text-lg font-bold hover:from-emerald-700 hover:to-teal-700 transition-all transform hover:scale-105 shadow-2xl hover:shadow-emerald-500/25">
                                🚀 Akses Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="cta-button text-white px-10 py-4 rounded-full text-lg font-bold shadow-2xl">
                                🔐 Masuk Sistem
                            </a>
                        @endauth
                        <a href="#features" class="glass-card text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-white/10 transition-all border border-white/20">
                            📚 Jelajahi Fitur
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Section -->
        <section id="features" class="py-24 px-4 lg:px-8">
            <div class="container mx-auto">
                <div class="text-center mb-20">
                    <h3 class="text-5xl font-black text-white mb-6 tracking-tight">Fitur Unggulan</h3>
                    <p class="text-2xl text-gray-300 font-light max-w-2xl mx-auto">Teknologi modern untuk pengalaman perpustakaan terbaik</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Cards -->
                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">📚</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Koleksi Buku</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Ribuan buku dari berbagai kategori dengan pencarian canggih dan sistem rekomendasi personal</p>
                    </div>

                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">🔍</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Pencarian Rak Pintar</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Temukan lokasi buku dengan mudah. Sistem otomatis menunjukkan nomor rak yang tepat</p>
                    </div>

                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">⏰</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Denda Otomatis</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Sistem penghitungan denda yang akurat dan transparan. Denda per hari keterlambatan, tarif dapat diatur oleh admin</p>
                    </div>

                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">📊</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Laporan Real-time</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Dashboard analitik lengkap dengan statistik peminjaman dan histori denda siswa</p>
                    </div>

                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">👥</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Manajemen Siswa</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Sistem terorganisir untuk mengelola data siswa dengan jurusan PPLG, TJKT, DKV, dan BD</p>
                    </div>

                    <div class="feature-card glass-card rounded-2xl p-8 text-center group shadow-2xl">
                        <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
                            <span class="text-4xl">🖼️</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-6">Galeri Buku</h4>
                        <p class="text-gray-300 leading-relaxed font-light">Koleksi sampul buku yang menarik untuk memudahkan identifikasi dan pencarian visual</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-20 bg-black/30 backdrop-blur-md py-12 px-4 lg:px-8 border-t border-white/10">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <div class="mb-6 md:mb-0 text-center md:text-left">
                        <h4 class="text-white font-bold text-xl mb-3">PAZPUS</h4>
                        <p class="text-gray-300 font-light max-w-md">Mendorong pembelajaran melalui teknologi digital untuk generasi masa depan</p>
                    </div>
                    <div class="flex space-x-8">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors font-medium">📘 Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors font-medium">📷 Instagram</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors font-medium">🐦 Twitter</a>
                    </div>
                </div>
                <div class="pt-8 border-t border-white/10 text-center">
                    <p class="text-gray-400 font-light">
                        © 2026 Sistem PAZPUS. Crafted with ❤️ for better education.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Mobile Menu Toggle (if needed) -->
    <script>
        // Add any interactive JavaScript here if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add intersection observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>