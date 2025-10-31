<?php
namespace iutnc\deefy\auth;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class Authz {

    public static function checkRole(int role):bool {

        $db = DeefyRepository::getInstance();

    }

    public static function checkPlaylistOwner():bool {

        $db = DeefyRepository::getInstance();

    }

}
