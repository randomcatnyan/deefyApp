<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

abstract class Action {

    protected ?string $http_method = null;
    protected ?string $hostname = null;
    protected ?string $script_name = null;

    public function __construct(){

        $this->http_method = $_SERVER['REQUEST_METHOD'];
        $this->hostname = $_SERVER['HTTP_HOST'];
        $this->script_name = $_SERVER['SCRIPT_NAME'];

    }

    public function __invoke() {
        $to_return = "<p>please send a GET or POST request</p>";
        switch($this->http_method) {
            case "GET":
                $to_return = $this->executeGet();
                break;
            case "POST":
                $to_return = $this->executePost();
                break;
        }
        return $to_return;
    }

    abstract public function executeGet() : string;

    abstract public function executePost() : string;

}
