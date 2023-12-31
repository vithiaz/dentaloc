<div class="content-body add-clinic-page">
    <div class="container">
        <div class="page-title">
            <h1>Edit Klinik</h1>
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
                        <div wire:ignore class="editor-container">
                            <div id="editor">
                                {!! $this->description !!}
                            </div>
                        </div>
                        {{-- <div class="form-items">
                            <textarea wire:model='description' class="form-input-default" type="text" placeholder="Deskripsi klinik ..."></textarea>
                            @error('description')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div> --}}
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

                @foreach ($this->db_images as $index=>$image)
                    @if (!$this->in_listed_delete_state($image['id'], $this->db_images_state_delete, false))
                        <div wire:key="db-image-{{ $index }}" class="image-container">
                            <div wire:click="append_delete_uploaded_image({{ $image['id'] }})" class="hover-overlay">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                            <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $this->name }}-stored-image-{{ $index }}">
                        </div>
                    @endif
                @endforeach
                
                @foreach ($this->image_uploads as $index=>$image)
                    <div wire:key="uploaded-image-{{ $index }}" class="image-container">
                        <div wire:click='remove_uploaded_images({{ $index }})' class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ $image->temporaryUrl() }}" alt="{{ $this->name }}-uploaded-image-{{ $index }}">
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
                    @if (count($this->db_doctors) > 0 || count($this->listed_doctor) > 0)
                        @foreach ($this->db_doctors as $doctor)
                            @if (!$this->in_listed_delete_state($doctor['id'], $this->db_doctor_state_delete, false))
                                <div wire:key='db-doctor-{{ $doctor['id'] }}' class="doctor-card">
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
                                        <button wire:click="append_delete_doctor({{ $doctor['id'] }})" class="btn delete-btn hovered">
                                            <i class="fa-solid fa-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </div>                                
                            @endif

                        @endforeach

                        @foreach ($this->listed_doctor as $doctor)                        
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
                        @endforeach

                    @else
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
                    @endif
                                                        
                </div>
            </div>

            {{-- Doctor List --}}
            <livewire:admin.components.add-doctor.doctor-list />

        </section>


        <div class="page-content-card">
            <div class="button-wrapper">
                <button wire:click='save_changed' class="btn submit-button ico">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>


    </div>


    <script>

        function uploadClinicImages() {
            $('#image-upload-input').click()
        }

        function initMap() {
            window.addEventListener('render-map', function (data) {
                let clinicInfo = data.detail[0]

                const centerLatLong = { lat: parseFloat(clinicInfo.lat), lng: parseFloat(clinicInfo.long) };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 14,
                    center: centerLatLong,
                });
    
                // Create the initial InfoWindow.
                let infoWindow = new google.maps.InfoWindow({
                    content: clinicInfo.name,
                    position: { lat: parseFloat(clinicInfo.lat), lng: parseFloat(clinicInfo.long) },
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
            })


        }

        window.initMap = initMap;
    </script>
    
</div>

@push('script')
<script>

    $(document).ready(function () {
        $('#editor').summernote({
            placeholder: "Berita ...",
            minHeight: 250,

            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontname', 'strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']],
                ['misc', ['undo', 'redo']],
            ],
            callbacks: {
                onChange: (contents, $editable) => {
                    @this.set('description', contents);
                }
            },
        });
        $('.dropdown-toggle').dropdown();
    });
    
</script>
@endpush