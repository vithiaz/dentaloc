<div class="content-body add-doctor-page">
    <div class="container">
        <div class="page-title">
            <h1>Edit Dokter</h1>
        </div>

        <div class="page-title secondary">
            <h1>Informasi Dokter</h1>
        </div>
        <form wire:submit='store_doctor' id="add-doctor-form" class="page-content-card" enctype="multipart/form-data">
            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row">
                        <span class="form-title">Nama Lengkap</span>
                        <div class="form-items">
                            <input wire:model='name' class="form-input-default" type="text" placeholder="nama lengkap dengan gelar">
                            @error('name')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-uploads-container">
                <input wire:model='image' type="file" id="doctor-image-upload" name="image_upload" style="display: none">
                @if ($this->image_state_changed)
                    <div class="image-container">
                        <div onclick="uploadImage()" class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ $this->image->temporaryUrl() }}" alt="{{ $this->name }}-profile">
                    </div>                    
                @else
                    <div class="image-container">
                        <div onclick="uploadImage()" class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ asset('storage/'.$this->image) }}" alt="{{ $this->name }}-profile">
                    </div>                    
                @endif
            </div>

            <button id="add-doctor-form-btn" type="submit" style="display: none">add</button>
        </form>

        
        <div class="page-content-card">
            <div class="button-wrapper">
                <button onclick="submitDoctorForm()" class="btn submit-button ico">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>


    </div>



    @teleport('body')
    <script>

        function submitDoctorForm() {
            $('#add-doctor-form-btn').click()
        }

        function uploadImage() {
            $('#doctor-image-upload').click()
        }

    </script>
    @endteleport
</div>