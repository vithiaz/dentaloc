<div class="">

    @push('map-container')
        <div class="mapbox-container">
            <div id="mapbox" class="map-object">
            </div>
        </div>
    @endpush

    @teleport('#main-navbar .container')
        <div class="description-box-shadow">
            <div class="description-box">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, magni ullam voluptates officiis ipsam sit veritatis dolore explicabo doloremque dignissimos.</p>
            </div>
        </div>
    @endteleport

    <div class="homepage">
        <section class="clinic-list">
            <div class="container">
                <h1 class="section-title">DAFTAR KLINIK</h1>
                <div class="swiper clinicSwiper">
                    <div class="swiper-wrapper">
                        @forelse ($this->Clinic as $clinic)
                            <a href="{{ route('clinic-detail', ['id' => $clinic['id'] ]) }}" class="swiper-slide clinic-card">
                                <i class="fa-solid fa-house-chimney-medical main-icon"></i>
                                <div class="desc-wrapper">
                                    <span class="clinic-name">{{ $clinic['name'] }}</span>
                                    <span class="hours">{{ getHoursMinutes($clinic['open_time']) }} - {{ getHoursMinutes($clinic['closed_time']) }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="swiper-slide clinic-card">
                                <i class="fa-solid fa-exclamation"></i>
                                <div class="desc-wrapper">
                                    <span class="clinic-name">Belum ada Klinik Terdaftar ...</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="product-swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section class="description" style="background-image: url({{ asset('image/clinic_background.jpg') }})">
            <div class="container">
                <div class="row-wrapper">
                    <div class="description-wrapper">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni illo dolor nostrum nobis accusamus, ipsam tempore quaerat ut commodi, delectus quae suscipit atque a fugiat! Culpa ex culpa nisi dolor cupidatat cillum adipisicing sint magna elit id exercitation id ut. Nisi et sit excepteur ea excepteur.</p>
                        <p>Sit do magna excepteur eu nulla enim laboris Lorem adipisicing. Irure incididunt amet laboris ut aliqua ad tempor.</p>
                    </div>
                    <div class="image-wrapper">
        
                    </div>
                </div>
            </div>
        </section>

        {{-- ss --}}
        <livewire:homepage-news />

    </div>


    @push('script')
    <script>
        function createInfoWindow(map, lat, lng, name) {
            let infoWindow = new google.maps.InfoWindow({
                content: name,
                position: { lat, lng },
            });
            const marker = new google.maps.Marker({
                position: { lat, lng },
                map,
                title: name,
            });
            marker.addListener("click", () => {
                infoWindow.open(map);
            })

        }
        function initMap() {
            const centerLatLong = { lat: 1.4720661476891193, lng: 124.84264583707038 };
            const map = new google.maps.Map(document.getElementById("mapbox"), {
                zoom: 13,
                center: centerLatLong,
            });
            // Create the initial InfoWindow.
            $(document).ready(function () {
                @this.Clinic.forEach(clinic => {
                    createInfoWindow(map, parseFloat(clinic.lat), parseFloat(clinic.long), clinic.name)
                });
            })
        }
        window.initMap = initMap;




        // handle description box shadow
        function checkDescBoxIsWrapped() {
            var flexChild = $('.description-box-shadow');
            var parentWidth = flexChild.parent().width();
            var childWidth = flexChild.width();

            if (childWidth >= parentWidth) {
                return true
            } else {
                return false
            }
        }
        function handleMapDesriptionBox() {
            let mapBoxDesc = $('.description-box')

            if (checkDescBoxIsWrapped()) { 
                mapBoxDesc.css('transform', 'translateY(-100%)')
                mapBoxDesc.css('min-height', 'unset')
            } else {
                mapBoxDesc.css('transform', 'translateY(-50%)')
                mapBoxDesc.css('min-height', '220px')
            }
            checkDescBoxIsWrapped()
        }

        // Swiper
        var HeroProductSwiper = new Swiper(".clinicSwiper",
        {
            slidesPerView: 4,
            spaceBetween: 20,
            slidesPerGroup: 4,
            loop: false,
            loopFillGroupWithBlank: true,
            pagination: {
                el: ".product-swiper-pagination",
                clickable: true,
            },
            // navigation: {
            //     nextEl: ".swipe-next-btn",
            //     prevEl: ".swipe-prev-btn",
            // },
            breakpoints: {
                    0: {
                        slidesPerView: 1,
                        slidesPerGroup: 1,
                    },
                    430: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                    },
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 3,
                    },
                    1200: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                }
        });

        $( document ).ready(() => {
            handleMapDesriptionBox()
        })

        $( window ).resize(() => {
            handleMapDesriptionBox()        
        })
        
        
    </script>
    @endpush
</div>