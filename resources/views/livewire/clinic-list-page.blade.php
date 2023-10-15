<div class="clinic-list-page">
    @push('stylesheet')
        <link rel="stylesheet" href="{{ asset('css/clinic-list-page.css') }}">
    @endpush

    <section class="map-layer-container">
        <div wire:ignore id="mapbox"></div>
        <div class="page-title">
            <span class="section-title">
                DAFTAR KLINIK
            </span>
        </div>
    </section>

    <section class="clinic-list">
        <div class="container">
            <div class="head-container">
                <div class="search-container">
                    <div class="input-form">
                        <input wire:model.live='search' type="text" class="default-input" name="search" id="clinic-search" placeholder="Cari klinik ...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </div>
            <div class="card-row-wrapper">
                <div class="clinic-card-wrapper">
                    @forelse ($clinic_filter as $clinic)
                        <a href="{{ route('clinic-detail', ['id' => $clinic->id ]) }}" class="clinic-card">
                            <i class="fa-solid fa-house-chimney-medical main-icon"></i>
                            <div class="desc-wrapper">
                                <span class="clinic-name">{{ $clinic->name }}</span>
                                <span class="hours">{{ getHoursMinutes($clinic->open_time) }} - {{ getHoursMinutes($clinic->closed_time) }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="clinic-card">
                            <i class="fa-solid fa-exclamation"></i>
                            <div class="desc-wrapper">
                                <span class="clinic-name">...</span>
                                <span class="">Klinik tidak ditemukan</span>
                            </div>
                        </div>  
                    @endforelse
                </div>
                <div class="information-wrapper">
                    <span class="info-title">INFORMASI</span>
                    <div class="info-card-wrapper">
                        <div class="information-card">
                            <div class="count">{{ $this->clinic_count }}</div>
                            <div class="label">Total Klinik Terdaftar</div>
                        </div>
                        <div class="information-card">
                            <div class="count">{{ $this->open_clinic_count }}</div>
                            <div class="label">Total Klinik dibuka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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

    </script>
    @endpush

</div>
