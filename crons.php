<?php

/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 11/16/2016
 * Time: 6:20 PM
 */

require (dirname(__FILE__).'/bootstrap/autoload.php');
$app =require_once dirname(__FILE__).'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture(),
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);
$controller = app()->make('App\Http\Controllers\CronsController');
$arguments = [];
return app()->call([$controller, 'run'], $arguments);