<article class="deck-panel">
    <div
        class="deck-panel-preview"
        style="background-image: url({{ optional($deck->displayCard)->format('card') }});"
    ></div>

    <div class="deck-panel-info">
        <h2>{{ $deck->name }}</h2>
        @if ($deck->size !== 30)
            <h3 class="deck-panel-info-warning">
                <i class="fa fa-exclamation-triangle"></i>
                Missing cards: {{ $deck->size }}/30 !
            </h3>
        @else
            <h3>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($deck->created_at))->diffForHumans() }}</h3>
        @endif
    </div>

    <div class="deck-panel-buttons">
        <a class="button" href="{{ route('decks.edit', $deck->slug) }}">
            <i class="fas fa-edit"></i>
            Edit
        </a>
        <a class="button" href="{{ route('decks.duplicate', $deck->slug) }}">
            <i class="fas fa-copy"></i>
            Duplicate
        </a>
        <a class="button" href="{{ route('decks.delete', $deck->slug) }}">
            <i class="fas fa-trash"></i>
            Delete
        </a>
    </div>
</article>
