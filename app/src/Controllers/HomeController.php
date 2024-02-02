<?php

declare(strict_types=1);

namespace ExadsChallenge\Controllers;

use ExadsChallenge\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'database' => filter_input(INPUT_ENV, 'DB_DATABASE'),
        ];
        self::loadView($data);
    }
}
