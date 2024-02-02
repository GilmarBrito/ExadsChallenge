<?php

namespace ExadsChallenge\Controllers;

use ExadsChallenge\Controllers\BaseController;

class PageNotFoundController extends BaseController
{
    public function index()
    {
        self::loadView();
    }
}
