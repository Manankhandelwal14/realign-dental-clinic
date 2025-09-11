<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <x-statistics-card title="Years Of Experience" number="5" />
            <x-statistics-card title="Dentist Specialists" number="3" />
            <x-statistics-card title="Patient Satisfaction" number="100" />
        </div>
    </div>
</section>

@push('scripts')
    <script>
        const stats = document.querySelectorAll(".stats-number");
        stats.forEach((stat) => {
            const target = parseInt(stat.getAttribute("data-target"));
            let count = 0;
            const increment = target / 50;
            const updateCount = () => {
                if (count < target) {
                    count += increment;
                    stat.textContent = Math.ceil(count);
                    setTimeout(updateCount, 40);
                } else {
                    stat.textContent = target;
                }
            };
            updateCount();
        });
    </script>
@endpush
