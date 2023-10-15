<div class="content-body clinic-list-page">
    <div class="container">
        <div class="page-title">
            <h1>Daftar Klinik</h1>
        </div>

        <div class="page-content-card">
            <div class="clinics-wrapper">
                <button id="get-data-triggered" style="display: none" wire:click='getData'>Click</button>
                @foreach ($clinics as $clinic)
                    <div wire:key='card-{{ $clinic->id }}' class="clinic-card">
                        <div class="clinic-info-wrapper">
                            <span class="clinic-name">{{ $clinic->name }}</span>
                            <span class="hours">{{ getHoursMinutes($clinic->open_time) }} - {{ getHoursMinutes($clinic->closed_time) }}</span>
                            <div class="button-wrapper">
                                <a wire:navigate href="{{ route('admin.edit-clinic', ['id' => $clinic->id]) }}" class="a-button-box">
                                    <button class="btn edit-button ico hovered">
                                        <i class="fa-solid fa-pen"></i>
                                        <span>Edit</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="clinic-map-wrapper">
                            <div wire:ignore id="map-clinic-{{ $clinic->id }}" class="clinic-map"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div wire.ingore class="pagination-wrapper">
                {{ $clinics->links() }}
            </div>
        </div>

        
    </div>

    
    <script>
        function generateMap(mapId, title, lat, long) {
            var map = new google.maps.Map(document.getElementById(mapId), {
                zoom: 15,
                center: { lat: lat, lng: long },
            });
            // Create the initial InfoWindow.
            let infoWindow1 = new google.maps.InfoWindow({
                content: title,
                position: { lat: lat, lng: long },
            });
            infoWindow1.open(map);
        }

        function initMap() {
            window.addEventListener("render-map", function(data){
                let clinics = data.detail[0]

                clinics.forEach(clinic => {
                    generateMap("map-clinic-"+clinic.id, clinic.name, parseFloat(clinic.lat), parseFloat(clinic.long))
                });
            });
        }

    </script>

    @teleport('script')
    <script>
        $(document).ready(function () {
            $('#get-data-triggered').click()
        })
        
        $(window).on('changed-page', function () {
            $('#get-data-triggered').click()
        })
    </script>
    @endteleport

        
    
</div>