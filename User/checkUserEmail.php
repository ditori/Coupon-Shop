<?php
    require  __DIR__ . '/../ServerConnection.php';

    $email= $_POST['email'];
    $res= $usr_dao->checkEmail($email);

    echo $res;
?>
