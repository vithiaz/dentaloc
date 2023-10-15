<div class="content-body add-news-page">
    <div class="container">
        <div class="page-title">
            <h1>Edit Berita</h1>
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
                <input wire:model='image' type="file" id="news-image-upload" name="image_upload" style="display: none">
                @if ($this->image_state_changed)
                    <div class="image-container">
                        <div onclick="uploadImage()" class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ $this->image->temporaryUrl() }}" alt="{{ $this->title }}-image">
                    </div>                    
                @else
                    <div class="image-container">
                        <div onclick="uploadImage()" class="hover-overlay">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <img src="{{ asset('storage/'.$this->image) }}" alt="{{ $this->title }}-image">
                    </div>                    
                @endif
            </div>

            <div wire:ignore class="editor-container">
                <div id="editor">{!! $this->body !!}</div>
            </div>

            <button id="add-news-form-btn" type="submit" style="display: none">add</button>
        </form>


        <div class="page-content-card">
            <div class="button-wrapper">
                <button onclick="submitNewsForm()" class="btn submit-button ico">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>

    </div>

    @push('script')
    <script>
        function submitNewsForm() {
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