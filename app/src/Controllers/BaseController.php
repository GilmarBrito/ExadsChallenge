<?php

declare(strict_types=1);

namespace ExadsChallenge\Controllers;

use ExadsChallenge\Interfaces\ModelInterface;

class BaseController
{
    public const HTTP_METHOD_GET = "GET";
    public const HTTP_METHOD_HEAD = "HEAD";
    public const HTTP_METHOD_POST = "POST";
    public const HTTP_METHOD_PUT = "PUT";
    public const HTTP_METHOD_DELETE = "DELETE";
    public const HTTP_METHOD_CONNECT = "CONNECT";
    public const HTTP_METHOD_OPTIONS = "OPTIONS";
    public const HTTP_METHOD_TRACE = "TRACE";
    public const HTTP_METHOD_PATCH = "PATCH";
    public $model;
    public function model(ModelInterface $model)
    {
        $this->model = new $model();
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
        return strtolower(basename(str_replace(['\\', 'Controller'], ['/', ''], get_called_class())));
    }

    protected static function getFileName(): string
    {
        return debug_backtrace()[2]['function'];
    }
    protected function getRequestMethod(): string
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }
}
