<?php
    require  __DIR__ . '/../ServerConnection.php';

    $order_id= intval($_POST['order_id']);
    $res = true;

    $order_coupons = $ord_cpn_dao->getOrder($order_id);

    foreach ($order_coupons as $ord_cpn)
    {
        if ($res == true)
        {
            $test= $ord_cpn_dao->removeCouponFromOrder($order_id, $ord_cpn->getCouponId());
            if ($test != true)
            {
                $res= false;
                echo false;
            }
        }
    }

    if ($res == true)
    {
        echo $ord_dao->removeOrder($order_id);
    }
?>
