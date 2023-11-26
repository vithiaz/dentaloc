<div class="clinic-detail-page">
    @push('stylesheet')
        <link rel="stylesheet" href="{{ asset('css/clinic-detail-page.css') }}">
    @endpush

    <section id="map" class="map-hero-container"></section>

    <section class="info-body-container">
        <div class="container info-body-wrapper">
            <div class="image-wrapper">
                <div id="image-display" class="image-container">
                    <img src="" class="hide" alt="">
                </div>
                <div id="images-list" class="row-wrapper">
                        @foreach ($this->Clinic['images'] as $index=>$image)
                            <div class="image-container">
                                <img src="{{ asset('storage/'.$image['image']) }}" alt="{{ $this->Clinic['name'] }}-profile-{{ $index }}">
                            </div>
                        @endforeach                        
                </div>
            </div>
            <div class="info-wrapper">
                <span class="page-title">Info Klinik</span>
                <h1 class="clinic-name">{{ $this->Clinic['name'] }}</h1>
                <span class="operation-time">{{ getHoursMinutes($this->Clinic['open_time']) }} - {{ getHoursMinutes($this->Clinic['closed_time']) }}</span>
                <div class="description">
                    {!! $this->Clinic['description'] !!}
                </div>
            </div>
        </div>
    </section>

    <section class="doctor-list-container">
        <div class="container">
            <span class="page-title">Daftar Dokter</span>
            <div class="doctors-card-wrapper">

                @forelse ($this->Clinic['clinic_doctors'] as $doctor)
                    <x-doctor-card 
                        :id='$doctor["doctor_id"]'
                        :timeStart='$doctor["operation_start"]'
                        :timeEnd='$doctor["operation_end"]'
                    />
                @empty
                    <div class="empty-container">
                        <span>...tidak ada dokter terdaftar</span>
                    </div>
                @endforelse
                
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
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: centerLatLong,
            });
            
            // // Create the initial InfoWindow.
            $(document).ready(function () {
                map.setCenter({ lat: parseFloat(@this.Clinic['lat']), lng: parseFloat(@this.Clinic['long']) });
                createInfoWindow(map, parseFloat(@this.Clinic.lat), parseFloat(@this.Clinic.long), @this.Clinic.name)
            })
        }
        window.initMap = initMap;

        
        
        // Handle Image Display
        let displayUrl = ''
        function setDisplayImage(displayUrl) {
            let imageDisplay = $('#image-display img')
            if (displayUrl) {
                imageDisplay.removeClass('hide')
                imageDisplay.attr('src', displayUrl)
            }
        }
        // Handle Focus Image
        function handleFocusImage() {
            $('#images-list .image-container').each(function () {
                let imageObj = $( this ).find('img')
                
                if ( imageObj.attr('src') == displayUrl ) {
                    $( this ).addClass('focus')
                } else {
                    $( this ).removeClass('focus')
                }
            })
        }
        
        // handle image list click
        $('#images-list .image-container').click(function() {
            let imageSrc = $( this ).find('img').attr('src')
            displayUrl = imageSrc
            
            setDisplayImage(imageSrc)
            handleFocusImage()
        })
        
        $( document ).ready(function () {
            displayUrl = $('#images-list .image-container img').first().attr('src')
            
            setDisplayImage(displayUrl)
            handleFocusImage()
        })

    </script>
    @endpush


</div>
