<?php
require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;

session_start();

$dispatcher = new Dispatcher();
$dispatcher->run();
