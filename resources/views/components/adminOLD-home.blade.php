<div class="flex-1 p-4 md:p-8 overflow-y-auto">

    <header class="header-with-backdrop-blur text-white shadow-md mb-6 rounded-md">
        <div class="w-full h-full py-20 backdrop-blur-[1px] hover:backdrop-brightness-50 duration-500 ease-in-out backdrop-brightness-75 flex flex-col lg:flex-row justify-between items-center rounded-md">
            <h1 class="text-xl font-semibold mb-2 lg:ml-6 sm:mb-0">Al-Aqobah 1</h1>
            <div class="flex items-center">
                <span class="lg:mr-6">Selamat datang, {{ Auth::user()->name }}</span>
            </div>
        </div> 
    </header>

    <style>
        .header-with-backdrop-blur {
            background-image: url('/images/masjid/Pic 5_Al-Aqobah 1.jpg');
            background-size: cover;
            background-position-y: 50%;
        }
    </style>

{{-- <div class="text-white shadow-md mb-6 overflow-hidden rounded-md">
    <div class="header-with-backdrop-blur hover:scale-105 duration-500 ease-in-out">
        <div class="w-full h-full py-20 backdrop-blur-[1px] backdrop-brightness-75 flex flex-col lg:flex-row justify-between items-center">
            <h1 class="text-xl font-semibold mb-2 sm:mb-0">Al-Aqobah 1</h1>
            <div class="flex items-center">
                <span class="mr-4">Selamat datang, {{ Auth::user()->name }}</span>
            </div>
        </div> 
    </div>
</div>

<style>
    .header-with-backdrop-blur {
        background-image: url('/images/masjid/Pic 5_Al-Aqobah 1.jpg');
        background-size: cover;
        background-position-y: 30%;
    }
</style> --}}
    

          
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-3">
         <a href="#jadwal-hari-ini" id="scroll-ke-hari-ini" class="bg-white shadow-md rounded-md p-6 hover:bg-green-200 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Jadwal Hari Ini</h3>
                @if($jadwalHariIni->isEmpty())
                    <p class="text-gray-600 text-sm">Tidak ada jadwal hari ini.</p>
                @else
                    <div class="text-2xl font-bold text-blue-500">{{ $jadwalHariIni->count() }}</div>
                    @if($jadwalHariIni->count() > 0)
                        @php
                            $jadwalTerdekat = $jadwalHariIni->sortBy('jam_mulai')->first();
                            $jadwalMingguSelanjutnyaTerdekat = $jadwalHariIni->sortBy('jam_mulai')->skip(1)->first();
                        @endphp
                        <p class="text-gray-600 text-sm mt-1">
                            Terdekat: {{ \Carbon\Carbon::parse($jadwalTerdekat->jam_mulai)->format('H:i') }} WIB
                            @if($jadwalMingguSelanjutnyaTerdekat)
                                <br>Selanjutnya: {{ \Carbon\Carbon::parse($jadwalMingguSelanjutnyaTerdekat->jam_mulai)->format('H:i') }} WIB
                            @endif
                        </p>
                    @endif
                @endif
        </a>

        <a href="#jadwal-minggu-depan" id="scroll-ke-minggu-ini" class="bg-white shadow-md rounded-md p-6 hover:bg-orange-200 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Jadwal Belum Terlaksana</h3>
            <div class="text-2xl font-bold text-blue-500">{{ $jadwalBelumTerlaksanaCount }}</div>
        </a>
        <a href="#jadwal-sudah-terlaksana" id="scroll-ke-sudah-terlaksana" class="bg-white shadow-md rounded-md p-6 hover:bg-blue-200 hover:shadow-lg transition duration-300">
            <h3 class="text-lg font-semibold mb-2">Jadwal Sudah Terlaksana</h3>
            <div class="text-2xl font-bold text-green-500">{{ $jadwalSudahTerlaksanaCount }}</div>
        </a>
        <div class="bg-white shadow-md rounded-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Jadwal</h3>
            <div class="text-2xl font-bold text-gray-500">{{ $totalJadwalCount }}</div>
        </div>
        <div></div>
    </div>





    {{-- <section class=" flex flex-col gap-10 w-full justify-center">
        <h1 class='text-2xl text-center font-sans uppercase font-bold text-gray-700'>Image Cards</h1>
        <p class="text-center">Each of the cards have texts decsriptions, which get displayed when you hover the images. Just some dummy texts.</p>
        <section class=" flex flex-wrap gap-10 w-full justify-center items-center ">
          <div class="relative group w-80">
                      <span class="flex flex-col justify-center items-center">
                          <img
                              src="https://cdn.pixabay.com/photo/2020/02/23/15/09/woman-4873600_960_720.jpg"
                              alt="Sample"
                              class="w-full h-full object-cover rounded-lg"
                          />
                          <h1 class="-mt-16 text-xl font-bol bg-black opacity-75 w-full py-5 text-center">HOVER THE IMAGE ONE</h1>
                      </span>
                      <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-5 text-center font-sans">
                          <h2 class="text-xl font-sans font-bold text-gray-100">JUST BEFORE TAKE-OFF</h2>
                          <p class="text-gray-50 text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit autem quaerat explicabo, voluptatum, assumenda placeat reiciendis aliquid itaque voluptates facere odit laboriosam, exercitationem aperiam labore dolorem quasi quia minima. Fugiat maxime, molestias molestiae aliquid animi quas voluptas natus sequi iusto atque placeat, suscipit, voluptatem laborum libero sit fuga deserunt accusamus!</p>
                      </div>
          </div>
          <div class="relative group w-80 ">
                      <span class="flex flex-col justify-center items-center">
                          <img
                              src="https://cdn.pixabay.com/photo/2020/09/20/16/27/model-5587623_960_720.jpg"
                              alt="Sample"
                              class="w-full h-full object-cover rounded-lg"
                          />
                          <h1 class="-mt-10 text-xl font-bol bg-black w-full py-2 text-center">HOVER THE IMAGE TWO</h1>
                      </span>
                      <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-5 text-center font-sans">
                          <h2 class="text-xl font-sans font-bold text-gray-100">JUST BEFORE TAKE-OFF</h2>
                          <p class="text-gray-50 text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit autem quaerat explicabo, voluptatum, assumenda placeat reiciendis aliquid itaque voluptates facere odit laboriosam, exercitationem aperiam labore dolorem quasi quia minima. Fugiat maxime, molestias molestiae aliquid animi quas voluptas natus sequi iusto atque placeat, suscipit, voluptatem laborum libero sit fuga deserunt accusamus!</p>
                      </div>
          </div>
          <div class="relative group w-80">
                      <span class="flex flex-col justify-center items-center">
                          <img
                              src="https://cdn.pixabay.com/photo/2019/12/10/13/31/woman-4685862_960_720.jpg"
                              alt="Sample"
                              class="w-full h-full object-cover rounded-lg"
                          />
                          <h1 class="-mt-10 text-xl font-bol bg-black w-full py-2 text-center">HOVER THE IMAGE THREE</h1>
                      </span>
                      <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-5 text-center font-sans">
                          <h2 class="text-xl font-sans font-bold text-gray-100">JUST BEFORE TAKE-OFF</h2>
                          <p class="text-gray-50 text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit autem quaerat explicabo, voluptatum, assumenda placeat reiciendis aliquid itaque voluptates facere odit laboriosam, exercitationem aperiam labore dolorem quasi quia minima. Fugiat maxime, molestias molestiae aliquid animi quas voluptas natus sequi iusto atque placeat, suscipit, voluptatem laborum libero sit fuga deserunt accusamus!</p>
                      </div>
          </div>
        </section>
      </section> --}}

      





    {{-- <div class="max-w-2xl mx-auto">

        <div id="default-carousel" class="relative rounded-lg overflow-hidden shadow-lg" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-80 md:h-96" data-carousel-inner>
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                        class="object-cover w-full h-full" alt="Slide 1">
                    <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-xl font-semibold text-white md:text-2xl dark:text-gray-800">First Slide</span>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg"
                        class="object-cover w-full h-full" alt="Slide 2">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg"
                        class="object-cover w-full h-full" alt="Slide 3">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 -translate-x-1/2 space-x-2" data-carousel-indicators>
                <button type="button" class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="flex absolute top-1/2 left-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                data-carousel-prev>
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button type="button"
                class="flex absolute top-1/2 right-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                data-carousel-next>
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
  
        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    
    </div> --}}


    {{-- <div class="min-h-screen flex flex-col p-8 sm:p-16 md:p-24 justify-center bg-white">
        <!-- Themes: blue, purple and teal -->
        <div data-theme="teal" class="mx-auto max-w-6xl">
          <h2 class="sr-only">Featured case study</h2>
          <section class="font-sans text-black">
            <div class="[ lg:flex lg:items-center ] [ fancy-corners fancy-corners--large fancy-corners--top-left fancy-corners--bottom-right ]">
              <div class="flex-shrink-0 self-stretch sm:flex-basis-40 md:flex-basis-50 xl:flex-basis-60">
                <div class="h-full">
                  <article class="h-full">
                    <div class="h-full">
                      <img class="h-full object-cover" src="https://inviqa.com/sites/default/files/styles/pullout/public/2020-08/XD-1.jpeg?h=f75d236a&itok=PBoXPDmW" width="733" height="412" alt='""' typeof="foaf:Image" />
                    </div>
                  </article>
                </div>
              </div>
              <div class="p-6 bg-grey">
                <div class="leading-relaxed">
                  <h2 class="leading-tight text-4xl font-bold">CXcon: Experience Transformation</h2>
                  <p class="mt-4">Our second CXcon in October was dedicated to experience transformation. The free one-day virtual event&nbsp;brought together 230+ heads of digital, thought leaders, and UX practitioners to discuss all aspects of experience design..</p>
                  <p class="mt-4">In a jam-packed day filled with keynote sessions, panels, and virtual networking we explored topics including design leadership, UX ethics, designing for emotion and innovation at scale.</p>
                  <p><a class="mt-4 button button--secondary" href="https://inviqa.com/cxcon-experience-transformation">Explore this event</a></p>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div> --}}

    
    
      
    




    {{-- <!-- component -->
    <div class="gallery border-2 rounded mx-auto m-5 bg-white shadow-md w-full max-w-lg lg:max-w-2xl">
    <div class="top flex p-2 border-b select-none">
        <div class="heading text-gray-800 w-full pl-3 font-semibold my-auto"></div>
        <div class="buttons ml-auto flex text-gray-600 mr-1">
        <svg action="prev" class="w-7 border-2 rounded-l-lg p-1 cursor-pointer border-r-0"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path action="prev" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <svg action="next" class="w-7 border-2 rounded-r-lg p-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path action="next" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
        </div>
    </div>
    <div class="content-area w-full overflow-hidden aspect-[3/2]">
        <div class="bg-blue-500 platform shadow-xl flex aspect-[3/2]">

            <div class="bg-red-500 each-frame border-box flex-none object-center aspect-[3/2] h-full" title="Al-Aqobah 1">
                <img src="/images/No Image.png" alt="Al-Aqobah 1" class="aspect-[3/2] object-cover object-center rounded-md shadow-md">
            </div>

            <div class="each-frame border-box flex-none object-center aspect-[3/2]" title="Al-Aqobah 1">
                <img src="/images/No Image.png" alt="Al-Aqobah 1" class="aspect-[3/2] object-cover object-center rounded-md shadow-md">
            </div>

            <div class="each-frame border-box flex-none object-center aspect-[3/2]" title="Al-Aqobah 1">
                <img src="/images/No Image.png" alt="Al-Aqobah 1" class="aspect-[3/2] object-cover object-center rounded-md shadow-md">
            </div>

        </div>
    </div>
    </div>

    <style>
        .platform {
            position: relative;
            transition: right 0.3s;
        }
    </style>

    <script>
       function gallery(){
    this.index=0;
    this.load=function(){
        this.rootEl = document.querySelector(".gallery");
        this.platform = this.rootEl.querySelector(".platform");
        this.frames = this.platform.querySelectorAll(".each-frame");
        this.contentArea = this.rootEl.querySelector(".content-area");
        this.width = this.rootEl.offsetWidth;
        this.frameWidth = this.width; // Simpan lebar frame
        this.limit = {start:0,end:this.frames.length-1};
        this.frames.forEach(each=>{each.style.width=this.frameWidth+"px";});
        this.goto(this.index);
    }
    this.set_title = function(){this.rootEl.querySelector(".heading").innerText=this.frames[this.index].getAttribute("title");}
    this.next = function(){this.platform.style.right=this.frameWidth * ++this.index + "px";this.set_title();}
    this.prev = function(){this.platform.style.right=this.frameWidth * --this.index + "px";this.set_title();}
    this.goto = function(index){this.platform.style.right = this.frameWidth * index + "px";this.index=index;this.set_title();}
    this.load();
}
var G = new gallery();
G.rootEl.addEventListener("click",function(t){
    var val = t.target.getAttribute("action");
    if(val == "next" && G.index != G.limit.end){G.next();}
    if(val == "prev" && G.index != G.limit.start){G.prev();}
    if(val == "goto"){
        let rv = t.target.getAttribute("goto");
        rv = rv == "end" ? G.limit.end:rv;
        G.goto(parseInt(rv));
    }
});
document.addEventListener("keyup",function(t){
    var val = t.keyCode;
    if(val == 39 && G.index != G.limit.end){G.next();}
    if(val == 37 && G.index != G.limit.start){G.prev();}
});
    </script> --}}

    <section class="bg-white shadow-md rounded-md">
        <div class="py-4 px-2 mx-auto max-w-screen-xl sm:px-4 lg:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 h-full">
                <div class="col-span-2 sm:col-span-2 bg-gray-50 h-[20rem] lg:h-full flex flex-col">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow">
                        <img src="/images/masjid/Pic 1_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl">Al-Aqobah 1</h3>
                    </a>
                </div>
                <div class="col-span-2 md:col-span-1 lg:col-span-2 bg-stone-50">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 mb-4 h-[15rem] md:h-auto">
                        <img src="/images/masjid/Pic 4_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 6g-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl">PT. PUSRI</h3> --}}
                    </a>
                    <div class="grid gap-4 grid-cols-2 md:grid-cols-2 lg:grid-cols-2 h-[20rem] md:h-auto">
                        <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40">
                            <img src="/images/masjid/Pic 2_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                        </a>
                        <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40">
                            <img src="/images/masjid/Pic 8_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                            {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                        </a>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-2 md:col-span-1 bg-sky-50 h-[15rem] md:h-full flex flex-col">
                    <a href="" class="group relative flex flex-col overflow-hidden rounded-lg px-4 pb-4 pt-40 flex-grow">
                        <img src="/images/masjid/Pic 11_Al-Aqobah 1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/25 to-gray-900/5"></div>
                        {{-- <h3 class="z-10 text-2xl font-medium text-white absolute top-0 left-0 p-4 xs:text-xl md:text-3xl"></h3> --}}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="columns-1 md:columns-2 xl:columns-3 gap-7 my-10">
        <div class=" break-inside-avoid mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031162.jpg" alt="Gallery image" />
        </div>
        <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031232.jpg" alt="Gallery image" />
        </div>
        <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031357.jpg" alt="Gallery image" />
        </div>
        <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031375.jpg" alt="Gallery image" />
        </div>
        <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031396.jpg" alt="Gallery image" />
        </div>
        <div class=" break-inside-avoid  mb-8">
        <img class="h-auto max-w-full rounded-lg" src="https://pagedone.io/asset/uploads/1688031414.png" alt="Gallery image" />
        </div>
    </div> --}}


    


    
    {{-- <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 lg:max-w-2xl mx-auto mb-10">
        <div class="row-span-1 col-span-1">
            <img src="/images/No Image.png" alt="Foto 1" class="w-full h-full object-cover rounded-md shadow-md">
        </div>
        <div class="row-span-1 col-span-1">
            <img src="/images/No Image.png" alt="Foto 2" class="w-full h-full object-cover rounded-md shadow-md">
        </div>
        <div class="row-span-2 col-span-1">
            <img src="/images/No Image.png" alt="Foto 3" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-3 col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-1 col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-3 col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-2 col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-1 col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

        <div class="row-span-1 col-span-2 lg:col-span-1">
            <img src="/images/No Image.png" alt="Foto 4" class="w-full h-full object-cover rounded-md shadow-md">
        </div>

    </div> --}}





    <div id="jadwal-hari-ini" class="scroll-mt-20 my-6 bg-white shadow-md rounded-md p-6">
        <h3 class="text-lg font-semibold mb-2">Jadwal Hari Ini</h3>
        @if($jadwalHariIni->isEmpty())
            <p class="text-gray-600 text-sm">Tidak ada jadwal hari ini.</p>
        @else
            <div class="grid grid-cols-1 gap-4 pt-4">
                @foreach($jadwalHariIni as $jadwal)
                    <div class="rounded-md overflow-hidden hover:bg-gray-100 hover:shadow-lg transition duration-300 group">
                        <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block">
                            <div class="flex sm:flex-row flex-col items-start">
                                @if($jadwal->gambar)
                                    <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full sm:w-32 h-32 object-cover rounded-md sm:mr-4 mb-2 sm:mb-0">
                                @else
                                    <div class="w-full sm:w-32 h-32 bg-gray-100 flex items-center justify-center text-gray-500 rounded-md sm:mr-4 mb-2 sm:mb-0">Tidak Ada Gambar</div>
                                @endif
                                <div class="pt-0 pb-5 pl-4 sm:pl-0 sm:pt-5">
                                    <h3 class="font-semibold text-lg group-focus:underline">{{ $jadwal->judul_ceramah }}</h3>
                                    <p class="text-gray-600 text-sm group-focus:underline">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                                    <p class="text-gray-500 text-sm group-focus:underline">{{ $jadwal->nama_ustadz }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="jadwal-minggu-ini" class="scroll-mt-20 mb-8">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Ini</h2>
        @if($jadwalMingguIni->isEmpty())
            <p>Tidak ada jadwal untuk minggu ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($jadwalMingguIni as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Depan</h2>
        @if($jadwalMingguDepan->isEmpty())
            <p>Tidak ada jadwal untuk minggu depan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($jadwalMingguDepan as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal Minggu Selanjutnya</h2>
        @if($jadwalMingguSelanjutnya->isEmpty())
            <p>Tidak ada jadwal minggu selanjutnya.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($jadwalMingguSelanjutnya as $jadwal)
                    <a href="{{ route('admin.schedules.show', $jadwal->slug) }}" class="block bg-white rounded-md shadow-md overflow-hidden hover:scale-105 hover:shadow-lg  transition duration-300">
                        @if($jadwal->gambar)
                            <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">Tidak Ada Gambar</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $jadwal->judul_ceramah }}</h3>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} WIB</p>
                            <p class="text-gray-500 text-sm">{{ $jadwal->nama_ustadz }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
    
            {{ $jadwalMingguSelanjutnya->links() }}
        @endif
    </div>

    <div id="jadwal-sudah-terlaksana" class="scroll-mt-20 my-8">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-200 pb-2">Jadwal yang Sudah Terlaksana</h2>
        @if($jadwalSudahTerlaksana->isEmpty())
            <p>Tidak ada jadwal untuk minggu lalu.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-md shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ustadz</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwalSudahTerlaksana as $jadwal)
                        <tr onclick="window.location='{{ route('admin.schedules.show', $jadwal->slug) }}'" class="cursor-pointer hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($jadwal->gambar)
                                        <img src="{{ asset($jadwal->gambar) }}" alt="{{ $jadwal->judul_ceramah }}" class="max-w-40 rounded">
                                    @else
                                        <span class="text-gray-500 text-sm">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->judul_ceramah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->nama_ustadz }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->tanggal_ceramah)->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tempat_ceramah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="mt-4">
                {{ $jadwalSudahTerlaksana->links() }}
            </div>
        @endif
    </div>

    <div>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollLinks = [
            { id: 'scroll-ke-hari-ini', target: '#jadwal-hari-ini' },
            { id: 'scroll-ke-minggu-ini', target: '#jadwal-minggu-ini' },
            { id: 'scroll-ke-sudah-terlaksana', target: '#jadwal-sudah-terlaksana' }
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