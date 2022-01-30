<?php

use App\App;
use App\Modules\Admin\AdminModule;
use App\Modules\Blog\BlogModule;
use App\Renderer;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

define("VIEWS", dirname(__DIR__). DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR);
define("SOURCES", dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR);
function sources (string $sources): string {
    return SOURCES . str_replace("/", DIRECTORY_SEPARATOR, $sources);
}


$render = new Renderer(VIEWS);

$app = new App([
    BlogModule::class,
    AdminModule::class
], [
    "renderer" => $render
]);


$app->run();

