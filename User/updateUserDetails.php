<?php
    require  __DIR__ . '/../ServerConnection.php';

    $user_id = $_COOKIE["yaniv-isa-geek-userid"];

    $usr= $usr_dao->getUser($user_id);

    //var_dump($usr);

    // if they post a first name then switch it with the one in the user object
    if (!empty($_POST["first_name"]))
    {
        $usr->setFirstName($_POST["first_name"]);
    }

    // if they post a last name then switch it with the one in the user object
    if (!empty($_POST["last_name"]))
    {
        $usr->setLastName($_POST["last_name"]);
    }

    // if they post a password then switch it with the one in the user object
    if (!empty($_POST["password"]))
    {
        $usr->setPassword($_POST["password"]);
    }

    // if they post an email then switch it with the one in the user object
    if (!empty($_POST["email"]))
    {
        $usr->setEmail($_POST["email"]);
    }

    //echo "<br><br>";
    //var_dump($usr);

    echo $usr_dao->updateUser($usr);

?>
