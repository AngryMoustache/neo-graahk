<?php

namespace App\Http\Controllers;

use App\Models\Set;

class CollectionController extends Controller
{
    public function index()
    {
        $sets = Set::get();

        return view('collection.index', [
            'sets' => $sets
        ]);
    }
}
