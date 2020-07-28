@php
    $set ??= $card->currentSet->first();
    $rarity ??= $card->getRarity($user ?? null);
    $fullart ??= ($rarity === 'Extraordinary' || $rarity === 'Fabulous');
@endphp
<div class="card {{ ($fullart ? 'card-fullart' : '') }} card-{{ $card->type }}">
    <div class="card-container">
        <div class="card-overlay"></div>
        <div
            class="card-image"
            @if ($fullart && $card->animatedAttachment)
                style="background-image: url({{ $card->animatedAttachment->format('card') }})"
            @else
                style="background-image: url({{ $card->attachment->format('card') }})"
            @endif
        ></div>

        <div class="card-set-logo" style="background-image: url({{ $set->icon->path() }})"></div>

        <div class="card-data">
            <div class="card-data-cost"><span>{{ $card->cost }}</span></div>
            <div class="card-data-name"><span>{{ $card->name }}</span></div>
            <div class="card-data-rarity"><x-card.card-types :card="$card" :rarity="$rarity" /></div>
            <div class="card-data-power"><span>{{ $card->power }}</span></div>
            <div class="card-data-text"><span>{{ $card->text }}</span></div>
        </div>
    </div>
</div>
