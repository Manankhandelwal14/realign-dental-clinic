<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        .pulse {
            animation: pulse 2s ease-in-out infinite;
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-rose-50 flex items-center justify-center p-4">
    <div class="max-w-4xl w-full mx-auto text-center relative">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="float absolute top-20 left-20 w-24 h-24 bg-[teal]/10 rounded-full"></div>
            <div class="float absolute bottom-20 right-20 w-32 h-32 bg-secondary/10 rounded-full"
                style="animation-delay: -2s"></div>
            <div class="float absolute top-40 right-40 w-16 h-16 bg-[teal]/10 rounded-full"
                style="animation-delay: -4s"></div>
        </div>

        <div class="relative z-10 space-y-8 fade-in">
            <h1 class="text-[180px] font-bold text-[teal] leading-none">500</h1>
            <h2 class="text-4xl font-semibold text-gray-800">Internal Server Error</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">We're experiencing some technical difficulties. Our team
                has been notified and is working to fix the issue.</p>

            <div class="flex flex-col items-center gap-6 mt-12">
                {{-- <button id="reportBtn"
                    class="pulse bg-[teal] text-white px-8 py-4 rounded-lg flex items-center gap-2 hover:bg-[teal]/90 transition-all shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bug" viewBox="0 0 16 16">
                        <path
                            d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z" />
                    </svg>
                    <span class="whitespace-nowrap">Report This Error</span>
                </button> --}}

                <a href="/" class="text-[teal] hover:text-[teal]/80 flex items-center gap-2 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                    </svg>
                    <span>Return to Homepage</span>
                </a>
            </div>
        </div>
    </div>

    <div id="reportModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-lg w-full p-6 shadow-2xl fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Report Error</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="ri-close-line ri-lg"></i>
                </button>
            </div>

            <form id="errorForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">What were you trying to do?</label>
                    <textarea
                        class="w-full border border-gray-300 rounded-lg p-2 h-24 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email (optional)</label>
                    <input type="email"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                        placeholder="your@email.com">
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" id="cancelBtn"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-lg">Cancel</button>
                    <button type="submit"
                        class="bg-[teal] text-white px-6 py-2 rounded-lg hover:bg-[teal]/90 transition-all">Submit
                        Report</button>
                </div>
            </form>
        </div>
    </div>

    <div id="successToast"
        class="hidden fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg fade-in">
        <div class="flex items-center gap-2">
            <x-icons.check />
            <span>Error report submitted successfully!</span>
        </div>
    </div>

    <script>
        const reportBtn = document.getElementById('reportBtn');
        const reportModal = document.getElementById('reportModal');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const errorForm = document.getElementById('errorForm');
        const successToast = document.getElementById('successToast');
        reportBtn.addEventListener('click', () => {
            reportModal.classList.remove('hidden');
        });

        [closeModal, cancelBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                reportModal.classList.add('hidden');
            });
        });
        errorForm.addEventListener('submit', (e) => {
            e.preventDefault();
            reportModal.classList.add('hidden');
            successToast.classList.remove('hidden');
            setTimeout(() => {
                successToast.classList.add('hidden');
            }, 3000);
            errorForm.reset();
        });

        reportModal.addEventListener('click', (e) => {
            if (e.target === reportModal) {
                reportModal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
