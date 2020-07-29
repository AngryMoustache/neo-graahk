<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class DeckBuilderController extends Controller
{
    protected $pagination;

    public function page(Request $request)
    {
        $user = User::find($request->post('user'));
        $this->pagination = (object)$request->post('pagination');

        $cards = $this->fetchCards();
        if ($cards->isEmpty() && $this->pagination->page !== 1) {
            $this->pagination->page = 1;
            $this->fetchCards();
        }

        return [
            'pagination' => $this->pagination,
            'view' => view('api.deck-builder.page', [
                    'cards' => $cards,
                    'user' => $user
                ])->render()
        ];
    }

    protected function fetchCards()
    {
        $page = $this->pagination->page;
        $perPage = $this->pagination->perPage;
        $total = Card::count();
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
            ->limit($perPage)
            ->get();

        $this->pagination->page = $page;

        return $cards;
    }
}
