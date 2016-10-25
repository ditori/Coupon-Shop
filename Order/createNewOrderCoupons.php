<?php

    require  __DIR__ . '/../ServerConnection.php';

    $user_id= intval($_POST['user_id']);
    $order_id= intval($_POST['order_id']);

    $crt_cpns = $crt_dao->getCart($user_id);
    $res= true;

    foreach ($crt_cpns as $crt_cpn)
    {
        if ($res)
        {
            $arr= array();
            $arr["order_id"]= $order_id;
            $arr["coupon_id"]= $crt_cpn->getCouponId();
            $arr["quantity"]= $crt_cpn->getQuantity();

            $ob= new OrderCoupon ($arr);
            $res= $ord_cpn_dao->addCouponToOrder($ob);
        }
    }

    echo json_encode($res);
?>
