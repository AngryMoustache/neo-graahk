<nav class="main-nav">
    <h1>GRAAHK</h1>
    <ul>
        <x-nav.item
            route="{{ route('static.home') }}"
            text="Home"
        />
        <x-nav.item
            route="{{ route('decks.index') }}"
            text="Decks"
        />
        @if (optional(auth()->user())->admin)
            <x-nav.item
                route="{{ route('admin.index') }}"
                text="Admin"
            />
        @endif
    </ul>
</nav>
