document.addEventListener("DOMContentLoaded", function () {
    const scrollLinks = [
        { id: "scroll-ke-home", target: "#scroll-home" },
        { id: "scroll-ke-home-2", target: "#scroll-home" },
        { id: "scroll-ke-home-3", target: "#scroll-home" },
        { id: "scroll-ke-grup-jadwal", target: "#grup-jadwal" },
        { id: "scroll-ke-grup-jadwal-2", target: "#grup-jadwal" },
        { id: "scroll-ke-grup-jadwal-3", target: "#grup-jadwal" },
        { id: "scroll-ke-grup-jadwal-4", target: "#grup-jadwal" },
        { id: "scroll-ke-jadwal-sholat", target: "#scroll-jadwal-sholat" },
        { id: "scroll-ke-jadwal-sholat-2", target: "#scroll-jadwal-sholat" },
        { id: "scroll-ke-jadwal-sholat-3", target: "#scroll-jadwal-sholat" },
        { id: "scroll-ke-galery", target: "#scroll-galery" },
        { id: "scroll-ke-galery-2", target: "#scroll-galery" },
        { id: "scroll-ke-galery-3", target: "#scroll-galery" },
        { id: "scroll-ke-footer", target: "#scroll-footer" },
        { id: "scroll-ke-footer-2", target: "#scroll-footer" },
        { id: "scroll-ke-hari-ini", target: "#jadwal-hari-ini" },
        { id: "scroll-ke-minggu-ini", target: "#jadwal-minggu-ini" },
        { id: "scroll-ke-minggu-depan", target: "#jadwal-minggu-depan" },
        {
            id: "scroll-ke-sudah-terlaksana",
            target: "#jadwal-sudah-terlaksana",
        },
        {
            id: "scroll-ke-sudah-terlaksana-2",
            target: "#jadwal-sudah-terlaksana",
        },
        { id: "scroll-ke-map", target: "#scroll-map" },
        { id: "scroll-ke-map-2", target: "#scroll-map" },
    ];

    scrollLinks.forEach((linkInfo) => {
        const scrollLink = document.getElementById(linkInfo.id);
        const targetId = linkInfo.target;
        const targetElement = document.querySelector(targetId);

        if (scrollLink && targetElement) {
            scrollLink.addEventListener("click", function (event) {
                event.preventDefault();

                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            });
        }
    });
});

let year,
    month,
    day,
    yearNext,
    monthNext,
    dayNext,
    tomorow,
    hours,
    minutes,
    seconds,
    today,
    todayNext,
    clock;

function updateClock() {
    const date = new Date();
    // date.setHours(date.getHours() - 6);
    year = date.getFullYear();
    month = String(date.getMonth() + 1).padStart(2, "0");
    day = String(date.getDate()).padStart(2, "0");

    tomorow = new Date(date.getTime() + 24 * 60 * 60 * 1000);
    yearNext = tomorow.getFullYear();
    monthNext = String(tomorow.getMonth() + 1).padStart(2, "0");
    dayNext = String(tomorow.getDate()).padStart(2, "0");
    // console.log(todayNext);

    hours = String(date.getHours()).padStart(2, "0");
    minutes = String(date.getMinutes()).padStart(2, "0");
    seconds = String(date.getSeconds()).padStart(2, "0");

    today = `${year}-${month}-${day}`;
    todayNext = `${yearNext}-${monthNext}-${dayNext}`;
    clock = `${hours}:${minutes}`;

    const clockElement = document.getElementById("live-clock");
    if (clockElement) {
        clockElement.textContent = clock;
    }
    const jadwalSholatNext = document.getElementById("jadwal-sholat-next");
    if (jadwalSholatNext && jadwalSholatNext.querySelector(".live-time")) {
        jadwalSholatNext.querySelector(".live-time").textContent =
            clock + ":" + seconds;
    }
}

setInterval(updateClock, 1000);
document.addEventListener("DOMContentLoaded", () => {
    updateClock();
    fetchJadwalSholat();
});

async function fetchJadwalSholat() {
    try {
        const idKota = "0816"; // Kode Kota Palembang
        // const apiUrl = `/proxy/jadwal-sholat?idKota=${idKota}&today=${today}`;
        const apiUrl = `https://api.myquran.com/v2/sholat/jadwal/${idKota}/${today}`;

        const response = await fetch(apiUrl);
        const data = await response.json();
        const ds = data.data.jadwal;

        const jadwalSholatHariIni = document.getElementById(
            "jadwal-sholat-hari-ini"
        );
        const jadwalSholatDiv = document.getElementById("jadwal-sholat");
        const jadwalSholatNext = document.getElementById("jadwal-sholat-next");

        let jadwalHTML = "";
        let nextPrayer = null;

        const prayerTimes = {
            Subuh: ds.subuh,
            Dzuhur: ds.dzuhur,
            Ashar: ds.ashar,
            Maghrib: ds.maghrib,
            Isya: ds.isya,
        };

        for (const waktu in prayerTimes) {
            const prayerTime = prayerTimes[waktu];
            const [prayerHour, prayerMinute] = prayerTime
                .split(":")
                .map(Number);
            const [currentHour, currentMinute] = clock.split(":").map(Number);

            let isNext = false;

            if (!nextPrayer) {
                if (
                    currentHour < prayerHour ||
                    (currentHour === prayerHour && currentMinute < prayerMinute)
                ) {
                    nextPrayer = waktu;
                    isNext = true;
                }
            }

            jadwalHTML += `<p class="text-sm ${
                isNext ? "text-blue-600 font-bold" : "text-gray-700"
            }">${waktu}: ${prayerTime}</p>`;
        }

        let apiUrlNext;
        let responseNext;
        let dataNext;
        if (!nextPrayer) {
            apiUrlNext = `https://api.myquran.com/v2/sholat/jadwal/${idKota}/${todayNext}`;
            responseNext = await fetch(apiUrl);
            dataNext = await responseNext.json();
            jadwalHTML += `<p class="text-sm text-blue-600 font-bold">Subuh Besok: ${dataNext.data.jadwal.subuh}</p>`;
        }

        jadwalSholatHariIni.innerHTML = `Jadwal Sholat | ${day}/${month}/${year}`;
        jadwalSholatDiv.innerHTML = jadwalHTML;

        if (jadwalSholatNext && nextPrayer) {
            jadwalSholatNext.innerHTML = `
                    <h1 class="text-4xl font-bold text-blue-600">${prayerTimes[nextPrayer]}</h1>
                    <p class="text-green-600 text-sm">Waktu Sholat ${nextPrayer}</p>
                    <p class="text-gray-600 text-sm live-time"></p>
                `;
        } else {
            jadwalSholatNext.innerHTML = `
                    <h1 class="text-4xl font-bold text-blue-600">${dataNext.data.jadwal.subuh}</h1>
                    <p class="text-green-600 text-sm">Waktu Sholat Subuh, Besok</p>
                    <p class="text-gray-600 text-sm live-time"></p>
                `;
        }
    } catch (error) {
        console.error("Gagal mengambil data jadwal sholat:", error);
        document.getElementById("jadwal-sholat").innerHTML =
            '<p class="text-red-500 text-sm">Gagal memuat jadwal sholat.</p>';
    }
}
