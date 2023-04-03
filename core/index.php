<?php

use Src\Router\Api;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $api = (new Api($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_REQUEST))->route();
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage(), "code" => $e->getCode()]);
}
