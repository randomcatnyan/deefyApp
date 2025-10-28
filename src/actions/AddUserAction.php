<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class AddUserAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-user'>

            <label>
                <p>Name : </p>
                <input type='text' name='name' placeholder='Jean Lemec' />
            </label>

            <label>
                <p>Email : </p>
                <input type='email' name='email' placeholder='me@mymail.com' />
            </label>

            <label>
            <p>Age : </p>
                <input type='number' name='age' min='0' max='200' />
            </label>

            <br />
            <br />

            <input type='submit' value='Send'/>
        </form>
        ";
    }

    public function executePost() : string{

        $db = DeefyRepository::getInstance();

        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);

        $_SESSION["user"]["name"] = $name;
        $_SESSION["user"]["email"] = $email;
        $_SESSION["user"]["age"] = $age;
        $r = "
        <p>
        Account created<br />
        Name : " . $name . "<br/>
        Email : " . $email . "<br />
        Age : " . $age . "
        </p>";
        return $r;
    }

}
