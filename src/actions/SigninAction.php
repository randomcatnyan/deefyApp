<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class SigninAction extends Action {

    public function executeGet() : string{
        return "hey";
    }

    public function executePost() : string{
        return "";
    }

}
