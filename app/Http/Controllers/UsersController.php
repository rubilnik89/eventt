<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller {

    public function addNewUser(Request $request) {

        $Email = $request->query('email');
        $Password = $request->query('password');

        $user = env("DB_USERNAME");
        $pass = env("DB_PASSWORD");
        $host = env("DB_HOST");
        $database = env("DB_DATABASE");
        $connection = pg_connect("host=$host dbname=$database user=$user password=$pass port=5432");
        if (!$connection) {
            die("Could not open connection to database server");
        }
        
        $result=pg_query($connection,"INSERT INTO users VALUES ('$Email','$Password');");
        if(!$result){
            echo pg_last_error($connection);
        } else {
            echo "User full successfully<br>";
        }
        
        pg_close($connection);

    }

    public function authorization(Request $request) {

        $Email = $request->query('email');
        $Password = $request->query('password');

        $user = env("DB_USERNAME");
        $pass = env("DB_PASSWORD");
        $host = env("DB_HOST");
        $database = env("DB_DATABASE");
        $connection = pg_connect("host=$host dbname=$database user=$user password=$pass port=5432");
        if (!$connection) {
            die("Could not open connection to database server");
        }
        
        $checkEmail = pg_query($connection, "SELECT email FROM users WHERE email='$Email'");
        $c_line = pg_fetch_array($checkEmail);
        $c_psswd = $c_line['email'];

        if ($c_psswd!=$Email){
            echo "You are not register";
            exit;
        };

        $result = pg_query($connection, "SELECT password FROM users WHERE email='$Email'");

        $line = pg_fetch_array($result);
        $psswd = $line['password'];


        if ($psswd == $Password){
            $result1 = pg_query($connection, "SELECT * FROM people WHERE email='$Email'");
            $line1 = pg_fetch_array($result1);

            $email=$line1['email'];
            $pass=$line['password'];
            echo "
                Email: $email<br>
                Password: $pass
            ";

        } else echo 'Incorrect password';

        pg_close($connection);

    }
}