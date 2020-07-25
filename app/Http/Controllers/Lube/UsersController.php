<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\CardForm;
use App\Lube\Forms\UserForm;
use App\Models\Card;
use App\Models\User;

class UsersController extends LubeController
{
    public $model = User::class;
    public $form = UserForm::class;
    public $routeBase = 'users';

    public $label = 'User';
    public $labelPlural = 'Users';

    public $searchable = [
        'name'
    ];
}
