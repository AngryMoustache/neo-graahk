<div class="news-item">
    <div
        class="news-item-image"
        style="background-image: url('{{ optional($item->attachment)->format('newsItem') }}')"
    ></div>
    <div class="news-item-text">
        <h3 class="news-item-title">{{ $item->title }}</h3>

        <div class="news-item-tags">
            @foreach ($item->tags as $tag)
                <x-tag :tag="$tag" />
            @endforeach
        </div>

        <p> {!! nl2br(\Str::limit($item->body, 200)) !!}</p>
        <a href="{{ route('news.show', $item) }}" class="button">Read more >></a>
    </div>
</div>
