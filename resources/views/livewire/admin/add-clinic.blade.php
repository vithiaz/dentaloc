<div class="content-body add-clinic-page">
    <div class="container">
        <div class="page-title">
            <h1>Tambah Klinik</h1>
        </div>

        <div class="page-title secondary">
            <h1>Informasi Klinik</h1>
        </div>
        <div class="page-content-card">
            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row">
                        <span class="form-title">Nama Klinik</span>
                        <div class="form-items">
                            <input wire:model='name' class="form-input-default" type="text" placeholder="Nama">
                            @error('name')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row">
                        <span class="form-title">Jam Buka</span>
                        <div class="form-items row">
                            <input wire:model='open_time' class="form-input-default" type="time">
                            <span class="separator-line">-</span>
                            <input wire:model='closed_time' class="form-input-default" type="time">
                            @error('open_time')
                                <small class="error">{{ $message }}</small>
                            @enderror
                            @error('closed_time')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row top-align">
                        <span class="form-title">Deskripsi</span>
                        <div class="form-items">
                            <textarea wire:model='description' class="form-input-default" type="text" placeholder="Deskripsi klinik ..."></textarea>
                            @error('description')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row">
                        <span class="form-title">Lokasi (Long / Lat)</span>
                        <div class="form-items row">
                            <input wire:model='long' class="form-input-default" type="text" placeholder="longitude">
                            <span class="separator-line">/</span>
                            <input wire:model='lat' class="form-input-default" type="text" placeholder="latitude">
                            @error('long')
                                <small class="error">{{ $message }}</small>
                            @enderror
                            @error('lat')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>            
            <div class="map-container">
                <div wire:ignore id="map"></div>
            </div>
            
            <div class="image-uploads-container">
                <input wire:model='images' id="image-upload-input" type="file" name="image_upload" style="display: none" multiple>
                <div onclick="uploadClinicImages()" id="image-upload-triggered" class="image-container">
                    <i class="fa-solid fa-images"></i>
                    <span>upload gambar</span>
                </div>
                
                @foreach ($this->image_uploads as $index=>$image)
                    <div wire:key="{{ $index }}" class="image-container">
                        <div wire:click='remove_uploaded_images({{ $index }})' class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ $image->temporaryUrl() }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>

        
        <section class="page-content-card doctors">
            <div class="section-wrapper registered-card-wrapper">
                <div class="wrapper-head">
                    <span class="title">Dokter Terdaftar</span>
                </div>
                
                <div class="wrapper-wrap">
                    @forelse ($this->listed_doctor as $doctor)                        
                        <div wire:key='listed-doctor-{{ $doctor['doctor_id'] }}' class="doctor-card">
                            <div class="image-container">
                                @if ($this->get_doctor_info($doctor['doctor_id'])->image)
                                    <img src="{{ asset('storage/'.$this->get_doctor_info($doctor['doctor_id'])->image) }}" alt="">
                                @else
                                    <div class="no-image">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="details-container">
                                <span class="name">{{ $this->get_doctor_info($doctor['doctor_id'])->name }}</span>
                                <span class="hours">{{ $doctor['start_hours'] }} - {{ $doctor['end_hours'] }}</span>
                            </div>
                            <div class="button-container">
                                <button wire:click="pop_listed_doctor({{ $doctor['doctor_id'] }})" class="btn delete-btn hovered">
                                    <i class="fa-solid fa-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="doctor-card">
                            <div class="image-container">
                                <div class="no-image">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                            <div class="details-container">
                                <div class="name">Tidak ada dokter</div>
                            </div>
                            <div class="button-container">
                                
                            </div>
                        </div>
                    @endforelse
                    
                </div>
            </div>

            {{-- Doctor List --}}
            <livewire:admin.components.add-doctor.doctor-list />

        </section>


        <div class="page-content-card">
            <div class="button-wrapper">
                <button wire:click='store_clinic' class="btn submit-button ico">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Klinik</span>
                </button>
            </div>
        </div>


    </div>


    <script>
        function uploadClinicImages() {
            $('#image-upload-input').click()
        }

        function initMap() {
            const centerLatLong = { lat: 1.4720661476891193, lng: 124.84264583707038 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: centerLatLong,
            });

            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click di map untuk menentukan long/lat",
                position: { lat: 1.4770769994479105, lng: 124.84425944772731 },
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    '<span>lng: '+mapsMouseEvent.latLng.toJSON().lng+'</span><br>'+
                    '<span>lat: '+mapsMouseEvent.latLng.toJSON().lat+'</span>'
                );
                infoWindow.open(map);


                @this.long = mapsMouseEvent.latLng.toJSON().lng
                @this.lat = mapsMouseEvent.latLng.toJSON().lat

            });
        }

        window.initMap = initMap;
    </script>
    
</div>