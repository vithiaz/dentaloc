<div class="content-body add-news-page">
    <div class="container">
        <div class="page-title">
            <h1>Tambah Berita</h1>
        </div>

        <div class="page-title secondary">
            <h1>Detail</h1>
        </div>
        <form wire:submit='store_news' class="page-content-card">
            <div class="row-wrapper">
                <div class="form-wrapper">
                    <div class="form-input-wrapper row">
                        <span class="form-title">Judul</span>
                        <div class="form-items">
                            <input wire:model='title' class="form-input-default" type="text" placeholder="Judul Berita">
                            @error('title')
                                <small class="error">{{ $message }}</small>
                            @enderror
                            @error('body')
                                <small class="error">{{ $message }}</small>
                            @enderror
                            @error('image')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-uploads-container">
                @if (!$this->image)
                    <input wire:model='image' type="file" id="news-image-upload" name="image_upload" style="display: none">
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

            <div wire:ignore class="editor-container">
                <div id="editor"></div>
            </div>

            <button id="add-news-form-btn" type="submit" style="display: none">add</button>
        </form>


        <div class="page-content-card">
            <div class="button-wrapper">
                <button onclick="submitDoctorForm()" class="btn submit-button ico">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Berita</span>
                </button>
            </div>
        </div>

    </div>

    @push('script')
    <script>
        function submitDoctorForm() {
            $('#add-news-form-btn').click()
        }

        function uploadImage() {
            $('#news-image-upload').click()
        }

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
                    ['misc', ['undo', 'redo']],
                ],
                callbacks: {
                    onChange: (contents, $editable) => {
                        @this.set('body', contents);
                    }
                },
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
    @endpush
    
</div>