<nav class="main-nav">
    <h1>GRAAHK</h1>
    <ul>
        <x-nav.item
            route="{{ route('static.home') }}"
            text="Home"
        />

        @auth
            <x-nav.item
                route="{{ route('decks.index') }}"
                text="Decks"
            />

            {{-- <x-nav.item
                route="{{ route('game.browser') }}"
                text="Browser"
            /> --}}
        @endauth

        <x-nav.item
            route="{{ route('news.index') }}"
            text="News"
        />

        @if (optional(auth()->user())->admin)
            <x-nav.item
                route="{{ route('admin.index') }}"
                text="Admin"
            />
        @endif
    </ul>
</nav>
