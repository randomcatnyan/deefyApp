<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\actions\DefaultAction;

class SignoutAction extends Action {

    public function executeGet() : string{
        if ( isset( $_SESSION["user"] ) ) {
            session_destroy();
        }
        return ( new DefaultAction()() );
    }

    public function executePost() : string{
        return $this->executeGet();
    }

}
