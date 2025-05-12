<div id="scroll-map" class="scroll-mt-20 mt-8 mb-8">
    <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Lokasi Masjid</h2>
    <div class="overflow-hidden rounded-md shadow-md">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.4424348373436!2d104.79979469999999!3d-2.974643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b77b54752dde9%3A0xa476856998a2a3b2!2sMasjid%20Al%20-%20Aqobah%201!5e0!3m2!1sid!2sid!4v1746677602550!5m2!1sid!2sid"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollLinks = [
            { id: 'scroll-ke-home', target: '#scroll-home' },
            { id: 'scroll-ke-home-2', target: '#scroll-home' },
            { id: 'scroll-ke-grup-jadwal', target: '#grup-jadwal' },
            { id: 'scroll-ke-grup-jadwal-2', target: '#grup-jadwal' },
            { id: 'scroll-ke-grup-jadwal-3', target: '#grup-jadwal' },
            { id: 'scroll-ke-grup-jadwal-4', target: '#grup-jadwal' },
            { id: 'scroll-ke-jadwal-sholat', target: '#scroll-jadwal-sholat' },
            { id: 'scroll-ke-jadwal-sholat-2', target: '#scroll-jadwal-sholat' },
            { id: 'scroll-ke-jadwal-sholat-3', target: '#scroll-jadwal-sholat' },
            { id: 'scroll-ke-galery', target: '#scroll-galery' },
            { id: 'scroll-ke-galery-2', target: '#scroll-galery' },
            { id: 'scroll-ke-galery-3', target: '#scroll-galery' },
            { id: 'scroll-ke-footer', target: '#scroll-footer' },
            { id: 'scroll-ke-footer-2', target: '#scroll-footer' },
            { id: 'scroll-ke-hari-ini', target: '#jadwal-hari-ini' },
            { id: 'scroll-ke-minggu-ini', target: '#jadwal-minggu-ini' },
            { id: 'scroll-ke-minggu-depan', target: '#jadwal-minggu-depan' },
            { id: 'scroll-ke-sudah-terlaksana', target: '#jadwal-sudah-terlaksana' },
            { id: 'scroll-ke-sudah-terlaksana-2', target: '#jadwal-sudah-terlaksana' },
            { id: 'scroll-ke-map', target: '#scroll-map' },
            { id: 'scroll-ke-map-2', target: '#scroll-map' }
        ];

        scrollLinks.forEach(linkInfo => {
            const scrollLink = document.getElementById(linkInfo.id);
            const targetId = linkInfo.target;
            const targetElement = document.querySelector(targetId);

            if (scrollLink && targetElement) {
                scrollLink.addEventListener('click', function(event) {
                    event.preventDefault();

                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }
        });
    });
</script>