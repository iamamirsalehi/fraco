<?php

use Symfony\Component\HttpFoundation\Response;

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response as PeceeResponse;
use Pecee\Http\Request;

function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}

function route(?string $name = null, $parameters = null, ?array $getParams = null)
{
    return 'http://' . (Router::getUrl($name, $parameters, $getParams)->getAbsoluteUrl());
}

function response(): PeceeResponse
{
    return Router::response();
}

function request(): Request
{
    return Router::request();
}

function requestData(?string $key = null)
{
    if (is_null($key)) {
        return request()->getInputHandler()->all();
    }

    return request()->getInputHandler()->get($key)->value;
}

function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

function config(string $config, $key)
{
    $configFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config/' . $config . '.php';
    if (!file_exists($configFilePath)) {
        return null;
    }

    $configContent = include $configFilePath;

    if (isset($configContent[$key])) {
        return $configContent[$key];
    }

    return null;
}

function view(string $path, array $data = [], int $status = 200, array $headers = [])
{
    $path = explode('.', $path);

    $defaultViewDirectoryName = config('view', 'default_app_view');

    $viewsPath = config('view', 'path');

    $fullPath = $viewsPath . DIRECTORY_SEPARATOR . $defaultViewDirectoryName;
    foreach ($path as $item) {
        $fullPath .= DIRECTORY_SEPARATOR . $item;
    }

    $fullPath .= '.php';

    if (file_exists($fullPath)) {
        ob_start();
        extract($data);

        include_once $fullPath;

        $content = ob_get_clean();

        return (new Response($content, $status, $headers))->getContent();
    }

    return null;
}


