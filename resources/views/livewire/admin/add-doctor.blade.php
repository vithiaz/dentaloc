<div class="content-body add-news-page">
    <div class="container">
        <div class="page-title">
            <h1>Tambah Dokter</h1>
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
                @if (!$this->image)
                    <input wire:model='image' type="file" id="doctor-image-upload" name="image_upload" style="display: none">
                    <div onclick="uploadImage()" class="image-container image-upload-triggered">
                        <i class="fa-solid fa-images"></i>
                        <span>upload foto</span>
                    </div>
                @else
                    <div class="image-container">
                        <div wire:click='clear_uploaded_image' class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ $this->image->temporaryUrl() }}" alt="">
                    </div>                    
                @endif
            </div>

            <button id="add-doctor-form-btn" type="submit" style="display: none">add</button>
        </form>

        
        <div class="page-content-card">
            <div class="button-wrapper">
                <button onclick="submitDoctorForm()" class="btn submit-button ico">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Dokter</span>
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