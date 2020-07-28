@extends('deck-layout')

@section('content')
    <div class="container">
        <div class="container-body">
            <deck-builder :user="{{ optional(auth()->user())->id }}">
                <template v-slot:default="slot">
                    <div class="db-livewire">
                        <div class="db-header">
                            {{-- Header --}}
                        </div>

                        <div class="db-content" v-html="slot.content"></div>
                    </div>

                    <div class="db-content-deck-list">
                        <input
                            class="db-content-deck-list-title"
                            wire:model="deckName"
                        >

                        <div class="db-content-deck-list-buttons">
                            <div class="db-content-deck-list-buttons-counter">
                                <h2 @if ($deck->cards->count() !== 30) class="red" @endif>
                                    {{ $deck->cards->count() }}/30
                                </h2>
                            </div>

                            <div class="db-content-deck-list-buttons-save">
                                <a class="button">Save deck</a>
                            </div>
                        </div>

                        <table class="db-content-deck-list-cards" cellpadding="0" cellspacing="1">
                            {{-- @foreach ($cardList as $key => $card)
                                <tr class="db-content-deck-list-cards-card">
                                    <td class="db-content-deck-list-cards-card-amount" wire:click="addCard({{ $key }})">
                                        x{{ $card['amount'] }}
                                    </td>
                                    <td
                                        wire:click="removeCard({{ $key }})"
                                        class="db-content-deck-list-cards-card-name"
                                        style="background-image: url({{ $card['image'] }})"
                                    >
                                        <span>{{ $card['name'] }}</span>
                                    </td>
                                    <td class="db-content-deck-list-cards-card-cost">
                                        {{ $card['cost'] }}
                                    </td>
                                </tr>
                            @endforeach --}}
                        </table>
                    </div>
                </div>
            </template>
        </deck-builder>
    </div>
@endsection
