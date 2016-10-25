<?php
    require  __DIR__ . '/../ServerConnection.php';

    $user_id = $_COOKIE["yaniv-isa-geek-userid"];

    $usr= $usr_dao->getUser($user_id);
    $res = 0;

    // if they post a first name and it is not the user current first name
    if (!empty($_POST["first_name"]) && $usr->getFirstName()==$_POST["first_name"])
    {
        //echo "first_name: " . $_POST["first_name"];
        $res = 1;
    }

    // if they post a last name and it is not the user current last name
    if (!empty($_POST["last_name"]) && $usr->getLastName()==$_POST["last_name"])
    {
        //echo "last_name: " . $_POST["last_name"];
        $res = 1;
    }

    // if they post a password and it is not the user current password
    if (!empty($_POST["password"]) && $usr->getPassword()==$_POST["password"])
    {
        //echo "password: " . $_POST["password"];
        $res = 1;
    }

    // if they post an email and it is not the user current email
    if (!empty($_POST["email"]) && $usr->getEmail()==$_POST["email"])
    {
        //echo "email: " . $_POST["email"];
        $res = 1;
    }

    echo $res;

?>
