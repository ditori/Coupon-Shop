<?php
    require  __DIR__ . '/../ServerConnection.php';

    $user_name= $_POST['username'];
    $res= $usr_dao->checkUser($user_name);

    echo $res;
?>
