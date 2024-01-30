<?php

namespace ExadsChallenge\Core;

class Framework
{
    private const CONTROLLER_NAMESPACE = '\\ExadsChallenge\\Controllers\\';
    protected string $controllerName = '';
    protected object|null $controllerObject = null;
    protected string $methodName = '';
    protected array $params = [];
    protected bool $hasAction = false;

    public function __construct()
    {
        $uri = $this->parseUrl();
        $this->controllerName = $uri[0] ?? '';
        $this->methodName = $uri[1] ?? '';
        $this->params = count($uri) > 2 ? array_slice($uri, 2) : [];

        $this->dispatch();
    }

    private function parseUrl(): array
    {
        return explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
    }

    private function dispatch(): self
    {

        $this
            ->setController()
            ->setMethod()
            ->checkRoute();

        call_user_func_array([$this->controllerObject, $this->methodName], $this->params);

        return $this;
    }

    private function setController(): self
    {
        if ($this->controllerName === '') {
            $this->controllerName = 'home';
        }

        $this->controllerName = self::CONTROLLER_NAMESPACE . ucfirst($this->controllerName);

        if (class_exists($this->controllerName, true) === false) {
            $this->controllerName = self::CONTROLLER_NAMESPACE . 'PageNotFound';
        }

        $this->controllerObject = new $this->controllerName();

        return $this;
    }

    private function setMethod(): self
    {
        if ($this->methodName === '') {
            $this->methodName = 'index';

            return $this;
        }

        $this->methodName = strtolower($this->methodName);

        return $this;
    }

    private function checkRoute(): self
    {
        if (method_exists($this->controllerName, $this->methodName) === false) {
            $this->controllerName = self::CONTROLLER_NAMESPACE . 'PageNotFound';
            $this->controllerObject = new $this->controllerName();
            $this->methodName = 'index';
        }

        return $this;
    }
}
