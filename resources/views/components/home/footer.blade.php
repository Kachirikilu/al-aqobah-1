<footer id="scroll-footer" class="flex flex-col space-y-10 justify-center m-10 mt-40">

    <nav class="flex justify-center flex-wrap gap-6 text-gray-500 font-medium">
        <a class="hover:text-gray-900" href="/">Home</a>
        <a class="hover:text-gray-900" href="#group-jadwal" id="scroll-ke-grup-jadwal-4">Kegiatan</a>
        <a class="hover:text-gray-900" href="#scroll-jadwal-sholat" id="scroll-ke-jadwal-sholat-3">Waktu Sholat</a>
        <a class="hover:text-gray-900" href="#scroll-galery" id="scroll-ke-galery-3">Gallery</a>
        <a class="hover:text-gray-900" href="/login">
            @if(Auth::check())
                Dashboard
            @else
                Login
            @endif
        </a>
    </nav>

    <div class="flex justify-center space-x-5">
        <a href="https://www.facebook.com/share/19SofgsQFs/" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/facebook-new.png" />
        </a>
        <a href="https://www.linkedin.com/in/wildan-athif-muttaqien-89b327297" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/linkedin-2.png" />
        </a>
        <a href="https://www.instagram.com/athif_kyuziera/profilecard/?igsh=NHFsazN2a2diM3Rp " target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/instagram-new.png" />
        </a>
        <a href="https://wa.me/628985655826" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/whatsapp.png" />
        </a>
        <a href="https://x.com/WildanAthif12" target="_blank" rel="noopener noreferrer">
            <img src="https://img.icons8.com/fluent/30/000000/twitter.png" />
        </a>
    </div>
    <p class="text-center text-gray-700 font-medium">&copy; 2025 PT. PUSRI</p>
</footer>