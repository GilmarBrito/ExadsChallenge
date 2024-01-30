<?php

declare(strict_types=1);

namespace ExadsChallenge\Core;

use ReflectionClass;

class Controller
{
    public function model($model)
    {
        //TODO: write code to get model
    }

    public static function loadView(array $data = [])
    {
        $viewFilePath = dirname(__DIR__) .
            DIRECTORY_SEPARATOR .
            'Views' .
            DIRECTORY_SEPARATOR .
            self::getFolderName() .
            DIRECTORY_SEPARATOR .
            self::getFileName() .
            '.php';

        if (file_exists($viewFilePath)) {
            require_once $viewFilePath;
        }
    }

    public function pageNotFound()
    {
        $this->loadView();
    }

    protected static function getFolderName(): string
    {
        return strtolower(basename(str_replace('\\', '/', get_called_class())));
    }

    protected static function getFileName(): string
    {
        return debug_backtrace()[2]['function'];
    }
}
