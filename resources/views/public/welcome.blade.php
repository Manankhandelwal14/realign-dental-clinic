<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReAlign Dental Clinic - Coming Soon</title>
    {{-- seo --}}
    <meta name="description"
        content="Discover expert dental care at ReAlign Dental Clinic. We're opening soon with state-of-the-art services. Stay tuned!">
    <meta name="keywords" content="dental, clinic, dental clinic, dental care, dental health, teeth, smile, oral health">
    <meta name="author" content="ReAlign Dental Clinic">
    <meta property="og:title" content="ReAlign Dental Clinic - Coming Soon">
    <meta property="og:description"
        content="Experience excellence in dental care. We're preparing something special for you.">
    <meta property="og:image" content="{{ asset('images/logo/logo-png.png') }}">
    <meta property="og:url" content="https://realigndental.com">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ReAlign Dental Clinic">
    <meta property="og:locale" content="en_US">
    {{-- favicon --}}
    <link rel="icon" href="{{ asset('images/logo/logo-png.png') }}" type="image/png">
    {{-- tailwindcss --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #particles-canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Dentist",
      "name": "ReAlign Dental Clinic",
      "url": "https://realigndental.com",
      "image": "https://realigndental.com/images/logo/logo-png.png",
      "telephone": "+917891012206",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "94/40, Vijay Path, Mansarovar",
        "addressLocality": "Jaipur",
        "postalCode": "302020",
        "addressCountry": "India",
        "addressRegion": "Rajasthan"
      },
      "openingHours": "Mo,Tu,We,Th,Fr 09:00-17:00",
      "sameAs": [
        "https://www.instagram.com/realigndentalclinic/",
        "https://www.youtube.com/@RealignDental"
      ]
    }
    </script>
</head>

