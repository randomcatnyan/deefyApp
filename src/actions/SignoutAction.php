<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\actions\DefaultAction;

class SignoutAction extends Action {

    public function executeGet() : string{
        if ( isset( $_SESSION["user"] ) ) {
            session_unset();
        }
        $to_render = new DefaultAction();
        $to_return = $to_render();
        return $to_return;
    }

    public function executePost() : string{
        return $this->executeGet();
    }

}
