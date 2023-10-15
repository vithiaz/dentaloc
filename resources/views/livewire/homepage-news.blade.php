<section class="news">
    <div class="container">
        <h2 class="section-title">BERITA</h2>
        <div class="news-card-wrapper">
            @forelse ($News as $news)
                <a wire:key='news-card-{{ $news->id }}' href="{{ route('news-detail', ['slug' => $news->title_slug.'-'.$news->id]) }}" wire:key='news-card-{{ $news->id }}' class="news-card">
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
            @empty
                <div class="empty-container">
                    <span>...belum ada berita</span>
                </div>
            @endforelse
        </div>
        <div class="pagination-wrapper">
            {{ $News->links(data: ['scrollTo' => '.news-card-wrapper']) }}
        </div>
    </div>
</section>