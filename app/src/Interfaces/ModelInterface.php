<?php

declare(strict_types=1);

namespace ExadsChallenge\Interfaces;

interface ModelInterface
{
    public function findById(int $id);
    public function findAll();
}
