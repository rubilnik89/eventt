<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller {

    public function createConnection()
    {
        $dbUserName = env("DB_USERNAME");
        $dbPassword = env("DB_PASSWORD");
        $dbHost = env("DB_HOST");
        $databaseName = env("DB_DATABASE_NAME");
        $connection = pg_connect("host=$dbHost dbname=$databaseName user=$dbUserName password=$dbPassword");
        if (!$connection) {
            die("Could not open connection to database server");
        }
        return $connection;
    }

    public function createNewUser(Request $request) {
        $email = $request->query('email');
        $password = $request->query('password');

        $connection = $this->createConnection();
        
        $result=pg_query($connection,"INSERT INTO users VALUES ('$email','$password')");
        if(!$result){
            echo pg_last_error($connection);
        } else {
            echo "User full successfully<br>";
        }
        
        pg_close($connection);

    }

    public function loginUser(Request $request) {

        $email = $request->query('email');
        $password = $request->query('password');

        $connection = $this->createConnection();

        $emailResult = pg_query($connection, "SELECT email FROM users WHERE email='$email'");
        $emailArray = pg_fetch_array($emailResult);
        $retrievedEmail = $emailArray['email'];

        if (!$retrievedEmail){
            echo "User not registered.";
            exit;
        };

        $passwordResult = pg_query($connection, "SELECT password FROM users WHERE email='$email'");
        $passwordArray = pg_fetch_array($passwordResult);
        $retrievedPassword = $passwordArray['password'];

        if ($retrievedPassword == $password){
            $userResult = pg_query($connection, "SELECT * FROM users WHERE email='$email'");
            $userArray = pg_fetch_array($userResult);
            $email=$userArray['email'];

            echo "
                Email: $email<br>
            ";
        } else {
            echo 'Incorrect password';
        }

        pg_close($connection);
    }
}