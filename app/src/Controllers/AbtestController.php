<?php

namespace ExadsChallenge\Controllers;

use DateTime;
use ExadsChallenge\Controllers\BaseController;
use ExadsChallenge\Libraries\ABTestHandler;

class AbtestController extends BaseController
{
    public function index()
    {
        $abTest = new ABTestHandler(3);

        $data = [
            'promotion' => $abTest->getPromotionName(),
            'design' => $abTest->selectDesign()
        ];

        self::loadView($data);
    }
}
