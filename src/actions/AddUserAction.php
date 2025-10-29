<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class AddUserAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-user'>


            <label>
                <p>Email : </p>
                <input type='email' name='email' placeholder='me@mymail.com' />
            </label>

            <label>
                <p>Password : </p>
                <input type='password' name='password' minlength='4' required />
            </label>

            <br />
            <br />

            <input type='submit' value='Send'/>
        </form>
        ";
    }

    public function executePost() : string{

        $db = DeefyRepository::getInstance();

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        $to_return = "
        <p>
        Account created<br />
        Email : " . $email . "<br />
        Password : " . $password . "
        </p>";

        return $to_return;
    }

}
