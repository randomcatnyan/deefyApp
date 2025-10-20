<?php
require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\repository\DeefyRepository;

DeefyRepository::setConfig( 'db.config.ini' );

session_start();

$dispatcher = new Dispatcher();
$dispatcher->run();

var_dump(DeefyRepository::getInstance()->getAllPlaylists());
