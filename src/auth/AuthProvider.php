<?php
namespace iutnc\deefy\auth;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\AuthnException;

class AuthProvider {

    public static function signin(string $email, string $password):bool {

        $db = DeefyRepository::getInstance();

        return true;

    }

    public static function register(string $email, string $password):bool {

        $db = DeefyRepository::getInstance();

    }

    public static function getSignedInUser():string {
        if ( isset( $_SESSION["user"] ) ) {
            return $_SESSION["user"];
        }
        throw new AuthnException("No user signed in");
    }

}