<body class="bg-black min-h-screen flex flex-col items-center justify-center p-4 overflow-x-hidden">
    <canvas id="particles-canvas"></canvas>

    <!-- Main Content Container -->
    <div class="content max-w-4xl mx-auto text-center">
        <!-- Logo -->
        <div class="transform hover:scale-105 transition-transform duration-300" id="logo-container">
            <img src="{{ asset('images/logo/logo-png.png') }}" alt="ReAlign Dental Clinic Logo"
                class="w-48 md:w-48 mx-auto floating" loading="lazy">
        </div>

        {{-- ReAlign Dental Clinic --}}
        <h1 class="text-gold text-sm md:text-xl font-bold mb-4 uppercase" id="coming-soon-text">
            ReAlign Dental Clinic
        </h1>
        <!-- Coming Soon Text -->
        <h1 class="text-gold text-4xl md:text-6xl font-bold mb-4" id="coming-soon-text">
            Coming Soon
        </h1>

        <!-- Description -->
        <p class="text-gold/80 text-lg md:text-xl mb-8 max-w-2xl mx-auto" id="description">
            Experience excellence in dental care. We're preparing something special for you.
        </p>

        <!-- Countdown Timer -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 max-w-xl mx-auto">
            <div class="bg-black/50 border border-gold/30 rounded-lg p-4 hover-glow">
                <span id="days" class="text-gold text-3xl font-bold block">00</span>
                <span class="text-gold text-sm">Days</span>
            </div>
            <div class="bg-black/50 border border-gold/30 rounded-lg p-4 hover-glow">
                <span id="hours" class="text-gold text-3xl font-bold block">00</span>
                <span class="text-gold text-sm">Hours</span>
            </div>
            <div class="bg-black/50 border border-gold/30 rounded-lg p-4 hover-glow">
                <span id="minutes" class="text-gold text-3xl font-bold block">00</span>
                <span class="text-gold text-sm">Minutes</span>
            </div>
            <div class="bg-black/50 border border-gold/30 rounded-lg p-4 hover-glow">
                <span id="seconds" class="text-gold text-3xl font-bold block">00</span>
                <span class="text-gold text-sm">Seconds</span>
            </div>
        </div>
        <div>
            <p class="text-gray-300 font-semibold mb-2 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-300 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 14h-2v-2h2Zm0-4h-2V7h2Z"></path>
                </svg>
                Sorry for the delay! We are going live as soon as possible.
            </p>
        </div>

        <!-- Contact Information -->
        <div class="text-gold/80 mb-2 mt-3" id="contact-info">
            <p class="mb-2">Contact us: <a href="tel:+917891012206" class="hover:text-gold transition-colors">+91
                    7891012206</a></p>
        </div>

        <!-- Social Links -->
        <div class="flex justify-center gap-6 mb-8" id="social-links">
            <a href="https://www.instagram.com/realigndentalclinic/" target="_blank" rel="noopener noreferrer"
                class="text-gold/80 hover:text-gold transition-colors transform hover:scale-110"
                aria-label="Follow us on Instagram">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
            </a>
            <a href="https://www.youtube.com/@RealignDental" target="_blank" rel="noopener noreferrer"
                class="text-gold/80 hover:text-gold transition-colors transform hover:scale-110"
                aria-label="Subscribe to our YouTube channel">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                </svg>
            </a>
        </div>
        <!-- Instant Callback Button -->
        <button onclick="toggleModal()"
            class="bg-gold text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition">
            Get an Instant Callback
        </button>

        <!-- Callback Modal -->

        <div id="callback-modal"
            class="fixed inset-0 flex items-center justify-center bg-black/60 
            {{-- if not error in name and phone then add hidden --}}
            @if (!$errors->has('name') && !$errors->has('phone')) hidden @endif
        ">
            <div
                class="backdrop-blur-md bg-white/10 border border-white/20 text-white rounded-lg shadow-lg p-6 max-w-md w-full text-center relative modal">
                <button onclick="toggleModal()" class="absolute top-2 right-3 text-white text-lg font-bold">×</button>
                <!-- Logo -->
                <img src="{{ asset('images/logo/logo-small-png.png') }}" alt="ReAlign Dental Clinic Logo"
                    class="w-20 mx-auto mb-3">
                <h1 class="text-gold text-sm md:text-xl font-bold mb-4 uppercase" id="coming-soon-text">
                    ReAlign Dental Clinic
                </h1>
                <h2 class="text-2xl font-bold mb-2">Request a Callback</h2>
                <p class="text-gray-300 mb-4">Our dentist will contact you as soon as possible.</p>
                <form action="{{ route('public.request-a-callback') }}" method="POST">

                    @csrf

                    <!-- Name Input -->
                    <div>
                        <x-input id="name"
                            class="w-full px-4 py-2 bg-white/20 border border-white/30 rounded-lg text-white placeholder-gray-300 focus:ring-2 focus:ring-gold focus:outline-none mb-0"
                            type="text" name="name" :value="old('name')" required autofocus
                            placeholder="Enter your name" />
                        <x-input-error for="name" class="text-left mt-1" />
                    </div>
                    <!-- Phone Input -->
                    <div class="mb-3 mt-2">
                        {{-- prefix +91 --}}
                        <div class="flex items-center justify-start">
                            <span
                                class="text-white px-4 py-2 bg-white/20 border border-white/30 rounded-l-lg text-white placeholder-gray-300 focus:ring-2 focus:ring-gold focus:outline-none">+91</span>
                            <x-input id="phone"
                                class="w-full px-4 py-2 bg-white/20 border border-white/30 rounded-r-lg rounded-l-none text-white placeholder-gray-300 focus:ring-2 focus:ring-gold focus:outline-none"
                                type="tel" name="phone" :value="old('phone')" required
                                placeholder="Enter your phone number" />
                        </div>
                        <x-input-error for="phone" class="text-left mt-1" />
                    </div>

                    {{-- are you sure checkbox --}}
                    <div class="mb-3">
                        <div class="flex items-center justify-start">
                            <input type="checkbox" name="confirm" id="confirm"
                                class="mr-2 rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gold shadow-sm focus:ring-gold dark:focus:ring-gold dark:focus:ring-offset-gray-800">
                            <label for="confirm" class="text-white">I am sure about my phone number.</label>
                        </div>
                        <x-input-error for="confirm" class="text-left mt-1" value="accepted" />
                    </div>

                    <!-- Submit Button -->
                    <button
                        class="bg-gold text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition w-full">
                        Submit
                    </button>
                </form>
            </div>
        </div>

        {{-- success model for submited --}}
        @if (session('success'))
            <div class="fixed inset-0 flex items-center justify-center bg-black/60" id="success-modal">
                <div class=" bg-black/60 text-white rounded-lg shadow-lg p-6 max-w-md w-full text-center modal">
                    <div
                        class="backdrop-blur-md bg-white/10 border border-white/20 text-white rounded-lg shadow-lg p-6 max-w-md w-full text-center relative modal">
                        <h2 class="text-2xl font-bold mb-2">Thank you!</h2>
                        <p class="text-gray-300 mb-4">Our dentist will contact you as soon as possible.</p>
                        <button onclick="toggleSuccessModal()"
                            class="bg-gold text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- already submited model for today model --}}
        @if (session('error'))
            <div class="fixed inset-0 flex items-center justify-center bg-black/60" id="success-modal">
                <div class=" bg-black/60 text-white rounded-lg shadow-lg p-6 max-w-md w-full text-center modal">
                    <div
                        class="backdrop-blur-md bg-white/10 border border-white/20 text-white rounded-lg shadow-lg p-6 max-w-md w-full text-center relative modal">
                        <h2 class="text-2xl font-bold mb-2">Already Submited!</h2>
                        <p class="text-gray-300 mb-4">You have already submited your request for today.</p>
                        <button onclick="toggleSuccessModal()"
                            class="bg-gold text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        function toggleModal() {
            document.getElementById('callback-modal').classList.toggle('hidden');
        }

        function toggleSuccessModal() {
            document.getElementById('success-modal').classList.toggle('hidden');
        }

        // Three.js Particle System
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({
            canvas: document.getElementById('particles-canvas'),
            alpha: true
        });
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Create particles
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        const posArray = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 5;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.005,
            color: 0xC6A962, // Gold color
            transparent: true,
            opacity: 0.8
        });

        const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particlesMesh);

        camera.position.z = 3;

        // Mouse movement effect
        let mouseX = 0;
        let mouseY = 0;

        document.addEventListener('mousemove', (event) => {
            mouseX = event.clientX / window.innerWidth - 0.5;
            mouseY = event.clientY / window.innerHeight - 0.5;
        });

        // Animation
        function animate() {
            requestAnimationFrame(animate);

            particlesMesh.rotation.y += 0.001;
            particlesMesh.rotation.x += 0.001;

            // Follow mouse
            particlesMesh.rotation.x += mouseY * 0.05;
            particlesMesh.rotation.y += mouseX * 0.05;

            renderer.render(scene, camera);
        }

        animate();

        // GSAP Animations
        gsap.from("#coming-soon-text", {
            duration: 1.5,
            y: 100,
            opacity: 0,
            ease: "power4.out"
        });

        gsap.from("#description", {
            duration: 1.5,
            y: 50,
            opacity: 0,
            delay: 0.5,
            ease: "power4.out"
        });

        gsap.from("#contact-info", {
            duration: 1.5,
            y: 50,
            opacity: 0,
            delay: 1,
            ease: "power4.out"
        });

        gsap.from("#social-links a", {
            duration: 1,
            scale: 0,
            opacity: 0,
            delay: 1.5,
            stagger: 0.2,
            ease: "back.out(1.7)"
        });

        // Hover effect for countdown boxes
        document.querySelectorAll('.hover-glow').forEach(box => {
            box.addEventListener('mouseenter', () => {
                gsap.to(box, {
                    duration: 0.3,
                    scale: 1.05,
                    boxShadow: '0 0 20px rgba(198, 169, 98, 0.5)',
                    ease: "power2.out"
                });
            });

            box.addEventListener('mouseleave', () => {
                gsap.to(box, {
                    duration: 0.3,
                    scale: 1,
                    boxShadow: 'none',
                    ease: "power2.out"
                });
            });
        });

        // Countdown Timer
        // const launchDate = new Date('2025-02-10T00:00:00').getTime();

        // const timer = setInterval(function() {
        //     const now = new Date().getTime();
        //     const distance = launchDate - now;

        //     const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        //     const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //     const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //     const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        //     document.getElementById("days").innerHTML = String(days).padStart(2, '0');
        //     document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
        //     document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
        //     document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

        //     if (distance < 0) {
        //         clearInterval(timer);
        //         document.getElementById("countdown").innerHTML = "LAUNCHED";
        //     }
        // }, 1000);

        // Window resize handler
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>

</html>
