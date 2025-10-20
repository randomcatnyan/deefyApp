<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class AddUserAction extends Action {

    public function execute() : string{

        $r = "";

        if (isset($_POST['name'])) {
            $_SESSION["user"]["name"] = $_POST["name"];
            $_SESSION["user"]["email"] = $_POST["email"];
            $_SESSION["user"]["age"] = $_POST["age"];
            $r = "<p>" . $_SESSION["user"]["name"] . " " . $_SESSION["user"]["email"] . " " . $_SESSION["user"]["age"] . "</p>";
        } else {
            $r = "
            <form method='post' action='?action=add-user'>

                <label>
                    <p>Name : </p>
                    <input type='text' name='name' placeholder='Jean Lemec' />
                </label>

                <label>
                    <p>Email : </p>
                    <input type='text' name='email' placeholder='me@mymail.com' />
                </label>

                <label>
                <p>Age : </p>
                    <input type='text' name='age' />
                </label>

                <input type='submit' value='Send'/>
            </form>
            ";
        }

        return $r;
    }

}
