<div class="news-detail-page">
    @push('stylesheet')
        <link rel="stylesheet" href="{{ asset('css/news-detail-page.css') }}">
    @endpush


    <section class="news-detail">
        <div class="container">
            <div class="head-wrapper">
                <div class="head-content">
                    <span class="title">Detail Berita</span>

                    <div class="news-title-wrapper">
                        <span class="news-date">{{ convertDateFormat($this->News->created_at, "d-m-Y") }}</span>
                        <h1 class="news-title">{{ $this->News->title }}</h1>
                    </div>
                </div>
                <div class="image-container">
                    @if ($this->News->image)
                        <img src="{{ asset('storage/'.$this->News->image) }}" alt="{{ $this->News->title_slug }}-image">
                    @endif
                </div>
            </div>
            <div class="content-wrapper">
                {!! $this->News->body !!}
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <h2 class="section-title">BERITA LAINNYA</h2>
            <div class="news-card-wrapper">
                @foreach ($this->OtherNews as $news)
                    <a href="{{ route('news-detail', ['slug' => $news->title_slug.'-'.$news->id]) }}" wire:key='news-card-{{ $news->id }}' class="news-card">
                        @if ($news->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}-image">
                            </div>
                        @endif
                        <div class="card-desc">
                            <span class="news-title">{{ $news->title }}</span>
                            <div class="date-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <span class="date">{{ $news->created_at }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>



    



    @teleport('body')
    <script>

    </script>
    @endteleport
</div>
