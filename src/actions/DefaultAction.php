<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class DefaultAction extends Action {

    public function execute() : string{
        return "yo";
    }

}
