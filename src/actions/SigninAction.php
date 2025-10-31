<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\auth\AuthProvider;

class SigninAction extends Action {

    public function executeGet() : string{
        return "
        <h1 style='font-weight:bold; font-size:large'>Login</h1>
        <form method='post' action='?action=signin'>

            <label>
                <p>Email : </p>
                <input type='email' name='email' placeholder='me@mymail.com' />
            </label>

            <label>
            <p>Password : </p>
            <input type='password' name='password' minlength='4' />
            </label>

            <br />
            <br />

            <input type='submit' value='Login'/>

        </form>
        ";
    }

    public function executePost() : string{

        $to_return = "<p>Wrong email or password, please try again.</p>" . $this->executeGet();

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ( AuthProvider::signin($email, $password) ) {
            $_SESSION["user"] = $email;
            $to_return = "<p>Succesfully signed in !</p>";
        }
        return $to_return;
    }

}
