<footer id="footer" class="flex flex-col space-y-10 justify-center m-10 mt-40">

    <nav class="flex justify-center flex-wrap gap-6 text-gray-500 font-medium">
        <a class="hover:text-gray-900" href="/">Home</a>
        <a class="hover:text-gray-900" href="#group-jadwal" id="scroll-ke-grup-jadwal-3">Kegiatan</a>
        <a class="hover:text-gray-900" href="#jadwal-sholat" id="scroll-ke-jadwal-sholat-3">Waktu Sholat</a>
        <a class="hover:text-gray-900" href="#galery" id="scroll-ke-galery-3">Gallery</a>
        <a class="hover:text-gray-900" href="/login">
            @if(Auth::check())
                Dashboard
            @else
            Login
            @endif
        </a>
    </nav>

    <div class="flex justify-center space-x-5">
        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/facebook-new.png" />
        </a>
        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/linkedin-2.png" />
        </a>
        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/instagram-new.png" />
        </a>
        <a href="https://messenger.com" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/whatsapp.png" />
        </a>
        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/twitter.png" />
        </a>
    </div>
    <p class="text-center text-gray-700 font-medium">&copy; 2025 PT. PUSRI</p>
</footer>