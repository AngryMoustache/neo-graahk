<?php

namespace App\Http\Controllers\Api;

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

        $cards = $this->fetchCards($request);

        return [
            'pagination' => $this->pagination,
            'view' => view('api.deck-builder.page', [
                    'cards' => $cards,
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
                    'showcase' => $card['showcase'] ? 1 : 0,
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

        $this->pagination->page = $page;

        return $cards->get();
    }

    protected function applyFilters($query)
    {
        if (!empty($this->filters->search)) {
            $query = $query->where('name', 'LIKE', "%{$this->filters->search}%")
                ->orWhere('masked_text', 'LIKE', "%{$this->filters->search}%")
                ->orWhere('stats_json->power', $this->filters->search)
                ->orWhere('stats_json->cost', $this->filters->search)
                ->orWhere('stats_json->type', $this->filters->search)
                ->orWhere('stats_json->tribe', $this->filters->search);
        }

        return $query;
    }
}
