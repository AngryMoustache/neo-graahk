<div class="card card-{{ $card->type }}">
    <div class="card-container">
        <div class="card-overlay"></div>
        <div class="card-image" style="background-image: url({{ $card->attachment->format('card') }})"></div>
        <div class="card-set-logo" style="background-image: url({{ $card->set->attachment->format('thumb') }})"></div>

        <div class="card-data">
            <div class="card-data-cost"><span>{{ $card->cost }}</span></div>
            <div class="card-data-name"><span>{{ $card->name }}</span></div>
            <div class="card-data-rarity">
                <span>
                    {{ $card->rarity }}
                    {{ $card->type }} -
                    {{ $card->tribe }}
                </span>
            </div>
            <div class="card-data-power"><span>{{ $card->power }}</span></div>
            <div class="card-data-text"><span>{{ $card->text }}</span></div>
        </div>
    </div>
</div>
