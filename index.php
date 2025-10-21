<?php
require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\repository\DeefyRepository;

DeefyRepository::setConfig( 'db.config.ini' );

session_start();

$dispatcher = new Dispatcher();
$dispatcher->run();

// je n'avais pas le temps de faire du css propre
// alors il y a des <br /> un peu partout
// dans le html
