<?php
namespace iutnc\deefy\auth;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\AuthnException;

class AuthProvider {

    public static function signin(string $email, string $password) {

        $db = DeefyRepository::getInstance();

    }

    public static function register(string $email, string $password) {

        $db = DeefyRepository::getInstance();

    }

}
