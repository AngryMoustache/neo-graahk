<?php

namespace App\Http\Controllers\Api;

use App\DeckGraph;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;

class DeckBuilderController extends Controller
{
    protected $pagination;
    protected $filters;

    public function page(Request $request)
    {
        $user = User::find($request->post('user'));
        $this->pagination = (object)$request->post('pagination');
        $this->filters = (object)$request->post('filters');

        $this->cards = $this->fetchCards($request);

        return [
            'pagination' => $this->pagination,
            'view' => view('api.deck-builder.page', [
                    'cards' => $this->cards,
                    'user' => $user
                ])->render()
        ];
    }

    public function save(Request $request)
    {
        $user = User::find($request->post('user'));
        $deck = Deck::find($request->post('deck')['id']);
        if ($deck->user->id !== $user->id) {
            abort(403);
        }

        $deck->name = $request->post('deck')['list']['name'];
        $deck->save();

        $pivots = [];
        collect($request->post('deck')['list']['cards'])
            ->each(function ($card) use (&$pivots) {
                $pivots[] = [
                    'showcase' => ($card['showcase'] ?? false) ? 1 : 0,
                    'amount' => $card['amount'],
                    'card_id' => $card['id'],
                ];
            });

        $deck->cards()->detach();
        $deck->cards()->sync($pivots);
    }

    protected function fetchCards(Request $request)
    {
        $total = Card::query();
        $total = $this->applyFilters($total);
        $total = $total->count();

        $page = $this->pagination->page;
        $perPage = $this->pagination->perPage;
        $maxPage = ceil($total / $perPage);

        if ($page <= 0) {
            $page = $maxPage;
        }

        if ($page > $maxPage) {
            $page = 1;
        }

        $cards = Card::orderBy('name')
            ->with('attachment', 'animatedAttachment', 'sets')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage);

        $cards = $this->applyFilters($cards);

        $this->pagination->arrows = ($total > $this->pagination->perPage);
        $this->pagination->page = $page;

        return $cards->get();
    }

    protected function applyFilters($query)
    {
        // Searchbar
        if (!empty($this->filters->search)) {
            $query = $query->where('name', 'LIKE', "%{$this->filters->search}%")
                ->orWhere('masked_text', 'LIKE', "%{$this->filters->search}%")
                ->orWhere('stats_json->power', $this->filters->search)
                ->orWhere('stats_json->cost', $this->filters->search)
                ->orWhere('stats_json->type', $this->filters->search)
                ->orWhere('stats_json->tribe', $this->filters->search);
        }

        // Set filter
        if (!empty($this->filters->sets)) {
            foreach ($this->filters->sets as $set) {
                $query = $query->orWhereHas('sets', fn ($q) => $q->where('sets.id', $set));
            }
        }

        // Format filter
        if (!empty($this->filters->formats)) {
            foreach ($this->filters->formats as $format) {
                $query = $query->orWhereHas('formats', fn ($q) => $q->where('formats.id', $format));
                $query = $query->orWhereHas('sets', function ($query) use ($format) {
                    $query->whereHas('formats', fn ($q) => $q->where('formats.id', $format));
                });
            }
        }

        return $query;
    }
}
