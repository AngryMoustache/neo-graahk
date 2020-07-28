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

        return view('api.deck-builder.page', [
            'cards' => $cards,
            'user' => $user
        ]);
    }

    protected function fetchCards()
    {
        return Card::orderBy('name')
            ->with('attachment', 'animatedAttachment', 'sets')
            ->offset(($this->pagination->page - 1) * 8)
            ->limit(8)
            ->get();
    }
}
