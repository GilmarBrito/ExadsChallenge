<?php

namespace ExadsChallenge\Controllers;

use ExadsChallenge\Core\Controller;

class PageNotFound extends Controller
{
    public function index()
    {
        self::loadView();
    }
}
