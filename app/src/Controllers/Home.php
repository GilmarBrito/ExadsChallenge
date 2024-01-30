<?php

namespace ExadsChallenge\Controllers;

use ExadsChallenge\Core\Controller;

class Home extends Controller
{
    public function index()
    {
        self::loadView();
    }
}
