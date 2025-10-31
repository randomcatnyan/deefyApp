<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\auth\AuthProvider;

class AddUserAction extends Action {

    public function executeGet() : string{
        return "
        <h1 style='font-weight:bold; font-size:large'>Signup</h1>
        <form method='post' action='?action=add-user'>

            <label>
                <p>Email : </p>
                <input type='email' name='email' placeholder='me@mymail.com' />
            </label>

            <label>
                <p>Password : </p>
                <input type='text' name='password' minlength='10' required />
            </label>

            <br />
            <br />

            <input type='submit' value='Create account !'/>
        </form>
        ";
    }

    public function executePost() : string{

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        $to_return = "";
        if ( AuthProvider::register($email, $password) ) {
            $to_return = "
            <p>
            Account created<br />
            Email : " . $email . "<br />
            Password : " . $password . "
            </p>
            <a href=?action=signin>Sign into your account</a>
            ";
        } else {
            $to_return = "<p>Cannot create multiple accounts with one email.</p>" . $this->executeGet();
        }

        return $to_return;
    }

}
