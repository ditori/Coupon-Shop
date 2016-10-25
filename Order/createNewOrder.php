<?php

    require  __DIR__ . '/../ServerConnection.php';

    $arr= array();
    $arr['order_id']= (-1);
    $arr['user_id']= intval($_POST['user_id']);
    $arr['status']= "pending";
    $arr['order_date'] = date('Y-m-d H:i:s');
    $arr['total_price']= intval($_POST['total_price']);

    $ob= new Order ($arr);
    //var_dump($ob);
    $res= $ord_dao->addOrder($ob);

    if ($res == true)
    {
        // after creation of the order finding and sending to the client the order id
        $ord = $ord_dao->getOrderByOrderObject($ob);
        echo $ord->getOrderId();
    }
    else
    {
        echo null;
    }
?>
