<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aura Aesthetics | Premium BarberShop</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            :root {
                --primary-gold: #D4AF37;
                --primary-dark: #0D0D0D;
                --secondary-dark: #1A1A1A;
            }
            body { background-color: var(--primary-dark); font-family: 'Inter', sans-serif; color: #F5F5F5; }
            .gold-text {
                background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .btn-gold {
                background-color: var(--primary-gold);
                color: #000;
                transition: all 0.3s ease;
            }
            .btn-gold:hover {
                background-color: #FFD700;
                transform: scale(1.05);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Hero Image Background -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-40" alt="Barber Shop">
                <div class="absolute inset-0 bg-black opacity-60"></div>
            </div>

            <div class="relative z-10 text-center px-6">
                <h1 class="text-6xl md:text-8xl font-bold mb-4 tracking-tighter">
                    AURA <span class="gold-text">AESTHETICS</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto font-light">
                    Elevamos el arte de la barbería a una experiencia premium. Precisión, estilo y elegancia en cada corte.
                </p>

                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-gold px-8 py-4 rounded-full font-bold text-lg uppercase tracking-wider">Ir al Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-gold px-8 py-4 rounded-full font-bold text-lg uppercase tracking-wider">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="border border-[#D4AF37] text-[#D4AF37] hover:bg-[#D4AF37] hover:text-black px-8 py-4 rounded-full font-bold text-lg uppercase tracking-wider transition-all">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>

        <!-- Services Preview Section -->
        <div class="py-20 px-6 bg-[#111]">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-8 border border-gray-800 rounded-2xl hover:border-[#D4AF37] transition-all group">
                    <div class="text-[#D4AF37] mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2 group-hover:text-[#D4AF37]">Corte Clásico</h3>
                    <p class="text-gray-400">Estilo atemporal con acabado a navaja y toalla caliente.</p>
                </div>
                <div class="text-center p-8 border border-gray-800 rounded-2xl hover:border-[#D4AF37] transition-all group">
                    <div class="text-[#D4AF37] mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2 group-hover:text-[#D4AF37]">Diseño de Barba</h3>
                    <p class="text-gray-400">Perfilado y cuidado con productos orgánicos de alta gama.</p>
                </div>
                <div class="text-center p-8 border border-gray-800 rounded-2xl hover:border-[#D4AF37] transition-all group">
                    <div class="text-[#D4AF37] mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2 group-hover:text-[#D4AF37]">Tratamiento Facial</h3>
                    <p class="text-gray-400">Limpieza profunda y exfoliación para el hombre moderno.</p>
                </div>
            </div>
        </div>
    </body>
</html>
