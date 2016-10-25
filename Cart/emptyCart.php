<?php
    require  __DIR__ . '/../ServerConnection.php';

    $user_id= $_POST['user_id'];
    $crt_cpns= $crt_dao->getCart($user_id);

    $res= true;

    foreach ($crt_cpns as $crt_cpn)
    {
        if ($res)
        {
            $coupon_id= $crt_cpn->getCouponId();
            $res= $crt_dao->removeCouponFromCart($user_id, $coupon_id);
        }
    }

    echo $res;
?>
