<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

// Can either be seperated or combined with curly braces
use App\Core\{Router, Request};

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
