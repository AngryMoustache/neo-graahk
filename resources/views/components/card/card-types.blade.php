<span>
    @if ($rarity = $card->getRarity()) {{ $rarity }} - @endif
    {{ "$card->tribe $card->type" }}
</span>
